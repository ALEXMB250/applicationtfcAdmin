<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enseignant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
    {
		$enseignants = $this->Common_model->select("enseignant");		
		$data = array();

		foreach ($enseignants as $enseignant_key => $enseignant) 
		{
			$data[$enseignant_key]['enseignant'] = $enseignant;

			if(!empty($enseignant))
			{
				$promotions_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "promotion_affectee");
				$cours_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "cours_affecte");
				
				foreach ($promotions_affectes as $promotion_affecte) 
				{
					$promotion = $this->Common_model->select_by_filter($promotion_affecte["promotion_id"], "id_promotion", "promotion");
					if (!empty($promotion)) {
						$data[$enseignant_key]["promotions"][] = $promotion;
					}
					
				}

				foreach ($cours_affectes as $cours_affecte)
				{
					$cours = $this->Common_model->select_by_filter($cours_affecte["cours_id"], "id_cours", "cours");
					if (!empty($cours) && $enseignant["id_enseignant"] == $cours_affecte["enseignant_id"]) {
						$data[$enseignant_key]["cours"][] = $cours;
					}
				}
			}
		}

		// echo "<pre>";
		// var_dump($data);die();
		// echo "</pre>";


		$data["enseignants"] = $data;
		$data["page_title"] = "Enseignant";		
		$data["slide_bar"] = "enseignant";

		$data["main_containt"] = $this->load->view("enseignant/list", $data , true);		

        $this->load->view("index", $data);
    }

    
    public function add()
    {
		if ($_POST) 
		{
			$data = [
                "email" => $_POST["email"],
                "mdp" => $_POST["mdp"]
			];
			
			$data = $this->security->xss_clean($data);
			$enseignant_id = $this->Common_model->insert($data,"enseignant");

			$promotions = $_POST['promotions'];
			$courses = $_POST['cours'];

			foreach ($courses as $course) {
				$data = [
					"cours_id" => $course,
					"enseignant_id" => $enseignant_id
				];

				$this->Common_model->insert($data,"cours_affecte");
			}

			foreach ($promotions as $promotion) {
				$data = [
					"promotion_id" => $promotion,
					"enseignant_id" => $enseignant_id
				];

				$this->Common_model->insert($data,"promotion_affectee");
			}


			redirect("Enseignant");

		}

		$data["cours"] = $this->Common_model->select("cours");
		$data["promotions"] = $this->Common_model->select("promotion");

		$data["page_title"] = "Enseignant";
		$data["slide_bar"] = "Enseignant";
		$data["main_containt"] = $this->load->view("enseignant/add", $data, true);			

		$this->load->view("index", $data);
	}
	
	public function edit($primary_key)
    {
		
		
		if ($_POST) {

			$data = [
                "email" => $_POST["email"],
                "mdp" => $_POST["mdp"]
			];

			$enseignant = (array) $this->Common_model->get_single_info($primary_key, "id_enseignant", "enseignant");
			$cours_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "cours_affecte");

			var_dump($cours_affectes);die();

			foreach ($cours_affectes as $key => $value) {
				$data = [
					"email" => $_POST["email"],
					"mdp" => $_POST["mdp"]
				];

				$this->Common_model->update($data, $value['id_cours_affecte'], "id_cours_affecte", "cours_affecte");
			}

			// foreach ($courses as $key => $course) {
			// 	$data = [
			// 		"cours_id" => $course,
			// 		"enseignant_id" => $enseignant_id
			// 	];

			// 	$this->Common_model->insert($data,"cours_affecte");
			// }
			
			
			$data = $this->security->xss_clean($data);
			$enseignant_id = $this->Common_model->insert($data,"enseignant");
			$this->Common_model->update($data, $primary_key, "id_enseignant", "enseignant");
			$promotions_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "promotion_affectee");


			$promotions = $_POST['promotions'];
			$courses = $_POST['cours'];

			foreach ($courses as $key => $course) {
				$data = [
					"cours_id" => $course,
					"enseignant_id" => $enseignant_id
				];

				// $this->Common_model->insert($data,"cours_affecte");
				$this->Common_model->update($data, $enseignant['cours'], "id_cours_affecte", "cours_affecte");
			}

			foreach ($promotions as $key => $promotion) {
				$data = [
					"promotion_id" => $promotion,
					"enseignant_id" => $enseignant_id
				];

				// $this->Common_model->insert($data,"promotion_affectee");
				$this->Common_model->update($data, $primary_key, "id_promotion", "promotion");
			}			
			redirect("Enseignant/index");			
		}

		$enseignant = $this->get_enseignant_data($primary_key);

		$data['promotions'] = $this->Common_model->select("promotion");
		$data['cours'] = $this->Common_model->select("cours");
		$data["page_title"] = "Enseignant";
		$data["enseignant"] = $enseignant;
		$data["slide_bar"] = "enseignant";

		$data["main_containt"] = $this->load->view("enseignant/edit", $data, true);			

		$this->load->view("index", $data);		
	}

	public function get_enseignant_data($primary_key)
	{
		$enseignant = (array) $this->Common_model->get_single_info($primary_key, "id_enseignant", "enseignant");
		$data["enseignant"] = $enseignant;
		
		$promotions_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "promotion_affectee");
		$cours_affectes = $this->Common_model->select_by_filter($enseignant["id_enseignant"], "enseignant_id", "cours_affecte");

		foreach ($promotions_affectes as $promotion_affecte) 
		{
			$promotion = $this->Common_model->select_by_filter($promotion_affecte["promotion_id"], "id_promotion", "promotion");
			if (!empty($promotion)) {
				$data["promotions"][] = $promotion;
			}			
		}

		foreach ($cours_affectes as $cours_affecte) 
		{
			$cours = $this->Common_model->select_by_filter($cours_affecte["id_cours_affecte"], "id_cours", "cours");
			if (!empty($cours)) {
				$data["cours"][] = $cours;
			}
		}

		return $data;		

	}
	
	public function delete($primary_key)
    {
		$this->Common_model->delete($primary_key, "id_enseignant", 'enseignant');
		redirect("Enseignant");			
    }

}
