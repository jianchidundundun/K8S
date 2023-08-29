<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

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
	public function index($coursename = NULL)
	{	
		$this->load->model('course_model');

		$this->load->view('template/header');
		if ($coursename != NULL) {
			$temp = $this->course_model->findCourseInformation($coursename);
			$data['coursename'] = $coursename;
			$data['des'] = $temp['des'];
			$courseData = array(
				'course' => $coursename
			);

			$this->session->set_userdata($courseData);

			$this->load->view('course',$data);
		}
		
		$this->load->view('template/footer');
	}
	

	public function loadCourse($coursename =NULL){
		$this->load->model('course_model');

		$this->load->view('template/header');
		if ($coursename != NULL) {
			$temp = $this->course_model->findCourseInformation($coursename);
			$add = $temp['pictureaddress'];
			$index = strpos($add,'assets');
			$photoPath = substr($add,$index);
			$data['photopath'] = $photoPath;

			$data['comment'] = $this->course_model->getAllComment($coursename);

			$this->load->view('course',$data);
		}
		
		$this->load->view('template/footer');
	}
	
}
