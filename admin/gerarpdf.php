<?php
include 'cabecalho_gerarpdf.php';
use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf(["enable_remote" => true]);

ob_start();
require_once 'processa_relatorio.php';
$dompdf->loadHtml(ob_get_clean());

$dompdf->setPaper("A4", "portrait");

$dompdf->render();
$dompdf->stream("Relatório_$titulo.pdf", ["Attachment" => false]);
?>