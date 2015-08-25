<?php

/**
 * home short summary.
 *
 * home description.
 *
 * @version 1.0
 * @author C
 */
class CommonHomeController extends Controller
{
    public function index()
    {

        
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $data['forum_link'] = $this->url->link('forum/main');
        $data['event_link'] = $this->url->link('common/event', ['view' =>'event.html']);
        $data['research_link'] = $this->url->link('common/research', ['view' =>'research.html']);
        $data['chapters_link'] = $this->url->link('common/chapters', ['view' =>'chapters.html']);
        $data['membership_link'] = $this->url->link('common/membership', ['view' =>'membership.html']);
        $data['committee_link'] = $this->url->link('common/committee', ['view' =>'committee.html']);
        $this->response->render($this->load->view('home.html', $data));
    }
}
