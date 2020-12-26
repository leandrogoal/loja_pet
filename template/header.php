<?php
require "config1.php";
require "classes/produto.php";
require "classes/usuario.php";
require "classes/cidade.php";


if(isset($_POST['compra'])){
$total_compra =$_SESSION['subTotal'];

if(isset($_POST['compra'])){
unset($_SESSION['carrinho']);
unset($_SESSION['subTotal']);
unset($_SESSION['quanti_item']);
}
}

if(isset($_SESSION['usuario'])){
   
    $sql = "SELECT * FROM usuario WHERE id = :id ";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":id", $_SESSION['usuario']);
    $sql->execute();

    $usuario = $sql->fetch();
}

if(isset($_SESSION['cidade'])) {
  $cidade =$_SESSION['cidade'];

  if(isset($_GET['id_c'])){
    $categoria = $_GET['id_c'];

    $offset=0; 
   $limit=8; 
    
   
    $sql = "SELECT * FROM produtos WHERE categoria = :categoria ORDER BY RAND() LIMIT $offset, $limit ";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":categoria", $categoria);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $list = $sql->fetchAll();
      }


  }else{

   $offset=0; 
   $limit=8; 
  
    $id_cid= 1;

    $sql = "SELECT *
    FROM produtos  ORDER BY RAND() LIMIT $offset, $limit ";
    $sql = $pdo->query($sql);

    if($sql->rowCount() > 0) {
      $list = $sql->fetchAll();
      }
  }
}



?>
<html>
    <head>
        <meta charset="utf-8">
    <title>Meu Amor Pet</title>
    <link rel="shortcut icon" type="image/x-png" href="assets/images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/css.css">
      </head>
           <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
        
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
    
  <body>

    <nav class="navbar navbar-expand-lg menu_primeiro">
      <button class="navbar-toggler bota" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL; ?>">LOJA<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">QUEM SOMOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL ?>cadastro">CADASTRO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTATO</a>
          </li>
        </ul>
        <?php if(isset($_SESSION['usuario'])): ?>

         <div class="usuarioCab">Olá <?php echo $usuario['nome']; ?> <a style="width: 70px;" href="<?php BASE_URL?>conta.php"  class="btn btn-light menu_primeiro_bot">Conta</a>  <a href="<?php BASE_URL?>sair.php" class="btn btn-light menu_primeiro_bot">Sair</a></div>
        <?php endif; ?>
        <?php if(!isset($_SESSION['usuario'])): ?>
        <form class="form-inline my-2 my-lg-0" method="POST" >

          <input class="form-control mr-sm-2 menu_primeiro_email" name="email_log" type="email" placeholder="e-mail" >
          <input class="form-control mr-sm-2 menu_primeiro_senha" name="senha_log" type="password" placeholder="senha" >
          <button type="submit" class="btn btn-light menu_primeiro_bot">ENTRAR</button>
        </form>
        <?php endif; ?>
      </div>
    </nav>
    <div class="topo">
      <div class="row">
      <div class="col-sm-3 logo_topo">
        <a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/logo.png"></a>
      </div>
      <div class="col-sm-8 image_topo">
        <img src="<?php echo BASE_URL; ?>assets/images/banner.png">
      </div>
      <div class="col-sm-1 carrinhos">
      
       <?php
        if(isset($_SESSION['usuario']) && empty($_SESSION['usuario'])== false)
          {
          ?>
            <a type="submit" href="<?php echo BASE_URL?>carrinho.php?id_product='0'&qt_product=''">
              <div class="cartarea">
                <div class="carticon">
                  <div class="cartqt">
                    <?php if(isset($_SESSION['quanti_item'])){
                      $qt=0;
                      foreach ($_SESSION['carrinho'] as $qtd) {
                        $qt += $qtd;
                      }
                       echo $qt;
                    }else{ echo 0;} ;
                    ?>
                    
                  </div>
                </div>
                <div class="carttotal">
                  <span>R$ <?php if(isset($_SESSION['subTotal'])){echo number_format($_SESSION['subTotal'], 2, ',', '.');}else{ echo '0,00';}   ?></span>
                </div>
              </div>
            </a>
          
        <?php
        } ?>
            
      </div>
     </div>
    </div>
