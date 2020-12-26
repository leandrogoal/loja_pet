<?php
require "template/header.php";
require "classes/usuario.php";

//produtos


if (!isset($_SESSION['cidade'])) {
header("Location:".BASE_URL."cid.php");
exit();
}

?>
<div class="corpo">
	<div class="menu_vertical">
		<a href="index.php?id_c=cachorro" type="button" class="btn btn-primary" >CACHORROS</a><br>
		<a href="index.php?id_c=gato" type="button" class="btn btn-primary">GATOS</a>
	</div>

	<div class="home_loja">
		<div class="row">
		<?php
		foreach ($list as $produto_item):?>
			<div class="col-sm-3">
				<div class="produto_item">
					<a href="<?php echo BASE_URL;?>produto.php?id_prod=<?php echo $produto_item['id']; ?>">
					<img src="<?php echo BASE_URL;?>midia/produtos/<?php echo $produto_item['imagem'];  ?>">
					<div class="produto_nome">
						<?php echo $produto_item['nome'];  ?>
					</div>
					<div class="produto_marca">
						<?php echo $produto_item['marca'];  ?>
					</div>
					<div class="produto_preco">
						R$ <?php echo number_format($produto_item['preco'], 2, ',', '.'); ?>
					</div>
					</a>
				</div>
			</div>
		<?php endforeach ?>
		</div>
	</div>
</div>
<?php
require "template/footer.php"
?>