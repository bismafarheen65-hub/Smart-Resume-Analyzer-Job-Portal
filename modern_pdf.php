<style>

@page{
    size:A4;
    margin:0;
}

html,
body{
    margin:0;
    padding:0;
    width:210mm;
    height:297mm;
    font-family:DejaVu Sans, Arial, sans-serif;
    background:#ffffff;
}

*{
    box-sizing:border-box;
}

table.wrapper{
    width:210mm;
    border-collapse:collapse;
    table-layout:fixed;
}

td{
    padding:0;
    margin:0;
}

.left{
    width:35%;
    background:#4f46e5;
    color:#fff;
    padding:25px;
    vertical-align:top;
   
}

.right{
    width:65%;
    background:#ffffff;
    padding:25px;
    vertical-align:top;
    
}

.profile{
    text-align:center;
    margin-bottom:20px;
}

.profile-pic{
    width:110px;
    height:110px;
    border-radius:55px;
    border:4px solid #ffffff;
    display:block;
    margin:0 auto 15px auto;
}

.name{
    font-size:22px;
    font-weight:bold;
    text-align:center;
}

.role{
    text-align:center;
    font-size:13px;
    color:#eeeeee;
    margin-top:6px;
    margin-bottom:20px;
}

.contact{
    font-size:12px;
    line-height:20px;
    color:#ffffff;
}

.ltitle{
    margin-top:22px;
    margin-bottom:8px;
    font-size:13px;
    font-weight:bold;
    border-bottom:1px solid rgba(255,255,255,.35);
    padding-bottom:5px;
}

.left p{
    font-size:12px;
    line-height:19px;
    margin:0 0 10px;
    color:#ffffff;
}

.skill{
    background:#5d55ef;
    color:#ffffff;
    padding:6px 8px;
    margin-bottom:6px;
    font-size:11px;
}

.card{
    margin-bottom:18px;
}

.rtitle{
    font-size:15px;
    font-weight:bold;
    color:#4f46e5;
    border-bottom:2px solid #4f46e5;
    padding-bottom:5px;
    margin-bottom:10px;
}

.right p{
    font-size:12px;
    line-height:20px;
    color:#333333;
    margin:0 0 8px;
}

hr{
    border:none;
    border-top:1px solid #dddddd;
    margin:10px 0;
}

</style>

<table class="wrapper">
<tr{
    height:297mm;
}>

<td class="left">

<div class="profile">

<?php if(!empty($data['profile_picture'])){ ?>

<img class="profile-pic"
src="<?php echo pdfImageBase64($data['profile_picture']); ?>">

<?php } ?>

<div class="name">
<?php echo htmlspecialchars($data['full_name'] ?? 'Your Name'); ?>
</div>

<div class="role">
<?php echo htmlspecialchars($data['role'] ?? 'Professional Candidate'); ?>
</div>

</div>

<div class="contact">

<?php echo htmlspecialchars($data['email'] ?? ''); ?><br><br>

<?php echo htmlspecialchars($data['phone'] ?? ''); ?><br><br>

<?php echo htmlspecialchars($data['address'] ?? ''); ?>

</div>

<div class="ltitle">ABOUT</div>

<p>
<?php echo nl2br(htmlspecialchars($data['about'] ?? '')); ?>
</p>

<div class="ltitle">SKILLS</div>

<?php

$skills = !empty($data['skills']) ? explode(",", $data['skills']) : [];

foreach($skills as $skill){

    echo "<div class='skill'>".htmlspecialchars(trim($skill))."</div>";

}

?>

</td>

<td class="right">
<!-- EDUCATION -->
<div class="card">

    <div class="rtitle">EDUCATION</div>

    <?php
    if(!empty($edu['degree'])){

        for($i=0; $i<count($edu['degree']); $i++){
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

    <?php if($i != count($edu['degree'])-1){ ?>
        <hr>
    <?php } ?>

    <?php
        }

    }else{
        echo "<p>N/A</p>";
    }
    ?>

</div>

<!-- EXPERIENCE -->
<div class="card">

    <div class="rtitle">WORK EXPERIENCE</div>

    <?php
    if(!empty($exp['title'])){

        for($i=0; $i<count($exp['title']); $i++){
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

    <?php if($i != count($exp['title'])-1){ ?>
        <hr>
    <?php } ?>

    <?php
        }

    }else{
        echo "<p>Fresher</p>";
    }
    ?>

</div>

<!-- PROJECTS -->
<div class="card">

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

</div>

<!-- CERTIFICATIONS -->
<div class="card">

    <div class="rtitle">CERTIFICATIONS</div>

    <?php
    if(!empty($cert['name'])){

        for($i=0; $i<count($cert['name']); $i++){
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

    <?php if($i != count($cert['name'])-1){ ?>
        <hr>
    <?php } ?>

    <?php
        }

    }else{
        echo "<p>N/A</p>";
    }
    ?>

</div>

</td>

</tr>

</table>