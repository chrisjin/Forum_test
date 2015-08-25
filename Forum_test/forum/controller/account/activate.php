<?php

/**
 * activate short summary.
 *
 * activate description.
 *
 * @version 1.0
 * @author C
 */
class AccountActivateController extends Controller
{
    function SendActivateEmail($address, $link)
    {
        $title = 'Please click the link to activate!';
        $msg = "<a href='$link'>Click to Activate!</a>";
        EmailUtil::send($address, $title, 
            $msg);
    }
    public function index()
    {
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
        {
            $this->load->model('account/user');
            $email = $this->request->post['email'];
            $data['info'] = 'Please check ' . $email . '.<br>' .
                'You will receive an email in secs, <br>if not please click activate again!';
            
            $code = $this->account_user_model->GetActivateCode($email);
            
            $act_url = $this->url->link('account/activate', ['email' => $email, 'code' => $code, 
                'method' => 'activate']);
            $this->SendActivateEmail($email, $act_url);

            
            $this->response->render($this->load->view('info.html', $data));
            

            return;
        }
        else if(isset($this->request->get['email']))
        {
            $data['email'] = $this->request->get['email'];
            if(isset($this->request->get['method']) && isset($this->request->get['code']))
            {
                $method = $this->request->get['method'];
                $code = $this->request->get['code'];
                $email = $data['email'];
                $this->load->model('account/user');
                $correctcode = $this->account_user_model->GetActivateCode($email);
                if($code == $correctcode)
                {
                    $data['info'] = 'Congrats! Activation succeeded!';
                    $data['link'] = $this->url->link('forum/main');
                    $data['link_msg'] = 'Join the talk!';
                    $this->account_user_model->SetAuthLevel($email, 2);
                }
                else
                {
                    $data['info'] = 'Sorry. Activation failed.';
                    $data['link'] = $this->url->link('account/activate', ['email' => $email]);
                    $data['link_msg'] = 'Active again!';
                }
                $this->response->render($this->load->view('info.html', $data));
                return;
            }
            $data['inputid'] = 'email';
            $data['action_post'] = $this->url->link('account/activate');
            $this->response->render($this->load->view('activate.html', $data));
        }
        else
            $this->response->render($this->load->view('error.html', $data));

    }
}
