<?php

/**
 * forum short summary.
 *
 * forum description.
 *
 * @version 1.0
 * @author C
 */
class ForumMainController extends Controller
{
    private function _buildbreadcrumbs_link()
    {
        $this->load->model('forum/section');
        $breadcrumbs_link[0] = ['Forum', StrUtil::form_link('forum/main')];
        if(isset($this->request->get['path']))
        {
            $forum_path = $this->request->get['path'];
            $patharr = explode('/', $forum_path);
            if(count($patharr) >= 1)
            {
                $sections = $this->forum_section_model->GetSectionByID($patharr[0])->rows;
                assert(count($sections) == 1);
                $breadcrumbs_link[1] = [$sections[0]['name'],
                        StrUtil::form_link('forum/main',['path'=>"$patharr[0]"])];
            }
            if(count($patharr) >= 2)
            {
                $subsection = $this->forum_section_model->GetSubsectionByID($patharr[1])->rows;
                assert(count($subsection) == 1);
                $breadcrumbs_link[2]= [$subsection[0]['name'],
                        StrUtil::form_link('forum/main',['path'=>"$patharr[0]/$patharr[1]"])];
            }
            if(count($patharr) >= 3)
            {
                $this->load->model('forum/thread');
                $thread = $this->forum_thread_model->GetThreadByID($patharr[2])->rows;
                assert(count($thread) == 1);
                $breadcrumbs_link[3]= [$thread[0]['title'],
                    StrUtil::form_link('forum/main',['path'=>"$patharr[0]/$patharr[1]/$patharr[2]"])];
            }
        }
        return $breadcrumbs_link;
    }
    public function index()
    {

        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

        $data['breadcrumbs_link'] = $this->_buildbreadcrumbs_link();
        
        $level = count($data['breadcrumbs_link']);
        if($level<=2)
            $data['body'] = $this->load->controller('forum/section');
        else if($level<=3)
            $data['body'] = $this->load->controller('forum/thread');
        else if($level<=4)
            $data['body'] = $this->load->controller('forum/post');
        
        
        $this->response->render($this->load->view('forum/main.html', $data));

    }
}
