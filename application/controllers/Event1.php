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

class Event1 extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // check access permission
        if (!get_permission('event', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {           
            $this->form_validation->set_rules('title', translate('title'), 'trim|required');            
            if ($this->form_validation->run() !== false) { 

            $servertime =  date("H:i:s", strtotime($this->input->post('time_start')));
			$meetcode =  rand(1111111111,9999999999); 
              $datetime = $this->input->post('joining_date')." ".$servertime;  
			  
			   $instructor= implode(',',$this->input->post('state'));
			   //print_r($this->input->post('joining_date')); die;
                $arrayEvent = array(                   
                    'name' => $this->input->post('title'), 
                    'assembly' => $instructor, 					
					'plandate' => $this->input->post('joining_date'),                    
					'plantime' => $this->input->post('time_start'),    
					'videotype' => $this->input->post('videotype'),    
                     'meetingname' => $meetcode, 
                      'serverurl' => $meetcode,					 
                    'imagepath' => "mobilepath.jpg",                    
                                       
                );
                $this->db->insert('video_training', $arrayEvent);
				
				//curl server meetcode
				  $this->createmetting($this->input->post('title'), $meetcode, $datetime);
				  
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event1');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = "Virtual Classroom & Broadcast";
        $this->data['sub_page'] = 'event/index1';
        $this->data['main_menu'] = 'Live';
		
		 $this->data['statelist'] = $this->application_model->getassemblylist();
		
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/daterangepicker/daterangepicker.css',
				'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
				'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }



  public function getstatedata()
    {
        // check access permission
        if (!get_permission('event', 'is_view')) {
            access_denied();
        }
 
        $this->data['title'] = "State List";
        $this->data['sub_page'] = 'event/statelist';
        $this->data['main_menu'] = 'Live';
		
		  $this->data['statelist'] = $this->application_model->getstatelist();
		
        
        $this->load->view('layout/index', $this->data);
    }


  public function createmetting($meetingname, $meetcode, $datetime)
    {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://stage.simplifiedvc.com/api/auth/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"email": "admin",
			"password": "admin123",
			"device_name": "android"
		}',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
	 $res	= json_decode($response);
	 // echo $res->token; 
	//die;

     $curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://stage.simplifiedvc.com/api/meetings',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "title": "'.$meetingname.'",
    "agenda": "यह एक टेस्ट कॉल है agenda ",
    "description": "<p>Now start meeting&nbsp;</p>",
    "start_date_time": "'.$datetime.'",
    "period": 60,
    "type": {
        "uuid": "video_conference"
    },
    "category": {
        "uuid": "9441670f-2582-447b-ba76-8e6a4f6ccb4d"
    },
    "identifier": "'.$meetcode.'",
    "max_participant_count": 1000,
    "accessible_via_link": true,
    "accessible_to_members": false,
    "is_pam": false,
    "is_host": true,
    "is_instant_meeting": false,
    "keep_alive": false,
    "cover": null,
    "attachments": [],
    "planned_start_date_time": "'.$datetime.'",
    "status": "live",
    "has_snapshots": false,
    "has_recordings": false,
    "has_chunk_recordings": false,
    "config": {
        "enable_comments": false,
        "private_comments": false,
        "enable_comment_before_meeting_starts": false,
        "enable_chat": true,
        "enable_yt_live_streaming": true,
        "enable_screen_sharing": false,
        "enable_recording": true,
        "enable_auto_recording": false,
        "auto_upload_recording": false,
        "auto_upload_recorded": false,
        "can_stop_auto_recording": false,
        "enable_hand_gesture": true,
        "footer_auto_hide": false,
        "enable_file_sharing": false,
        "enable_link_sharing": true,
        "enable_whiteboard": false,
        "disable_scroll": true,
        "speech_detection": false,
        "mute_participants_on_start": false,
        "allow_joining_without_devices": false,
        "pam_open_join_as_guest_page": true,
        "pam_enable_screen_sharing_for_guest": true,
        "pam_enable_link_sharing_for_guest": true,
        "pam_enable_whiteboard_for_guest": true,
        "enable_snapshot": false,
        "anyone_can_take_snapshot": false,
        "enable_snapshot_alert": false,
        "snapshot_alert_to_user_only": false,
        "snapshot_alert_to_moderators": false,
        "ask_host_before_joining": false,
        "prefer_rear_camera_first": false,
        "enable_user_avatar": true,
        "enable_full_user_avatar": true,
        "enable_meeting_info": true,
        "force_update_username": false,
        "auto_end_meeting": false,
        "alert_before_auto_end": false,
        "can_snooze_auto_end": false,
        "can_cancel_auto_end": false,
        "alert_before_auto_end_time": 1,
        "max_participant_count": 1000,
        "layout": "grid"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$res->token.'',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;



	
		
	}


      public function privioushistory($id = '')
    {
		
		 
		 $videotraindata  = $this->application_model->getvideotraining($id);
		 
		 $youtubeID = $this->getYouTubeVideoId($videotraindata['path']);
         $thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/hqdefault.jpg';
 
		 $arrayEvent = array(                   
                    'title' => $videotraindata['name'], 
                    'path' => $videotraindata['path'], 					
					'imagepath' => $thumbURL,                    
					'assembly' => '',
                );
		 //print_r($arrayEvent); die;		
        // $this->db->insert('brodcast_history_path', $arrayEvent);
		 redirect('event1'); die;
	}
  
  
  function getYouTubeVideoId($pageVideUrl) {
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}

   public function assignuser($id = '')
    {
		$role = 9;
		$this->data['act_role'] = $role;
		$this->data['title'] = "Assign Conference";
		$this->data['sub_page'] = 'employee/view1';
		$this->data['sid'] = $id;
		//$this->data['main_menu'] = 'employee';
		//$branchID = $this->application_model->get_branch_id();
		//$this->data['stafflist'] = $this->application_model->getStaffList($branchID, $role);
		$this->load->view('layout/index', $this->data);
	}
	
	 public function assignuserassembly($id = '')
    {
		$role = 9;
		$this->data['act_role'] = $role;
		$this->data['title'] = "Assign Conference";
		$this->data['sub_page'] = 'employee/viewassembly';
		$this->data['sid'] = $id;
		//$this->data['main_menu'] = 'employee';
		//$branchID = $this->application_model->get_branch_id();
		 $this->data['statelist'] = $this->application_model->getassemblylist();
		 $this->data['stafflist1'] = $this->application_model->getStaffListnew1(5);
		  $this->data['stafflist2'] = $this->application_model->getStaffListnew2(6);
		$this->load->view('layout/index', $this->data);
	}
	
	public function assignuser1($id = '')
    {
		$role = 9;
		$this->data['act_role'] = $role;
		$this->data['title'] = "Conference User";
		$this->data['sub_page'] = 'employee/assignviewlist';
		$this->data['sid'] = $id;
		//$this->data['main_menu'] = 'employee';
		//$branchID = $this->application_model->get_branch_id();		 
		$this->data['stafflist'] = $this->application_model->getassignStaffList1assembly($id);
		 
		$this->load->view('layout/index', $this->data);
	}
	
	public function assemblyview()
    {
		$role = 9;
		$this->data['act_role'] = $role;
		$this->data['title'] = "Assembly List";
		$this->data['sub_page'] = 'employee/assemblylist';
		$this->data['sid'] = $id;
		//$this->data['main_menu'] = 'employee';
		//$branchID = $this->application_model->get_branch_id();		 
		$this->data['stafflist'] = $this->application_model->getassemblyview();
		 
		$this->load->view('layout/index', $this->data);
	}
	
	
	 public function getlistview()
    {
		$postvalue = $this->input->post();	
		$id = $postvalue['id']; 
		$sid = $postvalue['sid']; 
		$data['stafflist'] = $this->application_model->getStaffList($id);
		//print_r($data); die;
		$data['sid'] = $sid; 
		$this->load->view('employee/view2', $data);
	}
	
	
	 public function getlistviewassembly()
    {
		$postvalue = $this->input->post();	
		$id = $postvalue['id']; 
		 $sid = $postvalue['sid']; 
		$data['stafflist'] = $this->application_model->getStaffListassembly($id);
		  
		$data['sid'] = $sid; 
		$this->load->view('employee/view2', $data);
	}
	
	 public function editevent($id = '')
    {
		
		 if ($_POST) {           
            $this->form_validation->set_rules('title', translate('title'), 'trim|required');            
            if ($this->form_validation->run() !== false) {                
               
			     if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {
                  $fileInfo = pathinfo($_FILES["user_photo"]["name"]);
			  
                  $img_name = mt_rand(100000,999999) . '.' . $fileInfo['extension'];
               
                move_uploaded_file($_FILES["user_photo"]["tmp_name"], "/var/www/html/school/" . $img_name);
				}
			   
			   
                $arrayEvent = array(                   
                    'name' => $this->input->post('title'),
                    'path' => $this->input->post('path'),					 
                    'streamid' => $this->input->post('streamid'), 
                    'imagepath' =>  $img_name, 					
                );
				  $this->db->where('id', $this->input->post('ssid'));
                  $this->db->update('video_training', $arrayEvent);
  
                 if($this->input->post('streamid')) {     
           	    $post = [
					'mId' => $this->input->post('serverurl'),
					'key' => $this->input->post('streamid'),					
					];
					$payload = json_encode($post);
					
					// print_r($payload); die;
					$ch = curl_init('https://stage.simplifiedvc.com/stream/setkey');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 

					// execute!
					$response = curl_exec($ch);

					// close the connection, release resources used
					curl_close($ch);

					// do anything you want with your response
					//var_dump($response);
                   // die;
				} 

           redirect('event1'); die;
  //$this->db->insert('video_training', $arrayEvent);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event1');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
		
		
/*		 
 $post = [
					'mId' => "XLHP5R",
					'key' => "amm0-q7wj-4fds-uk7c-4e0s",					
					];
					$payload = json_encode($post);
					
					// print_r($payload); die;
					$ch = curl_init('https://stage.simplifiedvc.com/stream/setkey');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 

					// execute!
					$response = curl_exec($ch);

					// close the connection, release resources used
					curl_close($ch);

					// do anything you want with your response
					 var_dump($response);
                   die;
		
		*/
		
		$this->data['stafflist'] = $this->application_model->editvideopath($id);
		 $this->data['branch_id'] = $branchID;
        $this->data['title'] = "Virtual Classroom & Broadcast";
        $this->data['sub_page'] = 'event/index2';
        $this->data['main_menu'] = 'Live';
		
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
	
	
	 public function putstaffval()
    {
		 $postvalue = $this->input->post();			  
		 $arrayEvent = array(                   
			'staffid' => $postvalue['staffid'],
			'eventid' => $postvalue['eventid']                    
		);
		$this->db->insert('assignconference', $arrayEvent);  
		echo "ddfd"; die;				
	}
	
    public function delete($id = '')
    {
        // check access permission
        if (get_permission('event', 'is_delete')) {
            $event_db = $this->db->where('id', $id)->get('event')->row_array();
            if ($event_db['created_by'] == get_loggedin_user_id()) {
                $this->db->where('id', $id);
                $this->db->delete('event');
            } else {
                set_alert('error', 'You do not have permission to delete');
            }
        } else {
            set_alert('error', translate('access_denied'));
        }
    }

    /* types form validation rules */
    protected function types_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('type_name', translate('name'), 'trim|required|callback_unique_type');
    }

    // exam term information are prepared and stored in the database here
    public function types()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('event_type', 'is_add')) {
                access_denied();
            }
            $this->types_validation();
            if ($this->form_validation->run() !== false) {
                //save information in the database file
                $data['name'] = $this->input->post('type_name');
                $data['icon'] = $this->input->post('event_icon');
                $data['branch_id'] = $this->application_model->get_branch_id();
                $this->db->insert('event_types', $data);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['typelist'] = $this->app_lib->getTable('event_types');
        $this->data['sub_page'] = 'event/types';
        $this->data['main_menu'] = 'event';
        $this->data['title'] = translate('event_type');
        $this->load->view('layout/index', $this->data);
    }

    public function types_edit()
    {
        if ($_POST) {
            if (!get_permission('event_type', 'is_edit')) {
                ajax_access_denied();
            }
            $this->types_validation();
            if ($this->form_validation->run() !== false) {
                //save information in the database file
                $data['name'] = $this->input->post('type_name');
                $data['icon'] = $this->input->post('event_icon');
                $data['branch_id'] = $this->application_model->get_branch_id();
                $this->db->where('id', $this->input->post('type_id'));
                $this->db->update('event_types', $data);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event/types');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function type_delete($id)
    {
        if (!get_permission('event_type', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('event_types');
    }

    /* unique valid type name verification is done here */
    public function unique_type($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $type_id = $this->input->post('type_id');
        if (!empty($type_id)) {
            $this->db->where_not_in('id', $type_id);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('event_types')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_type", translate('already_taken'));
            return false;
        }
    }

    // the event is controlled from here published or unpublished
    public function status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($status == 'true') {
            $arrayData['active'] = 1;
        } else {
            $arrayData['active'] = 0;
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->update('video_training', $arrayData);
        $return = array('msg' => translate('information_has_been_updated_successfully'), 'status' => true);
        echo json_encode($return);
    }

    public function getDetails()
    {
        $id = $this->input->post('event_id');
        if (empty($id)) {
            redirect(base_url(), 'refresh');
        }

        $auditions = array("1" => "everybody", "2" => "class", "3" => "section");
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $ev = $this->db->get('event')->row_array();
        $type = $ev['type'] == 'holiday' ? translate('holiday') : get_type_name_by_id('event_types', $ev['type']);
        $remark = (empty($ev['remark']) ? 'N/A' : $ev['remark']);
        $html = "<tbody><tr>";
        $html .= "<td>" . translate('title') . "</td>";
        $html .= "<td>" . $ev['title'] . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('type') . "</td>";
        $html .= "<td>" . $type . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('date_of_start') . "</td>";
        $html .= "<td>" . _d($ev['start_date']) . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('date_of_end') . "</td>";
        $html .= "<td>" . _d($ev['end_date']) . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('audience') . "</td>";
        $audition = $auditions[$ev['audition']];
        $html .= "<td>" . translate($audition);
        if ($ev['audition'] != 1) {
            $selecteds = json_decode($ev['selected_list']);
            foreach ($selecteds as $selected) {
                $html .= "<br> <small> - " . $this->db->get_where($audition, array('id' => $selected))->row()->name . '</small>';
            }
        }
        $html .= "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('description') . "</td>";
        $html .= "<td>" . $remark . "</td>";
        $html .= "</tr></tbody>";
        echo $html;
    }

    /* generate section with class group */
    public function getSectionByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $result = $this->db->get_where('class', array('branch_id' => $branchID))->result_array();
            if (count($result)) {
                foreach ($result as $class) {
                    $html .= '<optgroup label="' . $class['name'] . '">';
                    $allocations = $this->db->get_where('sections_allocation', array('class_id' => $class['id']))->result_array();
                    if (count($allocations)) {
                        foreach ($allocations as $allocation) {
                            $section = $this->db->get_where('section', array('id' => $allocation['section_id']))->row_array();
                            $html .= '<option value="' . $allocation['section_id'] . '">' . $section['name'] . '</option>';
                        }
                    } else {
                        $html .= '<option value="">' . translate('no_selection_available') . '</option>';
                    }
                    $html .= '</optgroup>';
                }
            }
        }
        echo $html;
    }

    public function get_events_list($branchID = '')
    {
        if (is_loggedin()) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            } else {
                $this->db->where('branch_id', $branchID);
            }
            $this->db->where('status', 1);
            $events = $this->db->get('event')->result();
            foreach ($events as $row) {
                $arrayData = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'start' => $row->start_date,
                    'end' => date('Y-m-d', strtotime($row->end_date . "+1 days")),
                );
                if ($row->type == 'holiday') {
                    $arrayData['className'] = 'fc-event-danger';
                    $arrayData['icon'] = 'umbrella-beach';
                } else {
                    $icon = get_type_name_by_id('event_types', $row->type, 'icon');
                    $arrayData['icon'] = $icon;
                }
                $eventdata[] = $arrayData;
            }
            echo json_encode($eventdata);
        }
    }

}
