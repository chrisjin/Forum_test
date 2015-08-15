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
    const SUCC = 1;
    const FAIL = 2;
    const NOUSER =3;
    public function index() 
    {
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            
            $this->load->model('account/user');
            
            $email = $this->request->post['email'];
            $userquery = $this->account_user_model->GetUserByEmail($email);
            if($userquery->num_rows == 1)
            {
                $data['info']="User exists!!";
                $this->response->render($this->load->view('register_fail.html', $data));
            }
            else if($this->request->post['password'] 
                == $this->request->post['password_again']
                && strlen($this->request->post['email']) > 0
                && strlen($this->request->post['username']) > 0
                && strlen($this->request->post['password']) > 0)
            {
                $this->request->post['password'] = StrUtil::password_hash($this->request->post['password']);
                $this->account_user_model->AddUser( $this->request->post);
                $data['email'] = $this->request->post['email'];
                $data['username'] = $this->request->post['username'];
                $data['info']="Register successful!";
                $data['login_link'] = $this->url->link('account/login');
                $this->response->render($this->load->view('register_succ.html', $data));
            }  
            else
            {
                if(strlen($this->request->post['password']) == 0)
                    $data['info']="Password can not be empty!";
                if($this->request->post['password']  != $this->request->post['password_again'])
                    $data['info']="Password not consistent!";
                $this->response->render($this->load->view('register_fail.html', $data));
            }
            //$this->account_user_model->Insert('user', $this->request->post, array('username', 'email', 'password'));
            
        }
        else
        {

            $data['action_post'] = $this->url->link('account/register');
            
            $data['email'] = 'email';
            $data['username'] = 'username';
            $data['password'] = 'password';
            $data['password_again']= 'password_again';
            $data['activation'] = 'activation';
            
            $this->response->render($this->load->view('register.html', $data));
        }
    }
}
