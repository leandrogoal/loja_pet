<?php
require "template/header.php";

if(!isset($_SESSION['usuario'])){
	header("Location:".BASE_URL."cadastro.php");

}
$tipo = 1;
$sql="SELECT * FROM parceiras WHERE tipo = :tipo";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":tipo", $tipo);
   	$sql->execute();

   	if($sql->rowCount() > 0){
		$parceiras = $sql->fetchAll();

			
	}

?>

<div class="corpo" style="min-height: 500px;">
	<div class="" style="width: 90%; margin: auto;margin-top: 30px;">
		<center>
			<h2>Conta Joinhas <img style="width: 4%;" src="assets/images/joinha.png"></h2>
		</center>
		<hr>
		<div class="row" style="margin-top: 25px;">
			<div class="col-sm-2">
				<ul >
					<li>
						<a href="doa.php" style="width: 120px; margin-bottom: 10px; background: #006aabff;" class="btn btn-primary">Doação</a>
					</li>
					<li>
						<a href="" style="width: 120px; background: #006aabff;" class="btn btn-primary">Utilizar</a>
					</li>
				</ul>

				
			</div>
			<div class="col-sm-10" >
				<center><h4>Escolha uma ONG/Protetor(a)</h4></center><br>
				<form action="efetiv_doa.php" method="GET" class="row" style="width: 60%; margin: auto; margin-bottom: 30px;">
					<select class="form-control col-sm-7" name="parceira">
						<option></option>
						<?php
							foreach ($parceiras as $parceira) {?>
								<option value="<?php echo $parceira['id']; ?>"><?php echo $parceira['nome']; ?></option>

							<?php	
							}
						  ?>
						
					</select>
					<div class="col-sm-1"></div>
					<input class="col-sm-3 btn btn-primary"  type="submit" >

					
				</form>
			<hr>
			<center><h4>Conheça as ONG's/Protetor(a)s cadastradas</h4></center><br>
			<div class="row lista_ong">
				<?php
					foreach ($parceiras as $parceira) {?>
						<div class="col-sm-3 " style="padding: 30px;">
							<a  href="parceiras.php?parceira=<?php echo $parceira['id']?>">
							<div class="div_list_ong">
								<img style="width: 100%; margin: auto;" src="assets/images/sem_foto.png">
								<center><div><h4>Nome</h4> </div></center>
							</div>	
							</a>
						</div>

					<?php	
					}
				 ?>
				
						
			</div>

				
			</div>
		</div>
		
	</div>
</div>	
<?php
require "template/footer.php";
?>

