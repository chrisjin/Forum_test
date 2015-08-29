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
    private $pagesize = 5;
    
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
                
                if(strlen($content) > 0)
                {
                    $this->forum_thread_model->AddPost($content, $threadid, $userid);
                }
                $this->response->redirect($this->request->full_path());
            }
        }
        $thread = $this->forum_thread_model->GetThreadByID($this->forum_path_arr[2])->rows;
        assert(count($thread) == 1);
        $thread = $thread[0];
        $data['thread_title'] = $thread['title'];

        $posts = $this->forum_thread_model->GetPostByRange($this->forum_path_arr[2],
            $this->pagesize * $this->current_page,
            $this->pagesize)->rows;
        

        
        
        $this->load->model('account/user');
        $row_num = $this->pagesize * $this->current_page;
        foreach($posts as &$post)
        {
            $user_info = $this->account_user_model->GetUserByID($post['user_id'])->rows;
            $post['username'] = $user_info[0]['username'];
            $post['content'] = htmlspecialchars_decode($post['content']);
            $post['row_num'] = $row_num;
            $post['post_time'] = date('m/d/Y, H:i:s', strtotime($post['post_time']));
            $post['avatar'] = 'forum/view/img/avatar.jpg';
            $post_id = $post['post_id'];
            $post['delete_url'] = StrUtil::form_link('forum/delete',
                        ['postid'=>"$post_id",
                        'path'=>"$this->forum_path"]);
            $row_num++;
        }
        $data['posts'] = $posts;
        
        $data['post_url'] = $this->request->full_path();
        
        
        $numpost = $this->forum_thread_model->GetNumPostByThreadID($this->forum_path_arr[2]);
        $pagination = $this->load->view('forum/pagination.html', 
            ['pagination' 
            => $this->PageLinkByRange($this->current_page, $numpost, $this->pagesize)]);

        
        $data['pagination_top'] = $pagination;
        $data['pagination_bottom'] = $pagination;
        
        $data['auth_level'] = $this->user->GetAuthLevel();
        return $this->View('forum/post.html', $data);
    }
}
