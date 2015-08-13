<?php
class ForumDeleteController extends Controller
{
    public function index()
    {
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header'); 
        if($this->user->GetAuthLevel() != 1)
        {
            $this->response->render($this->load->view('error.html', $data));
            return;
        }
        $this->load->model('forum/thread');
        if(isset($this->request->get['threadid']))
        {
            if(isset($this->request->get['path']))
            {

                $threadid = $this->request->get['threadid'];
                $this->forum_thread_model->DeleteThreadByID($threadid);
                
                $path = $this->request->get['path'];
                $this->response->redirect($this->url->link("forum/main&path=$path"));

            }
            return;
        }
        if(isset($this->request->get['postid']))
        {
            if(isset($this->request->get['path']))
            {
                $postid = $this->request->get['postid'];
                $this->forum_thread_model->DeletePostByID($postid);

                $path = $this->request->get['path'];
                $this->response->redirect($this->url->link("forum/main&path=$path"));
            }
            return;
        }
        
        

    }
}
?>