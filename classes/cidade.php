<?php

		$sql = "SELECT * FROM estados";
		$sql = $pdo->query($sql);

		if($sql->rowCount() > 0){
			$estados = $sql->fetchAll();
		}

		
		$sql = "SELECT * FROM cidades";
		$sql = $pdo->query($sql);

		if($sql->rowCount() > 0){
			$cidades = $sql->fetchAll();
		}