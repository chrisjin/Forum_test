<?php

/**
 * logout short summary.
 *
 * logout description.
 *
 * @version 1.0
 * @author C
 */
class AccountLogoutController extends Controller
{
    public function index() 
    {
        if($this->user->IsLogged())
        {
            $this->load->model('account/user');
            $email = $this->user->GetEmail();
            $this->account_user_model->SetSalt($email, '');
            $this->session->destroy();
            $this->response->redirect($this->url->link('common/home'));
        }
    }
}
