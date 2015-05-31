<?php

/**
 * header short summary.
 *
 * header description.
 *
 * @version 1.0
 * @author C
 */
class CommonHeaderController extends Controller
{
     public function index()
     {
         $this->data['link_login'] = $this->url->link('account/login');

         $this->data['link_register'] = $this->url->link('account/register');
         
         return $this->load->view('header.html', $this->data);
     }
}
