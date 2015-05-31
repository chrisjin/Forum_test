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
    public function adduser($data)
    {
        $this->db->query('INSERT INTO user (email, username, password) VALUES' 
        . '(\''. $data['email'] . '\', \'' . $data['username'] .'\', \'' . $data['password'] . '\')');
    }
}
