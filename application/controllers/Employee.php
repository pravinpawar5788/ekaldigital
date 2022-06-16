<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Accounting.php
 * @copyright : Reserved RamomCoders Team
 */

class Employee extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('custom_fields');
        $this->load->model('employee_model');
        $this->load->model('email_model');
        $this->load->model('crud_model');
    }

    public function index()
    {
        redirect(base_url('dashboard'));
    }

    /* staff form validation rules */
    protected function employee_validation()
    {
        if (is_superadmin_loggedin()) {
           // $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required');
        $this->form_validation->set_rules('present_address', translate('present_address'), 'trim|required');
       // $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
        //$this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
      //  $this->form_validation->set_rules('joining_date', translate('joining_date'), 'trim|required');
       // $this->form_validation->set_rules('qualification', translate('qualification'), 'trim|required');
        $this->form_validation->set_rules('user_role', translate('role'), 'trim|required|callback_valid_role');
        //$this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
        if (!isset($_POST['staff_id'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
            $this->form_validation->set_rules('retype_password', translate('retype_password'), 'trim|required|matches[password]');
       }
      //  $this->form_validation->set_rules('facebook', 'Facebook', 'valid_url');
      //  $this->form_validation->set_rules('twitter', 'Twitter', 'valid_url');
      //  $this->form_validation->set_rules('linkedin', 'Linkedin', 'valid_url');
        $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
        // custom fields validation rules
        $class_slug = $this->router->fetch_class();
        $customFields = getCustomFields($class_slug);
        foreach ($customFields as $fields_key => $fields_value) {
            if ($fields_value['required']) {
                $fieldsID = $fields_value['id'];
                $fieldLabel = $fields_value['field_label'];
                $this->form_validation->set_rules("custom_fields[employee][" . $fieldsID . "]", $fieldLabel, 'trim|required');
            }
        }
    }


    /* getting all employee list */
    public function view($role = 9)
    {
        if (!get_permission('employee', 'is_view') || ($role == 1 || $role == 6 || $role == 7)) {
            access_denied();
        }
		
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view3';
        $this->data['main_menu'] = 'employee';
		if (is_superadmin_loggedin()) {
        $this->data['stafflist'] = $this->employee_model->getStaffListnew($role);
		}
		else{
			  
		  $emplist	=  $this->employee_model->getSingleStafflist(get_loggedin_user_id());
		      $staffrole = $emplist['staff_role'];
 	   if($staffrole == 1) { $catid = 'p_id';  $subcat = $emplist['p_id'];    } 
       if($staffrole == 2) { $catid = 's_id'; $subcat = $emplist['s_id']; } 
       if($staffrole == 3) { $catid = 'b_id'; $subcat = $emplist['b_id']; } 
        if($staffrole == 4) { $catid = 'a_id';  $subcat = $emplist['a_id']; } 			 
			 
		$this->data['stafflist'] = $this->employee_model->getStaffList1($branchID, $role, $catid, $subcat);	
			
		}
        $this->load->view('layout/index', $this->data);
    }
	
	 /* getting all employee list */
    public function view1($role = 1 )
    {
         
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view4';
        $this->data['main_menu'] = 'employee';
	    $this->data['stafflist'] = $this->employee_model->getStaffListnew1($role);
		
		/*if (is_superadmin_loggedin()) {
        $this->data['stafflist'] = $this->employee_model->getStaffListnew1($role);
		}
		else{
			  
		  $emplist	=  $this->employee_model->getSingleStafflist(get_loggedin_user_id());
		      $staffrole = $emplist['staff_role'];
 	   if($staffrole == 1) { $catid = 'p_id';  $subcat = $emplist['p_id'];    } 
       if($staffrole == 2) { $catid = 's_id'; $subcat = $emplist['s_id']; } 
       if($staffrole == 3) { $catid = 'b_id'; $subcat = $emplist['b_id']; } 
        if($staffrole == 4) { $catid = 'a_id';  $subcat = $emplist['a_id']; } 			 
			 
		$this->data['stafflist'] = $this->employee_model->getStaffList1($branchID, $role, $catid, $subcat);	
			
		} */
	//$config = array();
  //  $config["base_url"] = base_url('employee/view1');	
	//$config['total_rows'] = $this->db->where('category',1)->from("staff")->count_all_results();
  //  $config['per_page'] = 20;//number of data to be shown on single page
   // $config["uri_segment"] = 3;
	//$this->pagination->initialize($config);
   // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
   // $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti($config["per_page"], (($page)*$config["per_page"]));
   // $this->data["links"] = $this->pagination->create_links();//create the link for pagination
		
		
	/*if($role == 1){
		
	$config = array();
    $config["base_url"] = base_url('employee/view1');	
	$config['total_rows'] = $this->db->where('category',1)->from("staff")->count_all_results();
	//echo $config['total_rows']; die;
	//echo $this->db->last_query();  die;
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
	
	}
	else if($role == 2){
		
	$config = array();
    $config["base_url"] = base_url('employee/view1/2');	
	$config['total_rows'] = $this->db->where('category',2)->from("staff")->count_all_results();
	//echo $config['total_rows']; die;
	//echo $this->db->last_query(); die;
	
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewkaryakarta($config["per_page"], (($page)*$config["per_page"]));
	//echo $this->data["stafflist"]; die;
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
	
	} 
	else if($role == 3){
		
	$config = array();
    $config["base_url"] = base_url('employee/view1/3');	
	$config['total_rows'] = $this->db->where('category',3)->from("staff")->count_all_results();
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewacharya($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
	
	}
	else if($role == 5){
	
	$config = array();
    $config["base_url"] = base_url('employee/view1/5');	
	$config['total_rows'] = $this->db->where('category',5)->from("staff")->count_all_results();
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewguest($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
	
	}
	else if($role == 6){
		
	$config = array();
    $config["base_url"] = base_url('employee/view1/6');	
	$config['total_rows'] = $this->db->where('category',6)->from("staff")->count_all_results();
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewnominee($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
	
	}
	else {
		
	$config = array();
    $config["base_url"] = base_url('employee/view1');	
	$config['total_rows'] = $this->db->where('category',1)->from("staff")->count_all_results();
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
	$this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination	
	
	} */
		
		
        $this->load->view('layout/index', $this->data);
    }
	
	
	public function view6()
    {
        $role = 1;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view6';
        $this->data['main_menu'] = 'employee';
		
		$config = array();
		//$config["base_url"] = base_url('employee/view6');
		//  $this->db->count_all("staff");//here we will count all the data from the table
		/*$config['total_rows'] = $this->db->where('category',1)->from("staff")->count_all_results();

		//echo $config['total_rows']; die;
		$config['per_page'] = 10;//number of data to be shown on single page
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 

		$this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti123($config["per_page"], (($page)*$config["per_page"]));
		$this->data["links"] = $this->pagination->create_links();//create the link for pagination*/
		
		
		$search_string = '';
		
		 $total_rows = $this->db->where('category',1)->from("staff")->count_all_results();
        // page
        $config                     = $this->employee_model->pagination();
        $config["base_url"]         = base_url() . "employee/view6?".$search_string;
        $config["total_rows"]       = $total_rows;
        $config["per_page"]         = 20;
        $config["uri_segment"]      = 3;          
        //$config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE; 
        $this->pagination->initialize($config);
        $data['last_row_num']=$this->uri->segment(3);
        $page = $this->input->get('per_page');//($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
        $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti123($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();
		
		
		
		$this->data['mainpage'] = "testimonial";
	     
        $this->load->view('layout/index', $this->data);
    }
	
	 public function view7()
    {
        $role = 2;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view7';
        $this->data['main_menu'] = 'employee';
		
	$config = array();
  /*  $config["base_url"] = base_url('employee/view7');
    $config['total_rows'] = $this->db->where('category',2)->from("staff")->count_all_results();
   
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti12($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination*/
	
	
	$search_string = '';
		
		 $total_rows = $this->db->where('category',2)->from("staff")->count_all_results();
        // page
        $config                     = $this->employee_model->pagination();
        $config["base_url"]         = base_url() . "employee/view7?".$search_string;
        $config["total_rows"]       = $total_rows;
        $config["per_page"]         = 20;
        $config["uri_segment"]      = 3;          
        //$config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE; 
        $this->pagination->initialize($config);
        $data['last_row_num']=$this->uri->segment(3);
        $page = $this->input->get('per_page');//($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
        $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti12($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();
	
	
    $this->data['mainpage'] = "testimonial";
		
        $this->load->view('layout/index', $this->data);
    } 
	
	public function view8()
    {
        $role = 3;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view8';
        $this->data['main_menu'] = 'employee';
		
	$config = array();
   /* $config["base_url"] = base_url('employee/view8');
    $config['total_rows'] = $this->db->where('category',3)->from("staff")->count_all_results();
   
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewacharya($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination*/
	
	
	$search_string = '';
		
		 $total_rows = $this->db->where('category',3)->from("staff")->count_all_results();
        // page
        $config                     = $this->employee_model->pagination();
        $config["base_url"]         = base_url() . "employee/view8?".$search_string;
        $config["total_rows"]       = $total_rows;
        $config["per_page"]         = 20;
        $config["uri_segment"]      = 3;          
        //$config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE; 
        $this->pagination->initialize($config);
        $data['last_row_num']=$this->uri->segment(3);
        $page = $this->input->get('per_page');//($this->uri->segment(3)) ? $this->uri->segment(3) : 0;   
        $this->data["stafflist"] = $this->employee_model->getStaffListnewacharya($config["per_page"], $page);
        $this->data["links"] = $this->pagination->create_links();
	
    $this->data['mainpage'] = "testimonial";
		
        $this->load->view('layout/index', $this->data);
    } 
	public function view9()
    {
        $role = 5;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view9';
        $this->data['main_menu'] = 'employee';
		
	$config = array();
    $config["base_url"] = base_url('employee/view9');
    $config['total_rows'] = $this->db->where('category',5)->from("staff")->count_all_results();
   
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewguest($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
    $this->data['mainpage'] = "testimonial";
		
        $this->load->view('layout/index', $this->data);
    } 
	
	public function view10()
    {
        $role = 6;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view10';
        $this->data['main_menu'] = 'employee';
		
	$config = array();
    $config["base_url"] = base_url('employee/view10');
    $config['total_rows'] = $this->db->where('category',6)->from("staff")->count_all_results();
	//print_r($total_rows); die;
    //echo $this->db->last_query();  die;
    $config['per_page'] = 20;//number of data to be shown on single page
    $config["uri_segment"] = 3;
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewnominee($config["per_page"], (($page)*$config["per_page"]));
    $this->data["links"] = $this->pagination->create_links();//create the link for pagination
    $this->data['mainpage'] = "testimonial";
		
        $this->load->view('layout/index', $this->data);
    } 
	
	
	
	 /* getting all employee list */
    public function viewsamiti()
    {
        $role = 1;
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view5';
        $this->data['main_menu'] = 'employee';
		
		 $config = array();
   $config["base_url"] = base_url('employee/viewsamiti');
    //  $this->db->count_all("staff");//here we will count all the data from the table
  $config['total_rows'] = $this->db->where('category',1)->from("staff")->count_all_results();
   
   $config['per_page'] = 20;//number of data to be shown on single page
   $config["uri_segment"] = 3;
   $this->pagination->initialize($config);
     $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
    $this->data["stafflist"] = $this->employee_model->getStaffListnewsamiti($config["per_page"], (($page)*$config["per_page"]));
   $this->data["links"] = $this->pagination->create_links();//create the link for pagination
   $this->data['mainpage'] = "testimonial";
		
		
		// $this->data['stafflist'] = $this->employee_model->getStaffListnew1($role);
	     
        $this->load->view('layout/index', $this->data);
    }
	
	
	/* getting all employee list */
    public function examresult($role = 9)
    {
        
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/examresult';
        $this->data['main_menu'] = 'employee';	 		 
		 
        $this->data['stafflist'] = $this->employee_model->getStaffListExam($branchID, $role);	 
		 
        $this->load->view('layout/index', $this->data);
    }

	/* getting all employee list */
    public function examresult1($role = 9)
    {
        
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/examresult1';
        $this->data['main_menu'] = 'employee';	 		 
		 
        $this->data['stafflist'] = $this->employee_model->getStaffListExam($branchID, $role);	 
		 
        $this->load->view('layout/index', $this->data);
    }
	
	/* getting all employee list */
    public function examresult2($role = 9)
    {
        
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/examresult2';
        $this->data['main_menu'] = 'employee';	 		 
		 
        $this->data['stafflist'] = $this->employee_model->getStaffListExamtoday($branchID, $role);	 
		 
        $this->load->view('layout/index', $this->data);
    }
	
    /* bank form validation rules */
    protected function bank_validation()
    {
        $this->form_validation->set_rules('bank_name', translate('bank_name'), 'trim|required');
        $this->form_validation->set_rules('holder_name', translate('holder_name'), 'trim|required');
        $this->form_validation->set_rules('bank_branch', translate('bank_branch'), 'trim|required');
        $this->form_validation->set_rules('account_no',  translate('account_no'), 'trim|required');
    }

	
	  /* employees all information are prepared and stored in the database here */
    public function add1()
    {
        if (!get_permission('employee', 'is_add')) {
            access_denied();
        }
        if ($_POST) {
            if($_POST['roleuser'] == "5")
			{
				$staff_role = 12; 
                $qualification =  "Guest"; 				
			}
            else
			{
				$staff_role = 13;  
				$qualification =  "Nominee"; 				
            }				
		   
		   
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),			 
			'staff_role'=>$staff_role,
            'name' => $_POST['name'],
            'sex' => $_POST['sex'],
            'religion' => '-',
            'blood_group' => 'A+',
            'birthday' => date("Y-m-d"),
            'mobileno' => $_POST['mobileno'],
            'present_address' => $_POST['state'],
            'permanent_address' => $_POST['state'],
			'assembly' => $_POST['state'],
            'photo' => "photo",            
            'joining_date' => date("Y-m-d"),
            'qualification' => $qualification,
            'email' => $_POST['mobileno'],
            'facebook_url' => "faaa.com",
            'linkedin_url' => "linkkk.com",
            'twitter_url' => "twwww.com",
            'category' => $_POST['roleuser'],			
			
        );
       //print_r($inser_data1); die;
        $inser_data2 = array(
            'username' => $_POST['mobileno'],
            'role' => $staff_role,
        );

        if (!isset($data['staff_id']) && empty($data['staff_id'])) {
            // RANDOM STAFF ID GENERATE
            $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('staff', $inser_data1);
			 
			//echo $this->db->last_query();  die;
            $employeeID = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $employeeID;
            $inser_data2['password'] = $_POST['mobileno'];
            $this->db->insert('login_credential', $inser_data2);
			redirect(base_url('employee/view1/'.$_POST['roleuser']), 'refresh');
			
        }
		}
		
		 $this->data['statelist'] = $this->application_model->getassemblylist();
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = "Guest User";
        $this->data['sub_page'] = 'employee/add1';
        $this->data['main_menu'] = 'employee';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }
 
	public function nomineetoadd()
    {
			
		$nomineelist = $this->application_model->getnomineelist();
		foreach($nomineelist as $nominee)
		{ 
		 $mobileno = "8000000".$nominee['id']; 
		$staff_role = 13;  
		$qualification =  "Nominee"; 
		
		  $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),			 
			'staff_role'=>$staff_role,
            'name' => $nominee['fullname'],
            'sex' => $nominee['gender'],
            'religion' => '-',
            'blood_group' => 'A+',
            'birthday' => date("Y-m-d"),
            'mobileno' => $mobileno,
            'present_address' => $nominee['assembly'],
            'permanent_address' => $nominee['assembly'],
			'assembly' => $nominee['assembly'],
            'photo' => "photo",            
            'joining_date' => date("Y-m-d"),
            'qualification' => $qualification,
            'email' => $mobileno,
            'facebook_url' => "faaa.com",
            'linkedin_url' => "linkkk.com",
            'twitter_url' => "twwww.com",
            'category' => 6,			
			
        );
       // print_r($inser_data1); die;
        $inser_data2 = array(
            'username' => $mobileno,
            'role' => $staff_role,
        );

        if (!isset($data['staff_id']) && empty($data['staff_id'])) {
            // RANDOM STAFF ID GENERATE
            $inser_data1['staff_id'] = substr(app_generate_hash(), 3, 7);
            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('staff', $inser_data1);
			 
			//echo $this->db->last_query();  die;
            $employeeID = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $employeeID;
            $inser_data2['password'] = $mobileno;
            $this->db->insert('login_credential', $inser_data2);
			//redirect(base_url('employee/view1/'.$_POST['roleuser']), 'refresh');
			
        }
		
	}
		
	}	
	
    /* employees all information are prepared and stored in the database here */
    public function add()
    {
        if (!get_permission('employee', 'is_add')) {
            access_denied();
        }
        if ($_POST) {
			
           // $this->employee_validation();
            //if (!isset($_POST['chkskipped'])) {
                //$this->bank_validation();
           // }
         //   if ($this->form_validation->run() !== false) {
				
                //save all employee information in the database
                $user_id = $this->employee_model->save($this->input->post());
				
                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $studentID);
                }

                set_alert('success', translate('information_has_been_saved_successfully'));
                //send account activate email
                $this->email_model->sentStaffRegisteredAccount($post);
                redirect(base_url('employee/view7/' . $post['user_role']), 'refresh');
          //  }
        }
		
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('add_employee');
        $this->data['sub_page'] = 'employee/add';
        $this->data['main_menu'] = 'employee';
		 $this->data['statelist'] = $this->application_model->getstate();
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }



