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
    //public $test = "PPPPP";
    public function index($selectedtab)
    {
        $this->data['link_login'] = $this->url->link('account/login');
        $this->data['link_logout'] = $this->url->link('account/logout');
        $this->data['link_register'] = $this->url->link('account/register');
        $this->data['link_activate'] = $this->url->link('account/activate', ['email' => $this->user->GetEmail() ]);
        
        $this->data['islogged'] = $this->user->IsLogged();
        $this->data['email'] = $this->user->GetEmail();
        $this->data['username'] = $this->user->GetUserName();
        $this->data['auth_level'] = $this->user->GetAuthLevel();
        
        $this->data['logo'] = 'forum/view/img/logo.png';
        
        // the controller with a view argument is a virtual controller 
        // used to identify the highlight item on the nav.
        // will be redirected to the gen.php.
        $this->data['headeritem'] = 
            PartStoob\Nav::items([
            'Home' => [HTTP_SERVER . 'index.php', 'home'],
            'Visit CDF' => [$this->url->link('forum/main'), 'forum'],
            'Recruitment' => [$this->url->link('common/recruitment', ['view' =>'recruitment.html']), 'recruitment'],
            'About Us' => [$this->url->link('common/about'), 'about'],
            'Contact Us' => [$this->url->link('common/contact', ['view' =>'contact.html']), 'contact'],
            ]);
        return $this->View('header.html', $this->data);
    }
}
