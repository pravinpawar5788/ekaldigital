<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Application_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_branch_id()
    {
        if (is_superadmin_loggedin()) {
            return $this->input->post('branch_id');
        } else {
            return get_loggedin_branch_id();
        }
    }

	public function getStaffListnew1($role)
    {
		  
        $this->db->select('staff.*');
        $this->db->from('staff');  
      $this->db->where_in('staff.category', array(5));
       // $this->db->where('staff.category', $role);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

	
	public function getStaffListnew2($role)
    {
		  
        $this->db->select('staff.*');
        $this->db->from('staff');  
      $this->db->where_in('staff.category', array(6));
       // $this->db->where('staff.category', $role);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
	
	
	 public function getusercredentials($id = '')
    {
        $this->db->select('*');
        $this->db->from('login_credential');
		$this->db->where('user_id', $id);        
        $query = $this->db->get();  
//echo $this->db->last_query(); 		 die;
        return $query->row_array();
    }
	
	
	 public function gettopnewslist()
    {
		   $db2 = $this->load->database('news', TRUE);  
        $db2->select('*');
        $db2->from('posts');
		$db2->order_by("id", "desc");
        $db2->limit(5);		
        $query = $db2->get();
        return $query->result_array();
    }
	
	
    public function profilePicUpload()
    {
        if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {
            $file_size = $_FILES["user_photo"]["size"];
            $file_name = $_FILES["user_photo"]["name"];
            $allowedExts = array('jpg', 'jpeg', 'png');
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($files = filesize($_FILES['user_photo']['tmp_name'])) {
                if (!in_array(strtolower($extension), $allowedExts)) {
                    $this->form_validation->set_message('handle_upload', translate('this_file_type_is_not_allowed'));
                    return false;
                }
                if ($file_size > 2097152) {
                    $this->form_validation->set_message('handle_upload', translate('file_size_shoud_be_less_than') . " 2048KB.");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', translate('error_reading_the_file'));
                return false;
            }
            return true;
        }
    }

     // get staff all list
    public function getStaffList($id)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role,p.p_name as p_name,sm.s_name as s_name,b.b_name as b_name,an.a_name as a_name');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
		$this->db->join("ekal_prabhag as p", "p.id = staff.p_id", "left");
		$this->db->join("ekal_sambhag as sm", "sm.id = staff.s_id", "left");
		$this->db->join("ekal_bhag as b", "b.id = staff.b_id", "left");
		$this->db->join("ekal_anchal as an", "an.id = staff.a_id", "left");
          $this->db->where('an.id', $id);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
    }

   // get staff all list
    public function getStaffListassembly($id)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role,p.p_name as p_name,sm.s_name as s_name,b.b_name as b_name,an.a_name as a_name');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
		$this->db->join("ekal_prabhag as p", "p.id = staff.p_id", "left");
		$this->db->join("ekal_sambhag as sm", "sm.id = staff.s_id", "left");
		$this->db->join("ekal_bhag as b", "b.id = staff.b_id", "left");
		$this->db->join("ekal_anchal as an", "an.id = staff.a_id", "left");
          $this->db->where('staff.assembly', $id);
        $this->db->order_by('staff.id', 'ASC');
       return $this->db->get()->result_array();
		//return $this->db->last_query();  
    }


 // get staff all list
    public function getassemblylist()
    {
        $sql = "SELECT `assembly` FROM `constituencylist` where `state` = 'Uttar Pradesh' and `assembly` != ''";  
		
               $query = $this->db->query($sql);

        return $query->result_array();   
    }


 
    public function getvideotraining($id)
    {
        $sql = "SELECT * FROM `video_training` where id = " . $this->db->escape($id);  
		
        $query = $this->db->query($sql);
        
        return $query->row_array();   
    }

    public function getstatelist()
    {
        $sql = "SELECT count(*) as cnt, state FROM `constituencylist` group by state"; 
		
        $query = $this->db->query($sql);
        
        return $query->result_array();   
    }



// get staff all list
    public function getnomineelist()
    {
        $sql = "SELECT * FROM `nominee`";  
		
        $query = $this->db->query($sql);

        return $query->result_array();   
    }
    
    public function getassignStaffList1($id)
    {		 
        
		  $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role,p.p_name as p_name,sm.s_name as s_name,b.b_name as b_name,an.a_name as a_name');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
		$this->db->join("ekal_prabhag as p", "p.id = staff.p_id", "left");
		$this->db->join("ekal_sambhag as sm", "sm.id = staff.s_id", "left");
		$this->db->join("ekal_bhag as b", "b.id = staff.b_id", "left");
		$this->db->join("ekal_anchal as an", "an.id = staff.a_id", "left");
		$this->db->join("assignconference as ass", "ass.staffid = staff.id", "left");
          $this->db->where('ass.eventid', $id);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
		
    }

      public function getassignStaffList1assembly($id)
    {		 
        
		  $this->db->select('staff.*');
        $this->db->from('staff');
      
		$this->db->join("assignconference as ass", "ass.staffid = staff.id", "left");
          $this->db->where('ass.eventid', $id);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
		
    }
   
   public function getassemblyview()
    {		 
        
		  //$sql = "SELECT constituencylist.`assembly`, count(*) as cnt FROM `constituencylist` left join staff on constituencylist.assembly = staff.`assembly` where `state` = 'Uttar Pradesh'  group by constituencylist.`assembly` ";  
		$sql ="SELECT constituencylist.`assembly`, count(*) as cnt,count(case staff.category when '1' then 1 else null end) as category1,count(case staff.category when '2' then 1 else null end) as category2,count(case staff.category when '3' then 1 else null end) as category3,count(case staff.category when '4' then 1 else null end) as category4
		FROM `constituencylist` left join staff on constituencylist.assembly = staff.`assembly` 
		where `state` = 'Uttar Pradesh'  group by constituencylist.`assembly`";
					   $query = $this->db->query($sql);

        return $query->result_array(); 
		
    }
   
   
    public function getUserNameByRoleID($roleID, $userID = '')
    {
        if ($roleID == 6) {
            $sql = "SELECT name,email,photo,branch_id FROM parent WHERE id = " . $this->db->escape($userID);
            return $this->db->query($sql)->row_array();
        } elseif ($roleID == 7) {
            $sql = "SELECT student.id, CONCAT(student.first_name,' ',student.last_name) as name, student.email, student.photo, enroll.branch_id FROM student INNER JOIN enroll ON enroll.student_id = student.id WHERE student.id = " . $this->db->escape($userID);
            return $this->db->query($sql)->row_array();
        } else {
            $sql = "SELECT name,email,photo,branch_id, s_id FROM staff WHERE id = " . $this->db->escape($userID);
            return $this->db->query($sql)->row_array();
        }
    }
	
	 public function editvideopath($id = '')
    {
        $this->db->select('*');
        $this->db->from('video_training');
		$this->db->where('video_training.id', $id);        
        $query = $this->db->get();        
        return $query->row_array();
    }


     public function editnominee($id = '')
    {
        $this->db->select('*');
        $this->db->from('nominee');
		$this->db->where('nominee.id', $id);        
        $query = $this->db->get();        
        return $query->row_array();
    }

    public function getStudentListByClassSection($classID = '', $sectionID = '', $branchID = '', $deactivate = false, $rollOrder = false)
    {
        $this->db->select('e.*,s.photo, CONCAT(s.first_name, " ", s.last_name) as fullname,s.register_no,s.parent_id,s.email,s.mobileno,s.blood_group,s.birthday,s.admission_date,c.name as class_name,se.name as section_name');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
       // $this->db->join('login_credential as l', 'l.user_id = s.id and l.role = 7', 'inner');
        $this->db->join('class as c', 'e.class_id = c.id', 'left');
        $this->db->join('section as se', 'e.section_id=se.id', 'left');
        $this->db->where('e.class_id', $classID);
        $this->db->where('e.branch_id', $branchID);
        $this->db->where('e.session_id', get_session_id());
        if ($rollOrder == true) {
            $this->db->order_by('e.roll', 'ASC');
        } else {
            $this->db->order_by('s.id', 'ASC');
        }
        if ($sectionID != 'all') {
            $this->db->where('e.section_id', $sectionID);
        }
        if ($deactivate == true) {
         //   $this->db->where('l.active', 0);
        }
        return $this->db->get()->result_array();
    }

    public function getStudentDetails($id)
    {
        $this->db->select('s.*,e.class_id,e.section_id,e.id as enrollid,e.roll,e.branch_id,e.session_id,c.name as class_name,se.name as section_name,sc.name as category_name');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'left');
        $this->db->join('class as c', 'e.class_id = c.id', 'left');
        $this->db->join('section as se', 'e.section_id = se.id', 'left');
        $this->db->join('student_category as sc', 's.category_id=sc.id', 'left');
        $this->db->where('s.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function smsServiceProvider($branch_id)
    {
        $this->db->select('sms_api_id');
        $this->db->where('branch_id', $branch_id);
        $this->db->where('is_active', 1);
        $r = $this->db->get('sms_credential')->row_array();
        if ($r == "") {
            return 'disabled';
        } else {
           return  $r['sms_api_id'];
        }
    }

    public function getLangImage($id = '', $thumb = true)
    {
        $file_path = 'uploads/language_flags/flag_' . $id . '_thumb.png';
        if (file_exists($file_path)) {
            if ($thumb == true) {
                $image_url = base_url($file_path);
            } else {
                $image_url = base_url('uploads/language_flags/flag_' . $id . '.png');
            }
        } else {
            if ($thumb == true) {
                $image_url = base_url('uploads/language_flags/defualt_thumb.png');
            } else {
                $image_url = base_url('uploads/language_flags/defualt.png');
            }
        }
        return $image_url;
    }

    public function get_book_cover_image($name)
    {
        if (empty($name)) {
            $image_url = base_url('uploads/book_cover/defualt.png');
        } else {
            $file_path = 'uploads/book_cover/' . $name;
            if (file_exists($file_path)) {
                $image_url = base_url($file_path);
            } else {
                $image_url = base_url('uploads/book_cover/defualt.png');
            }
        }
        return $image_url;
    }

    // get exam and term name
    public function exam_name_by_id($exam_id)
    {
        $getExam = $this->db->get_where('exam', array('id' => $exam_id))->row_array();
        if (!empty($getExam['term_id'])) {
            $getTerm = $this->db->get_where('exam_term', array('id' => $getExam['term_id']))->row_array();
            return $getExam['name'] . ' (' . $getTerm['name'] . ')';
        } else {
            return $getExam['name'];
        }
    }

   
    // private unread message counter
    public function checkmobileno($mobileno)
    {
         
        $query = $this->db->select('id')->where(array(
            'mobileno' => $mobileno           
        ))->get('staff');
        return $query->num_rows();
    }
 // private unread message counter
    public function checkusername($username)
    {
         
        $query = $this->db->select('id')->where(array(
            'username' => $username           
        ))->get('login_credential');
        return $query->num_rows();
    }



    // private unread message counter
    public function count_unread_message()
    {
        $active_user = loggedin_role_id() . '-' . get_loggedin_user_id();
        $query = $this->db->select('id')->where(array(
            'reciever' => $active_user,
            'read_status' => 0,
            'trash_inbox' => 0,
        ))->get('message');
        return $query->num_rows();
    }

    // reply unread message counter
    public function reply_count_unread_message()
    {
        $activeUser = loggedin_role_id() . '-' . get_loggedin_user_id();
        $query = $this->db->select('id')->where(array(
            'sender' => $activeUser,
            'reply_status' => 1,
            'trash_sent' => 0,
        ))->get('message');
        return $query->num_rows();
    }

    // unread message alert in topbar
    public function unread_message_alert()
    {
        $activeUser = loggedin_role_id() . '-' . get_loggedin_user_id();
        $activeUser = $this->db->escape($activeUser);
        $sql = "SELECT id,body,created_at,IF(sender = " . $activeUser . ", 'sent','inbox') as `msg_type`,IF(sender = " . $activeUser . ", reciever,sender) as `get_user` FROM message WHERE (sender = " . $activeUser . " AND trash_sent = 0 AND reply_status = 1) OR (reciever = " . $activeUser . " AND trash_inbox = 0 AND read_status = 0) ORDER BY id DESC";
        $result = $this->db->query($sql)->result_array();
        foreach ($result as $key => $value) {
           $result[$key]['message_details'] =  $this->getMessage_details($value['get_user']);
        }
        return $result;
    }

    public function getMessage_details($user_id)
    {
        $getUser = explode('-', $user_id);
        $userRoleID = $getUser[0];
        $userID = $getUser[1];
        $userType = '';
        if ($userRoleID == 6) {
            $userType = 'parent';
            $getUSER = $this->db->query("SELECT name,photo FROM parent WHERE id = " . $this->db->escape($userID))->row_array();
        } elseif ($userRoleID == 7) {
            $userType = 'student';
            $getUSER = $this->db->query("SELECT CONCAT(first_name, ' ', last_name) as name,photo FROM  student WHERE id = " . $this->db->escape($userID))->row_array();
        } else {
            $userType = 'staff';
            $getUSER = $this->db->query("SELECT name,photo FROM staff WHERE id = " . $this->db->escape($userID))->row_array();
        }
        $arrayData = array(
            'imgPath' => get_image_url($userType, $getUSER['photo']), 
            'userName' => $getUSER['name'], 
        );
        return $arrayData;
    }
	
	
	 public function flashscreenget($id = null) {
		 
		    $sql = "SELECT address FROM `flashscreenmsg` where id = " . $id . ""; 
        $query = $this->db->query($sql);

        return $query->row_array();
		 
        $this->db->select('address')->from('flashscreenmsg');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
	public function getstate(){
	   
			 
			  $sql = "SELECT `state` FROM `constituencylist` group by `state`";  
		
               $query = $this->db->query($sql);

        return  $query->result_array();         	
		
			 

	}
	
	public function getdistrict($state){
	   $state = str_replace('%20', ' ', $state);
			 

			   $sql = "SELECT `district` FROM `constituencylist` where state =" . $this->db->escape($state)." group by `district`";  
		 
               $query = $this->db->query($sql);

         return  $query->result_array();         	
		
		 

	}
	
	public function getloksabha($district){
	   $state = str_replace('%20', ' ', $state);
			 
			   $sql = "SELECT `lokshabha` FROM `constituencylist` where district =" . $this->db->escape($district)." group by `lokshabha`";  
		 
               $query = $this->db->query($sql);

         return $query->result_array();         	
		
		 
	}
	
	public function getblock($district){
	   $state = str_replace('%20', ' ', $state);
			 
			   $sql = "SELECT `block` FROM `constituencylist` where district =" . $this->db->escape($district)." group by `block`";  
		 
               $query = $this->db->query($sql);

         return $query->result_array();         	
		
		 
	}
	
	public function getvillage($block){
		
	   $state = str_replace('%20', ' ', $state);
			 
			   $sql = "SELECT `village` FROM `constituencylist` where block =" . $this->db->escape($block)." group by `village`";  
		 
               $query = $this->db->query($sql);

         return $query->result_array();  	 
		
		 
	}
	
	public function getgrampanchayat($village){
		
	   $state = str_replace('%20', ' ', $state);
			 
			   $sql = "SELECT `grampanchayat` FROM `constituencylist` where village =" . $this->db->escape($village)." group by `grampanchayat`";  
		 
               $query = $this->db->query($sql);

         return $query->result_array();  	 
		
		 
	}
	
	
	public function getassembly($loksabha){
	   $state = str_replace('%20', ' ', $state);
			 
			   $sql = "SELECT `assembly` FROM `constituencylist` where lokshabha =" . $this->db->escape($loksabha)." group by `assembly`";  
		 
               $query = $this->db->query($sql);

         return  $query->result_array();         	
		
			 

	}
	
	
}
