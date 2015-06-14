<?php

/**
 * header short summary.
 *
 * header description.
 *
 * @version 1.0
 * @author C
 */
class CommonHeaderController extends Controller
{
    public function index($selectedtab)
    {
        $this->data['link_login'] = $this->url->link('account/login');
        $this->data['link_logout'] = $this->url->link('account/logout');
        $this->data['link_register'] = $this->url->link('account/register');
        
        $this->data['islogged'] = $this->user->IsLogged();
        $this->data['email'] = $this->user->GetEmail();
        $this->data['username'] = $this->user->GetUserName();
        

        $this->data['headeritem'] = 
            PartStoob\Nav::items([
            'Home' => [HTTP_SERVER . 'index.php', 'home'],
            'Forum' => [$this->url->link('forum/main'), 'forum'],
            'About Us' => [$this->url->link('common/about'), 'about']
            ]);
        return $this->load->view('header.html', $this->data);
    }
}
