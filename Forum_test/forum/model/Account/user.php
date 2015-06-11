<?php

/**
 * user short summary.
 *
 * user description.
 *
 * @version 1.0
 * @author C
 */
class AccountUserModel extends Model
{

    public function AddUser($data)
    {
        $this->Insert('user', $data, array('email', 'username', 'password'));
    }
    public function GetUserByEmail($email)
    {
        $user_info = $this->db->query("SELECT * FROM user WHERE LOWER(email) = '$email'");
        return $user_info;
    }
    public function GetUserByID($id)
    {
        $user_info = $this->db->query("SELECT * FROM user WHERE user_id = '$id'");
        return $user_info;
    }
    public function SetSalt($email, $salt)
    {
        $this->db->query("UPDATE user SET salt = '$salt' WHERE LOWER(email) = '$email'");
    }
    public function GetSalt($email)
    {
        $query_info = $this->GetUserByEmail($email);
        if(isset($query_info['salt']))
        {
            return $query_info['salt'];
        }
        else
            return false;
    }
}
