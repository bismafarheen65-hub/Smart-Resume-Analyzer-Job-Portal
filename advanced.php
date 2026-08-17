<style>
body{
    margin:0;
    padding:20px;
    background:#eef2f7;
    font-family:Arial,sans-serif;
}

.cv-advanced{
    width:794px;
    min-height:1123px;
    margin:auto;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.wrapper{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
    min-height:1123px;
}
.wrapper tr{
    height:1123px;
}

.left{
    width:32%;
    background:#1f2937;
    color:#fff;
    padding:25px;
    vertical-align:top;
    height:1123px;
}

.right{
    width:68%;
    padding:30px;
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
    border:3px solid #fff;
    object-fit:cover;
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
    margin-top:4px;
}

.title{
    font-size:14px;
    font-weight:bold;
    color:#fff;
    margin-top:25px;
    margin-bottom:10px;
    border-bottom:1px solid rgba(255,255,255,.3);
    padding-bottom:6px;
}

.left p{
    margin:8px 0;
    font-size:13px;
    line-height:20px;
}

.skill{
    background:#374151;
    color:#fff;
    padding:8px 10px;
    border-radius:5px;
    margin-bottom:8px;
    font-size:12px;
}

.rtitle{
    color:#1f2937;
    font-size:16px;
    font-weight:bold;
    border-bottom:2px solid #2563eb;
    padding-bottom:5px;
    margin-top:20px;
    margin-bottom:10px;
}

.right p{
    font-size:13px;
    line-height:22px;
    color:#444;
    margin:6px 0;
}
</style>

<div class="cv-advanced">

<table class="wrapper">

<tr>

<td class="left">

<div class="profile">

<?php if(!empty($data['profile_picture'])){ ?>
<img src="uploads/<?php echo $data['profile_picture']; ?>" alt="">
<?php } ?>

<div class="name">
<?php echo htmlspecialchars($data['full_name'] ?? ''); ?>
</div>

<div class="role">
Professional Candidate
</div>

</div>

<div class="title">CONTACT</div>

<p><strong>Email</strong><br><?php echo $data['email'] ?? ''; ?></p>

<p><strong>Phone</strong><br><?php echo $data['phone'] ?? ''; ?></p>

<p><strong>Address</strong><br><?php echo $data['address'] ?? ''; ?></p>

<div class="title">SKILLS</div>

<?php
$skills=!empty($data['skills'])?explode(",",$data['skills']):[];

foreach($skills as $s){
echo "<div class='skill'>".htmlspecialchars(trim($s))."</div>";
}
?>

</td>

<td class="right">
<!-- PERSONAL INFO -->
<div class="rtitle">PERSONAL INFORMATION</div>

<p><strong>CNIC:</strong>
<?php echo htmlspecialchars($data['cnic'] ?? 'N/A'); ?>
</p>

<p><strong>Languages:</strong>
<?php echo htmlspecialchars($data['languages'] ?? 'N/A'); ?>
</p>

<!-- EDUCATION -->
<div class="rtitle">EDUCATION</div>

<?php
if(!empty($edu['degree'])){

    for($i=0;$i<count($edu['degree']);$i++){
?>

<p>

<strong><?php echo htmlspecialchars($edu['degree'][$i]); ?></strong><br>

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
    }

}else{
?>

<p>N/A</p>

<?php } ?>


<!-- PROJECTS -->
<div class="rtitle">PROJECTS</div>

<p>
<?php
echo !empty($data['projects'])
? nl2br(htmlspecialchars($data['projects']))
: "N/A";
?>
</p>


<!-- EXPERIENCE -->
<div class="rtitle">EXPERIENCE</div>

<?php

if(!empty($exp['title'])){

for($i=0;$i<count($exp['title']);$i++){
?>

<p>

<strong><?php echo htmlspecialchars($exp['title'][$i]); ?></strong><br>

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
}

}else{
?>

<p>Fresher</p>

<?php } ?>


<!-- CERTIFICATIONS -->
<div class="rtitle">CERTIFICATIONS</div>

<?php

if(!empty($cert['name'])){

for($i=0;$i<count($cert['name']);$i++){
?>

<p>

<strong><?php echo htmlspecialchars($cert['name'][$i]); ?></strong><br>

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
}

}else{
?>

<p>N/A</p>

<?php } ?>

</td>

</tr>

</table>

</div>