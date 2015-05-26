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
        $data=array();
        $data['link'] = $this->url->link('account/login/show');
        $data['url'] = $this->url;
        echo $this->load->view('home.tpl', $data);
    }
}
