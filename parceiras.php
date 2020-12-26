<?php
require "template/header.php";

if(!isset($_SESSION['usuario'])){
	header("Location:".BASE_URL."cadastro.php");

}
$id_parceira = $_GET['parceira'];
$tipo = 1;
$sql="SELECT * FROM parceiras WHERE id = :id AND tipo = :tipo";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":tipo", $tipo);
	$sql->bindValue(":id", $id_parceira);
   	$sql->execute();

   	if($sql->rowCount() > 0){
		$parceira = $sql->fetch();

			
	}

?>

<div class="corpo" style="min-height: 500px;">
	<div class="" style="width: 90%; margin: auto;margin-top: 30px;">
		<center>
			<h2>Conta Joinhas <img style="width: 4%;" src="assets/images/joinha.png"></h2>
		</center>
		<hr>
			<center><h3><?php echo $parceira['nome'] ?></h3></center>
			<center><div><img style="width: 20%" src="<?php if(empty($parceira)){echo $foto_principal['foto']; }else{echo 'assets/images/sem_foto.png';} ?>"></div></center>
			<div>
				
			</div>
			<div class="fotos_parceira">
				
			</div>
	</div>
</div>	
<?php
require "template/footer.php";
?>

