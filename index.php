<?php 
require_once("vendor/autoload.php");
use Hcode\DB\Sql;
use Hcode\Page;
use Hcode\PageAdmin;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();
	
	$page->template("index");

});

$app->get('/adminPage' , function(){

	$page = new PageAdmin();
	$page->template("index");
	
});

$app->run();

 ?>