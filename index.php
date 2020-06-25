<?php 
session_start();
require_once("vendor/autoload.php");
use Hcode\DB\Sql;
use Hcode\Page;
use Hcode\PageAdmin;
use Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();
	
	$page->template("index");

});

$app->get('/adminPage' , function(){

	User::verifyLogin();
	$page = new PageAdmin();
	$page->template("index");

});

$app->get('/admin/login' , function(){

	$page = new PageAdmin(array(
		"header" => false,
		"footer" => false
	));
	$page->template("login");

});

$app->post('/admin/login' , function(){

	User::login($_POST['login'] , $_POST['password']);

	header("Location: /ecommerce/adminPage");

	exit;
});

$app->get('/logout',function(){
	
	User::logout();
	header("Location: /ecommerce/admin/login");
	exit;

});

$app->run();

 ?>