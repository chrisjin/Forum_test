<?php
class Url {
    private $domain;
    
    public function __construct($domain, $ssl = '') {
		$this->domain = $domain;
	}
    public function link($controller,$args = array())
    {
        $argstr='';
        
        
        foreach($args as $name => $value)
        {
            $argstr.= ('&' . $name . '=' . $value);
        }
        
        $url = '/index.php?route=' . $controller ;
        if (count($args)>0) {
            $url .= str_replace('&', '&amp;', '&' . ltrim($argstr, '&'));
        }
        return $url;
    }
}
