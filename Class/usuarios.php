<?php

$host="localhost";
$usuario="root";
$senha="";
$bd="cj_usuarios";

$db_conec_users= mysqli_connect($host,$usuario,$senha,$bd);
$mysqli_users=new mysqli($host,$usuario,$senha,$bd);


if ($mysqli_users->connect_errno){
    echo "Falha na conexão: ".$mysqli->connect_errno;
    exit();
}

Class Usuario
{
	private $pdo;
	public $msgErro = "";//tudo ok

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try 
		{
			$pdo = new PDO("mysql:dbname=".$nome,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}

    public function cadastrar($usuario, $senha)
	{
		global $pdo;
		//verificar se o usuario já está cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :u");
		$sql->bindValue(":u",$usuario);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //ja esta cadastrado
		}
		else
		{
			//caso nao, Cadastrar
			$sql = $pdo->prepare("INSERT INTO usuarios (usuario, senha) VALUES (:u, :s)");
			$sql->bindValue(":u",$usuario);
			$sql->bindValue(":s",md5($senha));
			$sql->execute();
			return true; //tudo ok
		}
	}

	public function logar($usuario, $senha)
	{
		global $pdo;
		//verificar se o usuario e senha estao cadastrados, se sim
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :u AND senha = :s");
		$sql->bindValue(":u",$usuario);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //cadastrado com sucesso
		}
		else
		{
			return false;//nao foi possivel logar
		}
	}
}



?>