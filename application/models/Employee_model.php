<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Employee_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // moderator employee all information
    public function save($data, $role = null, $id = null)
    {
		if($this->application_model->get_branch_id())
		{
			$branchid = 0;
		}
		else{
		   $branchid = $this->application_model->get_branch_id();
		   $staff_role = 5;
		}
		 
		//if($data['p_name']) { $staff_role = 1;}
		//if($data['s_name']) { $staff_role = 2;  }
		//if($data['b_name']) { $staff_role = 3;}
		//if($data['a_name']) { $staff_role = 4;}
		 
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),
			//'p_id'=>$data['p_name'],
			//'s_id'=>$data['s_name'],
			//'b_id'=>$data['b_name'],
			//'a_id'=>$data['a_name'],
			
			
			'staff_role'=>$staff_role,
			'kstate' => $data['state'],	
			'kdistrict' => $data['subject_id'],	
			'klokshabha' => $data['chapterid'],	
			'kassembly' => $data['assembly'],
			
			'gramblock' => $data['gramblock'],
			'gramvillage' => $data['gramvillage'],
			'grampanchayat' => $data['grampanchayat'],
			
			
			//'fmname' => $_POST['fmname'],
			//'fmemail' => $_POST['fmemail'],
			//'fmphone' => $_POST['fmphone'],
			
			'muncipalblock' => $data['muncipalblock'],
			'muncipalvillage' => $data['muncipalvillage'],
			'muncipalcorp' => $data['muncipalcorp'],
			'familymember' => $data['familymember'],
			
			
            'name' => $data['name'],
            'sex' => $data['sex'],
            'religion' => $data['religion'],
			'cast' => $data['cast'],
			'vooter_id' => $data['vooter_id'],
			'booth_no' => $data['booth_no'],
			'emptype' => $data['emptype'],
           // 'blood_group' => $data['blood_group'],
            'birthday' => $data["birthday"],
            'mobileno' => $data['mobile_no'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'photo' => $this->uploadImage('staff'),            
          //  'joining_date' => date("Y-m-d", strtotime($data['joining_date'])),
          //  'qualification' => $data['qualification'],
            'email' => $data['email'],
           // 'facebook_url' => $data['facebook'],
           // 'linkedin_url' => $data['linkedin'],
          //  'twitter_url' => $data['twitter'],
        );

        $inser_data2 = array(
            //'username' => $data["email"],
			'username' => $data["mobile_no"],
            'role' => $data["user_role"],
        );

        if (!isset($data['staff_id']) && empty($data['staff_id'])) {
            // RANDOM STAFF ID GENERATE
            $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('staff', $inser_data1);
			
			//echo print_r($inser_data1); die;
			//echo $this->db->last_query();  die;
			
            $employeeID = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $employeeID;
            $inser_data2['password'] = $data["password"];
            $this->db->insert('login_credential', $inser_data2);

            // SAVE USER BANK INFORMATION IN THE DATABASE
            if (!isset($data['chkskipped'])) {
                $data['staff_id'] = $employeeID;
               // $this->bankSave($data);
            }
            return $employeeID;
        } else {
            // UPDATE ALL INFORMATION IN THE DATABASE
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $data['staff_id']);
            $this->db->update('staff', $inser_data1);
            // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $this->db->where('user_id', $data['staff_id']);
            $this->db->where_not_in('role', array(6,7));
            $this->db->update('login_credential', $inser_data2);
        }
    }


   public function save1($data, $role = null, $id = null)
    {
		if($this->application_model->get_branch_id())
		{
			$branchid = 0;
		}
		else{
		   $branchid = $this->application_model->get_branch_id();
		}
		
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),			 
            'name' => $data['name'],
            'sex' => $data['sex'],
            'religion' => $data['religion'],
            'blood_group' => $data['blood_group'],
            'birthday' => $data["birthday"],
            'mobileno' => $data['mobile_no'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'photo' => $this->uploadImage('staff'),            
            'joining_date' => date("Y-m-d", strtotime($data['joining_date'])),
            'qualification' => $data['qualification'],
            'email' => $data['email'],
            'facebook_url' => $data['facebook'],
            'linkedin_url' => $data['linkedin'],
            'twitter_url' => $data['twitter'],
        );

        $inser_data2 = array(
            'username' => $data["email"],
            'role' => $data["user_role"],
        );

        if (!isset($data['staff_id']) && empty($data['staff_id'])) {
            // RANDOM STAFF ID GENERATE
            $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('staff', $inser_data1);
            $employeeID = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $employeeID;
            $inser_data2['password'] = $data["password"];
            $this->db->insert('login_credential', $inser_data2);

            // SAVE USER BANK INFORMATION IN THE DATABASE
            if (!isset($data['chkskipped'])) {
                $data['staff_id'] = $employeeID;
                $this->bankSave($data);
            }
            return $employeeID;
        } else {
            // UPDATE ALL INFORMATION IN THE DATABASE
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $data['staff_id']);
            $this->db->update('staff', $inser_data1);
            // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $this->db->where('user_id', $data['staff_id']);
            $this->db->where_not_in('role', array(6,7));
            $this->db->update('login_credential', $inser_data2);
        }
    }

    // GET SINGLE EMPLOYEE DETAILS
    public function getSingleStaff($id = '')
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id,login_credential.active,login_credential.username, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->where('staff.id', $id);
        if (!is_superadmin_loggedin()) {
            $this->db->where('staff.branch_id', get_loggedin_branch_id());
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            show_404();
        }
        return $query->row_array();
    }

    public function getSingleStafflist($id = '')
    {
        $this->db->select('*');
        $this->db->from('staff');
		$this->db->where('staff.id', $id);        
        $query = $this->db->get();        
        return $query->row_array();
    }

    // get staff all list
    public function getStaffList($branchID = '', $role_id, $active = 1)
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
        if ($branchID != "") {
            $this->db->where('staff.branch_id', $branchID);
        }
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', $active);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }


     public function getStaffListnew($role)
    {
		 
        $this->db->select('staff.*');
        $this->db->from('staff');  
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');		
        $this->db->where('login_credential.role', $role);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

    public function getStaffListnew11($role)
    {
		 
        $this->db->select('staff.*');
        $this->db->from('staff');  
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');		
        $this->db->where('login_credential.role', $role);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
    public function getStaffListnew1($role)
    {
		 
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', $role);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

   public function getStaffListnewsamiti($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 1);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
	
   public function getStaffListnewsamiti123($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 1);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
		//echo $this->db->last_query(); die;
    }
	
	
	function pagination(){
        $config['full_tag_open']    = '<ul class ="pagination">';
        $config['full_tag_close']   = '</ul><!--pagination-->';
        $config['first_link']       = '«';
        $config['first_tag_open']   = '<li class="page-item page-link">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '»';
        $config['last_tag_open']    = '<li class="page-item page-link">';
        $config['last_tag_close']   = '</li>';
        $config['next_link']        = '&rarr;';
        $config['next_tag_open']    = '<li class="page-item page-link">';
        $config['next_tag_close']   = '</li>';
        $config['prev_link']        = '&larr;';
        $config['prev_tag_open']    = '<li class="page-item page-link">';
        $config['prev_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li class="page-item page-number">';
        $config['num_tag_close']    = '</li>';
        return $config;
    }
	
   public function getStaffListnewsamiti12($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 2);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    } 
	
public function getStaffListnewkaryakarta($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 2);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
	
	public function getStaffListnewacharya($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 3);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
	
	public function getStaffListnewguest($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 5);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }
	
	public function getStaffListnewnominee($limit, $start)
    {
		   $this->db->limit($limit, $start);
        $this->db->select('staff.id,staff.photo,staff.qualification,staff.name,staff.email,staff.mobileno,staff.assembly');
        $this->db->from('staff');  
      
        $this->db->where('staff.category', 6);		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

     // get staff all list
    public function getStaffListExam($branchID = '', $role_id, $active = 1)
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
        if ($branchID != "") {
            $this->db->where('staff.branch_id', $branchID);
        }
        //$this->db->where('staff.s_id != 15');
        $this->db->where('login_credential.active', $active);
		  
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
    }
    
	public function getStaffListExamtoday($branchID = '', $role_id, $active = 1)
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
        if ($branchID != "") {
            $this->db->where('staff.branch_id', $branchID);
        }
         $this->db->where('staff.s_id = 17');
        $this->db->where('login_credential.active', $active);
		  
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
    }
	
     public function getStaffList1($branchID = '', $role_id, $catid, $subcatid,  $active = 1)
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
        if ($branchID != "" && $branchID != 0) {
            $this->db->where('staff.branch_id', $branchID);
        }
	    
		 $this->db->where('staff.'.$catid, $subcatid);
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', $active);
		
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }


    public function get_schedule_by_id($id)
    {
        $this->db->select('timetable_class.*,subject.name as subject_name,class.name as class_name,section.name as section_name');
        $this->db->from('timetable_class');
        $this->db->join('subject', 'subject.id = timetable_class.subject_id', 'inner');
        $this->db->join('class', 'class.id = timetable_class.class_id', 'inner');
        $this->db->join('section', 'section.id = timetable_class.section_id', 'inner');
        $this->db->where('timetable_class.teacher_id', $id);
        $this->db->where('timetable_class.session_id', get_session_id());
        return $this->db->get();
    }

   /* public function bankSave($data)
    {
        $inser_data = array(
            'staff_id' => $data['staff_id'],
            'bank_name' => $data['bank_name'],
            'holder_name' => $data['holder_name'],
            'bank_branch' => $data['bank_branch'],
            'bank_address' => $data['bank_address'],
            'ifsc_code' => $data['ifsc_code'],
            'account_no' => $data['account_no'],
        );
        if (isset($data['bank_id'])) {
            $this->db->where('id', $data['bank_id']);
            $this->db->update('staff_bank_account', $inser_data);
        } else {
            $this->db->insert('staff_bank_account', $inser_data);
        }  
    } */

    public function csvImport($row, $branchID, $userRole, $designationID, $departmentID)
    {
        $inser_data1 = array(
            'name' => $row['Name'],
            'sex' => $row['Gender'],
            'religion' => $row['Religion'],
            'blood_group' => $row['BloodGroup'],
            'birthday' => date("Y-m-d", strtotime($row['DateOfBirth'])),
            'joining_date' => date("Y-m-d", strtotime($row['JoiningDate'])),
            'qualification' => $row['Qualification'],
            'mobileno' => $row['MobileNo'],
            'present_address' => $row['PresentAddress'],
            'permanent_address' => $row['PermanentAddress'],
            'email' => $row['Email'],
            'designation' => $designationID,
            'department' => $departmentID,
            'branch_id' => $branchID,
            'photo' => 'defualt.png',
        );

        $inser_data2 = array(
            'username' => $row["Email"],
            'role' => $userRole,
        );

        // RANDOM STAFF ID GENERATE
        $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
        // SAVE EMPLOYEE INFORMATION IN THE DATABASE
        $this->db->insert('staff', $inser_data1);
        $employeeID = $this->db->insert_id();

        // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        $inser_data2['active'] = 1;
        $inser_data2['user_id'] = $employeeID;
        $inser_data2['password'] = $this->app_lib->pass_hashed($row["Password"]);
        $this->db->insert('login_credential', $inser_data2);
        return true;
    }
	
	 public function savesanch($arrayBranch)
    {
		$this->db->insert('branch', $arrayBranch);					 
		 return  $this->db->insert_id(); 
	}	
	
	 public function csvImport1($row, $branchID)
    {
		
		if($row['Qualification'] == "Teacher")
		{
			 $branchid1 = $branchID;
		      $staff_role = 5;
			  $userRole = 3;
		}
		else{
		  $branchid1 = 0;
		  $userRole = 9;
		}
		 
		if($row['pid']) { $staff_role = 1;}
		if($row['sid']) { $staff_role = 2;  }
		if($row['bid']) { $staff_role = 3;}
		if($row['aid']) { $staff_role = 4;}
		
        $inser_data1 = array(
			'name' => $row['Name'],
			'sex' => $row['Gender'],
			'joining_date' => date("Y-m-d", strtotime($row['JoiningDate'])),
			'qualification' => $row['Qualification'],
			'present_address' => $row['present_address'],
			'goan' => $row['goan'],
			'policestation' => $row['policestation'],
			'booth' => $row['booth'],
			'mobileno' => $row['MobileNo'], 
			'present_address' => $row['address'], 			
			'email' => $row['Email'],             
			'branch_id' => $branchid1,
			'photo' => 'defualt.png',
			'p_id' => $row['pid'],
			's_id' => $row['sid'],
			'b_id' => $row['bid'],
			'a_id' => $row['aid'],
			'staff_role' => $staff_role,
			'assembly' => $row['assembly'],
			'category' => $row['category'],			  
        );
             
        $inser_data2 = array(
            'username' => $row["Email"],
            'role' => $userRole,
        );

        // RANDOM STAFF ID GENERATE
        $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
        // SAVE EMPLOYEE INFORMATION IN THE DATABASE
        $this->db->insert('staff', $inser_data1);
        $employeeID = $this->db->insert_id();

        // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        $inser_data2['active'] = 1;
        $inser_data2['user_id'] = $employeeID;
        $inser_data2['password'] = $row["Password"];
        $this->db->insert('login_credential', $inser_data2);
        return true;
    }
	
}