/* csv file to import student information  and stored in the database here */
    public function import()
    {
        // check access permission
        if (!get_permission('multiple_import', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        
        $this->data['title'] = translate('multiple_import');
        $this->data['branch_id'] = $branchID;
        $this->data['sub_page'] = 'employee/multi_add';
        $this->data['main_menu'] = 'admission';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }



    /* profile preview and information are controlled here */
    public function profile($id = '')
    {
        if (!get_permission('employee', 'is_edit')) {
            access_denied();
        }
        if ($this->input->post('submit') == 'update') {
            $this->employee_validation();
            if ($this->form_validation->run() == true) {
				 
                //save all employee information in the database
                $this->employee_model->save1($this->input->post());
              
                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $id);
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
                $this->session->set_flashdata('profile_tab', 1);
                redirect(base_url('employee/profile/' . $id));
            } else {  
                $this->session->set_flashdata('profile_tab', 1);
            }
        }
        $this->data['categorylist'] = $this->app_lib->get_document_category();
        $this->data['staff'] = $this->employee_model->getSingleStaff($id);
        $this->data['title'] = translate('employee_profile');
        $this->data['sub_page'] = 'employee/profile';
        $this->data['main_menu'] = 'employee';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    // user interface and employees all information are prepared and stored in the database here
    public function delete($id = '')
    {
        if (!get_permission('employee', 'is_delete')) {
            access_denied();
        }
        // check student restrictions
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->delete('staff', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            $this->db->where('user_id', $id);
            $this->db->where_not_in('role', array(1, 6, 7));
            $this->db->delete('login_credential');
        }
    }

    // unique valid username verification is done here
    public function unique_username($username)
    {
        if ($this->input->post('staff_id')) {
            $staff_id = $this->input->post('staff_id');
            $login_id = $this->app_lib->get_credential_id($staff_id);
            $this->db->where_not_in('id', $login_id);
        }
        $this->db->where('username', $username);
        $query = $this->db->get('login_credential');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('username_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }

    public function valid_role($id)
    {
        $restrictions = array(1, 6, 7);
        if (in_array($id, $restrictions)) {
            $this->form_validation->set_message("valid_role", translate('selected_role_restrictions'));
            return false;
        } else {
            return true;
        }
    }

    // employee login password change here by admin
    public function change_password()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        if (!isset($_POST['authentication'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
        } else {
            $this->form_validation->set_rules('password', translate('password'), 'trim');
        }
        if ($this->form_validation->run() !== false) {
            $studentID = $this->input->post('staff_id');
            $password = $this->input->post('password');
            if (!isset($_POST['authentication'])) {
                $this->db->where_not_in('role', array(1, 6, 7));
                $this->db->where('user_id', $studentID);
                $this->db->update('login_credential', array('password' => $this->app_lib->pass_hashed($password)));
            }else{
                $this->db->where_not_in('role', array(1, 6, 7));
                $this->db->where('user_id', $studentID);
                $this->db->update('login_credential', array('active' => 0));
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $error);
        }
        echo json_encode($array);
    }

    // employee bank details are create here / ajax
    public function bank_account_create()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->bank_validation();
        if ($this->form_validation->run() !== false) {
            $post = $this->input->post();
            $this->employee_model->bankSave($post);
            set_alert('success', translate('information_has_been_saved_successfully'));
            $this->session->set_flashdata('bank_tab', 1);
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
        
    }

    // employee bank details are update here / ajax
    public function bank_account_update()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->bank_validation();
        if ($this->form_validation->run() !== false) {
            $post = $this->input->post();
            $this->employee_model->bankSave($post);
            $this->session->set_flashdata('bank_tab', 1);
            set_alert('success', translate('information_has_been_updated_successfully'));
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }

    // employee bank details are delete here
    public function bankaccount_delete($id)
    {
        if (get_permission('employee', 'is_edit')) {
            $this->db->where('id', $id);
            $this->db->delete('staff_bank_account');
            $this->session->set_flashdata('bank_tab', 1);
        }
    }

    public function bank_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('staff_bank_account');
        $result = $query->row_array();
        echo json_encode($result);
    }

    protected function document_validation()
    {
        $this->form_validation->set_rules('document_title', translate('document_title'), 'trim|required');
        $this->form_validation->set_rules('document_category', translate('document_category'), 'trim|required');
        if ($this->uri->segment(2) != 'document_update') {
            if (isset($_FILES['document_file']['name']) && empty($_FILES['document_file']['name'])) {
                $this->form_validation->set_rules('document_file', translate('document_file'), 'required');
            }
        }
    }

    // employee document details are create here / ajax
    public function document_create()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->document_validation();
        if ($this->form_validation->run() !== false) {
            $insert_doc = array(
                'staff_id' => $this->input->post('staff_id'),
                'title' => $this->input->post('document_title'),
                'category_id' => $this->input->post('document_category'),
                'remarks' => $this->input->post('remarks'),
            );
            // uploading file using codeigniter upload library
            $config['upload_path'] = './uploads/attachments/documents/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx|csv|txt';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if ($this->upload->do_upload("document_file")) {
                $insert_doc['file_name'] = $this->upload->data('orig_name');
                $insert_doc['enc_name'] = $this->upload->data('file_name');
                $this->db->insert('staff_documents', $insert_doc);
                set_alert('success', translate('information_has_been_saved_successfully'));
            } else {
                set_alert('error', strip_tags($this->upload->display_errors()));
            }
            $this->session->set_flashdata('documents_details', 1);
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }

    // employee document details are update here / ajax
    public function document_update()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        // validate inputs
        $this->document_validation();
        if ($this->form_validation->run() !== false) {
            $document_id = $this->input->post('document_id');
            $insert_doc = array(
                'title' => $this->input->post('document_title'),
                'category_id' => $this->input->post('document_category'),
                'remarks' => $this->input->post('remarks'),
            );
            if (isset($_FILES["document_file"]) && !empty($_FILES['document_file']['name'])) {
                $config['upload_path'] = './uploads/attachments/documents/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|csv|txt';
                $config['max_size'] = '2048';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload("document_file")) {
                    $exist_file_name = $this->input->post('exist_file_name');
                    $exist_file_path = FCPATH . 'uploads/attachments/documents/' . $exist_file_name;
                    if (file_exists($exist_file_path)) {
                        unlink($exist_file_path);
                    }
                    $insert_doc['file_name'] = $this->upload->data('orig_name');
                    $insert_doc['enc_name'] = $this->upload->data('file_name');
                } else {
                    set_alert('error', strip_tags($this->upload->display_errors()));
                }
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
            $this->db->where('id', $document_id);
            $this->db->update('staff_documents', $insert_doc);
            echo json_encode(array('status' => 'success'));
            $this->session->set_flashdata('documents_details', 1);
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
        
    }

    // employee document details are delete here
    public function document_delete($id)
    {
        if (get_permission('employee', 'is_edit')) {
            $enc_name = $this->db->select('enc_name')->where('id', $id)->get('staff_documents')->row()->enc_name;
            $file_name = FCPATH . 'uploads/attachments/documents/' . $enc_name;
            if (file_exists($file_name)) {
                unlink($file_name);
            }
            $this->db->where('id', $id);
            $this->db->delete('staff_documents');
            $this->session->set_flashdata('documents_details', 1);
        }
    }

    public function document_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('staff_documents');
        $result = $query->row_array();
        echo json_encode($result);
    }

    /* file downloader */
    public function documents_download()
    {
        $encrypt_name = $this->input->get('file');
        $file_name = $this->db->select('file_name')->where('enc_name', $encrypt_name)->get('staff_documents')->row()->file_name;
        $this->load->helper('download');
        force_download($file_name, file_get_contents('uploads/documents/' . $encrypt_name));
    }

    /* department form validation rules */
    protected function department_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('department_name', translate('department_name'), 'trim|required|callback_unique_department');
    }
	
	
	 /* department form validation rules */
    protected function prabhag_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('p_name', translate('prabhag'), 'required');
        }
       // $this->form_validation->set_rules('p_name', translate('department_name'), 'trim|required|callback_unique_department');
    }
	 protected function bhag_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('bhag_name', translate('bhag'), 'required');
        }
       // $this->form_validation->set_rules('p_name', translate('department_name'), 'trim|required|callback_unique_department');
    }


