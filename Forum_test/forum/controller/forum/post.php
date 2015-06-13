<?php

/**
 * post short summary.
 *
 * post description.
 *
 * @version 1.0
 * @author C
 */
class ForumPostController extends ForumController
{
    public function __construct($registry)
    {
        parent::__construct($registry);
        if(count($this->forum_path_arr)!=3)
            exit();
    }
    private function GeneratePagination()
    {
        
    }
    private $pagesize = 4;
    
    public function index()
    {
        $this->load->model('forum/thread');
        
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            if($this->user->IsLogged())
            {
                $content = $this->request->post['content'] ;
                $userid = $this->user->GetUserID();
                $threadid = $this->forum_path_arr[2];
                
                //echo $this->request->full_path();
                $this->forum_thread_model->AddPost($content, $threadid, $userid);             
                $this->response->redirect($this->request->full_path());
            }
        }
        
        //$posts = $this->forum_thread_model->GetPostByThreadID($this->forum_path_arr[2])->rows;
        $posts = $this->forum_thread_model->GetPostByRange($this->forum_path_arr[2],
            $this->pagesize * $this->current_page,
            $this->pagesize)->rows;
        
        $this->load->model('account/user');
        foreach($posts as &$post)
        {
            $user_info = $this->account_user_model->GetUserByID($post['user_id'])->rows;
            $post['username'] = $user_info[0]['username'];
            $post['content'] = htmlspecialchars_decode($post['content']);
        }
        $data['posts'] = $posts;
        
        $data['post_url'] = $this->request->full_path();
        
        
        $numpost = $this->forum_thread_model->GetNumPostByThreadID($this->forum_path_arr[2]);
        $pagination = $this->load->view('forum/pagination.html', 
            ['pagination' 
            => $this->PageLinkByRange($this->current_page, $numpost, $this->pagesize)]);

        
        $data['pagination_top'] = $pagination;
        $data['pagination_bottom'] = $pagination;
        

        return $this->load->view('forum/post.html', $data);
    }
}
