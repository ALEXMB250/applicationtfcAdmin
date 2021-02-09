<?php
class Common_model extends CI_Model {

	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }


    function update($data, $id, $refColumn, $table){
        $this->db->where($refColumn,$id);
        $this->db->update($table, $data);
        return;
    } 

    function delete($id, $column, $table){
        $this->db->where($column, $id);
        $this->db->delete($table);
        return true;
    }

    function restore($id, $column, $table){
        $data = $this->get_single_info($id, $column, $table);
        $data->is_deleted = 0;
        $this->db->where($column, $id);
        $this->db->update($table, (array) $data);

        return true;
    }


    function select($table){
        $this->db->select();
        $this->db->from($table);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    function select_by_filter($value, $column_name, $table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where($column_name, $value);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 


    public function is_email_duplicated($email){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    function get_single_info($id, $column, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column, $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }



    public function upload_image($input)
    {
        $config['upload_path']          = './assets/images/';
        $config['allowed_types'] 		= 'jpg|png|jpeg';

		$this->load->library('upload', $config);

        if (!$this->upload->do_upload($input)) {
            $error = array('error' => $this->upload->display_errors());
			echo $error['error'];
			print_r($_FILES[$input]);
        } else{
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			return $file_name;
        }

	}

}
