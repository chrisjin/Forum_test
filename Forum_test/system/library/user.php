<?php

/**
 * customer short summary.
 *
 * customer description.
 *
 * @version 1.0
 * @author C
 */
class User
{
    private $email;
    private $logged;
    private $userid;
    private $username;
    public function GetEmail()
    {
        return $this->email;
    }
    public function GetUserID()
    {
        return $this->userid;
    }
    public function GetUserName()
    {
        return $this->username;
    }
    public function __construct($registry) 
    {
        $this->session = $registry->get('session');
        $this->db = $registry->get('db');
        if(isset($this->session->data['token']) 
            &&isset($this->session->data['email']) )
        {
            $token = $this->session->data['token'];
            $email = $this->session->data['email'];
            $user_info = $this->db->query("SELECT * FROM user WHERE LOWER(email) = '$email'");
            
            $this->logged = false;
            if($user_info->num_rows == 1)
            {
                if($token == $user_info->row['salt'])
                {
                    $this->email = $email;
                    $this->logged = true;
                    $this->userid = $user_info->row['user_id'];
                    $this->username = $user_info->row['username'];
                }
            }
        }

    }
    public function  IsLogged()
    {
        return $this->logged;
    }
}
