<style>
body{
    margin:0;
    padding:20px;
    background:#f3f4f6;
    font-family:Arial, sans-serif;
}

.simple-cv{
    width:794px;
    min-height:1123px;
    margin:0 auto;
    background:#fff;
    padding:35px;
    box-sizing:border-box;
    border-radius:10px;
    box-shadow:0 10px 20px rgba(0,0,0,.12);
}

/* HEADER */
.header{
    text-align:center;
    border-bottom:2px solid #2563eb;
    padding-bottom:20px;
    margin-bottom:25px;
}

.profile-pic{
    width:85px;
    height:85px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #2563eb;
    display:block;
    margin:0 auto 12px;
}

.header h1{
    margin:0;
    font-size:28px;
    color:#1f2937;
}

/* SECTION */
.section{
    margin-top:22px;
}

.title{
    font-size:16px;
    font-weight:bold;
    color:#2563eb;
    border-bottom:2px solid #dbeafe;
    padding-bottom:6px;
    margin-bottom:12px;
    text-transform:uppercase;
}

.section p{
    margin:7px 0;
    font-size:14px;
    color:#444;
    line-height:22px;
}

@media print{

body{
    background:#fff;
    padding:0;
}

.simple-cv{
    width:210mm;
    min-height:297mm;
    margin:0;
    border-radius:0;
    box-shadow:none;
}

}
</style>

<div class="simple-cv">

    <!-- HEADER -->
    <div class="header">

        <?php if(!empty($data['profile_picture'])){ ?>

            <img class="profile-pic"
                 src="uploads/<?php echo htmlspecialchars($data['profile_picture']); ?>"
                 alt="Profile">

        <?php } ?>

        <h1>
            <?php echo htmlspecialchars($data['full_name'] ?? 'Your Name'); ?>
        </h1>

    </div>

    <!-- PERSONAL INFORMATION -->
    <div class="section">

        <div class="title">Personal Information</div>

        <p><strong>Email:</strong>
            <?php echo htmlspecialchars($data['email'] ?? 'N/A'); ?>
        </p>

        <p><strong>Phone:</strong>
            <?php echo htmlspecialchars($data['phone'] ?? 'N/A'); ?>
        </p>

        <p><strong>Address:</strong>
            <?php echo htmlspecialchars($data['address'] ?? 'N/A'); ?>
        </p>

        <p><strong>CNIC:</strong>
            <?php echo htmlspecialchars($data['cnic'] ?? 'N/A'); ?>
        </p>

        <p><strong>Languages:</strong>
            <?php echo htmlspecialchars($data['languages'] ?? 'N/A'); ?>
        </p>

    </div>
        <!-- EDUCATION -->
    <div class="section">

        <div class="title">Education</div>

        <p>
            <?php
            if(!empty($edu['degree'])){
                echo implode("<br>", array_map('htmlspecialchars', $edu['degree']));
            }else{
                echo "N/A";
            }
            ?>
        </p>

    </div>

    <!-- SKILLS -->
    <div class="section">

        <div class="title">Skills</div>

        <p>
            <?php
            echo !empty($data['skills'])
                ? nl2br(htmlspecialchars($data['skills']))
                : "N/A";
            ?>
        </p>

    </div>

    <!-- PROJECTS -->
    <div class="section">

        <div class="title">Projects</div>

        <p>
            <?php
            echo !empty($data['projects'])
                ? nl2br(htmlspecialchars($data['projects']))
                : "N/A";
            ?>
        </p>

    </div>

    <!-- EXPERIENCE -->
    <div class="section">

        <div class="title">Experience</div>

        <p>
            <?php
            if(!empty($exp['title'])){

                foreach($exp['title'] as $i => $title){

                    echo "<strong>".htmlspecialchars($title)."</strong>";

                    if(!empty($exp['company'][$i])){
                        echo " - ".htmlspecialchars($exp['company'][$i]);
                    }

                    if(!empty($exp['date'][$i])){
                        echo " (".htmlspecialchars($exp['date'][$i]).")";
                    }

                    echo "<br>";
                }

            }else{

                echo "Fresher";

            }
            ?>
        </p>

    </div>

    <!-- CERTIFICATIONS -->
    <div class="section">

        <div class="title">Certifications</div>

        <p>
            <?php
            if(!empty($cert['name'])){

                foreach($cert['name'] as $i => $name){

                    echo htmlspecialchars($name);

                    if(!empty($cert['org'][$i])){
                        echo " - ".htmlspecialchars($cert['org'][$i]);
                    }

                    if(!empty($cert['date'][$i])){
                        echo " (".htmlspecialchars($cert['date'][$i]).")";
                    }

                    echo "<br>";
                }

            }else{

                echo "N/A";

            }
            ?>
        </p>

    </div>

</div>