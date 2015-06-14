<?php

if (is_file('config.php')) {
	require_once('config.php');
}

require_once(DIR_SYSTEM . 'startup.php');

$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


$sql=file_get_contents("forum_test.sql"); 
$statement_arr=explode(";\n",$sql); 

foreach($statement_arr as $state){ 
    if(strlen($state) > 0)
    {
        $state=$state.";";
        //echo $state . '||||||||||||||<br>';
        $db->query($state);
    }
} 

echo 'done!!!';