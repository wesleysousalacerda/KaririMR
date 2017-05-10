<?php
if ($_SESSION["admin"]) {
    echo "hello admin";
} else {
    echo "Hello user";
}
?>
<div id="dvUsuarioView">
	<h1>Inicio - <?=$_SESSION["nome"];?></h1>
	

</div>