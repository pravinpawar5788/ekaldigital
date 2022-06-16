 <?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

 // Allow from any origin
	if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

	// Access-Control headers are received during OPTIONS requests
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}



	class Webservices extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('authentication_model');
			$class = $this->router->fetch_class();
			$method = $this->router->fetch_method();
			if ($this->input->server('REQUEST_METHOD') == 'GET')
				$postdata = json_encode($_GET);
			else if ($this->input->server('REQUEST_METHOD') == 'POST')
				$postdata = file_get_contents("php://input");
			
			$auth = '';

			if(isset(apache_request_headers()['Auth'])) {
            	$auth = apache_request_headers()['Auth'];
        	}
			
        	//$this->last_id = set_log($class,$method,$postdata,$auth);

		}

    public function userlogin($email, $password){
	         // echo  $fcmid = $_GET['fcmId'];  
			//header('Content-type: application/json');
			//$postdata = file_get_contents("php://input");	 
            //$request = json_decode($postdata,true);   
		     
			//$email = $request['email'];
			//$password = $request['password'];			 
			 
			 
			 
			    $login_credential = $this->authentication_model->login_credential1($email, $password);
				//if($fcmId) { 
			    // $this->db->where('id', 5);
                //$this->db->update('staff', array('gcmid' => $fcmId));
			    //echo $this->db->last_query(); die; 
				//}
			//$result = $this->subject_model->getChapterByClsandSection($class_id, $subjectid);
			
			header('Content-type: application/json');
 
			print json_encode($login_credential);
			//$this->response($result);

	}
	
	 public function userlogin1(){
	           $fcmid = $_GET['fcmId'];  
			    $password = $_GET['password'];  
				 $email = $_GET['username'];  
			  
			//header('Content-type: application/json');
			//$postdata = file_get_contents("php://input");	 
            //$request = json_decode($postdata,true);   
		     
			//$email = $request['email'];
			//$password = $request['password'];			 
			 
			 
			 
			    $login_credential = $this->authentication_model->login_credential1($email, $password);
				
				if($fcmid) { 
			     $this->db->where('id', $login_credential['result']->id);
                 $this->db->update('staff', array('gcmid' => $fcmid));
			     //echo $this->db->last_query(); die; 
				 }
			//$result = $this->subject_model->getChapterByClsandSection($class_id, $subjectid);
			
			header('Content-type: application/json');
 
			print json_encode($login_credential);
			//$this->response($result);

	}
	
	
	 // moderator employee all information
    public function usersave()
    {
		 
 
		 
		 
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		$request = json_decode($postdata,true);   
		$request =   $_GET;
		$branchid = 0; 	 
		// print_r($request); die;
		
		  $numrow = $this->application_model->checkmobileno($request['mobileno']);
		 if($numrow > 0)
		 {
			 header('Content-type: application/json');
			  $success = array(
			  'msg' => "Please enter unique mobile no..",
               'status' => "error",				  
            'username' => $request['mobileno'],
            'password' => "Please enter unique mobile no..",
        ); 
           
			print json_encode($success);
		 }
		 else
		 {
		if($request['name']) {  
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),			 
			'staff_role'=>10,
            'name' => $request['name'],
            'sex' => $request['gender'],
            'religion' =>$request['religion'],
			'cast' =>$request['cast'],
			'emptype' =>$request['employed'],
            'blood_group' => 'A+',
            'birthday' => date("Y-m-d"),
            'mobileno' => $request['mobileno'],
            'present_address' => $request['state'],
            'permanent_address' => $request['state'],
            'photo' => "photo",            
            'joining_date' => date("Y-m-d"),
            'qualification' => "User",
            'email' => $request['mobileno'],
            'facebook_url' => "faaa.com",
            'linkedin_url' => "linkkk.com",
            'twitter_url' => "twwww.com",
			'voteid' => $request['voterid'],
			'booth' => $request['booth'],
			'add_user' => $request['user_id'],
			'noofuser' => $request['noofuser'],
			'goan' => $request['goan'],
			'gramblock' => $request['block'],
			'gramvillage' => $request['village'],
			'grampanchayat' => $request['goan'],
			'assembly' => $request['assembly'],
			'loksabha' => $request['loksabha'],
			'gramtype' => $request['gramType'],
			'category' => $request['category'],
			'pincode' => $request['pincode'],
			'age' => $request['userAge'],
			'kstate'=>$request['state'],
			'kdistrict'=>$result['district'],
        );

        $inser_data2 = array(
            'username' => $request['mobileno'],
            'role' => 10,
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
            $inser_data2['password'] = $request['mobileno'];
            $this->db->insert('login_credential', $inser_data2);

            // SAVE USER BANK INFORMATION IN THE DATABASE
            /*if (!isset($data['chkskipped'])) {
                $data['staff_id'] = $employeeID;
                $this->bankSave($data);
            }*/
			
			 $success = array(
            'username' => $request['mobileno'],
            'password' => $request['mobileno'],
			'msg' => "Successfully added",
               'status' => "success",	
        );
			
				header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($success);
			
           // return $employeeID;
        }  
		}
		else
		{
			
			header('Content-type: application/json');
            $success = array(
            'username' => $request['mobileno'],
            'password' => "Please enter first name..",
			'msg' => "Please enter first name..",
               'status' => "error",	
        ); 
			print json_encode($success);
			
		}
	 }
		
    }
	
	
	 public function savefamilymember()
    {
		 
 
		 
		
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		$request = json_decode($postdata,true);   
		$request =   $_GET;
		$branchid = 0; 	 
		//print_r($request); die;
		$prefix = strtolower(substr( $request['name'], 0, 4));  
		  $numrow = $this->application_model->checkusername($request['mobileno']."".$prefix);
		 if($numrow > 0)
		 {
			 header('Content-type: application/json');
			  $success = array(
			  'msg' => "This user is already registered .",
               'status' => "error",				  
            'username' => $request['mobileno'],
            'password' => "This user is already registered.",
        ); 
           
			print json_encode($success);
		 }
		 else
		 {
	 
	    $result = $this->db->select()
                ->where('id', $request['user_id'])
                ->get('staff')->row_array();	
	    // print_r($result['name']); die;
		if($request['name']) {  
		
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),			 
			'staff_role'=>10,
            'name' => $request['name'],
            'sex' => $request['gender'],
            'religion' => $result['religion'],
            'blood_group' => 'A+',
            'birthday' => date("Y-m-d"),
            'mobileno' => $result['mobileno'],
            'present_address' => $result['state'],
            'permanent_address' => $result['state'],
            'photo' => "photo",            
            'joining_date' => date("Y-m-d"),
            'qualification' => "User",
            'email' => $result['mobileno'],
            'facebook_url' => "faaa.com",
            'linkedin_url' => "linkkk.com",
            'twitter_url' => "twwww.com",
			'voteid' => $request['voterid'],
			'booth' => $result['booth'],
			'add_user' => $request['user_id'],
			'noofuser' => $result['noofuser'],
			'goan' => $result['goan'],
			'gramblock' => $result['gramblock'],
			'gramvillage' => $result['gramvillage'],
			'grampanchayat' => $result['goan'],
			'assembly' => $result['assembly'],
			'loksabha' => $result['loksabha'],
			'gramtype' => $result['gramType'],
			'category' => "4",
			'family_member' => "1",
			'age' => $request['userAge'],
			'kstate'=>$result['state'],
			'kdistrict'=>$result['district'],
        );
		
		
//print_r($inser_data1['name']); die;
        $inser_data2 = array(
            'username' => $result['mobileno']."".$prefix,
            'role' => 10,
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
			//$inser_data2['username'] = $employeeID;
            $inser_data2['password'] = $result['mobileno']."".$prefix;
            $this->db->insert('login_credential', $inser_data2);

            // SAVE USER BANK INFORMATION IN THE DATABASE
            /*if (!isset($data['chkskipped'])) {
                $data['staff_id'] = $employeeID;
                $this->bankSave($data);
            }*/
			
			 $success = array(
            'username' => $result['mobileno']."".$prefix,
            'password' => $result['mobileno']."".$prefix,
			'msg' => "Successfully added",
               'status' => "success",	
        );
			
				header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($success);
			
           // return $employeeID;
        }  
		}
		else
		{
			
			header('Content-type: application/json');
            $success = array(
            'username' => $request['mobileno'],
            'password' => "Please enter first name..",
			'msg' => "Please enter first name..",
               'status' => "error",	
        ); 
			print json_encode($success);
			
		}
	 }
		
    }
	
	
	
	
	 public function gettopnews()
      {
		  
		
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		 
		 
		 $newslist = $this->application_model->gettopnewslist();
		   $data['newslist'] = $newslist; 	 
		 
		   header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($data);
		 
		 
	 }
	
	
	 public function getusercredentials($userid)
      {
		  
		
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		//$request = json_decode($postdata,true);   
		//$request =   $_GET;
		 
		 $userinfo = $this->application_model->getusercredentials($userid);
		 if($userinfo['username'])
		 {
		  $success = array(
            'username' => $userinfo['username'],
            'password' => $userinfo['password'],
            'status' => "success",				
        );
		 }
		 else{
			 $success = array(
             'status' => "error",				
        );
		 }
		 
							header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($success);
		 
		 
	 }
	
	
	 public function updateuserpersonaldetails()
    {
		  
		
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		$request = json_decode($postdata,true);   
		$request =   $_GET;
		$branchid = 0; 
		
        $update_data1 = array(            
            'name' => $request['name'],
			'age' => $request['userAge'],
            'sex' => $request['gender'],
			'mobileno' => $request['mobileno'],
            'religion' => $request['religion'],
			'cast' => $request['cast'],
            'emptype' => $request['emptype'],
            'kstate'=>$request['state'],
			'kdistrict'=>$request['district'],
			'pincode'=>$request['pincode'],           
           
        );
		
		      $this->db->where('id', $request['user_id']);
              $this->db->update('staff', $update_data1);            		 
			
			 $success = array(           
			'msg' => "Successfully update",
               'status' => "success",	
        );
			
		    header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($success);
	 
		
    }
	
	
	public function updateuservotingdetails()
    {
		  
		
		header('Content-type: application/json');
		$postdata = file_get_contents("php://input");	 
		$request = json_decode($postdata,true);   
		$request =   $_GET;
		$branchid = 0; 
		
        $update_data1 = array(  
             'kstate'=>$request['state'],
			'kdistrict'=>$request['district'],		
            'loksabha' => $request['loksabha'],
			'assembly' => $request['assembly'],
            'grampanchayat' => $request['goan'],
			'goan' => $request['goan'],
			'gramblock' => $request['gramblock'],
            'gramvillage' => $request['gramvillage'],
			'voteid' => $request['voteid'],
            'booth' => $request['booth'],          
           
        );
		
		      $this->db->where('id', $request['user_id']);
              $this->db->update('staff', $update_data1);            		 
			
			
			 $success = array(           
			'msg' => "Successfully update",
               'status' => "success",	
        ); 
		    header('Content-type: application/json');
          //$result =  "Recoed Inserted.."; 
			print json_encode($success);
	 
		
    }
	
	
	 public function resetpassword(){
	          $currentpwd =  $_GET['current_password'];
			  $newpwd =  $_GET['new_password'];
			  $id = $_GET['user_id'];
			//header('Content-type: application/json');
			//$postdata = file_get_contents("php://input");	 
            //$request = json_decode($postdata,true);   
		     
			//$email = $request['email'];
			//$password = $request['password'];			 
			   
			   $getPassword = $this->db->select('password')
                ->where('id', $id)
                ->get('login_credential')->row()->password;	 
            
			 
            if ($currentpwd == $getPassword) { 
			   
			    $this->db->where('id', $id);
                $this->db->update('login_credential', array('password' => $newpwd));
				//echo $this->db->last_query(); die;
				 $res['status'] = "success";
				
			 } else {
                    $res['status'] = "password wrong";
				 } 
			 
 
			header('Content-type: application/json');
 
			 print json_encode($res);
			//$this->response($result);

	}

   
	
	 public function updateteacher(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	
			
                    $query = "SELECT s.id, n.name,n.mobileno FROM `newtab` n inner join staff s on n.`mobileno` = s.mobileno";
					  $result1 = $this->db->query($query)->result_array();
			 //$result1 = $this->db->select('*')               
               // ->get('newtab')->result_array();	 
				foreach($result1 as $result) { 
     			echo "UPDATE `staff` SET `assembly` = '".$result['name']."' WHERE `staff`.`id` = ".$result['id'].";"; 
				  
				 
				}
		//	header('Content-type: application/json');
           
            
			//print json_encode($result);
			//$this->response($result);

	}
	
	
	 public function getuserjoinmeeting($id){
	   
	   
	   
	 
	   
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
             
            
			  $result1 = $this->authentication_model->gettodayplanListapi($id); 	 
			foreach($result1 as $result) {    
				  $post = [
	   'name' => $result['name'],
	   'email' => $result['password']."@gmail.com",
    'username' => $result['username'],
    'password' => $result['password'],
    'password_confirmation'   => $result['password'],
];
 //print_r($post); die;
$ch = curl_init('https://stage.simplifiedvc.com/api/auth/register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);

 
			}	 
			
     			
			header('Content-type: application/json');
           
            
			print json_encode($update_record);
			//$this->response($result);

	}
	
	 public function totaluseradded($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			 $result = $this->db->select('id')
                ->where('add_user', $userid)
                ->get('staff')->num_rows();	 
     		
            $sql = "SELECT sum(cast(noofuser as int)) as noofuser FROM `staff` WHERE add_user =" . $this->db->escape($userid);  
		
               $query = $this->db->query($sql);

         $result2 =  $query->row_array(); 

  $data['noofuser'] = $result2['noofuser']; 
			
			$data['totalcount'] = $result; 	
			
               $result1 = $this->db->select('*')
                ->where('add_user', $userid)
                ->get('staff')->result_array();	  

             $data['userlist'] = $result1; 	
			
			
						 
			
			header('Content-type: application/json');
           
            
			print json_encode($data);
			//$this->response($result);

	}
	
	 public function totalfamilymemberadded($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

		
			
               $result1 = $this->db->select('*')
                ->where('add_user', $userid)
				->where('family_member', "1")
                ->get('staff')->result_array();	  

             $data['userlist'] = $result1; 	
			
			
						 
			
			header('Content-type: application/json');
           
            
			print json_encode($data);
			//$this->response($result);

	}
	
	 public function nomineeinfo($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			  $sql = "SELECT n.* FROM `nominee` n inner join staff s on n.`assembly` = s.assembly WHERE s.id =" . $this->db->escape($userid);  
		     $sql1 = "SELECT n.* FROM `nominee` n inner join staff s on n.`assembly` = s.assembly WHERE s.id =" . $this->db->escape($userid)." AND electiondate >= CURDATE() ORDER BY electiondate";  
			 $sql2 = "SELECT n.* FROM `nominee` n inner join staff s on n.`loksabha` = s.loksabha WHERE s.id =" . $this->db->escape($userid)." AND electiondate >= CURDATE() ORDER BY electiondate";  
		
		
               $query = $this->db->query($sql);

            $query2 = $this->db->query($sql2);
			$query1 = $this->db->query($sql1);
           

         $result =  $query->row_array();         	
		 $result['data'] =  $query2->result_array();         	
		    $result['data'] =  $query1->result_array();   
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function upcommingevents($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");
			
			 $sql = "SELECT n.* FROM `nominee` n inner join staff s on n.`assembly` = s.assembly WHERE s.id =" . $this->db->escape($userid)." AND electiondate >= CURDATE() ORDER BY electiondate";  
			 $sql1 = "SELECT n.* FROM `nominee` n inner join staff s on n.`loksabha` = s.loksabha WHERE s.id =" . $this->db->escape($userid)." AND electiondate >= CURDATE() ORDER BY electiondate";  
			
			//$sql = "SELECT fullname, electiondate FROM nominee WHERE electiondate >= CURDATE() ORDER BY electiondate" ;
			
	  
            $query = $this->db->query($sql);
			$query1 = $this->db->query($sql1);
            $result['data'] =  $query->result_array();         	
		    $result['data'] =  $query1->result_array();         	
			header('Content-type: application/json');
           
            
			print json_encode($result);
			
			//$sql1 = "DELETE FROM `staff` WHERE `electiondate` &gt; DATE_SUB(NOW(), INTERVAL 10 MINUTE)";
			//sql = DELETE FROM table WHERE date < (NOW() - INTERVAL 5 MINUTE)


	}
	
	public function staffinfo($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			 $result = $this->db->select('fullname , electiondate')
                ->where('id', $userid)
                ->get('staff')->row();	 
     			
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	
	
	 public function staffinfo1($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			 $result = $this->db->select('name , voteid ,booth, assembly')
                ->where('id', $userid)
                ->get('staff')->row();	 
     			
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	 public function userinfo($userid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			 $result = $this->db->select('*')
                ->where('id', $userid)
                ->get('staff')->row();	 
     			
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	
	
	 public function getassemblyall(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			  $sql = "SELECT `assembly` FROM `constituencylist` where `state` = 'Uttar Pradesh'";  
		
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	 public function getstate(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			  $sql = "SELECT `state` FROM `constituencylist` group by `state`";  
		
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	 public function getstatepath(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			  $sql = "SELECT * FROM `statepath`";  
		
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function getbroadhispath(){
		$assembly1 = $_GET['assembly'];
	    $assembly = str_replace('%20', ' ', $assembly1);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
              if($assembly)
			  {				  
     		  $sql = "SELECT * FROM `brodcast_history_path` where assembly= '".$assembly."' OR assembly= '' ORDER BY id DESC";  
              } 
              else
              {
				  $sql = "SELECT * FROM `brodcast_history_path` ORDER BY id DESC";    
              }     	          
			  
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	
	
	public function getdistrict($state){
	   $state = str_replace('%20', ' ', $state);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			   $sql = "SELECT `district` FROM `constituencylist` where state =" . $this->db->escape($state)." group by `district`";  
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function getloksabha($district){
	   $district = str_replace('%20', ' ', $district);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			   $sql = "SELECT `lokshabha` FROM `constituencylist` where district =" . $this->db->escape($district)." group by `lokshabha`";  
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function getassembly($loksabha){
	   $loksabha = str_replace('%20', ' ', $loksabha);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			   $sql = "SELECT `assembly` FROM `constituencylist` where lokshabha =" . $this->db->escape($loksabha)." group by `assembly`";  
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	
	public function getblock($district){
	   $district = str_replace('%20', ' ', $district);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			      $sql = "SELECT block FROM constituencylist where district = " . $this->db->escape($district)." group by block";    
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		//print_r($result); die;
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function getvillage($block){
	   $block = str_replace('%20', ' ', $block);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			   $sql = "SELECT `village` FROM `constituencylist` where block =" . $this->db->escape($block)." group by `village`";  
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	public function getgrampanchayat($village){
	   $village = str_replace('%20', ' ', $village);
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			   $sql = "SELECT `grampanchayat` FROM `constituencylist` where village =" . $this->db->escape($village)." group by `grampanchayat`";  
		 
               $query = $this->db->query($sql);

         $result['data'] =  $query->result_array();         	
		
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
    public function resetprofile(){
	          $voteid =  $_GET['voteid'];
			  $booth =  $_GET['booth'];
			   $assembly =  $_GET['assembly'];
			  $name =  $_GET['name'];
			  $id = $_GET['user_id'];
			//header('Content-type: application/json');
			//$postdata = file_get_contents("php://input");	 
            //$request = json_decode($postdata,true);   
		     
			//$email = $request['email'];
			//$password = $request['password'];			 
			   
			   
			   
			    $this->db->where('id', $id);
                $this->db->update('staff', array('voteid' => $voteid, 'booth' => $booth, 'assembly' => $assembly));
				//echo $this->db->last_query(); die;
				 $res['status'] = "success";
				
			 
			 
 
			header('Content-type: application/json');
 
			 print json_encode($res);
			//$this->response($result);

	}

    public function todaytelecast($staffid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

		     $result = $this->authentication_model->todaytelecasteventid(); 
			 
			 foreach($result as $resjson)
			 {
				 $result1 = array();
				 $result1 = $this->authentication_model->gettodayplanList1($staffid, $resjson['id']);
				 if($result1['staffid']) { 
				  $update_record[] = array(
                    'id' => $resjson['id'],
                    'eventname' => $resjson['name'],                    
					'plandate' => $resjson['plandate'],
					'plantime' => $resjson['plantime'],
					'imagepath' => $resjson['imagepath'],
					'my_id' => $resjson['my_id'],
					'serverurl' => $resjson['serverurl'],
					'youtubepath' => $resjson['path'],
					'active' => $resjson['active'],
					'joinstatus' => $resjson['joinstatus'],
					'meetingname' => $resjson['meetingname'],					
					'videotype' => $resjson['videotype'],
					'user_id' => $result1['staffid']
                );
			 }
				else
				{
					 $update_record[] = array(
                    'id' => $resjson['id'],
                    'eventname' => $resjson['name'],                    
					'plandate' => $resjson['plandate'],
					'plantime' => $resjson['plantime'],
					'imagepath' => $resjson['imagepath'],
					'my_id' => $resjson['my_id'],
					'serverurl' => $resjson['serverurl'],
					'youtubepath' => $resjson['path'],
					'active' => $resjson['active'],
					'joinstatus' => $resjson['joinstatus'],
					'meetingname' => $resjson['meetingname'],
                    'videotype' => $resjson['videotype']					
					 
                );
				}
				
			 }
		    
             
              
		
		
			header('Content-type: application/json');
           
            
			print json_encode(array('data' =>$update_record));
			//$this->response($result);

	}


     public function class_list(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			$result = $this->class_model->getclass();       			
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	  public function staff(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

			$result = $this->staff_model->get();       			
			header('Content-type: application/json');
           
            
			print json_encode($result);
			//$this->response($result);

	}
	
	 public function classlist(){
	   
		//	header('Content-type: application/json');
		//	$postdata = file_get_contents("php://input");	 

			$result = $this->class_model->get();       			
			header('Content-type: application/json');
            $res['response']['classinfo'] = $result;
            
			print json_encode($res);
			//$this->response($result);

	}
		
	 public function checkstudentlog($id){
	   
	   
		//	header('Content-type: application/json');
		//	$postdata = file_get_contents("php://input");	 

            $resultcode = $this->subject_model->checkstudentlogcode($id);
			$schoolcode = $resultcode['schoolcode'];
		  	$student_id = $resultcode['student_id'];
	 	$result = $this->subject_model->checkstudentlog1($student_id, $schoolcode);        			
			    
			header('Content-type: application/json');	 
		     if($result == 0) 
			 {
				 $res['status'] = "no";
			 }
			 else
			 {
            $res['status'] = "yes";
			 }
			 
			print json_encode($res);
			//$this->response($result);

	}	
		
	 public function subject_list(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
            $request = json_decode($postdata,true);   
			   $result = $this->subject_model->getSubjectByClsandSection($request);
			
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}	
	
     
	
	 public function chapter_list(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
            $request = json_decode($postdata,true);   
		     
			$class_id = $request['class_id'];
			$bookid = $request['bookid'];			 
			 
			$result = $this->subject_model->getLessonByClsandSection($class_id, $bookid);
			
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}

	 public function lessonaddapi(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
            $request = json_decode($postdata,true);   
		     
			 	 
			 
			$result =  $this->subject_model->lessonadd($request);
			
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}
	  public function schoollevel_lesson(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	
            
			$result = $this->subject_model->getlesson();		  			
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}
	 public function schoollevel_lessonapi($sccode){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	
             
			$result = $this->subject_model->getlessonapi($sccode);		  			
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}
	 public function topic_list(){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 
            $request = json_decode($postdata,true);   
		     
			$class_id = $request['class_id'];
			$bookid = $request['bookid'];			 
			 
			//$result = $this->subject_model->getChapterByClsandSection($class_id, $subjectid);
			$result = $this->subject_model->getLessonByClsandSectionapi($class_id, $bookid);
			header('Content-type: application/json');

			print json_encode($result);
			//$this->response($result);

	}


 public function todayliveclass($staffid){
	   
			header('Content-type: application/json');
			$postdata = file_get_contents("php://input");	 

		  
		    
             $result = $this->authentication_model->gettodayplanList($staffid);
         
		
		
			header('Content-type: application/json');
           
            
			print json_encode(array('data' =>$result));
			//$this->response($result);

	}
	
	
 public function flashscreenapiadd(){
	 $str = "प्रतियोगी परीक्षाओं में सफलता दिलाने के लिए उत्तर प्रदेश सरकार ने अभ्युदय कोचिंग प्रारम्भ की है।";
	  $inser_data2['address'] = $str;
            $this->db->insert('flashscreenmsg', $inser_data2);
 }	

 public function flashscreenapi(){
	   
				header('Content-type: application/json;charset=utf-8');
			$postdata = file_get_contents("php://input");	
             
			 
			 
			$result = $this->application_model->flashscreenget(2);		  			
		       
			header('Content-type: application/json;charset=utf-8'); 
              $addstring =  $result['address'];
			  
			    print $addstring;   
            //print $addstring;   
		 //	print json_encode($addstring);
			//$this->response($result);

	}


 public function flashscreenapigoa(){
	   
				header('Content-type: application/json;charset=utf-8');
			$postdata = file_get_contents("php://input");	
             
			 
			 
			$result = $this->application_model->flashscreenget(3);		  			
		       
			header('Content-type: application/json;charset=utf-8'); 
              $addstring =  $result['address'];
			  
			    print $addstring;   
            //print $addstring;   
		 //	print json_encode($addstring);
			//$this->response($result);

	}
	
 public function flashscreenapiuk(){
	   
				header('Content-type: application/json;charset=utf-8');
			$postdata = file_get_contents("php://input");	
             
			 
			 
			$result = $this->application_model->flashscreenget(4);		  			
		       
			header('Content-type: application/json;charset=utf-8'); 
              $addstring =  $result['address'];
			  
			    print $addstring;   
            //print $addstring;   
		 //	print json_encode($addstring);
			//$this->response($result);

	}	

public function flashscreenapimanipur(){
	   
				header('Content-type: application/json;charset=utf-8');
			$postdata = file_get_contents("php://input");	
             
			 
			 
			$result = $this->application_model->flashscreenget(5);		  			
		       
			header('Content-type: application/json;charset=utf-8'); 
              $addstring =  $result['address'];
			  
			    print $addstring;   
            //print $addstring;   
		 //	print json_encode($addstring);
			//$this->response($result);

	}	

public function flashscreenapipanjab(){
	   
				header('Content-type: application/json;charset=utf-8');
			$postdata = file_get_contents("php://input");	
             
			 
			 
			$result = $this->application_model->flashscreenget(6);		  			
		       
			header('Content-type: application/json;charset=utf-8'); 
              $addstring =  $result['address'];
			  
			    print $addstring;   
            //print $addstring;   
		 //	print json_encode($addstring);
			//$this->response($result);

	}	


 public function sendPushNotificationToGCMtest() 
     { 
       $registatoin_ids =    "cK_qt72eS5yefHdUw4_82C:APA91bEuQnBoXQs5jDWKxzDm7DjibUAd_XQHZZVhas0i0yxI6JXmTcwp6B6kIJuQxSFblxw_F95H5QItgstuixpv5_QC-IitvdcMpR3j-DQz2lOTXcqxsgMXCL5Ax1c7g0pKcNLVFb0o";   
      
       $message = array("m" => 'Pravin message', "subject"=>"subject here");
      
     $url = 'https://fcm.googleapis.com/fcm/send';
      	$fields = array(
                'to'  => $registatoin_ids,
                'data'=> $message );		
	   //print_r($fields); die;
	   $key='AAAADzEXPJc:APA91bF4X3QqSYrlEDKbANDomOfhHLms3SrWvAO5wLIMZB-X5qKu6GgFpxS7R-2DWs-k4eZUhhXOGJ6G2KO5YK5Aa7evt8D6QNTS4cLAMSBBPBo-wYhOMRqokUluC3l7q-3nN7Cux3nQ';
        $headers = array('Authorization: key='.$key ,
                         'Content-Type: application/json' );
         $ch = curl_init();                 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 /*$info = curl_getinfo($ch);
var_dump($info);*/
        // Close connection
        curl_close($ch);
 
      // return $result;
	   print_r($result); die;
     }




	}






