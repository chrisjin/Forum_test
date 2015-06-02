<?php

/**
 * footer short summary.
 *
 * footer description.
 *
 * @version 1.0
 * @author C
 */
class CommonFooterController extends Controller
{
     public function index()
     {
        $data = array();
        return $this->load->view('footer.html', $data);
     }
}
