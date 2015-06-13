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
    protected $current_page = 0;
    public function __construct($registry)
    {
        parent::__construct($registry);
        if(isset($this->request->get['page']))
        {
            $this->current_page = $this->request->get['page'];
        }
        if(isset($this->request->get['path']))
        {
            $this->forum_path = $this->request->get['path'];
            $this->forum_path_arr = explode('/', $this->forum_path);
            $this->current_full_path = StrUtil::form_link('forum/main',['path'=>"$this->forum_path"]);
            
        }
        else
            exit();
    }
    
    public function PageLink($pagenum)
    {
        return StrUtil::form_link('forum/main',
            ['path'=>"$this->forum_path", 'page'=>$pagenum]);
    }
    
    public function PageLinkByRange($currentpage, $numitems, $pagesize = 10)
    {
        
        $numpage = (int)($numitems / $pagesize);
        //echo $numitems;
        if($numitems % $pagesize != 0)
            $numpage++;
        if($currentpage >= $numpage)
            return NULL;
        

        $firsturl['url'] = $this->PageLink(0);
        $firsturl['firstpage'] = true;
        $firsturl['lastpage'] = false;
        $firsturl['currentpage'] = false;
        
        $lasturl['url'] = $this->PageLink($numpage-1);
        $lasturl['firstpage'] = false;
        $lasturl['lastpage'] = true;
        $lasturl['currentpage'] = false;
        
        $url_arr[0] = $firsturl;
        $url_arr[$numpage-1] = $lasturl;
        
        for($i = $currentpage - 2; $i <= $currentpage+2; $i++)
        {
            if($i >= 0 && $i < $numpage)
            {
                $pageurl['url'] = $this->PageLink($i);
                $pageurl['firstpage'] = false;
                $pageurl['lastpage'] = false;
                $pageurl['currentpage'] = 
                    $i == $currentpage ? true : false;
                $url_arr[$i] = $pageurl;
            }
        }
        ksort($url_arr);
        return $url_arr;
    }
}
