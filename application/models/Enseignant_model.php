<?php
class Enseignant_model extends CI_Model {

    public function get_all_enseignants()
    {          
        return $this->db->query(
			"
			SELECT * FROM `cours_affecte`, `enseignant`, `cours`, `promotion_affectee`, `promotion`
			WHERE 
				enseignant.id_enseignant = cours_affecte.enseignant_id
				AND cours.id_cours = cours_affecte.cours_id
				AND enseignant.id_enseignant = promotion_affectee.enseignant_id
				AND promotion_affectee.promotion_id = promotion.id_promotion

			")->result_array();

	}

}
?>
