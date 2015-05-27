<?php

/**
 * login short summary.
 *
 * login description.
 *
 * @version 1.0
 * @author C
 */
class AccountLoginController extends Controller
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
            $this->response->render($this->load->view('login.html', $data));        
        
    }
}
