<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{	
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('user_model');


		// ci3 recaptha reference from https://codeigniter.org.cn/userguide3/helpers/captcha_helper.html?highlight=captcha#create_captcha
		// $this->load->helper('captcha');
		// $vals = array(
		// 	'img_path'  => './captcha/',
		// 	'img_url'   => 'http://example.com/captcha/'
		// );

		// $cap = create_captcha($vals);
		// // echo $cap['time'];
		// // echo $cap['word'];
		// // $this->user_model->insertCpatcha($cap['time'],$cap['word']);

		// $data['captha'] = $cap['image'];



		$this->load->view('template/header');
        $this->load->view('signup',$data);
		$this->load->view('template/footer');

	}

	public function sign_up()
	{
		$this->load->model('user_model');
		$this->load->helper('form');
		$this->load->helper('url');











		// recaptha verify
		// reference from https://www.youtube.com/watch?v=tmMG7_LcQHc

		$respone = $this->input->post('g-recaptcha-response');

		$s = '6LcKkiAgAAAAALzHDkxQI0avJKOtm7r6LdUipNBP';

		$res = file_get_contents('https://www.google.com/recaptcha/api/siteverify'.'?secret='.$s.'&response='.$respone);

		$result = json_decode($res);
		if (true) {
			$this->load->view('template/header');
			$username = $this->input->post('username');
			$passwordfirst = $this->input->post('password');
			$passwordSecond = $this->input->post('password_Twice');
			$email = $this->input->post('email');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');

			if ($passwordfirst == $passwordSecond) {
				//fisrt check the password and second password is same

				if (strlen($passwordfirst) >= 1){
					//check password is larger than 8
					if (true)
					{
						//check username is unique or not
						if (true) {
							//check email is unique or not, and then save all information in database
							//在检查完注册信息之后，把所有的信息都传到输入验证码页面，在用户输入正确验证码之后，在把所有信息穿到下一个控制器中，在进行数据库插入操作
							
							$passwordAfterEncrypt = password_hash($passwordfirst,PASSWORD_DEFAULT);

							$user_data = array(
								'signname' => $username,
								'signpassword' => $passwordAfterEncrypt,
								'signemail' => $email,
								'signquestion' => $question,
								'signanswer' => $answer,
								
							);


                       
                            $this->user_model->signup($username,$passwordAfterEncrypt,$email,$question,$answer);
                            $this->load->view('signupsuccessful');
							


							// $this->user_model->signup($username,$passwordAfterEncrypt,$email,$question,$answer);
							

						}else
						{
							$data['error']= "<div class=\"alert alert-danger\" role=\"alert\">Some one have already use your email, please try another email</div> ";
							$this->load->view('signup',$data);
						}

					}else
					{
						$data['error']= "<div class=\"alert alert-danger\" role=\"alert\">Some one have already use your username, please try another username</div> ";
						$this->load->view('signup',$data);
					}
				}else{
					$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> the password is to short, it must be larger than 8</div> ";
					$this->load->view('signup',$data);
				}

				
			}else
			{	
				$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> The passwords that you type twice is not same  </div> ";
				$this->load->view('signup',$data);
			}



			$this->load->view('template/footer');

		}





		
	}

	public function test(){
		$this->load->view("signupsuccessful");
	}

	public function sendEmail($email)
    {	
		$code = rand(100000,200000);
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE ,
            'mailtype' => 'html',
            'starttls' => true,
            'newline' => "\r\n"
            );
           
        $this->email->initialize($config);
        $this->email->from(get_current_user().'@student.uq.edu.au',get_current_user());
        $this->email->to($email);
        $this->email->cc($this->input->post('cc'));
        $this->email->subject('verify your emial');
        $this->email->message('your code is '.$code);
        $this->email->send();
		return $code;
    }

	public function verifycode()
	{	
		$this->load->model('user_model');

		$this->load->view('template/header');
        
		$typecode = $this->input->post('code');
		$origincode = $this->session->userdata('signcode');
		if ($typecode == $origincode) {
			//插入用户数据，并加载sign successful 页面
			$username = $this->session->userdata('signname');
			$userpassword = $this->session->userdata('signpassword');
			$useremail = $this->session->userdata('signemail');
			$userquestion = $this->session->userdata('signquestion');
			$useranswer = $this->session->userdata('signanswer');
			$this->user_model->signup($username,$userpassword,$useremail,$userquestion,$useranswer);
			$this->load->view('signupsuccessful');
		}else
		{
			//把erroe信息重新加载到email verify页面中
			$this->load->view('emailverify',array('error' => '<div class=\"alert alert-danger\" role=\"alert\"> Your code is not correct </div>'));

		}


		$this->load->view('template/footer');
	}


}