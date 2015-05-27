<?php

/**
 * home short summary.
 *
 * home description.
 *
 * @version 1.0
 * @author C
 */
class CommonHomeController extends Controller
{
    public function index()
    {
        $data['link_login'] = $this->url->link('account/login');

        $data['link_register'] = $this->url->link('account/register');
        
        
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $this->response->render($this->load->view('home.html', $data));
    }
}