protected function anchal_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('anchal_name', translate('anchal'), 'required');
        }
       // $this->form_validation->set_rules('p_name', translate('department_name'), 'trim|required|callback_unique_department');
    }
	
	protected function sanch_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('sanch_name', translate('sanch'), 'required');
        }
       // $this->form_validation->set_rules('p_name', translate('department_name'), 'trim|required|callback_unique_department');
    }

    /* department form validation rules */
    protected function sambhag_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('sambhag_name', translate('sambhag'), 'required');
        }
       // $this->form_validation->set_rules('p_name', translate('department_name'), 'trim|required|callback_unique_department');
    }


    // employee department user interface and information are controlled here
    public function department()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->department_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'name' => $this->input->post('department_name'), 
                    'branch_id' => $this->application_model->get_branch_id(), 
                );
                $this->db->insert('staff_department', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/department'));
            }
        }
        $this->data['department'] = $this->app_lib->getTable('staff_department');
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/department';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }
	
	public function prabhag()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->prabhag_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'p_name' => $this->input->post('p_name'), 
                   
                );
                $this->db->insert('ekal_prabhag', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/prabhag'));
            }
        }
        $this->data['prabhag'] = $this->app_lib->getPrabhag('ekal_prabhag');
        $this->data['title'] = translate('Prabhag');
        $this->data['sub_page'] = 'employee/prabhag';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/prabhag', $this->data);
    }
	
	function exampublishstatus() {
	  
	   $rowres = $this->db->get_where('ekal_sambhag',array('id'=>$this->input->post("id")))->row_array();
	  //$rowres = $this->subject_model->getquiznameid($this->input->post("id"));
	   
	  if($rowres['status'] == 0) { $active = 1; }  else { $active = 0; } 
	  $data = array(
                    'id' => $this->input->post("id"),
                    'status' => $active
                    
                );
				
      if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('ekal_sambhag', $data);
        }  
  }
	
	public function sambhag()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->sambhag_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'p_id' => $this->input->post('p_name'), 
                   
					's_name' => $this->input->post('sambhag_name'),
                );
                $this->db->insert('ekal_sambhag', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/sambhag'));
            }
        }
        $this->data['sambhag'] = $this->app_lib->getSambhag('ekal_sambhag'); 
        $this->data['title'] = translate('Sambhag');
        $this->data['sub_page'] = 'employee/sambhag';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/sambhag', $this->data);
    }
	public function bhag()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->bhag_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'p_id' => $this->input->post('p_name'), 
                   
					's_id' => $this->input->post('s_name'),
					'b_name' => $this->input->post('bhag_name'),
                );
                $this->db->insert('ekal_bhag', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/bhag'));
            }
        }
        $this->data['bhag'] = $this->app_lib->getBhag('ekal_bhag'); 
        $this->data['title'] = translate('bhag');
        $this->data['sub_page'] = 'employee/bhag';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }
	
	public function anchal()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->anchal_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'p_id' => $this->input->post('p_name'), 
                   
					's_id' => $this->input->post('s_name'),
					'b_id' => $this->input->post('b_name'),
					'a_name' => $this->input->post('anchal_name'),
                );
                $this->db->insert('ekal_anchal', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/anchal'));
            }
        }
        $this->data['bhag'] = $this->app_lib->getAnchal('ekal_anchal'); 
        $this->data['title'] = translate('anchal'); 
        $this->data['sub_page'] = 'employee/anchal';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }
	
	public function sanch()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->sanch_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'p_id' => $this->input->post('p_name'), 
                   
					's_id' => $this->input->post('s_name'),
					'b_id' => $this->input->post('b_name'),
					'a_id' => $this->input->post('a_name'),
					'name' => $this->input->post('sanch_name'),
					'school_name' => $this->input->post('sanch_name1'),
                );
                $this->db->insert('branch', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/sanch'));
            }
        }
        $this->data['bhag'] = $this->app_lib->getSanch('branch'); 
        $this->data['title'] = "Vidhan Sabha"; 
        $this->data['sub_page'] = 'employee/sanch';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }
	

    public function department_edit()
    {
        if (!get_permission('department', 'is_edit')) {
            ajax_access_denied();
        }
        $this->department_validation();
        if ($this->form_validation->run() !== false) {
            $arrayDepartment = array(
                'name' => $this->input->post('department_name'), 
                'branch_id' => $this->application_model->get_branch_id(), 
            );
            $department_id = $this->input->post('department_id');
            $this->db->where('id', $department_id);
            $this->db->update('staff_department', $arrayDepartment);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }
	
	 public function prabhag_edit()
    {
        if (!get_permission('department', 'is_edit')) {
            ajax_access_denied();
        }
        $this->prabhag_validation();
        if ($this->form_validation->run() !== false) {
            $arrayDepartment = array(
                'p_name' => $this->input->post('p_name'), 
                'state_name' => $this->input->post('state'), 
            );
            $department_id = $this->input->post('department_id');
            $this->db->where('id', $department_id);
            $this->db->update('ekal_prabhag', $arrayDepartment);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    public function sambhag_edit()
    {
        if (!get_permission('department', 'is_edit')) {
            ajax_access_denied();
        }
        $this->sambhag_validation();
        if ($this->form_validation->run() !== false) {
            $arrayDepartment = array(
                's_name' => $this->input->post('sambhag_name'), 
                'p_id' => $this->input->post('p_name'), 
            );
            $department_id = $this->input->post('department_id');
            $this->db->where('id', $department_id);
            $this->db->update('ekal_sambhag', $arrayDepartment);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    public function bhag_edit()
    {
        if (!get_permission('department', 'is_edit')) {
            ajax_access_denied();
        }
        $this->bhag_validation();
        if ($this->form_validation->run() !== false) {
            $arrayDepartment = array(
                'b_name' => $this->input->post('bhag_name'), 
                'p_id' => $this->input->post('p_name'), 
				's_id'=> $this->input->post('s_name1'), 
            );
            $department_id = $this->input->post('department_id');
            $this->db->where('id', $department_id);
            $this->db->update('ekal_bhag', $arrayDepartment);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }


    public function department_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('staff_department');
    }
	
	
	 public function prabhag_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        /*if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }*/
        $this->db->where('id', $id);
        $this->db->delete('ekal_prabhag');
    }
	
	 public function sambhag_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        /*if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }*/
        $this->db->where('id', $id);
        $this->db->delete('ekal_sambhag');
    }

     public function bhag_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        /*if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }*/
        $this->db->where('id', $id);
        $this->db->delete('ekal_bhag');
    }
	
	 public function anchal_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        /*if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }*/
        $this->db->where('id', $id);
        $this->db->delete('ekal_anchal');
    }
	
	 public function sanch_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        /*if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }*/
        $this->db->where('id', $id);
        $this->db->delete('branch');
    }
    // unique valid department name verification is done here
    public function unique_department($name)
    {
        $department_id = $this->input->post('department_id');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($department_id)) {
            $this->db->where_not_in('id', $department_id);
        }

        $this->db->where('branch_id', $branchID);
        $this->db->where('name', $name);
        $q = $this->db->get('staff_department');
        if ($q->num_rows() > 0) {
            $this->form_validation->set_message("unique_department", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    /* designation form validation rules */
    protected function designation_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('designation_name', translate('designation_name'), 'trim|required|callback_unique_designation');
    }

    // employee designation user interface and information are controlled here
    public function designation()
    {
        if ($_POST) {
            if (!get_permission('designation', 'is_add')) {
                access_denied();
            }
            $this->designation_validation();
            if ($this->form_validation->run() !== false) {
                $arrayData = array(
                    'name' => $this->input->post('designation_name'), 
                    'branch_id' => $this->application_model->get_branch_id(), 
                );
                $this->db->insert('staff_designation', $arrayData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/designation'));
            }
        }
        $this->data['designation'] = $this->app_lib->getTable('staff_designation');
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/designation';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }

    public function designation_edit()
    {
        if (!get_permission('designation', 'is_edit')) {
            ajax_access_denied();
        }
        $this->designation_validation();
        if ($this->form_validation->run() !== false) {
            $designation_id = $this->input->post('designation_id');
            $arrayData = array(
                'name' => $this->input->post('designation_name'), 
                'branch_id' => $this->application_model->get_branch_id(), 
            );
            $this->db->where('id', $designation_id);
            $this->db->update('staff_designation', $arrayData);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    public function designation_delete($id)
    {
        if (!get_permission('designation', 'is_delete')) {
            access_denied();
        }
        $this->db->where('id', $id);
        $this->db->delete('staff_designation');
    }

    // unique valid designation name verification is done here
    public function unique_designation($name)
    {
        $designation_id = $this->input->post('designation_id');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($designation_id)) {
            $this->db->where_not_in('id', $designation_id);
        }
        $this->db->where('name', $name);
        $this->db->where('branch_id', $branchID);
        $q = $this->db->get('staff_designation');
        if ($q->num_rows() > 0) {
            $this->form_validation->set_message("unique_designation", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // showing disable authentication student list
    public function disable_authentication()
    {
        // check access permission
        if (!get_permission('employee_disable_authentication', 'is_view')) {
            access_denied();
        }

        if (isset($_POST['search'])) {
            $branchID = $this->application_model->get_branch_id();
            $role = $this->input->post('staff_role');
            $this->data['stafflist'] = $this->employee_model->getStaffList($branchID, $role, 0);
        }

        if (isset($_POST['auth'])) {
            if (!get_permission('employee_disable_authentication', 'is_add')) {
                access_denied();
            }
            $stafflist = $this->input->post('views_bulk_operations');
            if (isset($stafflist)) {
                foreach ($stafflist as $id) {
                    $this->db->where('user_id', $id);
                    $this->db->where_not_in('role', array(1, 6, 7));
                    $this->db->update('login_credential', array('active' => 1));
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
            } else {
                set_alert('error', 'Please select at least one item');
            }
            redirect(base_url('employee/disable_authentication'));
        }
        $this->data['title'] = translate('deactivate_account');
        $this->data['sub_page'] = 'employee/disable_authentication';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }

    /* employee csv importer */
    public function csv_import()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('user_role', translate('role'), 'trim|required');
        $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
        $this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
        if (isset($_FILES['userfile']['name']) && empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', "Select CSV File", 'required');
        }
        if ($this->form_validation->run() !== false) {
            $branchID = $this->application_model->get_branch_id();
            $userRole = $this->input->post('user_role');
            $designationID = $this->input->post('designation_id');
            $departmentID = $this->input->post('department_id');
            $err_msg = "";
            $i = 0;
            $this->load->library('csvimport');
            $csv_array = $this->csvimport->get_array($_FILES["userfile"]["tmp_name"]);
            if ($csv_array) {
                $columnHeaders = array('Name','Gender','Religion','BloodGroup','DateOfBirth','JoiningDate','Qualification','MobileNo','PresentAddress','PermanentAddress','Email','Password');
                $csvData = array();
                foreach ($csv_array as $row) {
                    if ($i == 0) {
                        $csvData = array_keys($row);
                    }
                    $checkCSV = array_diff($columnHeaders, $csvData);
                    if (count($checkCSV) <= 0) {
                        if (filter_var($row['Email'], FILTER_VALIDATE_EMAIL)) {
                            // verify existing username
                            $this->db->where('username', $row['Email']);
                            $query = $this->db->get_where('login_credential');
                            if ($query->num_rows() > 0) {
                                $err_msg .= $row['Name'] . " - Imported Failed : Email Already Exists.<br>";
                            } else {
                                // save all employee information in the database
                                $this->employee_model->csvImport($row, $branchID, $userRole, $designationID, $departmentID);
                                $i++;
                            }
                        } else {
                            $err_msg .= $row['Name'] . " - Imported Failed : Invalid Email.<br>";
                        }
                    } else {
                        set_alert('error', translate('invalid_csv_file'));
                    }
                }
                if ($err_msg != null) {
                    $msgRes = $i . ' Successfully Added. <br>';
                    $msgRes .= $err_msg;
                    echo json_encode(array('status' => 'errlist', 'errMsg' => $msgRes));
                    exit();
                }
                if ($i > 0) {
                    set_alert('success', $i . ' Successfully Added');
                }
            } else {
                set_alert('error', translate('invalid_csv_file'));
            }
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }




 /* employee csv importer */
    public function csv_import1()
    {
        //if (is_superadmin_loggedin()) {
        //    $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
       // }
		
        //$this->form_validation->set_rules('user_role', translate('role'), 'trim|required');
        //$this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
        //$this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
        if (isset($_FILES['userfile']['name']) && empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', "Select CSV File", 'required');
        }
       // if ($this->form_validation->run() !== false) {
          //  $branchID = $this->application_model->get_branch_id();
          //  $userRole = $this->input->post('user_role');
			 
           // $designationID = $this->input->post('designation_id');
           // $departmentID = $this->input->post('department_id');
            $err_msg = "";
            $i = 0;
            $this->load->library('csvimport');
            $csv_array = $this->csvimport->get_array($_FILES["userfile"]["tmp_name"]);
			 //echo print_r($csv_array); die;
            if ($csv_array) {
                $columnHeaders = array('Name','Gender','JoiningDate','Qualification','MobileNo','Email','Password','Prabhag','Sambhag','Bhag','Anchal','Sanch','vkhand','goan','policestation','booth','address','assembly','category');
                $csvData = array();
                foreach ($csv_array as $row) {
                    if ($i == 0) {
                        $csvData = array_keys($row);
                    }
					$row['pid'] = ''; $row['sid'] = ''; $row['bid'] = ''; $row['aid'] = ''; $branchID = ''; 
					if($row['Prabhag']) {
					$this->db->where('p_name', $row['Prabhag']);
                    $query = $this->db->get_where('ekal_prabhag');
					$prabhag = $query->row_array();
					$row['pid'] = $prabhag['id'];
					}
					
					if($row['Sambhag']) {
					$this->db->where('s_name', $row['Sambhag']);
                    $query = $this->db->get_where('ekal_sambhag');
					$Sambhag = $query->row_array();
					$row['sid'] = $Sambhag['id'];
					}
					
					if($row['Bhag']) {
					$this->db->where('b_name', $row['Bhag']);
                    $query = $this->db->get_where('ekal_bhag');
					$Bhag = $query->row_array();
					$row['bid'] = $Bhag['id'];
					}
					
					if($row['Anchal']) {
					$this->db->where('a_name', $row['Anchal']);
                    $query = $this->db->get_where('ekal_anchal');
					$Anchal = $query->row_array();
					$row['aid'] = $Anchal['id'];
					}
					
					if($row['Sanch']) {  
					$this->db->where('name', $row['Sanch']);
					$this->db->where('school_name', $row['vkhand']);
                    $query = $this->db->get_where('branch');
					$sanch = $query->row_array();
					if($sanch['id'])
					{	$branchID = $sanch['id']; } 
					else
					{
						 
					    $arrayBranch = array(
						'name' => $row['Sanch'], 
                        'school_name' => $row['vkhand'],						
						'p_id' => $row['pid'],
						's_id' => $row['sid'],
						'b_id' => $row['bid'],
						'a_id' => $row['aid'],
						
					);
					echo 	$branchID = $this->employee_model->savesanch($arrayBranch);
					}
					
					
					}
					 
					
                    $checkCSV = array_diff($columnHeaders, $csvData);
                    if (count($checkCSV) <= 0) {
                        
                            // verify existing username
                            $this->db->where('username', $row['Email']);
                            $query = $this->db->get_where('login_credential');
                            if ($query->num_rows() > 0) { 
                                $err_msg .= $row['Name'] . " - Imported Failed : Email Already Exists.<br>";
                            } else {
								//print_r($row); die; 
                                // save all employee information in the database
                                $this->employee_model->csvImport1($row, $branchID);
                                $i++;
                            }
                         
                    } else {
                        set_alert('error', translate('invalid_csv_file'));
                    }
					 
                }
                if ($err_msg != null) {
                    $msgRes = $i . ' Successfully Added. <br>';
                    $msgRes .= $err_msg;
                    echo json_encode(array('status' => 'errlist', 'errMsg' => $msgRes));
                    exit();
                }
                if ($i > 0) {
                    set_alert('success', $i . ' Successfully Added');
                }
            } else {
                set_alert('error', translate('invalid_csv_file'));
            }
            echo json_encode(array('status' => 'success'));
        //} else {
         //   $error = $this->form_validation->error_array();
          //  echo json_encode(array('status' => 'fail', 'error' => $error));
       // }
    }




    /* sample csv downloader */
    public function csv_Sampledownloader()
    {
        $this->load->helper('download');
        $data = file_get_contents('uploads/multi_employee_sample.csv');
        force_download("multi_employee_sample.csv", $data);
    }
}
