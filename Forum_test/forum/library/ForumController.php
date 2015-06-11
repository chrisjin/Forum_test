<?php

/**
 * ForumController short summary.
 *
 * ForumController description.
 *
 * @version 1.0
 * @author C
 */
class ForumController extends Controller
{
    protected $forum_path = '';
    protected $forum_path_arr = [];
    protected $current_full_path = '';
    public function __construct($registry)
    {
        parent::__construct($registry);
        if(isset($this->request->get['path']))
        {
            $this->forum_path = $this->request->get['path'];
            $this->forum_path_arr = explode('/', $this->forum_path);
            if(count($this->forum_path_arr) != 2)
                exit();
            else
                $this->current_full_path = StrUtil::form_link('forum/main',['path'=>"$this->forum_path"]);
            
        }
        else
            exit();
    }
}
