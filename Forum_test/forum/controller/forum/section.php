<?php

/**
 * section short summary.
 *
 * section description.
 *
 * @version 1.0
 * @author C
 */
class ForumSectionController extends Controller
{
    private function _buildbreadcrumbs_link()
    {
        $breadcrumbs_link[0] = ['Forum', StrUtil::form_link('forum/section')];
        if(isset($this->request->get['path']))
        {
            $forum_path = $this->request->get['path'];
            $patharr = explode('/', $forum_path);
            if(count($patharr) >= 1)
            {
                $sections = $this->forum_section_model->GetSectionByID($patharr[0])->rows;
                assert(count($sections) == 1);
                $breadcrumbs_link[1] = [$sections[0]['name'],
                        StrUtil::form_link('forum/section',['path'=>"$patharr[0]"])];
            }
            if(count($patharr) == 2)
            {
                $subsection = $this->forum_section_model->GetSubsectionByID($patharr[1])->rows;
                assert(count($subsection) == 1);
                $breadcrumbs_link[2]= [$subsection[0]['name'],
                        StrUtil::form_link('forum/section',['path'=>"$patharr[0]/$patharr[1]"])];
            }
        }
        return $breadcrumbs_link;
    }
    public function index()
    {
        $this->load->model('forum/section');
        $sections= [];
        if(isset($this->request->get['path']))
        {
            $forum_path = $this->request->get['path'];
            $patharr = explode('/', $forum_path);
            if(count($patharr) == 1)
            {
                $sections = $this->forum_section_model->GetSectionByID($patharr[0])->rows;
            }
            if(count($patharr) == 2)
            {
                $sections = [];
                // show the theads
            }
        }
        else
        {
            $sections = $this->forum_section_model->GetAllSections()->rows;
        }
        $subsections = $this->forum_section_model->GetForumStructure();
        
        foreach($sections as $section)
        {
            foreach($subsections[$section['section_id']] as &$subsection)
            {
                $subid = $subsection['subsection_id'];
                $parentid = $subsection['section_id'];
                $subsection['url'] = 
                    StrUtil::form_link('forum/section',['path'=>"$parentid/$subid"]);
            }
        }
        
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['sections'] = $sections;
        $data['subsections'] = $subsections;
        $data['breadcrumbs_link'] = $this->_buildbreadcrumbs_link();

        $this->response->render($this->load->view('section.html', $data));
    }
}
