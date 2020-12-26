<?php
require "template/header.php";

if(!isset($_SESSION['usuario'])){
	header("Location:".BASE_URL."cadastro.php");

}


$id_user = $_SESSION['usuario'];
$_SESSION['parceira'] =  $_GET['parceira'];
$id_parceira = $_SESSION['parceira'];

$tipo = 1;
$sql="SELECT * FROM parceiras WHERE id = :id AND tipo = :tipo";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":tipo", $tipo);
	$sql->bindValue(":id", $id_parceira);
   	$sql->execute();

   	if($sql->rowCount() > 0){
		$parceira = $sql->fetch();

			
	}
$sql="SELECT * FROM usuario WHERE id = :id ";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":id", $id_user);
 	$sql->execute();

   	if($sql->rowCount() > 0){
		$dados_usuarios = $sql->fetch();

	}

if(isset($_POST['doar'])){
	$valor_doa = $_POST['doar'];
	
	$saldo_joinha_doa= $dados_usuarios['saldo_joinha_doa']-$valor_doa;
	echo $saldo_joinha_doa;

	$sql = "UPDATE usuario SET saldo_joinha_doa = :saldo_joinha_doa WHERE id = :id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":saldo_joinha_doa", $saldo_joinha_doa);
	$sql->bindValue(":id", $id_user);
    $sql->execute();


    	$joinha_doa  = floatval($valor_doa);
		$status= 2;
		$texto_doa ='Doação ';
		$pedido = $texto_doa.$_SESSION['parceira'].'.'.$_SESSION['usuario'].'.'. rand(1,999);
		$data = date("Y-m-d H:i");

				
		$sql = "INSERT INTO joinhas_doa (usuario, pedido, valor, status, data) VALUES (:usuario, :pedido, :valor, :status, :data)";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":usuario", $id_user);
		$sql->bindValue(":pedido", $pedido);
		$sql->bindValue(":valor", $joinha_doa);
		$sql->bindValue(":status", $status);
		$sql->bindValue(":data", $data);
		$sql->execute();

    header("Location:".BASE_URL."conta.php?doa_ef=1");
}
?>

<div class="corpo" style="min-height: 500px;">
	<div class="" style="width: 90%; margin: auto;margin-top: 30px;">
		<center>
			<h2>Conta Joinhas <img style="width: 4%;" src="assets/images/joinha.png"></h2>

		</center>
		<hr><br>
			<center><h3>Efetivação de Doação </h3></center>
			<div class="row" style="margin-top: 50px;">
				<div class="col-sm-7" style="border: 1px solid black;border-right: 0; border-radius: 10px 0px 0px 10px; padding: 25px;">
					<div class="row">
						<div class="col-sm-5">
							<img style="width: 70%;" src="assets/images/sem_foto.png">
						</div>
						<div class="col-sm-7">
							<center><h4><?php echo $parceira['nome'] ?></h4></center>
							....
						</div>
						
					</div>
						
				</div>
				<div class="col-sm-5" style="border: 1px solid black; border-radius: 0 10px 10px 0; padding: 25px;">
					<div >
						<div style="font-size: 20px; margin-bottom: 20px;">Saldo:  R$ <?php echo number_format($dados_usuarios['saldo_joinha_doa'], 2, ',','.'); ?>
						</div>
						<form method="POST">
							<div><input type="number" name="doar" step="0.01" min="0.01" style="width: 200px; margin-bottom: 15px;"  class="form-control"></div>
							<input type="submit" class=" btn btn-primary" value="Doar">
							
						</form>
						
					</div>
					    
				</div>
				
			</div>
	</div>
</div>

<?php
require "template/footer.php";
?>

