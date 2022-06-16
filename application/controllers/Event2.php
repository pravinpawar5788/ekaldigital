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

class Event2 extends Admin_Controller
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
            $this->form_validation->set_rules('fullname', translate('fullname'), 'trim|required');            
            if ($this->form_validation->run() !== false) {                
             
			    if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {
                  $fileInfo = pathinfo($_FILES["user_photo"]["name"]);
			  
                  $img_name = mt_rand(100000,999999) . '.' . $fileInfo['extension'];
                
                move_uploaded_file($_FILES["user_photo"]["tmp_name"], "/var/www/html/school/uploads/nominee/" . $img_name);
				}
				
                $arrayEvent = array(                
                     'cfor' => $this->input->post('cfor'),	
					'state' => $this->input->post('state'),	
					'district' => $this->input->post('subject_id'),	
					'loksabha' => $this->input->post('chapterid'),	
					'assembly' => $this->input->post('assembly'),						 
                    'fullname' => $this->input->post('fullname'),
                    'age' => $this->input->post('age'),
					 'gender' => $this->input->post('gender'),
					  'caste' => $this->input->post('caste'),
					  'electiondate' =>  date("Y-m-d", strtotime($this->input->post('date'))),
					   'PoliticalCareer' => $this->input->post('PoliticalCareer'),
					    'LifeandChildhood' => $this->input->post('LifeandChildhood'),
						'CriminalRecords' => $this->input->post('CriminalRecords'),
						'photo' => 'uploads/nominee/' . $img_name,
                           
                );
				 
                $this->db->insert('nominee', $arrayEvent);
				//echo $this->db->last_query(); die;
				  redirect('event2'); die;
				
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event2');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = "Nominee Details";
        $this->data['sub_page'] = 'event/index3';
        $this->data['main_menu'] = 'Live';
		 $this->data['statelist'] = $this->application_model->getstate();
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/daterangepicker/daterangepicker.css',
				'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
				 'vendor/dropify/js/dropify.min.js',
            ),
        );
		
		
		 
        $this->load->view('layout/index', $this->data);
    }

   public function getdistrict()
    {
	  	$state = $_POST['class_id'];
		$data = $this->application_model->getdistrict($state);
		echo json_encode($data);
	}

    public function getloksabha()
    {
	  	$district = $_POST['subjectid'];
		$data = $this->application_model->getloksabha($district);
		echo json_encode($data);
	}
	
	public function getblock()
    {
	  	$district = $_POST['subjectid'];
		$data = $this->application_model->getblock($district);
		echo json_encode($data);
	}
	
	public function getvillage()
    {
	  	$block = $_POST['vlgid'];
		$data = $this->application_model->getvillage($block);
		
		echo json_encode($data);
	}
	
	public function getgrampanchayat()
    {
	  	$village = $_POST['grmpid'];
		$data = $this->application_model->getgrampanchayat($village);
		
		echo json_encode($data);
	}
	


    public function getassembly()
    {
	  	$loksabha = $_POST['bookid'];
		 $data = $this->application_model->getassembly($loksabha);
		 echo json_encode($data);
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
	public function assignuser1($id = '')
    {
		$role = 9;
		$this->data['act_role'] = $role;
		$this->data['title'] = "Conference User";
		$this->data['sub_page'] = 'employee/assignviewlist';
		$this->data['sid'] = $id;
		//$this->data['main_menu'] = 'employee';
		//$branchID = $this->application_model->get_branch_id();		 
		$this->data['stafflist'] = $this->application_model->getassignStaffList1($id);
		 
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
	
	 public function editevent($id = '')
    {
		
		 if ($_POST) {           
            $this->form_validation->set_rules('fullname', translate('title'), 'trim|required');            
            if ($this->form_validation->run() !== false) {                
               
			   if($this->input->post('youtube1')){
			   $youtubeID = $this->getYouTubeVideoId($this->input->post('youtube1'));
                   $thumbURL1 = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
			   } 
			   if($this->input->post('youtube2')){
			   $youtubeID = $this->getYouTubeVideoId($this->input->post('youtube2'));
                   $thumbURL2 = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
			   }
			   if($this->input->post('youtube3')){
			   $youtubeID = $this->getYouTubeVideoId($this->input->post('youtube3'));
                   $thumbURL3 = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
			   }
			   if($this->input->post('youtube4')){
			   $youtubeID = $this->getYouTubeVideoId($this->input->post('youtube4'));
                   $thumbURL4 = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
			   }
			   if($this->input->post('youtube5')){
			   $youtubeID = $this->getYouTubeVideoId($this->input->post('youtube5'));
                   $thumbURL5 = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
			   }
			   
			    if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {
                  $fileInfo = pathinfo($_FILES["user_photo"]["name"]);
			  
                  $img_name = mt_rand(100000,999999) . '.' . $fileInfo['extension'];
                
                move_uploaded_file($_FILES["user_photo"]["tmp_name"], "/var/www/html/school/uploads/nominee/" . $img_name);
				
				
				
				
				$arrayEvent = array(              
                     					 
                    'fullname' => $this->input->post('fullname'),
                    'age' => $this->input->post('age'),
					 'gender' => $this->input->post('gender'),
					  'caste' => $this->input->post('caste'),					 
					   'PoliticalCareer' => $this->input->post('PoliticalCareer'),
					    'LifeandChildhood' => $this->input->post('LifeandChildhood'),
						'CriminalRecords' => $this->input->post('CriminalRecords'),
						'youtube1' => $this->input->post('youtube1'),
						'youtube2' => $this->input->post('youtube2'),
						'youtube3' => $this->input->post('youtube3'),
						'youtube4' => $this->input->post('youtube4'),
						'youtube5' => $this->input->post('youtube5'),
						'photo' => 'uploads/nominee/' . $img_name,
						'youpath1' => $thumbURL1,
						'youpath2' => $thumbURL2,
						'youpath3' => $thumbURL3,
						'youpath4' => $thumbURL4,
						'youpath5' => $thumbURL5,
                           
                );
				
				
				} else 
				{
					$arrayEvent = array(              
                     					 
                    'fullname' => $this->input->post('fullname'),
                    'age' => $this->input->post('age'),
					 'gender' => $this->input->post('gender'),
					  'caste' => $this->input->post('caste'),					 
					   'PoliticalCareer' => $this->input->post('PoliticalCareer'),
					    'LifeandChildhood' => $this->input->post('LifeandChildhood'),
						'CriminalRecords' => $this->input->post('CriminalRecords'),
						'youtube1' => $this->input->post('youtube1'),
						'youtube2' => $this->input->post('youtube2'),
						'youtube3' => $this->input->post('youtube3'),
						'youtube4' => $this->input->post('youtube4'),
						'youtube5' => $this->input->post('youtube5'),
						'youpath1' => $thumbURL1,
						'youpath2' => $thumbURL2,
						'youpath3' => $thumbURL3,
						'youpath4' => $thumbURL4,
						'youpath5' => $thumbURL5,
						 
                           
                );
				}
				
                
			   
			   
                
				  $this->db->where('id', $this->input->post('ssid'));
            $this->db->update('nominee', $arrayEvent);
                //$this->db->insert('video_training', $arrayEvent);
				 redirect('event2'); die;
				
				
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
		
		$this->data['stafflist'] = $this->application_model->editnominee($id);
		 $this->data['branch_id'] = $branchID;
        $this->data['title'] = "Edit Nominee";
        $this->data['sub_page'] = 'event/index4';
        $this->data['main_menu'] = 'Live';
		
		   $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/daterangepicker/daterangepicker.css',
				'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
				 'vendor/dropify/js/dropify.min.js',
            ),
        );
		 $this->load->view('layout/index', $this->data);
		
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
   $this->db->where('id', $id);
                $this->db->delete('nominee');
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


    public function compressImage($source_image, $compress_image) {
			$image_info = getimagesize($source_image);
			if ($image_info['mime'] == 'image/jpeg') {
			$source_image = imagecreatefromjpeg($source_image);
			imagejpeg($source_image, $compress_image, 40);
			} elseif ($image_info['mime'] == 'image/gif') {
			$source_image = imagecreatefromgif($source_image);
			imagegif($source_image, $compress_image, 40);
			} elseif ($image_info['mime'] == 'image/png') {
			$source_image = imagecreatefrompng($source_image);
			imagepng($source_image, $compress_image, 40);
     }

return $compress_image;
}


}
