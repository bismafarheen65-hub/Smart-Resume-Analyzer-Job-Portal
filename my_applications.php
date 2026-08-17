<?php

session_start();
include("config/db.php");


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];

$username = $_SESSION['user_name'] ?? "Student";



// FETCH APPLICATIONS

$query = mysqli_query($conn,"
SELECT
    applications.*,
    jobs.Job_Title,
    jobs.Company_Name
FROM applications
INNER JOIN jobs
ON applications.Job_ID = jobs.Job_ID
WHERE applications.User_ID='$user_id'
ORDER BY applications.Applied_Date DESC
");


?>


<!DOCTYPE html>

<html>

<head>

<title>My Applications</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


<style>


body{
font-family:Poppins,sans-serif;
background:#020617;
color:white;
padding:40px;
margin:0;
}


.container{
max-width:1000px;
margin:auto;
}


.card{

background:#0f172a;
padding:25px;
border-radius:20px;
margin-bottom:20px;
border:1px solid #1e293b;

}


h1{

color:#38bdf8;
margin-bottom:30px;

}


.title{

font-size:22px;
font-weight:600;

}


.company{

color:#94a3b8;
margin:10px 0;

}


.score{

font-size:28px;
color:#22c55e;
font-weight:bold;

}


.status{

display:inline-block;
padding:8px 15px;
border-radius:20px;
background:#1e293b;
margin-top:10px;

}


.date{

color:#94a3b8;
margin-top:15px;

}


.empty{

text-align:center;
padding:40px;

}


</style>


</head>


<body>


<div class="container">


<h1>📄 My Applications</h1>



<?php


if(mysqli_num_rows($query)>0){


while($row=mysqli_fetch_assoc($query)){



// GET AI SCORE FROM RESUME_ANALYSIS

$analysis = mysqli_query($conn,"
SELECT Match_Percentage
FROM resume_analysis
WHERE User_ID='".$row['User_ID']."'
AND Job_ID='".$row['Job_ID']."'
LIMIT 1
");


$score_data = mysqli_fetch_assoc($analysis);


$match_score = $score_data['Match_Percentage'] ?? 0;



?>



<div class="card">


<div class="title">

<?php echo htmlspecialchars($row['Job_Title']); ?>

</div>



<div class="company">

🏢 <?php echo htmlspecialchars($row['Company_Name']); ?>

</div>



<div class="score">

AI Match: <?php echo $match_score; ?>%

</div>



<div class="status">

Status:

<?php

echo !empty($row['Status'])

? htmlspecialchars($row['Status'])

: "Applied";

?>

</div>



<div class="date">

Applied Date:

<?php

if(!empty($row['Applied_Date'])){

echo date("d M Y",strtotime($row['Applied_Date']));

}

else{

echo "N/A";

}

?>

</div>


</div>



<?php


}


}

else{


?>


<div class="card empty">

<h2>No Applications Found</h2>

<p>You have not applied for any job yet.</p>

</div>


<?php


}


?>


</div>


</body>

</html>