<?php

/**
 * register short summary.
 *
 * register description.
 *
 * @version 1.0
 * @author C
 */
class AccountregisterController extends Controller
{

    public function index() 
    {
    
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            
            echo $this->request->post['email'] . '<br>';
            echo $this->request->post['username']. '<br>';
            echo $this->request->post['password']. '<br>';
            echo $this->request->post['password_again']. '<br>';
            $this->load->model('account/user');
            
            if($this->request->post['password'] 
                == $this->request->post['password_again'])
            $this->account_user_model->AddUser( $this->request->post);
            
            //$this->account_user_model->Insert('user', $this->request->post, array('username', 'email', 'password'));
            exit();
        }
        else
        {
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $data['action_post'] = $this->url->link('account/register');
            
            $data['email'] = 'email';
            $data['username'] = 'username';
            $data['password'] = 'password';
            $data['password_again']= 'password_again';
            
            
            $this->response->render($this->load->view('register.html', $data));
        }
    }
}
