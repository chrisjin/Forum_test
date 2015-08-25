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
    public function SetActivateCode($email, $code)
    {
        $this->db->query("INSERT INTO activate (email, code) VALUES ('$email', '$code')");
    }
    public function GetActivateCode($email)
    {
        $query_info = $this->db->query("SELECT * FROM activate WHERE LOWER(email) = '$email'");
        if(count($query_info->rows) == 1)
        {
            if(isset($query_info->row['code']))
            {
                return $query_info->row['code'];
            }
            return false;
        }
        else
            return false;
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
    public function SetAuthLevel($email, $level)
    {
        $this->db->query("UPDATE user SET auth_level = '$level' WHERE LOWER(email) = '$email'");
    }
}
