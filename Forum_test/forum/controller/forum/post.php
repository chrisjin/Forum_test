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
                
                
                $this->forum_thread_model->AddPost($content, $threadid, $userid);
                
                $this->response->redirect($this->current_full_path);
            }
        }
        
        $posts = $this->forum_thread_model->GetPostByThreadID($this->forum_path_arr[2])->rows;
        $this->load->model('account/user');
        foreach($posts as &$post)
        {
            $user_info = $this->account_user_model->GetUserByID($post['user_id'])->rows;
            $post['username'] = $user_info[0]['username'];
            $post['content'] = htmlspecialchars_decode($post['content']);
        }
        $data['posts'] = $posts;
        
        $data['post_url'] = $this->current_full_path;
        return $this->load->view('forum/post.html', $data);
    }
}
