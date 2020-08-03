<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * @ngonimuro 2020-09-03
	 * Authentication and security handler controller for KMS erp 
	 */

	class Auth extends CI_Controller {
		/**
		 * 
		 */
		function __construct()
		{	
			parent::__construct();
			Utils::no_cache();
			$this->load->model('auth_model');
			$this->load->helper('url');
			//$this->load->model('inventory_model');
			//$this->load->model('sales');
			$this->login_status = $this->session->userdata('isUserLoggedIn');
		}

		/**
		 * @ngonimuro 2020-09-03
		 * default method for auth controller
		 */
		public function index()
		{
			if($this->login_status):
				redirect('auth/user_rights');
			else:
				redirect('auth/login');
			endif;
		}
		/**
		 * function to get the ip address of the user
		 */
		
		function getIPAddress() 
		{  
			//whether ip is from the share internet  
			if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{  
						$ip = $_SERVER['HTTP_CLIENT_IP'];  
			}  
			//whether ip is from the proxy  
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{  
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
			}  
			//whether ip is from the remote address  
			else
			{  
				$ip = $_SERVER['REMOTE_ADDR'];  
			}  
			return $ip;  
		}  


		/**
		 *	1. Login form view and necessary data
		 */
		public function login()
		{
			$data = array();
			$header_data['tab_title']='Login KMS_ERP';
			if($this->session->userdata('success_msg')):
				$data['success_msg']=$this->session->userdata('success_msg');
			endif;
			if($this->session->userdata('error_msg')):
				$data['error_msg']=$this->session->userdata('error_msg');
				$this->session->unset_userdata('error_msg');
			endif;
			if($this->input->post('loginSubmit')):
				$this->form_validation->set_rules('username','Username','required');
				$this->form_validation->set_rules('password','password','required');	
				if($this->form_validation->run()==true):
					$con = array(
								'returnType'=>'single',
								'conditions'=> array(
													'username'=>$this->input->post('username'),
													'password'=>md5($this->input->post('password')),
													'status'=>1
												)
							);
					$checkLogin = $this->auth_model->getRows($con);
					if(count($checkLogin)>0):
						$branch_id=$this->auth_model->get_branch_id($checkLogin['branch']);
						$this->session->set_userdata('isUserLoggedIn',true);
						$this->session->set_userdata('user_id',$checkLogin['id']);
						$this->session->set_userdata('user_type',$checkLogin['type']);
						$this->session->set_userdata('user_name',$checkLogin['first_name']);
						$this->session->set_userdata('user_sname',$checkLogin['last_name']);
						$this->session->set_userdata('user_branch',$checkLogin['branch']);
						$this->session->set_userdata('active_branch_id',$branch_id['branch_id']);
						$this->session->set_userdata('user_email',$checkLogin['email']);
						$this->session->set_userdata('ip_address',$this->getIPAddress());
						//check user status	
						if($checkLogin['enabled']==='yes'):
							redirect('/auth/user_rights');
						elseif($checkLogin['enabled']==='1'):
							$data['error_msg']='This user has been suspended, contact administration for clarification';
							$this->load->view('elements/universal_header_element',$data);
							$this->load->view('auth/login',$data);
							$this->load->view('elements/footer');
						elseif($checkLogin['enabled']==='disabled'):
							$data['error_msg']='This user has been disabled from accessing the system, contact administration for clarification';
							$this->load->view('elements/universal_header_element',$data);
							$this->load->view('auth/login',$data);
							$this->load->view('elements/footer');
						else:
							$data['error_msg']='There is an issue with this user status!';
							$this->load->view('elements/universal_header_element',$data);
							$this->load->view('auth/login',$data);
							$this->load->view('elements/footer');
						endif;
					else:
						$data['error_msg']='Wrong username or password';
					endif;
				else:
					$data['error_msg']='Please fill in all mandatory fields';
				endif;
			endif;
			$this->load->view('elements/universal_header_element',$header_data);
			$this->load->view('auth/login_view',$data);
			$this->load->view('elements/auth/login_footer');
		}

		/**
		 * If user account allows for login determine group and assign access rigths
		 */
		public function user_rights()
		{

			if($this->login_status):
				switch($this->session->userdata('user_type')):
					case "SD":
						$this->session->set_userdata('privilege','admin');
						redirect(base_url('sales_dashboard'));
					break;
					case "AD":
						$this->session->set_userdata('privilege','admin');
						redirect(base_url('sales_dashboard'));
					break;
					case "BSD":
						$this->session->set_userdata('privilege','admin');
						redirect(base_url('sales_dashboard'));
					break;
					case "BAD":
						$this->session->set_userdata('privilege','admin');
						redirect(base_url('sales_dashboard'));
					break;
					case "TMG":
						$this->session->set_userdata('privilege','mgt');
						redirect(base_url('sales_dashboard'));
					break;
					case "MG":
						$this->session->set_userdata('privilege','mgt');
						redirect(base_url('sales_dashboard'));
					break;
					case "CA":
						$this->session->set_userdata('privilege','sales');
						redirect(base_url('sales_dashboard/sales'));
					break;
					case "TCA":
						$this->session->set_userdata('privilege','sales');
						redirect(base_url('sales_dashboard/sales'));
					break;
					case "SA":
						$this->session->set_userdata('privilege','sales');
						redirect(base_url('sales_dashboard/sales'));
					break;
					case "ST":
						$this->session->set_userdata('privilege','stock');
						redirect(base_url('sales_dashboard'));
					break;
					case "STC":
						$this->session->set_userdata('privilege','stock');
						redirect(base_url('sales_dashboard'));
					default: 
						echo "you are unassigned what are you doing here, batai munhu!";
						echo "<a href=";
						echo base_url('/auth/logout');
						echo ">logout</a>";
				endswitch;
			endif;         
		}

		/**
		 * logout
		 */		
		 public function logout()
		 {
			 $this->session->unset_userdata('isUserLoggedIn');
			 $this->session->unset_userdata('user_id');
			 $this->session->sess_destroy();
			 redirect('auth/login');
		 }
	}
