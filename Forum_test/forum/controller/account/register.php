<?php

/**
 * register short summary.
 *
 * register description.
 *
 * @version 1.0
 * @author C
 */
class AccountregisterController extends Controller
{
    public function index() 
    {
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $data['action_post'] = $this->url->link('account/login');
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            echo 'post';
            exit();
        }
        else
            $this->response->render($this->load->view('register.html', $data));
    }
}
