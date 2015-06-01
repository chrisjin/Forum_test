<?php

/**
 * login short summary.
 *
 * login description.
 *
 * @version 1.0
 * @author C
 */
class AccountLoginController extends Controller
{
    const SUCC = 1;
    const FAIL = 2;
    const NOUSER =3;
    private function validate($password, $userquery)
    {
        if($userquery->num_rows == 1)
        {
            if($password == $userquery->row['password'])
            {
                return AccountLoginController::SUCC;
            }
            else
            {
                return AccountLoginController::FAIL;
            }
        }
        else
        {
            return AccountLoginController::NOUSER;
        }

    }
    public function index()
    {
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        $data['action_post'] = $this->url->link('account/login');
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            $this->load->model('account/user');
            $email = $this->request->post['email'];
            $password = $this->request->post['password'];
            //echo $email;
            $userquery = $this->account_user_model->GetUserByEmail($email);
            $islog = $this->validate($password, $userquery);
            if($islog == AccountLoginController::SUCC)
            {
                $salt = substr(md5(uniqid(mt_rand())), 0, 10);
                $this->account_user_model->SetSalt($email, $salt);
                $this->session->data['token'] = $salt;
                $this->session->data['email'] = $email;
                $this->response->redirect($this->url->link('common/home'));
       
            }
            else
            {
                //$this->response->render($this->load->view('login.html', $data));  
                echo 'fail';
            }
        }
        else
        {
            $data['email'] = 'email';
            $data['password'] = 'password';
            $this->response->render($this->load->view('login.html', $data));        
        }
        
    }
}
