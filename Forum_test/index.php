<?php

if (is_file('config.php')) {
	require_once('config.php');
}

require_once(DIR_SYSTEM . 'startup.php');


$registry = new Registry();

$request = new Request();
$registry->set('request', $request);

$url = new Url(HTTP_SERVER);
$registry->set('url', $url);

$loader = new Loader($registry);
$registry->set('load', $loader);



if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}
$action->execute($registry);

//echo $url->link('account/login/show');
?>

