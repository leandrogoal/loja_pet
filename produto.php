<?php
require "template/header.php";
require "classes/produto.php";

?>
<div class="corpo">
	<div class="row home_prod">
		<div class="col-sm-4">
			<div class="imag_prod">
				<img src="<?php echo BASE_URL;?>midia/produtos/<?php echo $produto_item['imagem']; ?>" />
			</div>
			
		</div>
		<div class="col-sm-8">
			<h4><?php echo $produto_item['nome']; ?></h4>
			<div><?php echo $produto_item['marca']; ?></div><br/>
			
				<img src="assets/images/star.png" border="0" height="15" />
				
			<br>
			 <span class="alert alert-light original_price">Por: R$ <?php echo number_format($produto_item['preco'], 2, ',', '.'); ?></span>

			<form  method="GET" class="addtocartform" action="<?php echo BASE_URL?>carrinho.php">
				<input type="hidden" name="id_product" value="<?php echo $produto_item['id']; ?>" />
				<input type="hidden" name="qt_product" value="1" />
				<button data-action="decrease" style="border-radius:  5px 0 0 5px; font-size: 20px; font-weight: bold; width: 30px;">-</button><input type="text" name="qt" value="1" class="addtocart_qt" disabled /><button data-action="increase" style="border-radius: 0 5px 5px 0; font-size: 15px; font-weight: bold;">+</button>
				<input class="addtocart_submit btn btn-primary" type="submit" value="Inserir na Compra" />
			</form>

			<hr/>
			<pre><?php echo $produto_item['descricao']; ?></pre>
			<hr/>
			
			
		</div>
	</div> 
</div>
<?php
require "template/footer.php";
?>