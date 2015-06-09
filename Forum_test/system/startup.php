<?php
function autoload($class) {
	$file = DIR_SYSTEM . 'library/' . str_replace('\\', '/', strtolower($class)) . '.php';

	if (file_exists($file)) {
		include_once($file);

		return true;
	} else {
        $file = DIR_APPLICATION . 'library/' . str_replace('\\', '/', strtolower($class)) . '.php';
        if (file_exists($file)) {
            include_once($file);

            return true;
        }
        else {
        
            
            echo "File Err:$file<br>";
            return false;
        }
	}
}

spl_autoload_register('autoload');
spl_autoload_extensions('.php');

require_once(DIR_SYSTEM . 'action.php');
require_once(DIR_SYSTEM . 'controller.php');
require_once(DIR_SYSTEM . 'registry.php');
require_once(DIR_SYSTEM . 'loader.php');
require_once(DIR_SYSTEM . 'model.php');