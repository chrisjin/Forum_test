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
    private $pagesize = 4;
    public function index()
    {
        
        $this->load->model('forum/thread');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            if($this->user->IsLogged())
            {
                $title = $this->request->post['title'];
                $content = $this->request->post['content'];
                $userid = $this->user->GetUserID();
                $subsectionid = $this->forum_path_arr[1];
                if(strlen($title) > 0 && strlen($content) > 0)
                {
                    $this->forum_thread_model->AddThread($title, $content, $subsectionid, $userid);
                }
                $this->response->redirect($this->current_full_path);
            }
        }
        
        $urlarr = [];
        

        $subid = $this->forum_path_arr[1];
        //$threadarr = $this->forum_thread_model->GetThreadBySubsectionID($subid)->rows;
        
        $threadarr = $this->forum_thread_model->GetThreadByRange($this->forum_path_arr[1],
            $this->pagesize * $this->current_page,
            $this->pagesize)->rows;
        
        
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
            
            $numofpost = $this->forum_thread_model->GetNumPostByThreadID($thid);
            $threadinfo['postcount'] = $numofpost;
            
            $threadinfo['delete_url'] = StrUtil::form_link('forum/delete',
                        ['threadid'=>"$thid",
                        'path'=>"$this->forum_path"
                        ]);
            //$urlarr[]=[$title, $url]; 
            $urlarr[]=$threadinfo;
        }
        $data['post_url'] = $this->current_full_path;

        $data['threads'] = $urlarr;

        
        $numthread = $this->forum_thread_model->GetNumThreadBySubsectionID($this->forum_path_arr[1]);
        $pagination = $this->load->view('forum/pagination.html', 
            ['pagination' 
            => $this->PageLinkByRange($this->current_page, $numthread, $this->pagesize)]);
        
        $data['pagination_top'] = $pagination;
        $data['pagination_bottom'] = $pagination;
        
        $data['auth_level'] = $this->user->GetAuthLevel();
        $data['login_link'] = $this->url->link('account/login');
       // $data['register_link'] = 
        return $this->View('forum/thread.html', $data);
        //return $this->load->view('forum/thread.html', $data);
    }
}
