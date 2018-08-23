<?php
require_once "../includes/main.inc.php";

$gntServer = settings::get_web_root();
$refServer = parse_url($_SERVER['HTTP_REFERER'],  PHP_URL_HOST);

$isError = false;
if (strpos($gntServer, $refServer) === FALSE || !isset($_POST["svg"])) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}


$type = "svg";
if (isset($_POST["type"]) && $_POST["type"] == "png")
    $type = "png";

$filename = "image";
if (isset($_POST["name"]) && strlen($_POST["name"]) > 3)
    $filename = $_POST["name"];

$filename .= "." . $type;

$svg = $_POST["svg"];
$svg = rawurldecode($svg);

if ($type == "svg") {
    $pos = strpos($svg, '>') + 1;
    $svg = substr($svg, 0, $pos) . '<defs><style type="text/css"><![CDATA[.an-arrow-selected{opacity:1.0;stroke:#000;stroke-width:3;}.an-arrow-mute{opacity:0.4;}]]></style></defs>' . substr($svg, 16);
    header('Content-type: image/svg+xml');
    header('Content-Disposition: attachment; filename="' . $filename . '"'); 
    print $svg;
} elseif ($type == "png") {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
}


?>

