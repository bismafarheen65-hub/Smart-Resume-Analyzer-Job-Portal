<?php

session_start();

include("config/db.php");


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];

$job_id = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;


if($job_id <= 0){

    die("Invalid Job ID");

}



// Check already applied

$check = mysqli_query($conn,"
SELECT *
FROM applications
WHERE User_ID='$user_id'
AND Job_ID='$job_id'
LIMIT 1
");


if(mysqli_num_rows($check)>0){

    echo "<script>
    alert('You have already applied for this job.');
    window.location='my_applications.php';
    </script>";

    exit();

}




// Get AI Analysis Result

$result = mysqli_query($conn,"
SELECT *
FROM resume_analysis
WHERE User_ID='$user_id'
AND Job_ID='$job_id'
LIMIT 1
");



$data = mysqli_fetch_assoc($result);



if(!$data){

    echo "<script>
    alert('Please analyze your resume first.');
    window.history.back();
    </script>";

    exit();

}



// 60% Eligibility Check

if($data['Match_Percentage'] < 60){


    echo "<script>
    alert('Your match score is below 60%. You cannot apply.');
    window.history.back();
    </script>";


    exit();

}




// Insert Application

$insert = mysqli_query($conn,"
INSERT INTO applications
(
User_ID,
Job_ID,
Status
)

VALUES
(
'$user_id',
'$job_id',
'Applied'
)

");



if(!$insert){

    die(mysqli_error($conn));

}




echo "<script>

alert('Application Submitted Successfully!');

window.location='my_applications.php';

</script>";


?>