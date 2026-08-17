<style>

body{
    background:#e5e7eb;
    margin:0;
    padding:20px;
    font-family:'Segoe UI',Arial,sans-serif;
}

/* MAIN CV */
.modern-cv{
    width:210mm;
    min-height:297mm;
    margin:0 auto;
    background:#fff;
    display:flex;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

/* LEFT PANEL */
.left{
    width:35%;
    background:linear-gradient(180deg,#4f46e5,#1e1b4b);
    color:#fff;
    padding:30px;
    box-sizing:border-box;
}

/* RIGHT PANEL */
.right{
    width:65%;
    padding:30px;
    box-sizing:border-box;
}

/* PROFILE */
.profile{
    text-align:center;
    margin-bottom:20px;
}

.profile-pic{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #fff;
    display:block;
    margin:0 auto 15px;
}

/* NAME */
.name{
    font-size:22px;
    font-weight:bold;
    text-align:center;
    margin-top:10px;
}

.role{
    text-align:center;
    font-size:13px;
    color:#e5e7eb;
    margin-top:6px;
}

/* CONTACT */
.contact{
    text-align:center;
    font-size:13px;
    color:#e5e7eb;
    line-height:22px;
}

/* LEFT TITLES */
.ltitle{
    margin-top:24px;
    margin-bottom:10px;
    font-size:13px;
    font-weight:bold;
    color:#c7d2fe;
    border-bottom:1px solid rgba(255,255,255,.3);
    padding-bottom:6px;
}

/* LEFT TEXT */
.left p{
    font-size:13px;
    color:#f3f4f6;
    line-height:20px;
}

/* SKILLS */
.skill{
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.18);
    border-radius:8px;
    padding:8px 10px;
    margin-bottom:8px;
    font-size:12px;
}

/* CARD */
.card{
    background:#f8fafc;
    border-left:5px solid #4f46e5;
    border-radius:10px;
    padding:18px;
    margin-bottom:18px;
}

.rtitle{
    font-size:15px;
    font-weight:bold;
    color:#111827;
    margin-bottom:10px;
}

.right p{
    font-size:13px;
    color:#374151;
    line-height:22px;
}

hr{
    border:none;
    border-top:1px solid #e5e7eb;
    margin:12px 0;
}

/* Responsive */
@media(max-width:1400px){
    .modern-cv{
        transform:scale(.82);
        transform-origin:top center;
    }
}

@media(max-width:1024px){
    .modern-cv{
        transform:scale(.72);
        transform-origin:top center;
    }
}

@media(max-width:768px){

    body{
        padding:10px;
    }

    .modern-cv{
        width:100%;
        min-height:auto;
        transform:none;
        flex-direction:column;
    }

    .left,
    .right{
        width:100%;
    }
}

@media print{

    body{
        background:#fff;
        padding:0;
    }

    .modern-cv{
        transform:none;
        width:210mm;
        min-height:297mm;
        box-shadow:none;
        border-radius:0;
    }

}

</style>

<div class="modern-cv">

<!-- LEFT -->
<div class="left">

<div class="profile">

<?php if(!empty($data['profile_picture'])){ ?>

<img class="profile-pic"
src="uploads/<?php echo htmlspecialchars($data['profile_picture']); ?>"
alt="Profile">

<?php } ?>

<div class="name">
<?php echo htmlspecialchars($data['full_name'] ?? 'Your Name'); ?>
</div>

<div class="role">
<?php echo htmlspecialchars($data['role'] ?? 'Professional Candidate'); ?>
</div>

</div>

<div class="contact">

📧 <?php echo htmlspecialchars($data['email'] ?? ''); ?><br>

📞 <?php echo htmlspecialchars($data['phone'] ?? ''); ?><br>

📍 <?php echo htmlspecialchars($data['address'] ?? ''); ?>

</div>

<div class="ltitle">ABOUT</div>

<p>
<?php echo htmlspecialchars($data['about'] ?? 'Motivated professional with strong skills.'); ?>
</p>

<div class="ltitle">SKILLS</div>

<?php

$skills = !empty($data['skills']) ? explode(",", $data['skills']) : [];

foreach($skills as $skill){

echo '<div class="skill">'.htmlspecialchars(trim($skill)).'</div>';

}

?>

</div>

<!-- RIGHT -->
<div class="right">
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

</div> <!-- right -->

</div> <!-- modern-cv -->