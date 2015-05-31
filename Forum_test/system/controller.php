<?php

/**
 * Controller short summary.
 *
 * Controller description.
 *
 * @version 1.0
 * @author C
 */
class Controller
{
    private $registry;
    protected $data;
	public function __construct($registry) 
    {
        $this->data['_img_'] = DIR_IMAGE;
		$this->registry = $registry;
	} 
    
    public function __get($key) {
		return $this->registry->get($key);
	}

	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}
}
