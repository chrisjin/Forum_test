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
         $data = array();
         return $this->load->view('header.html', $data);
     }
}
