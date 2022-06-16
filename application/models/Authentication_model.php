<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication_model extends MY_Model
{
    
    // checking login credential
    public function login_credential($username, $password)
    {
		
        $this->db->select('*');
        $this->db->from('login_credential');
        $this->db->where('username', $username);
		$this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
           // $verify_password = $this->app_lib->verify_password($password, $query->row()->password);
           // if ($verify_password) {
                return $query->row();
           // }
        }
        return false;
    }


 public function login_credential1($username, $password)
    {
		 $response['status'] = 'error';
         $response['result']    ='';
				
        $this->db->select('login_credential.id,login_credential.user_id,login_credential.password,login_credential.role,login_credential.active, staff.name as username, staff.category as category');
        $this->db->from('login_credential');
        $this->db->where('login_credential.username', $username);
		$this->db->where('login_credential.password', $password);
		$this->db->join('staff', 'staff.id = login_credential.user_id');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
           // $verify_password = $this->app_lib->verify_password($password, $query->row()->password);
           // if ($verify_password) {
                $data= $query->row();
				//$data['username1']="sadhh";
				 $response['status'] = 'Success';
                $response['result']    = $data;
				 
				return $response;
           // }
        }
		//return json_encode('status'=>$status,'result'=>$data);
         return $response;
    }
	
	
	 public function todaytelecasteventid() {
       
	   //aet.plandate =  CURDATE() and
       	 $sql = "SELECT * FROM `video_training` WHERE active='1' "; 

        $query = $this->db->query($sql);

        return $query->result_array(); 
    } 

      public function gettodayplanList1($id, $event_id) {
       
	   //aet.plandate =  CURDATE() and
       	// $sql = "SELECT * FROM `assignclassplan_event` aet inner join  `assignclassplan` ass on aet.id = ass.event_id where  ass.user_id =" . $this->db->escape($id) ." ORDER BY `aet`.`plandate` ASC"; 
           $sql = "SELECT ase.staffid as staffid FROM `assignconference` ase inner join `video_training` vt on ase.`eventid` = vt.id where ase.`staffid` = " . $this->db->escape($id) ." and ase.`eventid` = " . $this->db->escape($event_id) .""; 
        $query = $this->db->query($sql);

        return $query->row_array();
     }


      public function gettodayplanList($id = null) {
       
	   //aet.plandate =  CURDATE() and
       	// $sql = "SELECT * FROM `assignclassplan_event` aet inner join  `assignclassplan` ass on aet.id = ass.event_id where  ass.user_id =" . $this->db->escape($id) ." ORDER BY `aet`.`plandate` ASC"; 
           $sql = "SELECT vt.*, vt.name as eventname, vt.id as event_id FROM `assignconference` ase inner join `video_training` vt on ase.`eventid` = vt.id where ase.`staffid` = " . $this->db->escape($id) .""; 
        $query = $this->db->query($sql);

        return $query->result_array();
     }
    
     public function gettodayplanListapi($id = null) {
       
	   //aet.plandate =  CURDATE() and
       	// $sql = "SELECT * FROM `assignclassplan_event` aet inner join  `assignclassplan` ass on aet.id = ass.event_id where  ass.user_id =" . $this->db->escape($id) ." ORDER BY `aet`.`plandate` ASC"; 
           $sql = "SELECT ase.eventid, s.name, s.mobileno as username, s.mobileno as password FROM `assignconference` ase inner join staff s on ase.`staffid` = s.id  WHERE ase.`eventid` = " . $this->db->escape($id) .""; 
        $query = $this->db->query($sql);

        return $query->result_array();
     }


    // password forgotten
    public function lose_password($username)
    {
        if (!empty($username)) {
            $this->db->select('*');
            $this->db->from('login_credential');
            $this->db->where('username', $username);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $login_credential = $query->row();
                $getUser = $this->application_model->getUserNameByRoleID($login_credential->role, $login_credential->user_id);
                $key = hash('sha512', $login_credential->role . $login_credential->username . app_generate_hash());
                $query = $this->db->get_where('reset_password', array('login_credential_id' => $login_credential->id));
                if ($query->num_rows() > 0) {
                    $this->db->where('login_credential_id', $login_credential->id);
                    $this->db->delete('reset_password');
                }
                $arrayReset = array(
                    'key' => $key,
                    'login_credential_id' => $login_credential->id,
                    'username' => $login_credential->username,
                );
                $this->db->insert('reset_password', $arrayReset);
                // send email for forgot password
                $this->load->model('email_model');
                $arrayData = array(
                    'role' => $login_credential->role, 
                    'branch_id' => $getUser['branch_id'], 
                    'username' => $login_credential->username, 
                    'name' => $getUser['name'], 
                    'reset_url' => base_url('authentication/pwreset?key=' . $key), 
                    'email' => $getUser['email'], 
                );
                $this->email_model->sentForgotPassword($arrayData);
                return true;
            }
        }
        return false;
    }
}
