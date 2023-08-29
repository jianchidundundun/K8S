<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 // reference from my infs3202 assignmen
    class Course_model extends CI_Model{

        function fetch_data($query)
        {
            if($query == '')
            {
                return null;
            }else{
                $this->db->select("*");
                $this->db->from("course");
                $this->db->like('course_name', $query);
                $this->db->or_like('course_creator', $query);
                $this->db->order_by('course_name', 'DESC');
                return $this->db->get();
            }
        }

        public function insertCourse($courseName,$des,$courseCreator){
            $data = array(
                'course_name' => $courseName,
                'des' => $des,
                'course_creator' => $courseCreator
            );

            $this->db->insert('course',$data);
        }
        

        public function updateVideoAddress($courseName, $newAddress){
            $data = array(
                'course_repo_address' => $newAddress
            );

            $this->db->where('course_name',$courseName);
            $this->db->update('course',$data);
        }

        public function findCourseInformation($coursename){
            $query = $this->db->query("SELECT * FROM course");
            foreach ($query->result() as $row)
            {
                if ($row->course_name == $coursename)
                {
                    return array(

                        'des' => $row->des

                    );
                }
            }

        }



        
        public function findCourseCreator($course){
            $query = "SELECT course_creator FROM course WHERE course_name = '$course'";

            $query = $this->db->query($query);

            
            foreach($query->result() as $row) {
                return $row->course_creator;
            }
        }

        public function addMessage($course_creator, $message,$course){

            $data = array(
                'user' => $course_creator,
                'message' => $message,
                'course' => $course
            );

            $this->db->insert('message',$data);

        }

        public function findMessage($user) {
            $query = "SELECT message FROM message WHERE user = '$user'";
            $query = $this->db->query($query);
            $result = array();
            foreach ($query->result() as $row)
            {
                $result[] = $row->message;
            }

            return $result;
        }

    }
?>