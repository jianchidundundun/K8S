<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
    class User_model extends CI_Model {
        
        public function login_getHash($username) {
            $this->db->where('username',$username);
            

            $query = $this->db->get('users');
            foreach ($query->result() as $row)
            {   

                return $row->password;

            }
            
        }

        public function check_username_unique($username)
        {
            $query = $this->db->query("SELECT * FROM users");
            foreach ($query->result() as $row)
            {
                if ($row->username == $username)
                {
                    return false;
                }
            }

            return true;
        }

        public function check_email_unique($email) 
        {
            $query = $this->db->query("SELECT * FROM users");
            foreach ($query->result() as $row)
            {
                if ($row->email == $email)
                {
                    return false;
                }
            }

            return true;

        }

        public function signup($username,$password,$email,$question,$answer)
        {
            $data = array(
                'username' => $username,
                'password' => $password,
                'email' =>$email,
                'question'=> $question,
                'answer' => $answer
            );
            $query = $this->db->insert('users', $data);
        }



        public function getinfomationByUsername($username)
        {
            $query = $this->db->query("SELECT * FROM users");
            foreach ($query->result() as $row)
            {   

                if ($row->username == $username) 
                {
                    return array('email' => $row->email,'phone' => $row->phone);
                }

            }
        }


        public function updateEmail($username,$newemail) {

            $data = array(
                'email' => $newemail
            );

            $this->db->where('username',$username);
            $this->db->update('users',$data);

        }

        public function updatePhone($username,$newphone){
            $data = array(
                'phone' => $newphone
            );

            $this->db->where('username',$username);
            $this->db->update('users',$data);
        }

        public function updatePassword($username,$newPassword) {
            $data = array(
                'password' => $newPassword
            );
            $this->db->where('username',$username);
            $this->db->update('users',$data);
        }

        public function getPhoto($username) {

            $query = $this->db->query("SELECT * FROM users");
            foreach($query->result() as $row) {
                if ($row->username == $username) {
                    return $row->photo;
                }
            }
        }

        public function findQuestion($username){
            $query = $this->db->query("SELECT * FROM users");
            foreach($query->result() as $row) {
                if ($row->username == $username) {
                    return $row->question;
                }
            }

        }

        public function findAnswer($username) {
            $query = $this->db->query("SELECT * FROM users");
            foreach($query->result() as $row) {
                if ($row->username == $username) {
                    return $row->answer;
                }
            }

            
        }

        // reference from ci3 document https://codeigniter.org.cn/userguide3/helpers/captcha_helper.html?highlight=captcha#create_captcha
        public function insertCpatcha($time,$word){
            $data = array(
                'captcha_time'  => $time,
                'ip_address'    => $this->input->ip_address(),
                'word'      => $word
            
            );

            $query = $this->db->insert_string('captcha', $data);
            $this->db->query($query);
        }



    }
    
        
?>