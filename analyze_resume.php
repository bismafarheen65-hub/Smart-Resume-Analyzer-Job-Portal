<?php

session_start();

include("config/db.php");
include("ai_match.php");


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];

$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;

if($job_id <= 0){
    die("Invalid Job ID");
}



// ================= FETCH JOB =================


$job_query = mysqli_query($conn,"
SELECT *
FROM jobs
WHERE Job_ID='$job_id'
");


$job = mysqli_fetch_assoc($job_query);



if(!$job){

    die("Job not found");

}



// ================= FETCH CV =================


$cv_query = mysqli_query($conn,"
SELECT *
FROM cv
WHERE user_id='$user_id'
LIMIT 1
");


$cv = mysqli_fetch_assoc($cv_query);


?>


<!DOCTYPE html>

<html>


<head>


<title>AI Resume Analysis</title>



<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">



<style>


*{

box-sizing:border-box;

font-family:Poppins,sans-serif;

}



body{

margin:0;

padding:30px;

background:#020617;

color:white;

}



.container{

max-width:1300px;

margin:auto;

}



.title{

font-size:35px;

font-weight:700;

color:#38bdf8;

margin-bottom:30px;

}



.layout{

display:grid;

grid-template-columns:1fr 1fr;

gap:25px;

}



.card{

background:#0f172a;

padding:25px;

border-radius:20px;

border:1px solid #1e293b;

box-shadow:0 15px 40px rgba(0,0,0,.4);

margin-bottom:25px;

}



.card h2{

color:#38bdf8;

border-bottom:1px solid #334155;

padding-bottom:10px;

}



.info{

line-height:35px;

color:#cbd5e1;

}



.skill{

display:inline-block;

padding:8px 15px;

border-radius:30px;

margin:5px;

font-size:14px;

}



.match{

background:#14532d;

color:#86efac;

}



.missing{

background:#7f1d1d;

color:#fecaca;

}



.score-box{

text-align:center;

}

.score{

height:160px;

width:160px;

border-radius:50%;

margin:auto;

display:flex;

align-items:center;

justify-content:center;

font-size:40px;

font-weight:700;

background:

linear-gradient(135deg,#2563eb,#9333ea);

box-shadow:0 0 40px #2563eb;

}



.score-text{

margin-top:15px;

color:#94a3b8;

}



.suggestion{

background:#1e293b;

padding:12px;

border-radius:12px;

margin:10px 0;

color:#cbd5e1;

}



.apply-btn{

display:block;

text-align:center;

background:#2563eb;

padding:15px;

border-radius:15px;

color:white;

text-decoration:none;

font-weight:600;

margin-top:20px;

}



.apply-btn:hover{

background:#1d4ed8;

}



@media(max-width:900px){


.layout{

grid-template-columns:1fr;

}


}



</style>


</head>


<body>


<div class="container">



<div class="title">

🤖 AI Resume Analysis

</div>



<?php if($cv){ ?>

<?php

// ================= AI DATABASE CHECK =================
$check = mysqli_query($conn,"
SELECT *
FROM resume_analysis
WHERE User_ID='$user_id'
AND Job_ID='$job_id'
LIMIT 1
");

$old = mysqli_fetch_assoc($check);

if($old){

    $score = $old['Match_Percentage'];
    $matched = explode(",", $old['Matched_Skills']);
    $missing = explode(",", $old['Missing_Skills']);
    $suggestions = explode("|", $old['Suggestions']);

}
else{

    $ai_result = analyzeResumeAI(
        $cv['skills'],
        $job['Required_Skills']
    );

    $score = $ai_result['match_percentage'] ?? 0;
    $matched = $ai_result['matched_skills'] ?? [];
    $missing = $ai_result['missing_skills'] ?? [];
    $suggestions = $ai_result['suggestions'] ?? [];

    $matched_string = implode(",", $matched);
    $missing_string = implode(",", $missing);
    $suggestion_string = implode("|", $suggestions);

    $insert = mysqli_query($conn,"
    INSERT INTO resume_analysis
    (
        User_ID,
        Job_ID,
        Match_Percentage,
        Matched_Skills,
        Missing_Skills,
        Suggestions
    )
    VALUES
    (
        '$user_id',
        '$job_id',
        '$score',
        '".mysqli_real_escape_string($conn,$matched_string)."',
        '".mysqli_real_escape_string($conn,$missing_string)."',
        '".mysqli_real_escape_string($conn,$suggestion_string)."'
    )
    ");

    if(!$insert){
        die(mysqli_error($conn));
    }
}
    









$job_skill_array = explode(",", $job['Required_Skills']);



?>





<div class="layout">



<!-- LEFT SIDE -->


<div>



<div class="card">


<h2>

💼 Job Information

</h2>



<div class="info">



<b>Job Title:</b>

<?php echo htmlspecialchars($job['Job_Title']); ?>


<br>



<b>Company:</b>

<?php echo htmlspecialchars($job['Company_Name']); ?>



<br><br>



<b>Required Skills:</b>



<br>



<?php


foreach($job_skill_array as $s){


$s = trim($s);


if($s!=""){


echo "

<span class='skill'>

$s

</span>

";


}


}


?>



</div>


</div>





<div class="card">


<h2>

📄 Your Resume

</h2>




<div class="info">



<b>Name:</b>

<?php echo htmlspecialchars($cv['full_name']); ?>



<br><br>




<b>Your Skills:</b>



<br>



<?php


$resume_skill_list = explode(",",$cv['skills']);



foreach($resume_skill_list as $s){


$s = trim($s);



if($s!=""){


echo "

<span class='skill'>

$s

</span>

";


}


}


?>




</div>



</div>



</div>
<!-- RIGHT SIDE -->


<div>



<div class="card score-box">



<h2>

📊 AI Matching Result

</h2>




<div class="score">


<?php echo $score; ?>%


</div>




<div class="score-text">


Resume Match Score


</div>



</div>






<div class="card">



<h2>

✅ Matched Skills

</h2>




<?php



if(count($matched)>0){



foreach($matched as $m){



if(trim($m)!=""){



echo "

<span class='skill match'>

".htmlspecialchars($m)."

</span>

";



}


}



}

else{


echo "No matching skills found.";


}



?>



</div>








<div class="card">



<h2>

❌ Missing Skills

</h2>




<?php



if(count($missing)>0){



foreach($missing as $m){



if(trim($m)!=""){



echo "

<span class='skill missing'>

".htmlspecialchars($m)."

</span>

";



}


}



}

else{


echo "No missing skills 🎉";


}



?>



</div>








<div class="card">


<h2>

💡 AI Career Suggestions

</h2>




<?php



if(count($suggestions)>0){



foreach($suggestions as $s){



if(trim($s)!=""){



echo "

<div class='suggestion'>

💡 ".htmlspecialchars($s)."

</div>

";


}


}



}



?>



</div>








<?php

if($score >= 60){

?>



<a class="apply-btn"

href="apply_job.php?job_id=<?php echo $job_id; ?>">


🚀 Apply Now


</a>



<?php

}

else{

?>



<div class="card" style="
background:#7f1d1d;
color:#fecaca;
text-align:center;
margin-top:20px;
">


<h2>

❌ Not Applicable for this Job

</h2>



<p>

Your resume match score is 

<b><?php echo $score; ?>%</b>

</p>



<p>

Minimum required score is 60%.

</p>



</div>



<?php

}


?>

<?php } else { ?>

<div class="card">
    <h2>❌ CV Not Found</h2>
    <p>Please create your CV first.</p>
</div>

<?php } ?>

</div>

</body>
</html>