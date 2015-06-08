<?php

/**
 * nav short summary.
 *
 * nav description.
 *
 * @version 1.0
 * @author C
 */

namespace PartStoob;
class Nav
{
    public function items($nametourl)
    {
        $content = "";
        $current_arr = $this->request->controller_arr();
        foreach($nametourl as $name => $url_filter)
        {
            if(is_array($url_filter))
            {
                $url = $url_filter[0];
                $filter = $url_filter[1];
            }
            else 
            {
                $url = $url_filter;
                $filter = \StrUtil::controller_arr_from_url($url_filter)[1];
            }
            
            $ismatch = false;
            $bound = count($current_arr);
            for($i = 0; $i < $bound; $i++)
            {
                if($current_arr[$i] == $filter)
                {
                    $ismatch = true;
                    break;
                }
            }
            
            if($ismatch)
                $oneline = "<li class='active'><a href='$url'>$name</a></li>";
            else
                $oneline = "<li><a href='$url'>$name</a></li>";
            $content = $content . $oneline;
        }
        return $content;
    }
}
