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
    public function InitData(&$data)
    {
        $data['controller'] = $this;
        $data['link'] = function($controllerpath, $args = array())
        {
            return $this->url->link($controllerpath, $args);
        };
        $data['user'] = $this->user;
        $data['current_url'] = $this->request->full_path();
        $data['piece'] = function($viewpath, $args = array())
        {
            $this->InitData($args);
            return $this->load->view($viewpath, $args); 
        };
    }
    public function Render($path, $data = array())
    {
        $this->InitData($data);
        $page = $this->load->view($path, $data);
        $this->response->render($page);
    }
    public function View($path, $data = array())
    {
        $this->InitData($data);
        return $this->load->view($path, $data);
    }
}
