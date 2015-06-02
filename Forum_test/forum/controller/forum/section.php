<?php

/**
 * section short summary.
 *
 * section description.
 *
 * @version 1.0
 * @author C
 */
class ForumSectionController extends Controller
{
    public function index()
    {
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $this->response->render($this->load->view('section.html', $data));
    }
}
