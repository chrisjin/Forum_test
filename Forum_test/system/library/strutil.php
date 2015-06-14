<?php

/**
 * strutil short summary.
 *
 * strutil description.
 *
 * @version 1.0
 * @author C
 */
class StrUtil
{
    //static function extract_fields($arrofdict, $fieldname)
    //{
    //    $retarr=[];
    //    foreach($arrofdict as $dict)
    //    {
    //        if(isset($dict[$fieldname]))
    //            $retarr[]=$dict[$fieldname];
    //    }
        
    //}
    static function password_hash($password)
    {
        return md5($password);
    }
    static function form_link($controller, $args = array())
    {
        $argstr='';  
        foreach($args as $name => $value)
        {
            $argstr.= ('&' . $name . '=' . $value);
        }
        
        $url = HTTP_SERVER . 'index.php?route=' . $controller ;
        if (count($args)>0) {
            $url .= str_replace('&', '&amp;', '&' . ltrim($argstr, '&'));
        }
        return $url;
    }
    static function controller_path_from_url($url)
    {
        $parts = parse_url($url);
        if(isset($parts['query']))
            parse_str($parts['query'], $query);
        else
            return CONTROLLER_HOME;
    
        if(isset($query['route']))
            return $query['route'];
        else
            return CONTROLLER_HOME;
    }
    static function controller_arr_from_url($url)
    {
        $path = StrUtil::controller_path_from_url($url);
        return explode('/', $path);
    }
}
