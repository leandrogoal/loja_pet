<?php
require "config1.php";

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
  <body>

     
    <nav class="navbar navbar-expand-lg menu_primeiro">
      <?php if (isset($_SESSION['usu_adm'])) { ?>
      <button class="navbar-toggler bota" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL; ?>">LOJA<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL ?>pedidos.php">CONFIRMAÇÃO PEDIDO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL ?>cadastro">CADASTRO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTATO</a>
          </li>
        </ul>
        
      </div>
       <?php
     } ?> 
    </nav>
   
