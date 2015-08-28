<?php

/**
 * gen short summary.
 *
 * gen description.
 *
 * @version 1.0
 * @author C
 */
class CommonGenController extends Controller
{
    public function index()
    {
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        //$data['controller'] = $this;
        if(isset($this->request->get['view']))
        {
            $viewname = $this->request->get['view'];
            if(is_file(DIR_TEMPLATE . $viewname))
            {
                $this->Render($viewname, $data);
                return;
            }
        }
        $this->Render('error.html', $data);    
        return;
    }
}
