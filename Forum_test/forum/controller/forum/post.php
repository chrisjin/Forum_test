<?php

/**
 * post short summary.
 *
 * post description.
 *
 * @version 1.0
 * @author C
 */
class ForumPostController extends Controller
{
    public function index()
    {
        $data = [];
        return $this->load->view('forum/post.html', $data);
    }
}
