<style>
body{
    font-family: Arial, sans-serif;
    margin:0;
    padding:30px;
    color:#333;
    font-size:13px;
}

.simple-cv{
    width:100%;
}

.header{
    text-align:center;
    border-bottom:2px solid #2563eb;
    padding-bottom:15px;
    margin-bottom:20px;
}

.profile-pic{
    width:90px;
    height:90px;
    border-radius:50%;
    border:3px solid #2563eb;
    display:block;
    margin:0 auto 10px;
}

.header h1{
    margin:5px 0;
    color:#1f2937;
    font-size:28px;
}

.section{
    margin-top:18px;
}

.title{
    font-size:16px;
    color:#2563eb;
    font-weight:bold;
    border-bottom:1px solid #ddd;
    padding-bottom:5px;
    margin-bottom:10px;
}

.section p{
    margin:6px 0;
    line-height:20px;
}
</style>

<div class="simple-cv">

<div class="header">

<?php
$image = pdfImageBase64($data['profile_picture'] ?? '');

if($image){
?>
<img class="profile-pic" src="<?php echo $image; ?>">
<?php } ?>

<h1><?php echo htmlspecialchars($data['full_name']); ?></h1>

</div>

<div class="section">
<div class="title">Personal Information</div>

<p><b>Email:</b> <?php echo htmlspecialchars($data['email']); ?></p>

<p><b>Phone:</b> <?php echo htmlspecialchars($data['phone']); ?></p>

<p><b>Address:</b> <?php echo htmlspecialchars($data['address']); ?></p>

<p><b>CNIC:</b> <?php echo htmlspecialchars($data['cnic']); ?></p>

<p><b>Languages:</b> <?php echo htmlspecialchars($data['languages']); ?></p>

</div>

<div class="section">

<div class="title">Education</div>

<?php
if(!empty($edu['degree'])){
    foreach($edu['degree'] as $i=>$degree){
        echo "<p><b>".$degree."</b>";

        if(!empty($edu['institute'][$i]))
            echo " - ".$edu['institute'][$i];

        if(!empty($edu['year'][$i]))
            echo " (".$edu['year'][$i].")";

        echo "</p>";
    }
}else{
    echo "<p>N/A</p>";
}
?>

</div>

<div class="section">

<div class="title">Skills</div>

<p><?php echo nl2br(htmlspecialchars($data['skills'])); ?></p>

</div>

<div class="section">

<div class="title">Projects</div>

<p><?php echo nl2br(htmlspecialchars($data['projects'])); ?></p>

</div>

<div class="section">

<div class="title">Experience</div>

<?php

if(!empty($exp['title'])){

foreach($exp['title'] as $i=>$title){

echo "<p><b>".$title."</b>";

if(!empty($exp['company'][$i]))
echo " - ".$exp['company'][$i];

if(!empty($exp['date'][$i]))
echo " (".$exp['date'][$i].")";

echo "</p>";

}

}else{

echo "<p>Fresher</p>";

}

?>

</div>

<div class="section">

<div class="title">Certifications</div>

<?php

if(!empty($cert['name'])){

foreach($cert['name'] as $i=>$name){

echo "<p>".$name;

if(!empty($cert['org'][$i]))
echo " - ".$cert['org'][$i];

if(!empty($cert['date'][$i]))
echo " (".$cert['date'][$i].")";

echo "</p>";

}

}else{

echo "<p>N/A</p>";

}

?>

</div>

</div>