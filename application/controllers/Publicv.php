<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicv extends CI_Controller {
	
	function __construct(){
		parent::__construct();
        $this->load->helper(array('form', 'url', 'date','blockchain','notification'));
		$this->load->library(array('session', 'encrypt', 'email'));
		$this->load->model(array('plisting', 'manage'));
		// $this->output->cache(0.5);
		$this->config->load('emailc');
		$data = array();
		$data_add = array();
	}
	
	public function cred(){
		
		$data = array();
		
		$data['page'] = 'Infactor';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/cred_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}

	public function bond_create(){
		
		$data = array();
		
		$data['page'] = 'bond_create';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		$this->load->view('includes/headern', $data);
		$this->load->view('includes/header_publicn', $data);
		
		$this->load->view('pages/public/bond_create_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	
	public function boss_101(){
        
        $data = array();
        
        $data['page'] = 'bond';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/bond_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
    }
	
	public function corda_bridge(){
        
        $data = array();
        
        $data['page'] = 'corda_bridge';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
       
        $this->load->view('pages/public/corda_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
    }
	
	
	
	
	public function projects(){
        
        $data = array();
        
        $data['page'] = 'projects';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
       
        $this->load->view('pages/public/projects_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
    }
	
	
	
	
	
	public function projects_detail(){
        
        $data = array();
        
        $data['page'] = 'projects_detail';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
       
        $this->load->view('pages/public/projects_detail_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
    }
	
	
	
	public function beneficiary(){
		
		$data = array();
		
		$data['page'] = 'beneficiary';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
				
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		$this->load->view('includes/headern', $data);
		$this->load->view('includes/header_publicn', $data);
		$this->load->view('pages/public/beneficiary_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	
	}
	
	public function buyer_supplier(){
		
		$data = array();
		
		$data['page'] = 'buyer_supplier';
		$data['pcountry'] = 0;
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
				
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$ccountries = $this->plisting->get_country();
		
		if($ccountries && !empty($ccountries) && is_array($ccountries) && sizeof($ccountries) <> 0){
			$data['pcountries'] = $ccountries;			
		}
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
			

		$data_add['instrument'] = $this->input->post('instrument');
		$data_add['pcountry'] = $this->input->post('pcountry');
		$data_add['name'] = $this->input->post('name');
		$data_add['amount'] = $this->input->post('amount');
		$data_add['currency_supported'] = $this->input->post('currency_supported');
		$data_add['maturity_date'] = $this->input->post('maturity_date');

		$configf = array();
		$configf['upload_path']   = FCPATH.'assets/instrument_files/';
		$configf['allowed_types'] = 'pdf|jpg|jpeg|png|'; // doc|docx|
		$configf['max_size']      = 5097152;
			
		if(isset($_FILES) && !empty($_FILES) && trim($_FILES["uploaded_file"]['name']) <> ''){
			
			$file_name = time().'_'.str_replace(" ", "-", $_FILES["uploaded_file"]['name']);
			$configf['file_name'] = $file_name;
			$file_namea = explode('.', $file_name);
			$this->load->library('upload', $configf);

			// log_message("info",">>>>>".$this->upload->do_upload('uploaded_file'));
			$file_success = $this->upload->do_upload('uploaded_file');
		
			if($file_success == 0)
			{
				log_message("error",'Error occurred during addition. <br/>');
			}
			else
			{
				$upfile_url = base_url().'assets/instrument_files/'.$file_name;
				$img = file_get_contents( base_url().'assets/instrument_files/'.$file_name);
				log_message("info",'Successfully added. <br/>'.$upfile_url);
			}
		}
		$data_add['uploaded_file'] = base64_encode($img);
		$data_add['private_key'] = $this->input->post('private_key');

		$options = array('data' => $data_add['uploaded_file']);
		$rculrfp = uploadDoc($options);
		
		// $url = 'http://90.0.0.84:3110/api/uploadDoc';
		// $data_string = 'data='.$data_add['uploaded_file'];
		// $curl = curl_init();
		
		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => $url,
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_CUSTOMREQUEST => "POST",
		// 	CURLOPT_POSTFIELDS => $data_string,
		// 	CURLOPT_HTTPHEADER => array(
		// 	"Cache-Control: no-cache",
		// 	"cache-control: no-cache"
		// 	),
		// ));

		// $response = curl_exec($curl);
		// $err = curl_error($curl);
		// $result = json_decode($response);
		// curl_close($curl);

		if($rculrfp){
			$rculrfpa = json_decode(stripslashes($rculrfp));
			log_message("info","<<<<<????".$rcurlpfstatus.$$rcurlpfstatus->hash);
		}

		
		if($result->status == true){
			$url = 'http://90.0.0.84:3110/api/generateContract';
			$data_string = 'ipfsHash='.$data['ipfshash'].'&instrumentType='.$data_add['instrument'].'&amount='.$data_add['amount'].'&currencySupported='.$data_add['currency_supported'].'&maturityDate='.$data_add['maturity_date'].'&name='.$data_add['name'].'&country='.$data_add['pcountry'];
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data_string,
				CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"cache-control: no-cache"
				),
			));
	
			$response1 = curl_exec($curl);
			$err = curl_error($curl);
			$result1 = json_decode($response1);
			curl_close($curl);
	
			// log_message("info",">>>".$result1->contract);
	
			$data_add['contract'] = $result1->contract;
	
			if($result1->status == true || $result1->status == 1 ){
				$this->smart_contract($data_add);
			}
		}
		
			log_message("error","Something wrong with API");
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
			$this->load->view('pages/public/buyer_supplier_view', $data);
			$this->load->view('includes/footer_commonn', $data);
			$this->load->view('pages_scripts/finance_doc_scripts', $data);
			$this->load->view('includes/footern');
		

		
		
	}
	
	public function financier(){
		
		$data = array();
		
		$data['page'] = 'financier';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
			
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
				
		$this->load->view('includes/headern', $data);
		$this->load->view('includes/header_publicn', $data);
		$this->load->view('pages/public/financier_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function contact(){
		
		$data = array();
		
		$data['page'] = 'contact';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
				
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		$action = $this->input->post('action');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
			
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
		
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
			
		}
		
		if($action == 'send_mail'){
			
			$config = array();
			$config = $this->config->item('$econfig');
						
			$this->email->initialize($config);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			
			$suser = $this->manage->get_superadmin();
			
			$from_email = 'contact@tradefinex.org'; 
			$to_email = $this->input->post('memail'); 
					
			$message = '<strong>Name : </strong>'.ucwords($this->input->post('mname')).'<br/>';
			$message .= '<strong>Email : </strong>'.$this->input->post('memail').'<br/>';
			$message .= '<strong>Contact : </strong>'.$this->input->post('mmob').'<br/>';
			$message .= '<strong>Company : </strong>'.$this->input->post('mcomp').'<br/>';
			$message .= '<strong>User Type : </strong>'.$this->input->post('musertype').'<br/>';
			$message .= '<strong>Service Type : </strong>'.$this->input->post('menquiry').'<br/>';
			$message .= '<strong>Message : </strong>'.$this->input->post('mmsg').'<br/>';
			
			$this->email->from($from_email, 'Support Tradefinex'); 
			$this->email->to($to_email);
			$this->email->bcc($from_email);
			$this->email->set_mailtype('html');
			$this->email->subject('Tradefinex Enquiry'); 
			$this->email->message($message);
            		
			// Send mail ** Our customer support team will respond to your query as soon as possible. Please find below the details of the query submitted.
			if($this->email->send()){ 
				$this->session->set_flashdata('msg_type', 'success');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Thank you for your query. Your query has been received. Our customer support team will respond to your query as soon as possible.</h3>"); 
			}	
			else{ 
				$this->session->set_flashdata('msg_type', 'error');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Can't be Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Error in sending Email. Please try again.</h3>");
			}
			
			redirect(base_url().'thankyouc');
		}
		
		$this->load->view('pages/public/contact_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function subscribe(){
		
		$action = $this->input->post('action');
		$request_page = $this->input->post('request_page');
		$encryption_key = $this->config->item('encryption_key');
		
		if($action == 'send_mail'){
				
			$config = $this->config->item('$econfig');
						
			$this->email->initialize($config);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			
			$suser = $this->manage->get_superadmin();
			
			$data['notifications'] = array();
			$data['notifications'] = get_initial_notification_status();
			
			if($data['user_id'] <> 0){
				
				$options = array();
				$options['user_id'] = $data['user_id'];
				$options['user_type'] = $data['user_type_ref'];
				
				$data['notifications'] = get_notification_status($options);
			}
			
			$from_email = 'social@tradefinex.org'; // $config['smtp_user'];  
			$to_email = $this->input->post('semail'); 
			
			$request_string = 'email='.$to_email.'&action=unsubscribe';
			$encode_request_string = $this->encrypt->encode($request_string, $encryption_key);
					
			$message = '';
			$message .= '<strong>Email : </strong>'.$this->input->post('semail').'<br/>';
			$message .= 'Thanks for Your subscription <br/>. If you will want to unsubscribe from us in future please click <a href="'.base_url('unsubscribe/?'.$encode_request_string).'">here</a>.';
			
			$this->email->from($from_email, 'Support Tradefinex'); 
			$this->email->to($to_email);
			$this->email->cc($suser[0]->tfa_email);
			$this->email->set_mailtype('html');
			$this->email->subject('Tradefinex Subscription'); 
			$this->email->message($message); 
			
			// Send mail 
			if($this->email->send()){ 
			
				$data_add = array();
				$data_add['semail'] = $to_email;
				
				$this->manage->add_subscription($data_add);
				
			   	$this->session->set_flashdata("sub_email_action", $this->input->post('action_area'));
				$this->session->set_flashdata("sub_email_sent", "<font class='sub_msg alert' color='orange' style='float:left;margin-top:5px;padding:0px;font-size:12px;margin-bottom: 0px;'>Thank you for Your subscription to us.</font>"); 
			}	
			else{ 
			    $this->session->set_flashdata("sub_email_action", $this->input->post('action_area'));
				$this->session->set_flashdata("sub_email_sent", "<font class='sub_msg alert' color='red' style='float:left;margin-top:5px;padding:0px;font-size:12px;margin-bottom: 0px;'>Error in sending Email. Please try again.</font>"); 
			}
		}
		
		redirect(base_url().$request_page);
	}
		
	public function consortium(){
		
		$data = array();
		
		$data['page'] = 'consortium';
		$data['msg'] = '';
		$mail_data['mmsg'] = $this->input->post('mmsg');
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$mail_data['full_name'] = $this->input->post('mname');
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
	    	$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}

			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$action = $this->input->post('action');
		
		if($action == 'send_mail'){
				
			$config = $this->config->item('$econfig');
						
			$this->email->initialize($config);
			//$this->email->cc('mansi.vora@tradefinex.org');
			// $this->email->bcc('mansi.vora@tradefinex.org');
			
			$suser = $this->manage->get_superadmin();
			
			$from_email = 'info@tradefinex.org'; // $config['smtp_user']; 
			$to_email = $this->input->post('memail'); 
						
			$message = '<strong>Name : </strong>'.ucwords($this->input->post('mname')).'<br/>';
			$message .= '<strong>Email : </strong>'.$this->input->post('memail').'<br/>';
			$message .= '<strong>Contact : </strong>'.$this->input->post('mmob').'<br/>';
			$message .= '<strong>Company : </strong>'.$this->input->post('mcomp').'<br/>';
			//$message .= '<strong>Nature of Business : </strong>'.$this->input->post('musertype').'<br/>';
			//$message .= '<strong>Website : </strong>'.$this->input->post('murl').'<br/>';
			//$message .= '<strong>Message : </strong>'.$this->input->post('mmsg').'<br/>';
			
			$this->email->from($from_email, 'Support Tradefinex'); 
			$this->email->to($to_email);
			$this->email->bcc($from_email);
			$this->email->set_mailtype('html');
			$this->email->subject('Tradefinex Consortium Enquiry'); 
		//$this->email->message($message); 
			$mail_body = $this->load->view('templates/mails/consortium_mail_body', $mail_data, TRUE);
			$this->email->message($mail_body);
			
			console.log("$from_email");
			
			
			// Send mail 
			if($this->email->send()){ 
				$this->session->set_flashdata('msg_type', 'success');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Congratulations!!<br>Now, you are part of TradeFinex Consortium. </h3>"); 
			}	
			else{ 
				$this->session->set_flashdata('msg_type', 'error');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Can't be Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Error in sending Email. Please try again.</h3>");
			}
			
			redirect(base_url().'thankyouc');
		}
		
		$this->load->view('pages/public/consortium_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function advertise(){
		
		$data = array();
		
		$data['page'] = 'advertise';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
		
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$action = $this->input->post('action');
		
		if($action == 'send_mail'){
				
			$config = $this->config->item('$econfig');
						
			$this->email->initialize($config);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			
			$suser = $this->manage->get_superadmin();
			
			$from_email = 'info@tradefinex.org';// $config['smtp_user'];  
			$to_email = $this->input->post('memail'); 
						
			$message = '<strong>Name : </strong>'.ucwords($this->input->post('mname')).'<br/>';
			$message .= '<strong>Email : </strong>'.$this->input->post('memail').'<br/>';
			$message .= '<strong>Contact : </strong>'.$this->input->post('mmob').'<br/>';
			$message .= '<strong>Company : </strong>'.$this->input->post('mcomp').'<br/>';
			$message .= '<strong>User Type : </strong>'.$this->input->post('musertype').'<br/>';
			$message .= '<strong>Message : </strong>'.$this->input->post('mmsg').'<br/>';
			
			$this->email->from($from_email, 'Support Tradefinex'); 
			$this->email->to($to_email);
			$this->email->cc($from_email);
			$this->email->set_mailtype('html');
			$this->email->subject('Tradefinex Advertise Enquiry'); 
			$this->email->message($message); 
			
			// Send mail 
			if($this->email->send()){ 
				$this->session->set_flashdata('msg_type', 'success');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Thank you for your query. Your query has been received. Our customer support team will respond to your query as soon as possible.</h3>"); 
			}	
			else{ 
				$this->session->set_flashdata('msg_type', 'error');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Can't be Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Error in sending Email. Please try again.</h3>");
			}
			
			redirect(base_url().'thankyouc');
		}
		
		$this->load->view('pages/public/advertise_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function careers(){
		
		$data = array();
		
		$data['page'] = 'careers';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
				
		if($data['user_id'] <> 0){
		
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}

			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$action = $this->input->post('action');
		
		if($action == 'send_mail'){
			
			$upfile_url = '';
			
		    $config = $this->config->item('$econfig');
						
			$this->email->initialize($config);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			
			$suser = $this->manage->get_superadmin();
					
			$configf = array();
			$configf['upload_path']   = FCPATH.'assets/career_files/';
			$configf['allowed_types'] = 'pdf'; // doc|docx|
			$configf['max_size']      = 1048576;
				
			if(isset($_FILES) && !empty($_FILES) && trim($_FILES["mfile"]['name']) <> ''){
				
				$file_name = time().'_'.str_replace(" ", "-", $_FILES["mfile"]['name']);
				$configf['file_name'] = $file_name;
				$file_namea = explode('.', $file_name);
				$this->load->library('upload', $configf);
				
				if(!$this->upload->do_upload('mfile'))
				{
				   $data['msg'] = 'error';
				   $data['msg_extra'] = 'Error occurred during addition. <br/>'.$this->upload->display_errors();
				}
				else
				{
					$data['msg'] = 'success';
					$upfile_url = base_url().'assets/career_files/'.$file_name;
					$success_data = $this->upload->data();
				}
			}
					
			$suser = $this->manage->get_superadmin();
			
			$from_email = 'careers@tradefinex.org'; // $config['smtp_user']; 
			$to_email = $this->input->post('memail'); 
						
			$message = '<strong>Name : </strong>'.ucwords($this->input->post('mfname').' '.$this->input->post('mlname')).'<br/>';
			$message .= '<strong>Email : </strong>'.$this->input->post('memail').'<br/>';
			$message .= '<strong>Contact : </strong>'.$this->input->post('mmob').'<br/>';
			$message .= '<strong>Linkedin URL : </strong>'.$this->input->post('mlinkurl').'<br/>';
			$message .= '<strong>Cover Letter : </strong>'.$this->input->post('mcoverl').'<br/>';
			// $message .= '<strong>User view about Tradefinex : </strong>'.$this->input->post('minmsg').'<br/>';
			
			if($upfile_url != ''){
				$message .= '<a href="'.$upfile_url.'" target="_blank">View uploaded Resume</a><br/>';
			}
			
			$this->email->from($from_email, 'Support Tradefinex'); 
			$this->email->to($to_email);
			$this->email->cc($suser[0]->tfa_email);
			$this->email->set_mailtype('html');
			$this->email->subject('Tradefinex Careers Enquiry'); 
			$this->email->message($message);
						
			// Send mail 
			if($this->email->send()){ 
				$this->session->set_flashdata('msg_type', 'success');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Thank you for your query. Your query has been received. Our customer support team will respond to your query as soon as possible.</h3>"); 
			}	
			else{ 
				$this->session->set_flashdata('msg_type', 'error');
				$this->session->set_flashdata("email_sent_common", "<h4 class='text-center' style='font-size:20px;color:#000;font-weight:700;'>Email Can't be Sent</h4>"); 
				$this->session->set_flashdata("popup_desc", "<h3 class='text-center' style='font-size:16px;line-height:20px;color:#000;padding-left:8px;padding-right:8px;'>Error in sending Email. Please try again.</h3>"); 
			}
					
			redirect(base_url().'thankyouc');
		}
		
		$this->load->view('pages/public/careers_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
		
	public function guide(){
		
		$data = array();
		
		$data['page'] = 'guide';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_no_nav', $data);
			$this->load->view('includes/header_nav', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_public', $data);
		}
		
		$this->load->view('pages/public/guide_view', $data);
		$this->load->view('includes/footer_common', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footer');
	}
	
	public function faq(){
		
		$data = array();
		
		$data['page'] = 'faq';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/faq_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	
	public function finance_solutions(){
		
		$data = array();
		
		$data['page'] = 'Finance Solutions';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/finance_solutions_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function trade_solutions(){
		
		$data = array();
		
		$data['page'] = 'Trade Solutions';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/trade_solutions_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	public function infactor(){
		
		$data = array();
		
		$data['page'] = 'Infactor';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/infactor_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	

	public function quickbook_dashboard(){
		
		$data = array();
		
		$data['page'] = 'Quickbook';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		// $suria = explode('?', $_SERVER['REQUEST_URI']);

		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/quickbook_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	

	public function invoice_factoring(){
		
		$data = array();
		
		$data['page'] = 'invoice_factoring';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		$this->load->view('includes/headern', $data);
		$this->load->view('includes/header_publicn', $data);
		
		$this->load->view('pages/public/invoice_factoring_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	

	public function news(){
		
		$data = array();
		
		$data['page'] = 'news';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_no_nav', $data);
			$this->load->view('includes/header_nav', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_public', $data);
		}
		
		$this->load->view('pages/public/news_view', $data);
		$this->load->view('includes/footer_common', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footer');
	}
	
	public function media_center(){
		
		$data = array();
		
		$data['page'] = 'media_center';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['medias'] = $medias = array();
		$data['medias'] = $medias = json_decode(file_get_contents(FCPATH.'/assets/frontend_pages/media/media_center.txt'), TRUE);
		
		$this->load->view('pages/public/media_center_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function videos(){
		
		$data = array();
		
		$data['page'] = 'videos';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/videos_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function privacy_policy(){
		
		$data = array();
		
		$data['page'] = 'privacy_policy';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/privacy_policy_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function terms_condition(){
		
		$data = array();
		
		$data['page'] = 'terms_condition';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
		
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
		
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$this->load->view('pages/public/terms_condition_view', $data);
		$this->load->view('includes/footer_commonn', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footern');
	}
	
	public function opportunities(){
		
		$data = array();
		
		$data['page'] = 'opportunities';
		$data['msg'] = '';
		$data['user_id'] = 0;
		$data['user_type'] = '';
		$data['full_name'] = '';
		$data['ufname'] = '';
		$data['ulname'] = '';
		$data['uemail'] = '';
		$data['ucontact'] = '';
		$data['uaddress'] = '';
		$data['uname'] = '';
		$data['upass'] = '';
		$data['uprofpic'] = '';
			
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_no_nav', $data);
			$this->load->view('includes/header_nav', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}	
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/header_public', $data);
		}
		
		$this->load->view('pages/public/opportunities_view', $data);
		$this->load->view('includes/footer_common', $data);
		$this->load->view('pages_scripts/common_scripts', $data);
		$this->load->view('includes/footer');
	}

	public function setup_masternode(){
        
        $data = array();
        
        $data['page'] = 'setup_masternode';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/setup_masternode_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function xdc_liquidity(){
        
        $data = array();
        
        $data['page'] = 'xdc_liquidity';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/xdc_liquidity_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function docker(){
        
        $data = array();
        
        $data['page'] = 'docker';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/docker_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function about_xinfin_masternode(){
        
        $data = array();
        
        $data['page'] = 'about_xinfin_masternode';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/about_xinfin_masternode_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function masternode_faqs(){
        
        $data = array();
        
        $data['page'] = 'masternode_faqs';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/masternode_faqs_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function private_distributed_ledger_solution(){
        
        $data = array();
        
        $data['page'] = 'private_distributed_ledger_solution';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/private_distributed_ledger_solution_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function hybrid_distributed_ledger_solution(){
        
        $data = array();
        
        $data['page'] = 'hybrid_distributed_ledger_solution';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/hybrid_distributed_ledger_solution_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function brokers(){
        
        $data = array();
        
        $data['page'] = 'brokers';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/brokers_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function rollout(){
        
        $data = array();
        
        $data['page'] = 'rollout';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
        
        
        
        $this->load->view('pages/public/rollout_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	public function smart_contract($data_add){
        
        $data = array();
        
        $data['page'] = 'smart_contract';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
		$data['display'] = $data_add;
		
		        
        
        $this->load->view('pages/public/smart_contract_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	
	public function supply_chain($data_add){
        
        $data = array();
        
        $data['page'] = 'supply_chain';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
		$data['display'] = $data_add;
		
		        
        
        $this->load->view('pages/public/supply_chain_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
	}
	
	
	public function smart_contractt($data_add){
        
        $data = array();
        
        $data['page'] = 'smart_contractt';
        $data['msg'] = '';
        $data['user_id'] = 0;
        $data['user_type'] = '';
        $data['full_name'] = '';
        $data['ufname'] = '';
        $data['ulname'] = '';
        $data['uemail'] = '';
        $data['ucontact'] = '';
        $data['uaddress'] = '';
        $data['uname'] = '';
        $data['upass'] = '';
        $data['uprofpic'] = '';
        
        $data['csrf'] = array();
        
		$data['csrf'] = array();
		
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$data['csrf'] = $csrf;
				
		$user = $this->session->userdata('logged_in');
		
		if($user && !empty($user) && sizeof($user) <> 0){
			$data['full_name'] = $user['user_full_name'];
			$data['user_id'] = $user['user_id'];
			$data['user_type_ref'] = $user['user_type_ref'];
			// redirect(base_url().'dashboard');
		}else{
			// redirect(base_url().'log/out');
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
		
		$data['notifications'] = array();
		$data['notifications'] = get_initial_notification_status();
		
		if($data['user_id'] <> 0){
			
			$options = array();
			$options['user_id'] = $data['user_id'];
			$options['user_type'] = $data['user_type_ref'];
			
			$data['notifications'] = get_notification_status($options);
		}
		
		if($data['user_id'] <> 0){
					
			$uresult = $this->manage->get_user_info_by_id_and_type($data['user_id'], $data['user_type_ref']);
						
			if(!empty($uresult) && is_array($uresult) && sizeof($uresult) <> 0){
				
				if($data['user_type_ref'] == 1){
					$data['ufname'] = $uresult[0]->tfsp_fname;
					$data['ulname'] = $uresult[0]->tfsp_lname;
					$data['uemail'] = $uresult[0]->tfsp_email;
					$data['ucontact'] = $uresult[0]->tfsp_contact;
					$data['uaddress'] = $uresult[0]->tfsp_address;
					$data['uprofpic'] = $uresult[0]->tfsp_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tfsp_public_visibility;
				}
				
				if($data['user_type_ref'] == 2){
					$data['ufname'] = $uresult[0]->tff_fname;
					$data['ulname'] = $uresult[0]->tff_lname;
					$data['uemail'] = $uresult[0]->tff_email;
					$data['ucontact'] = $uresult[0]->tff_contact;
					$data['uaddress'] = $uresult[0]->tff_address;
					$data['uprofpic'] = $uresult[0]->tff_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
					$data['uvisibility'] = $uresult[0]->tff_public_visibility;
				}
				
				if($data['user_type_ref'] == 3){
					$data['ufname'] = $uresult[0]->tfb_fname;
					$data['ulname'] = $uresult[0]->tfb_lname;
					$data['uemail'] = $uresult[0]->tfb_email;
					$data['ucontact'] = $uresult[0]->tfb_contact;
					$data['uaddress'] = $uresult[0]->tfb_address;
					$data['uprofpic'] = $uresult[0]->tfb_pic_file;
					$data['uname'] = $uresult[0]->tfu_usern;
					$data['upass'] = $uresult[0]->tfu_passwd;
				}
			}
			
			$this->load->view('includes/headern', $data);
			$this->load->view('includes/header_publicn', $data);
		}
        
		$data['display'] = $data_add;
		log_message("info","<><><>".$isplay);
			$url = 'http://90.0.0.84:3110/api/deployContract';
			$data_string = 'ipfsHash='.$display['ipfshash'].'&instrumentType='.$display['instrument'].'&amount='.$display['amount'].'&currencySupported='.$display['currency_supported'].'&maturityDate='.$display['maturity_date'].'&name='.$display['name'].'&country='.$display['pcountry'].'&privKey='.$display['private_key'];
			$curl = curl_init();
			
			log_message("info",">>>>".$data_string);
	
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data_string,
				CURLOPT_HTTPHEADER => array(
				"Cache-Control: no-cache",
				"cache-control: no-cache"
				),
			));
	
			$response = curl_exec($curl);
			$err = curl_error($curl);
			$result = json_decode($response);
			curl_close($curl);
		
		        
        
        $this->load->view('pages/public/smart_contract_view', $data);
        $this->load->view('includes/footer_commonn', $data);
        $this->load->view('pages_scripts/common_scripts', $data);
        $this->load->view('includes/footern');
    }
}
	
