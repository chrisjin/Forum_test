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
    private function HeaderItem($nametourl)
    {
        $content = "";
        foreach($nametourl as $name => $url)
        {

            if($_SERVER['REQUEST_URI'] == $url)
                $oneline = "<li class='active'><a href='$url'>$name</a></li>";
            else
                $oneline = "<li><a href='$url'>$name</a></li>";
            $content = $content . $oneline;
        }
        return $content;
    }
    public function index($selectedtab)
    {
        $this->data['link_login'] = $this->url->link('account/login');
        $this->data['link_logout'] = $this->url->link('account/logout');
        $this->data['link_register'] = $this->url->link('account/register');
        
        $this->data['islogged'] = $this->user->IsLogged();
        $this->data['email'] = $this->user->GetEmail();
        $this->data['username'] = $this->user->GetUserName();
        

        $this->data['headeritem'] = 
            $this->HeaderItem([
            'Home' => '/index.php',
            'Forum' => $this->url->link('forum/section'),
            'About Us' => $this->url->link('common/about')
            ]);
        return $this->load->view('header.html', $this->data);
    }
}
