<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class App_lib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_credential_id($user_id, $staff = 'staff')
    {
        $this->CI->db->select('id');
        if ($staff == 'staff') {
            $this->CI->db->where_not_in('role', array(6, 7));
        } elseif ($staff == 'parent') {
            $this->CI->db->where('role', 6);
        } elseif ($staff == 'student') {
            $this->CI->db->where('role', 7);
        }
        $this->CI->db->where('user_id', $user_id);
        $result = $this->CI->db->get('login_credential')->row_array();
        return $result['id'];
    }

    function get_bill_no($table)
    {
        $result = $this->CI->db->select("max(bill_no) as id")->get($table)->row_array();
        $id = $result["id"];
        if (!empty($id)) {
            $bill = $id + 1;
        } else {
            $bill = 1;
        }
        return str_pad($bill, 4, '0', STR_PAD_LEFT);
    }

    function get_table($table, $id = NULL, $single = FALSE)
    {
        if ($single == TRUE) {
            $method = 'row_array';
        } else {
            $this->CI->db->order_by('id', 'ASC');
            $method = 'result_array';
        }
        if ($id != NULL) {
            $this->CI->db->where('id', $id);
        }
        $query = $this->CI->db->get($table);
        return $query->$method();
    }

    function getTable($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        if (!is_superadmin_loggedin()) {
            $this->CI->db->where("branch_id", get_loggedin_branch_id());
        }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,b.name as branch_name");
        $this->CI->db->from("$table as t");
        $this->CI->db->join("branch as b", "b.id = t.branch_id", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	
	
	function getPrabhag($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        //if (!is_superadmin_loggedin()) {
        //    $this->CI->db->where("state_name", get_loggedin_branch_id());
       // }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,s.state_name as state_name");
        $this->CI->db->from("$table as t");
        $this->CI->db->join("ekal_state as s", "s.id = t.state_name", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	
	function getSambhag($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        //if (!is_superadmin_loggedin()) {
        //    $this->CI->db->where("state_name", get_loggedin_branch_id());
       // }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,s.state_name as state_name,p.p_name as p_name");
        $this->CI->db->from("$table as t");
        $this->CI->db->join("ekal_state as s", "s.id = t.state_name", "left");
		$this->CI->db->join("ekal_prabhag as p", "p.id = t.p_id", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	function getBhag($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        //if (!is_superadmin_loggedin()) {
        //    $this->CI->db->where("state_name", get_loggedin_branch_id());
       // }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,s.state_name as state_name,p.p_name as p_name,sm.s_name as s_name");
        $this->CI->db->from("$table as t");
        $this->CI->db->join("ekal_state as s", "s.id = t.state_name", "left");
		$this->CI->db->join("ekal_prabhag as p", "p.id = t.p_id", "left");
		$this->CI->db->join("ekal_sambhag as sm", "sm.id = t.s_id", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	
	
	function getAnchal($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        //if (!is_superadmin_loggedin()) {
        //    $this->CI->db->where("state_name", get_loggedin_branch_id());
       // }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,p.p_name as p_name,sm.s_name as s_name,b.b_name as b_name");
        $this->CI->db->from("$table as t");
        //$this->CI->db->join("ekal_state as s", "s.id = t.state_name", "left");
		$this->CI->db->join("ekal_prabhag as p", "p.id = t.p_id", "left");
		$this->CI->db->join("ekal_sambhag as sm", "sm.id = t.s_id", "left");
		$this->CI->db->join("ekal_bhag as b", "b.id = t.b_id", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	
	
	function getSanch($table, $where = "", $single = FALSE)
    {
        if ($where != NULL) {
            $this->CI->db->where($where);
        }
        //if (!is_superadmin_loggedin()) {
        //    $this->CI->db->where("state_name", get_loggedin_branch_id());
       // }
        if ($single == TRUE) {
            $method = "row_array";
        } else {
            $this->CI->db->order_by("id", "asc");
            $method = "result_array";
        }
        $this->CI->db->select("t.*,p.p_name as p_name,sm.s_name as s_name,b.b_name as b_name,an.a_name as a_name");
        $this->CI->db->from("$table as t");
        //$this->CI->db->join("ekal_state as s", "s.id = t.state_name", "left");
		$this->CI->db->join("ekal_prabhag as p", "p.id = t.p_id", "left");
		$this->CI->db->join("ekal_sambhag as sm", "sm.id = t.s_id", "left");
		$this->CI->db->join("ekal_bhag as b", "b.id = t.b_id", "left");
		$this->CI->db->join("ekal_anchal as an", "an.id = t.a_id", "left");
        $query = $this->CI->db->get();
        return $query->$method();
    }
	

    public function check_branch_restrictions($table, $id = '') {
        if (empty($id)) {
             access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $query = $this->CI->db->select('id,branch_id')->from($table)->where('id', $id)->limit(1)->get();
            if ($query->num_rows() != 0) {
                $branch_id = $query->row()->branch_id;
                if ($branch_id != $this->CI->session->userdata('loggedin_branch')) {
                    access_denied();
                }
            }
        }
    }

    public function pass_hashed($password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $hashed;
    }

    public function verify_password($password, $encrypt_password)
    {
        $hashed = password_verify($password, $encrypt_password);
        return $hashed;
    }

    public function getStaffList($branch_id = '', $role='')
    {
        if (empty($branch_id)) {
            $array = array('' => translate('select_branch_first'));
        } else {
            $this->CI->db->select('s.id,s.name,s.staff_id');
            $this->CI->db->from('staff as s');
            $this->CI->db->join('login_credential as l', 'l.user_id = s.id and l.role != 6 and l.role != 7', 'inner');
            if (!empty($branch_id)) {
                $this->CI->db->where('s.branch_id', $branch_id);
            }
            if (!empty($role)) {
                $this->CI->db->where_in('l.role', array($role));
            }
            $result = $this->CI->db->get()->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name . ' (' . $row->staff_id . ')';
            }
        }
        return $array;
    }

    public function getClass($branch_id = '')
    {
        if (empty($branch_id)) {
            $array = array('' => translate('select_branch_first'));
        } else {
            /*if (loggedin_role_id() == 3) {
                $this->CI->db->select('class.id,class.name');
                $this->CI->db->from('teacher_allocation');
                $this->CI->db->join('class', 'class.id = teacher_allocation.class_id', 'left');
                $this->CI->db->where('teacher_allocation.teacher_id', get_loggedin_user_id());
                $this->CI->db->where('teacher_allocation.session_id', get_session_id());
                $result = $this->CI->db->get()->result();
            } else { */
                $this->CI->db->where('branch_id', $branch_id);
                $result = $this->CI->db->get('class')->result();
            //}
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }
    
    public function getStudentCategory($branch_id = '')
    {
        if (empty($branch_id)) {
            $array = array('' => translate('select_branch_first'));
        } else {
            $this->CI->db->where('branch_id', $branch_id);
            $result = $this->CI->db->get('student_category')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

    public function getSections($class_id = '', $all = false, $multi = false)
    {
        if (empty($class_id)) {
            $array = array('' => translate('select_class_first'));
        } else {
            /*if (loggedin_role_id() == 3) {
                $result = $this->CI->db->select('teacher_allocation.section_id,section.name')
                    ->from('teacher_allocation')
                    ->join('section', 'section.id = teacher_allocation.section_id', 'left')
                    ->where(array('teacher_allocation.class_id' => $class_id,
                        'teacher_allocation.teacher_id' => get_loggedin_user_id(),
                        'teacher_allocation.session_id' => get_session_id()))
                    ->get()->result();
            } else {*/
                $this->CI->db->where('class_id', $class_id);
                $result = $this->CI->db->get('sections_allocation')->result(); 
            //}
            if ($multi == false) {
                $array = array('' => translate('select'));
            }
            if ($all == true && loggedin_role_id() != 3) {
                $array['all'] = translate('all_sections');
            }
            foreach ($result as $row) {
                $array[$row->section_id] = get_type_name_by_id('section', $row->section_id);
            }
        }
        return $array;
    }

    public function getDepartment($branch_id = '')
    {
        if (empty($branch_id)) {
            $array = array('' => translate('select_branch_first'));
        } else {
            $this->CI->db->where('branch_id', $branch_id);
            $result = $this->CI->db->get('staff_department')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }
	
	public function getStatePrabhagList($state_id = '')
    {
        if (empty($state_id)) {
            $array = array('' => translate('select_state_first'));
        } else {
            $this->CI->db->where('state_name', $state_id);
            $result = $this->CI->db->get('ekal_prabhag')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }
	
	public function getPrabhagSamList($prabhag_id = '')
    {
        if (empty($prabhag_id)) {
            $array = array('' => translate('select_prabhag_first'));
        } else {
            $this->CI->db->where('p_id', $prabhag_id);
            $result = $this->CI->db->get('ekal_sambhag')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->s_name;
            }
        }
        return $array;
    }
	
	
	public function getSambhagBhagList($sambhag_id = '')
    {
        if (empty($sambhag_id)) {
            $array = array('' => translate('select_sambhag_first'));
        } else {
            $this->CI->db->where('s_id', $sambhag_id);
            $result = $this->CI->db->get('ekal_bhag')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->b_name;
            }
        }
        return $array;
    }
	
	public function getBhagAnchalList($bhag_id = '')
    {
        if (empty($bhag_id)) {
            $array = array('' => translate('select_bhag_first'));
        } else {
            $this->CI->db->where('b_id', $bhag_id);
            $result = $this->CI->db->get('ekal_anchal')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->a_name;
            }
        }
        return $array;
    }
	
	
	public function getSanchList($anchal_id = '')
    {
        if (empty($anchal_id)) {
            $array = array('' => translate('select_anchal_first'));
        } else {
            $this->CI->db->where('a_id', $anchal_id);
            $result = $this->CI->db->get('branch')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

    public function getDesignation($branch_id = '')
    {
        if ($branch_id == '') {
            $array = array('' => translate('select_branch_first'));
        } else {
            $this->CI->db->where('branch_id', $branch_id);
            $result = $this->CI->db->get('staff_designation')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

    public function getVehicleByRoute($route_id = '')
    {
        if ($route_id == '') {
            $array = array('' => translate('first_select_the_route'));
        } else {
            $this->CI->db->where('route_id', $route_id);
            $result = $this->CI->db->get('transport_assign')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->vehicle_id] = get_type_name_by_id('transport_vehicle', $row->vehicle_id, 'vehicle_no');
            }
        }
        return $array;
    }

    public function getRoomByHostel($hostel_id = '')
    {
        if ($hostel_id == '') {
            $array = array('' => translate('first_select_the_hostel'));
        } else {
            $this->CI->db->where('hostel_id', $hostel_id);
            $result = $this->CI->db->get('hostel_room')->result();
            $array = array('' => translate('select'));
            foreach ($result as $row) {
                $array[$row->id] = $row->name . ' ('. get_type_name_by_id('hostel_category', $row->category_id).')';
            }
        }
        return $array;
    }

    public function getSelectByBranch($table, $branch_id = '', $all = false, $where = '')
    {
        if (empty($branch_id)) {
            $array = array('' => translate('select_branch_first'));
        } else {
            if (is_array($where)) {
                $this->CI->db->where($where);
            }
            $this->CI->db->where('branch_id', $branch_id);
            $result = $this->CI->db->get($table)->result();
            $array = array('' => translate('select'));
            if ($all == true) {
                $array['all'] = translate('all_select');
            }
            foreach ($result as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

    public function getSelectList($table, $all = '')
    {
        $arrayData = array("" => translate('select'));
        if ($all == 'all') {
            $arrayData['all'] = translate('all_select');
        }
        $result = $this->CI->db->get($table)->result();
        foreach ($result as $row) {
            $arrayData[$row->id] = $row->name;
        }
        return $arrayData;
    }
	
	 public function getStateList($table, $all = '')
    {
        $arrayData = array("" => translate('select'));
        if ($all == 'all') {
            $arrayData['all'] = translate('all_select');
        }
        $result = $this->CI->db->get($table)->result();
        foreach ($result as $row) {
            $arrayData[$row->id] = $row->state_name;
        }
        return $arrayData;
    }
	
	
	 public function getPrabhagList($table, $all = '')
    {
        $arrayData = array("" => translate('select'));
        if ($all == 'all') {
            $arrayData['all'] = translate('all_select');
        }
        $result = $this->CI->db->get($table)->result();
        foreach ($result as $row) {
            $arrayData[$row->id] = $row->p_name;
        }
        return $arrayData;
    }

    public function getRoles($arra_id = [1, 6, 7])
    {
        if ($arra_id !='all') {
            $this->CI->db->where_not_in('id', $arra_id);
        }
        $rolelist = $this->CI->db->get('roles')->result();
        $role_array = array('' => translate('select'));
        foreach ($rolelist as $role) {
            $role_array[$role->id] = $role->name;
        }
        return $role_array;
    }

    public function generateCSRF()
    {
        return '<input type="hidden" name="' . $this->CI->security->get_csrf_token_name() . '" value="' . $this->CI->security->get_csrf_hash() . '" />';
    }

    public function get_document_category()
    {
        $category = array(
            '' => translate('select'),
            '1' => "Resume File",
            '2' => "Offer Letter",
            '3' => "Joining Letter",
            '4' => "Experience Certificate",
            '5' => "Resignation Letter",
            '6' => "Other Documents",
        );
        return $category;
    }

    public function getDocumentCategory()
    {
        $category = array(
            '' => translate('select'),
            'Resume File' => "Resume File",
            'Offer Letter' => "Offer Letter",
            'Joining Letter' => "Joining Letter",
            'Experience Certificate' => "Experience Certificate",
            'Resignation Letter' => "Resignation Letter",
            'Other Documents' => "Other Documents",
        );
        return $category;
    }

    public function getAnimationslist()
    {
        $animations = array(
            'fadeIn' => "fadeIn",
            'fadeInUp' => "fadeInUp",
            'fadeInDown' => "fadeInDown",
            'fadeInLeft' => "fadeInLeft",
            'fadeInRight' => "fadeInRight",
            'bounceIn' => "bounceIn",
            'rotateInUpLeft' => "rotateInUpLeft",
            'rotateInDownLeft' => "rotateInDownLeft",
            'rotateInUpRight' => "rotateInUpRight",
            'rotateInDownRight' => "rotateInDownRight",
        );
        return $animations;
    }

    public function getMonthslist($m)
    {
        $months = array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July ',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        );
        return $months[$m];
    }

    public function getDateformat()
    {
        $date = array(
            "Y-m-d" => "yyyy-mm-dd",
            "Y/m/d" => "yyyy/mm/dd",
            "Y.m.d" => "yyyy.mm.dd",
            "d-M-Y" => "dd-mmm-yyyy",
            "d/M/Y" => "dd/mmm/yyyy",
            "d.M.Y" => "dd.mmm.yyyy",
            "d-m-Y" => "dd-mm-yyyy",
            "d/m/Y" => "dd/mm/yyyy",
            "d.m.Y" => "dd.mm.yyyy",
            "m-d-Y" => "mm-dd-yyyy",
            "m/d/Y" => "mm/dd/yyyy",
            "m.d.Y" => "mm.dd.yyyy",
        );
        return $date;
    }

    public function getBloodgroup()
    {
        $blood_group = array(
            '' => translate('select'),
            'A+' => 'A+',
            'A-' => 'A-',
            'B+' => 'B+',
            'B-' => 'B-',
            'O+' => 'O+',
            'O-' => 'O-',
            'AB+' => 'AB+',
            'AB-' => 'AB-',
        );
        return $blood_group;
    }

    function timezone_list()
    {
        static $timezones = null;
        if ($timezones === null) {
            $timezones = [];
            $offsets = [];
            $now = new DateTime('now', new DateTimeZone('UTC'));
                foreach (DateTimeZone::listIdentifiers() as $timezone) {
                $now->setTimezone(new DateTimeZone($timezone));
                $offsets[] = $offset = $now->getOffset();
                $timezones[$timezone] = '(' . $this->format_GMT_offset($offset) . ') ' . $this->format_timezone_name($timezone);
            }
            array_multisort($offsets, $timezones);
        }
        return $timezones;
    }

    function format_GMT_offset($offset)
    {
        $hours = intval($offset / 3600);
        $minutes = abs(intval($offset % 3600 / 60));
        return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
    }

    function format_timezone_name($name)
    {
        $name = str_replace('/', ', ', $name);
        $name = str_replace('_', ' ', $name);
        $name = str_replace('St ', 'St. ', $name);
        return $name;
    }
}
