<?php

class usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		$this->db = $this->load->database("default", TRUE);
    }

	public function get_usuario() {
        $this->db->select('*');
        $this->db->from('user060');
        return $this->db->get()->result();
    }

	public function get_product($id){
		$this->db->select('*');
        $this->db->from('user060');
        $this->db->where('id',$id);
        return $this->db->get()->row();
	}
    
}
