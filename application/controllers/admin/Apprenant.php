<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apprenant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
    {
		$promotions = $this->Common_model->select("promotion");		
		$data = array();

		foreach ($promotions as $promotion_key => $promotion) 
		{
			$data['promotions'][$promotion_key] = $promotion;
			$data['promotions'][$promotion_key]["apprenants"] = $this->Common_model->select_by_filter($promotion["id_promotion"], "promotion_id", "apprenant");
		}

		
		if (isset($qstring)) {
			$data["status"] = $qstring;
		}

		$data["page_title"] = "Apprenant";		
		$data["slide_bar"] = "apprenant";
		$data["main_containt"] = $this->load->view("apprenant/list", $data , true);		

        $this->load->view("index", $data);
    }

    
    public function add()
    {
		if ($_POST) 
		{
			$promotion = $_POST["promotion"];

			$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

			if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes))
			{
				if(is_uploaded_file($_FILES['file']['tmp_name']))
				{
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
					fgetcsv($csvFile);
					while(($line = fgetcsv($csvFile, 1000, ";")) !== FALSE)
					{
						$data =[
							"email" => $line[0],
							"mdp" => $this->genererMdp(),
							"promotion_id" => $promotion
						];

						$this->Common_model->insert($data,"apprenant");
					}

					fclose($csvFile);
					$qstring["status"] = 'Success';
				}
				else{
					$qstring["status"] = 'Error';
				}
			}
			
			else{
				$qstring["status"] = 'Fichier invalide ! <br> Veuillez selectionnez un fichier .csv';
			}

			redirect("Apprenant", $qstring);
		}

	}

	function genererMdp()
    {
	  $taille = 6;
      $cars="0123456789";
      $mdp='';
      $long=strlen($cars);

      srand((double)microtime()*1000000);

      for($i=0;$i<$taille;$i++)$mdp=$mdp.substr($cars,rand(0,$long-1),1);

      return $mdp;
	}
	//echo genererMdp(6);
	
	public function edit($primary_key)
    {
		$apprenant = (array) $this->Common_model->get_single_info($primary_key, "id_apprenant", "apprenant");
		
		if ($_POST) {

			$data = [
                "email" => $_POST["email"],
                "mdp" => $_POST["mdp"]
            ];

			$data = $this->security->xss_clean($data);

			$this->Common_model->update($data, $primary_key, "id_apprenant", "apprenant");

			redirect("Apprenant");
			
		} else{
			
			$data["page_title"] = "Apprenant";
			$data["apprenant"] = $apprenant;
			$data["slide_bar"] = "apprenant";
			$data["main_containt"] = $this->load->view("apprenant/edit", $data, true);			

			$this->load->view("index", $data);
		}	
	}

	
	public function delete($primary_key)
    {
		$this->Common_model->delete($primary_key, "id_apprenant", 'apprenant');
		redirect("Apprenant");
    }

}
