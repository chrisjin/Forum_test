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
                    StrUtil::form_link('forum/main',['path'=>"$parentid/$subid"]);
            }
        }
        

        $data['sections'] = $sections;
        $data['subsections'] = $subsections;

        return $this->load->view('forum/section.html', $data);
    }
}
