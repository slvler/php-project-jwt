<?php 

namespace Def\C;



class Control
{
	public function Database($name,$host,$dbname,$username,$pass){


		require_once __DIR__ . '/models/' . strtolower($name) . '.php';
		return new $name($host,$dbname,$username,$pass);
	}

	public function model($name,$db,$table_name)
	{

		require_once __DIR__ . '/models/' . strtolower($name) . '.php';
		return new $name($db,$table_name);
	}

	public function view($name, $data = [])
	{
		require __DIR__ . '/views/' . strtolower($name) . '.php';

	}

	public function views($name, $data = [])
	{
		require __DIR__ . '/views/giris/' . strtolower($name) . '.php';

	}


	public function helpers($name)
	{
		require __DIR__ . '/helpers/' . strtolower($name) . '_helper' . '.php';
	}

}



?>