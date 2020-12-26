<?php
 if(isset($_POST['email_ca'])){
            $email = $_POST['email_ca'];
           
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":email", $email);
            $sql->execute();

        if($sql->rowCount() > 0) {
            header("Location:".BASE_URL."index?email=".$email);
            exit();
        }else{    

            $nome = $_POST['nome_ca'];
            $sobre_nome = $_POST['sobre_nome'];
           
            $senha = md5($_POST['senha']);
            $celular = $_POST['celular'];
            $cidade = $_POST['cidade'];


		 $sql = "INSERT INTO usuario (nome, sobre_nome, email, senha, celular, cidade) VALUES (:nome, :sobre_nome, :email, :senha, :celular, :cidade)";
	    $sql = $pdo->prepare($sql);
	    $sql->bindValue(":nome", $nome);
	    $sql->bindValue(":sobre_nome", $sobre_nome);
	    $sql->bindValue(":email", $email);
	    $sql->bindValue(":senha", $senha);
	    $sql->bindValue(":celular", $celular);
	    $sql->bindValue(":cidade", $cidade);
        $sql->execute();
		}

		$sql = "SELECT * FROM usuario WHERE email = :email";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":email", $email);
            $sql->execute();

        if($sql->rowCount() > 0) {

        	$da = $sql->fetch();
        	$_SESSION['usuario'] = $da['id'];

        	
        }    
		header("Location".BASE_URL."carrinho.php");
		exit();
}

if(isset($_POST['email_log'])){
	$email= $_POST['email_log'];
	$senha = md5($_POST['senha_log']);

	$sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
            $sql->execute();

        if($sql->rowCount() > 0) {
            echo "entrou1";
        	$da = $sql->fetch();
        	$_SESSION['usuario'] = $da['id'];

        	header("Location:".BASE_URL."index.php");
			exit();
        	
        }else{

        	header("Location:".BASE_URL."cadastro.php");
			exit();
        }    
		
}
//SELECIONAR DADOS PARA ENDEREÇO DE USUARIO
if(isset($_SESSION['usuario'])){
$id_usu = $_SESSION['usuario'];
        $sql = "SELECT *,(select cidade from cidades where cidades.id = endereco.cidade)as cidade_nome
        FROM endereco WHERE id_usuario = :id ";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",$id_usu);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $end = $sql->fetch();
            
        }
       
}

//INSERIR DADOS DE ENDEREÇO
if(isset($_POST['cadastra_end'])){
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $num = $_POST['num'];
    $vila = $_POST['vila'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $id_usu = $_SESSION['usuario'];

    $sql = "INSERT INTO endereco (id_usuario, rua, num, vila, cep, estado, cidade) VALUES (:id_usuario, :rua, :num, :vila, :cep, :estado , :cidade)";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id_usuario", $id_usu);
    $sql->bindValue(":cep", $cep);
    $sql->bindValue(":rua", $rua);
    $sql->bindValue(":num", $num);
    $sql->bindValue(":vila", $vila);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":cidade", $cidade);
    $sql->execute();

    header("Location:".BASE_URL."carrinho.php?id_product='0'&qt_product=''");
    exit();
  }

//  ALTERANDO ENDEREÇO USUARIO
if(isset($_POST['alterar_end'])){
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $num = $_POST['num'];
    $vila = $_POST['vila'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $id_usu = $_SESSION['usuario'];

    $sql = "UPDATE endereco SET  rua = :rua , num = :num, vila = :vila, cep = :cep, estado = :estado, cidade =:cidade WHERE id_usuario = :id_usuario ";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":cep", $cep);
    $sql->bindValue(":rua", $rua);
    $sql->bindValue(":num", $num);
    $sql->bindValue(":vila", $vila);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":cidade", $cidade);
    $sql->bindValue(":id_usuario", $id_usu);
    $sql->execute();

 
    header("Location:".BASE_URL."carrinho.php?id_product='0'&qt_product=''");
    exit();
  }
?>