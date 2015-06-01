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

        
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $this->response->render($this->load->view('home.html', $data));
    }
}
