<?php
require_once("../libs/fasta.class.inc.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$fasta = new fasta($db,$_GET['id']);
	echo $fasta->view_fasta_file();
}
?>
