<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
    {
        
        if ($_POST) {

            $user_login = $_POST["email"];
            $user_pwd = $_POST["mdp"];

            $user_data = $this->Login_model->check_user($user_login, $user_pwd);

            if (!empty($user_data)) {

                $this->create_user_session($user_data->id_admin);
				$this->load->view("index");
                redirect(base_url('Enseignant'));
				
            }else{

                $this->session->set_flashdata('error_msg', 'Mot de passe ou login incorrect');
                redirect(base_url('login'));
            }

		}
		
        $data["page_title"] = "login";
        $this->load->view("login", $data);
    }

    public function logout(){

        $this->session->sess_destroy();
        redirect(base_url('login'));

    }

    
    public function add()
    {
        if ($_POST) {
            
            $user_id = $this->add_user();

            $data = [
                "nom" => $_POST["nom"],
                "postnom" =>  $_POST["postnom"],
                "prenom" =>  $_POST["prenom"],
                "email" =>  $_POST["email"],
                "telephone" =>  $_POST["phone"],
                "utilisateur_id" => $user_id,
                "adresse_client_id" => $this->add_address(),
                "id_entreprise" => 1
            ];
    
            $data = $this->security->xss_clean($data);
        
            $this->Common_model->insert($data, 'client');
            $this->create_user_session($user_id);

            redirect(base_url(''));

        }

        $data["page_title"] = "inscription";
        $data["pays_list"] = $this->Common_model->select("pays");
        $this->load->view('pages/register', $data);
    }

    private function create_user_session($user_id)
    {
        $user = $this->Common_model->get_single_info($user_id, "id_admin", "admin");

        $data = [
            'id_admin' => $user->id_admin ,
            'email' => $user->email,
            'mdp' => $user->mdp
        ];

        $this->session->set_userdata($data);
    }

    private function add_user()
    {
        $data = [
            "login" =>  $_POST["email"],
            "mdp" =>  $_POST["pwd"],
            "role_id" =>  3,
            "id_entreprise" => 1
        ];

        $data = $this->security->xss_clean($data);
    
        $user_id = $this->Common_model->insert($data, 'utilisateur');

        return $user_id;
    }

    private function add_address()
    {
        $data = [
            "numero" =>  $_POST["numero"],
            "avenue" =>  $_POST["avenue"],
            "quartier" =>  $_POST["quartier"],
            "ville" => $_POST["ville"],
            "pays_id" => $_POST["pays"]
        ];

        $data = $this->security->xss_clean($data);
    
        $address_id = $this->Common_model->insert($data, 'adresse_client');

        return $address_id;
    }


}
