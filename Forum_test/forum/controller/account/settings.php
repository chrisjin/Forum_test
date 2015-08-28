<?php
    class AccountSettingsController extends Controller
    {
        public function index()
        {
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $this->Render('settings.html', $data);
        }
    }
?>