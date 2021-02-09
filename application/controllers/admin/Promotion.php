<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends CI_Controller {

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
			$data['promotions'][$promotion_key]["cours"] = $this->Common_model->select_by_filter($promotion["id_promotion"], "id_promotion", "cours");
		}

		$data["page_title"] = "Promotion";
		$data["slide_bar"] = "promotion";
		$data["main_containt"] = $this->load->view("promotion/list", $data, true);
		

        $this->load->view("index", $data);
    }

    
    public function add()
    {
        if ($_POST) {

            $data = [
                "nom_promotion" => $_POST["nom_promotion"]
            ];
    
            $data = $this->security->xss_clean($data);
        
            $this->Common_model->insert($data, 'promotion');

            $this->index();

        }
	}
	
	public function edit($primary_key)
    {
		$promotion = (array) $this->Common_model->get_single_info($primary_key, "id_promotion", "promotion");
		
		if ($_POST) {

			$data = [
                "nom_promotion" => $_POST["nom_promotion"]
            ];

			$data = $this->security->xss_clean($data);

			$this->Common_model->update($data, $primary_key, "id_promotion", "promotion");

			$this->index();
			
		} else{
			
			$data["page_title"] = "Promotion";
			$data["promotion"] = $promotion;
			$data["slide_bar"] = "promotion";
			$data["main_containt"] = $this->load->view("Promotion/edit", $data, true);			

			$this->load->view("index", $data);
		}	
		
	}
	
	public function delete($primary_key)
    {
		$this->Common_model->delete($primary_key, "id_promotion", 'promotion');
		$this->index();			
    }

}
