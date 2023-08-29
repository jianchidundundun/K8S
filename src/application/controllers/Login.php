<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		//$this->load->view('login', $data);
		if (!$this->session->userdata('logged_in'))
		{
			//cookie
			if (get_cookie('remember')) {
				# code...
				$username = get_cookie('username');
				$password = get_cookie('password');
				$hashcodeP = $this->user_model->login_getHash($username);
				$flag = password_verify($password,$hashcodeP);
				if ($flag) {
					$user_data = array(
						'username' => $username,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					
					$this->load->view('home');
					
				}
			}else
			{
				$this->load->view('login',$data);
			}
		}else{
			$this->load->view('home');
		}
		$this->load->view('template/footer');
        
	}
	public function check_login()
	{	
		$this->load->model('user_model');
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember');// get cookie 选项从login form
		
		if (!$this->session->userdata('logged_in')) {
			// reference from https://www.php.net/manual/zh/function.password-verify.php（php password_verify）
			$hashcodeP = $this->user_model->login_getHash($username);
			$flag = password_verify($password,$hashcodeP);
			if ($flag) {
				$user_data = array(
					'username' => $username,
					'logged_in' => true
				);


				
				if ($remember) {
					# code...
					echo $remember.'cookies';
					set_cookie('username',$username,'300');
					set_cookie('password',$password,'300');
					set_cookie('remember',$remember,'300');

				}
				$this->session->set_userdata($user_data);
				$this->load->view("logins");
				
			}else 
			{
				$this->load->view('login',$data);
			}
		}else {
			$this->load->view("logins");

		
		}
		$this->load->view('template/footer');	

		
	}

	public function logout()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->session->unset_userdata('logged_in');
		session_destroy();
		$this->load->view('template/header');	
		$this->load->view("logout");
		$this->load->view('template/footer');	
		
	}
}
