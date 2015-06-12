<?php

/**
 * thread short summary.
 *
 * thread description.
 *
 * @version 1.0
 * @author C
 */
class ForumThreadController extends ForumController
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        if(count($this->forum_path_arr)!=2)
            exit();
    }
    public function index()
    {
        
        $this->load->model('forum/thread');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            if($this->user->IsLogged())
            {
                $title = $this->request->post['title'] . '<br>';
                $content = $this->request->post['content'] . '<br>';
                $userid = $this->user->GetUserID(). '<br>';
                $subsectionid = $this->forum_path_arr[1]. '<br>';
                $this->forum_thread_model->AddThread($title, $content, $subsectionid, $userid);
                
                $this->response->redirect($this->current_full_path);
            }
        }
        
        $urlarr = [];
        

        $subid = $this->forum_path_arr[1];
        $threadarr = $this->forum_thread_model->GetThreadBySubsectionID($subid)->rows;
        
        
        $this->load->model('account/user');
        foreach($threadarr as $thread)
        {
            $thid = $thread['thread_id'];
            $url = StrUtil::form_link('forum/main',
                ['path'=>"$this->forum_path/$thid"]);
            $title = $thread['title'];
            
            $threadinfo = $thread;
            $threadinfo['url'] = $url;
            $user_info = $this->account_user_model->GetUserByID($thread['user_id'])->rows;

            $threadinfo['username'] = $user_info[0]['username'];
            //$urlarr[]=[$title, $url]; 
            $urlarr[]=$threadinfo;
        }
        $data['post_url'] = $this->current_full_path;

        $data['threads'] = $urlarr;

        
        return $this->load->view('forum/thread.html', $data);
    }
}
