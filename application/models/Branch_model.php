<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Branch_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save($data)
    {
        $arrayBranch = array(
            'name' => $data['branch_name'],
            'school_name' => $data['school_name'],
            'email' => $data['email'],
            'mobileno' => $data['mobileno'],
            'prabhag' => $data['prabhag'],
            'sambhag' => $data['sambhag'],
			'bhag' => $data['bhag'],
			'anchal_district' => $data['anchal_district'],
			'kid' => $data['kid'],              
            'address' => $data['address'],
        );
        if (!isset($data['branch_id'])) {
            $this->db->insert('branch', $arrayBranch);
        } else {
            $this->db->where('id', $data['branch_id']);
            $this->db->update('branch', $arrayBranch);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
