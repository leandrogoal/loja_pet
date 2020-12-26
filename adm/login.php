<?php
require "template/header.php";


$alert_login =0;
if (isset($_POST['email'])) {

	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	


$sql = "SELECT * FROM usuario_adm WHERE email = :email AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

    if($sql->rowCount() > 0) {
        echo $email;
    	$da = $sql->fetch();
    	$_SESSION['usu_adm'] = $da['id'];

    	header("Location:".BASE_URL."index.php");
		exit();
    	
    }else{

    	$alert_login =1;
    } 
}
?>
<center><h1>Login</h1></center>
	<?php if(isset($alert_login) && $alert_login=1) {
		echo '<center><div style="width: 50%; margin: auto; " class="alert alert-danger" role="alert">
 				<h3>Login e/ou Senha estão errados!</h3>
				</div></center>';
	} ?>
<div class="corpo_login" style="width: 40%; margin: auto; margin-top: 40px;">

	<form method="POST">
	  <div class="form-group">
	    <label for="exampleInputEmail1">E-mail</label>
	    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
	    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Senha</label>
	    <input type="password" name="senha" class="form-control" id="exampleInputPassword1" placeholder="Senha">
	  </div>
	  
	  <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
	
</div>