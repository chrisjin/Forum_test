<?php

/**
 * thread short summary.
 *
 * thread description.
 *
 * @version 1.0
 * @author C
 */
class ForumThreadController extends Controller
{
    public function index()
    {
        $this->load->model('forum/thread');
        $urlarr = [];
        if(isset($this->request->get['path']))
        {
            $forum_path = $this->request->get['path'];
            $patharr = explode('/', $forum_path);
            if(count($patharr) == 2)
            {
                $subid = $patharr[1];
                $threadarr = $this->forum_thread_model->GetThreadBySubsectionID($subid)->rows;
                foreach($threadarr as $thread)
                {
                    $thid = $thread['thread_id'];
                    $url = StrUtil::form_link('forum/main',['path'=>"$patharr[0]/$patharr[1]/$thid"]);
                    $title = $thread['title'];
                    $urlarr[]=[$title, $url]; 
                }
            }
        }
        $data['threads'] = $urlarr;


        return $this->load->view('forum/thread.html', $data);
    }
}
