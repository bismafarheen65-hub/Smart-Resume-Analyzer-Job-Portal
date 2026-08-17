<?php
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include("config/db.php");
session_start();

/* CHECK LOGIN */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* TEMPLATE */
$template = $_GET['template'] ?? 'modern';

/* =========================
   PDF TEMPLATE PATH (IMPORTANT FIX)
========================= */
$pdfTemplate = __DIR__ . "/templates/" . $template . "_pdf.php";

if(!file_exists($pdfTemplate)){
    die("PDF Template missing: " . $pdfTemplate);
}

/* =========================
   FETCH DATA
========================= */
$query = mysqli_query($conn,"
    SELECT * FROM cv 
    WHERE User_ID='$user_id' 
    ORDER BY CV_ID DESC 
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("No CV Found!");
}

/* JSON DECODE */
$edu  = !empty($data['education']) ? json_decode($data['education'], true) : [];
$cert = !empty($data['certifications']) ? json_decode($data['certifications'], true) : [];
$exp  = !empty($data['experience']) ? json_decode($data['experience'], true) : [];

/* =========================
   IMAGE HELPER (BASE64)
========================= */
function pdfImageBase64($file){

    if(empty($file)) return '';

    $path = __DIR__ . "/uploads/" . $file;

    if(!file_exists($path)){
        return '';
    }

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = base64_encode($data);

    return 'data:image/' . $type . ';base64,' . $base64;
}

/* =========================
   DOMPDF CONFIG
========================= */
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set('defaultFont', 'Arial');

$dompdf = new Dompdf($options);

/* =========================
   LOAD TEMPLATE HTML
========================= */
ob_start();
include($pdfTemplate);
$html = ob_get_clean();

/* =========================
   LOAD HTML INTO DOMPDF
========================= */
$dompdf->loadHtml($html, 'UTF-8');

/* A4 PAGE SETUP */
$dompdf->setPaper('A4', 'portrait');

/* RENDER PDF */
$dompdf->render();

/* OUTPUT */
$dompdf->stream("CV_".$template.".pdf", [
    "Attachment" => true
]);

exit;
?>