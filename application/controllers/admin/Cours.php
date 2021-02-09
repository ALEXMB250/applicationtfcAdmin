<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cours extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
    {
		$cours = $this->Common_model->select("cours");
		$promotions = $this->Common_model->select("promotion");

		$data["page_title"] = "Cours";
		$data["cours"] = $cours;
		$data["promotions"] = $promotions;
		$data["slide_bar"] = "cours";
		$data["main_containt"] = $this->load->view("cours/list", $data, true);
		

        $this->load->view("index", $data);
    }

    
    public function add()
    {
        if ($_POST) {

            $data = [
                "nom_cours" => $_POST["nom_cours"],
                "id_promotion" => $_POST["promotion"]
            ];
    
            $data = $this->security->xss_clean($data);
        
            $this->Common_model->insert($data, 'cours');

            $this->index();

        }
	}
	
	public function edit($primary_key)
    {
		$course = (array) $this->Common_model->get_single_info($primary_key, "id_cours", "cours");
		
		if ($_POST) {

			$data = [
                "nom_cours" => $_POST["nom_cours"]
            ];

			$data = $this->security->xss_clean($data);

			$this->Common_model->update($data, $primary_key, "id_cours", "cours");

			$this->index();
			
		} else{
			
			$data["page_title"] = "Cours";
			$data["course"] = $course;
			$data["slide_bar"] = "cours";
			$data["main_containt"] = $this->load->view("cours/edit", $data, true);			

			$this->load->view("index", $data);
		}	
		
	}
	
	public function delete($primary_key)
    {
		$this->Common_model->delete($primary_key, "id_cours", 'cours');
		$this->index();			
    }

}
