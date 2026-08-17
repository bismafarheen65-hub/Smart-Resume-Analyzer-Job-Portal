<style>

@page{
    size:A4;
    margin:0;
}

html,
body{
    margin:0;
    padding:0;
    font-family:DejaVu Sans,Arial,sans-serif;
    background:#ffffff;
}

*{
    box-sizing:border-box;
}

table.wrapper{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
}

tr{
    page-break-inside:avoid;
}

.left{
    width:32%;
    background:#1f2937;
    color:#ffffff;
    padding:22px;
    vertical-align:top;
}

.right{
    width:68%;
    background:#ffffff;
    padding:25px;
    vertical-align:top;
}

.profile{
    text-align:center;
    margin-bottom:20px;
}

.profile img{
    width:90px;
    height:90px;
    border-radius:50%;
    border:3px solid #ffffff;
    object-fit:cover;
    display:block;
    margin:0 auto;
}

.name{
    font-size:22px;
    font-weight:bold;
    margin-top:12px;
    text-align:center;
}

.role{
    text-align:center;
    font-size:13px;
    color:#d1d5db;
    margin-top:5px;
    margin-bottom:18px;
}

.title{
    font-size:14px;
    font-weight:bold;
    color:#ffffff;
    margin-top:20px;
    margin-bottom:10px;
    border-bottom:1px solid rgba(255,255,255,.35);
    padding-bottom:6px;
}

.left p{
    margin:8px 0;
    font-size:12px;
    line-height:20px;
    color:#ffffff;
}

.skill{
    background:#374151;
    color:#ffffff;
    padding:7px 10px;
    border-radius:4px;
    margin-bottom:7px;
    font-size:11px;
}

.rtitle{
    color:#1f2937;
    font-size:15px;
    font-weight:bold;
    border-bottom:2px solid #2563eb;
    padding-bottom:5px;
    margin-top:20px;
    margin-bottom:10px;
}

.right p{
    font-size:12px;
    line-height:20px;
    color:#444444;
    margin:6px 0;
}

hr{
    border:none;
    border-top:1px solid #dddddd;
    margin:10px 0;
}

</style>

<table class="wrapper">

<tr>

<td class="left">

<div class="profile">

<?php if(!empty($data['profile_picture'])){ ?>

<img src="<?php echo pdfImageBase64($data['profile_picture']); ?>">

<?php } ?>

<div class="name">

<?php echo htmlspecialchars($data['full_name'] ?? 'Your Name'); ?>

</div>

<div class="role">

Professional Candidate

</div>

</div>

<div class="title">CONTACT</div>

<p>

<strong>Email</strong><br>

<?php echo htmlspecialchars($data['email'] ?? ''); ?>

</p>

<p>

<strong>Phone</strong><br>

<?php echo htmlspecialchars($data['phone'] ?? ''); ?>

</p>

<p>

<strong>Address</strong><br>

<?php echo htmlspecialchars($data['address'] ?? ''); ?>

</p>

<div class="title">SKILLS</div>

<?php

$skills=!empty($data['skills'])
?explode(",",$data['skills'])
:[];

foreach($skills as $s){

echo "<div class='skill'>".htmlspecialchars(trim($s))."</div>";

}

?>

</td>

<td class="right">

<div class="rtitle">PERSONAL INFORMATION</div>

<p>

<strong>CNIC:</strong>

<?php echo htmlspecialchars($data['cnic'] ?? 'N/A'); ?>

</p>

<p>

<strong>Languages:</strong>

<?php echo htmlspecialchars($data['languages'] ?? 'N/A'); ?>

</p>

<div class="rtitle">EDUCATION</div>

<?php

if(!empty($edu['degree'])){

for($i=0;$i<count($edu['degree']);$i++){

?>
<p>

<strong><?php echo htmlspecialchars($edu['degree'][$i] ?? ''); ?></strong><br>

<?php
if(!empty($edu['institute'][$i])){
    echo htmlspecialchars($edu['institute'][$i])."<br>";
}

if(!empty($edu['date'][$i])){
    echo htmlspecialchars($edu['date'][$i]);
}
?>

</p>

<?php

if($i!=count($edu['degree'])-1){
    echo "<hr>";
}

}

}else{

?>

<p>N/A</p>

<?php } ?>



<div class="rtitle">PROJECTS</div>

<p>

<?php

if(!empty($data['projects'])){

echo nl2br(htmlspecialchars($data['projects']));

}else{

echo "N/A";

}

?>

</p>



<div class="rtitle">EXPERIENCE</div>

<?php

if(!empty($exp['title'])){

for($i=0;$i<count($exp['title']);$i++){

?>

<p>

<strong><?php echo htmlspecialchars($exp['title'][$i] ?? ''); ?></strong><br>

<?php

if(!empty($exp['company'][$i])){
    echo htmlspecialchars($exp['company'][$i])."<br>";
}

if(!empty($exp['date'][$i])){
    echo htmlspecialchars($exp['date'][$i]);
}

?>

</p>

<?php

if($i!=count($exp['title'])-1){
    echo "<hr>";
}

}

}else{

?>

<p>Fresher</p>

<?php } ?>



<div class="rtitle">CERTIFICATIONS</div>

<?php

if(!empty($cert['name'])){

for($i=0;$i<count($cert['name']);$i++){

?>
<p>

<strong><?php echo htmlspecialchars($cert['name'][$i] ?? ''); ?></strong><br>

<?php

if(!empty($cert['org'][$i])){
    echo htmlspecialchars($cert['org'][$i])."<br>";
}

if(!empty($cert['date'][$i])){
    echo htmlspecialchars($cert['date'][$i]);
}

?>

</p>

<?php

if($i != count($cert['name'])-1){
    echo "<hr>";
}

}

}else{

?>

<p>N/A</p>

<?php } ?>

</td>

</tr>

</table>