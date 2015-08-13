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
    private $auth_level;
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
            $this->auth_level = 0;
            if($user_info->num_rows == 1)
            {
                if($token == $user_info->row['salt'])
                {
                    $this->email = $email;
                    $this->logged = true;
                    $this->userid = $user_info->row['user_id'];
                    $this->username = $user_info->row['username'];
                    if(isset($user_info->row['auth_level']))
                    {
                        $this->auth_level = $user_info->row['auth_level'];
                    }
                    else
                    {
                        $this->auth_level = 0;
                    }
                }
            }
        }

    }
    public function GetAuthLevel()
    {
        return $this->auth_level;
    }
    public function  IsLogged()
    {
        return $this->logged;
    }
}
