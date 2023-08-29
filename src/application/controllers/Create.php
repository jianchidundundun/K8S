<!-- reference from my infs3202 project in previous year -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends CI_Controller {

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
	public function index()
	{	
		$this->load->view('template/header'); 
    	if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				// reference from https://www.php.net/manual/zh/function.password-verify.php（php password_verify）
				$hashcodeP = $this->user_model->login_getHash($username);
				$flag = password_verify($password,$hashcodeP);
				if ( $flag )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session



			    	//登录模板的修改部分
					$this->load->view('create',array('error' => ' ')); //if user already logined show upload page
				
				}
			}else{
				$this->load->view("login"); //if user already logined direct user to home page
			}
		}else{
					//登录模板的修改部分
			$this->load->view('create',array('error' => ' ')); //if user already logined show login page
	
		}
		$this->load->view('template/footer');

	}


	public function insertNewCourse(){
		$username = $this->session->userdata('username');
		$this->load->model('course_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$courseName = $this->input->post('courseName');
		$des = $this->input->post('des');
		$data['courseName'] = $courseName;
		$this->course_model->insertCourse($courseName,$des,$username);
		$user_data = array(
			'courseName' => $courseName
		);

		$this->session->set_userdata($user_data);
		$this->load->view('createsuccessful',$data);
		$this->load->view('template/footer');

	}

    
}