<?php
namespace Hcode\Model;
use Hcode\DB\Sql;
use Hcode\CI_Model;

class User extends CI_Model{

	const SESSION = "User";

	public static function login($login,$pass){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN" ,array(
			":LOGIN" => $login
		));

		if (count($result) === 0) 
		{
			throw new \Exception("Usuário ou senha inexistente", 1);
		}

		$data = $result[0]; // SE NÃO OCORRER A EXCEPTION COLOCA POSIÇÃO ZERO NO ARRAY

		if(password_verify($pass, $data['despassword']))
		{

			$user = new User();	

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;
			
		}else{
			throw new \Exception("Senha inválida", 1);
		}

	}

	public static function verifyLogin($inadmin = true)
	{

		if(
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]		
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] != $inadmin
		){

			header("Location: /ecommerce/admin/login");
			exit;
		}

	}

	public static function logout()
	{
		$_SESSION[User::SESSION] = null;
	}

}