<?php

session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="Employer"){

    header("Location: elogin.php");
    exit();

}

$employer_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

/* ================= TOTAL JOBS ================= */

$count = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM jobs
WHERE Employer_ID='$employer_id'
");

$countData = mysqli_fetch_assoc($count);

$total_jobs = $countData['total'];
/* ================= TOTAL APPLICATIONS ================= */

$app_query = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM applications a
INNER JOIN jobs j
ON a.Job_ID = j.Job_ID
WHERE j.Employer_ID='$employer_id'
");

$app_data = mysqli_fetch_assoc($app_query);

$total_applications = $app_data['total'];



/* ================= TOTAL CANDIDATES ================= */

$candidate_query = mysqli_query($conn,"
SELECT COUNT(DISTINCT a.user_id) AS total
FROM applications a
INNER JOIN jobs j
ON a.Job_ID = j.Job_ID
WHERE j.Employer_ID='$employer_id'
");

$candidate_data = mysqli_fetch_assoc($candidate_query);

$total_candidates = $candidate_data['total'];



/* ================= BEST MATCH ================= */

$match_query = mysqli_query($conn,"
SELECT MAX(r.Match_Percentage) AS best
FROM resume_analysis r
INNER JOIN applications a
ON r.User_ID = a.User_ID
INNER JOIN jobs j
ON a.Job_ID = j.Job_ID
WHERE j.Employer_ID='$employer_id'
");

$match_data = mysqli_fetch_assoc($match_query);

$best_match = $match_data['best'] ?? 0;

/* ================= RECENT JOBS ================= */

$recent_jobs = mysqli_query($conn,"
SELECT *
FROM jobs
WHERE Employer_ID='$employer_id'
ORDER BY Posted_Date DESC
LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Employer Dashboard | CareerConnect</title>

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:#f8fafc;

}

/* ================= SIDEBAR ================= */

.sidebar{

position:fixed;
left:0;
top:0;

width:260px;
height:100vh;

background:#0f172a;

padding:25px;

color:white;

}

.logo{

font-size:24px;
font-weight:700;

margin-bottom:35px;

}

.logo span{

color:#22c55e;

}

.logo i{

color:#22c55e;
margin-right:8px;

}

.menu a{

display:block;

padding:14px 16px;

margin-bottom:12px;

text-decoration:none;

color:#cbd5e1;

border-radius:12px;

transition:.3s;

}

.menu a:hover,
.menu a.active{

background:#22c55e;
color:white;

}

.menu i{

width:24px;

}

/* ================= MAIN ================= */

.main{

margin-left:260px;
padding:35px;

}

/* ================= TOP ================= */

.top{

display:flex;
justify-content:space-between;
align-items:center;

}

.top h1{

font-size:30px;
color:#1e293b;

}

.profile{

background:white;

padding:12px 20px;

border-radius:12px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

font-weight:600;

}

.post-btn{

display:inline-block;

margin-top:25px;

background:#22c55e;

color:white;

padding:14px 28px;

border-radius:12px;

text-decoration:none;

font-weight:600;

transition:.3s;

}

.post-btn:hover{

background:#16a34a;

}
/* ================= CARDS ================= */

.cards{
    display:grid;
    grid-template-columns:repeat(4,minmax(180px,1fr));
    gap:20px;
    margin:35px 0;
}

.card{
    background:#fff;
    border-radius:18px;
    padding:20px;
    min-height:170px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    transition:all .3s ease;
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 28px rgba(0,0,0,.12);
}

.card i{
    font-size:34px;
    color:#22c55e;
    margin-bottom:15px;
}

.card h2{
    font-size:34px;
    font-weight:700;
    color:#1e293b;
    margin:0;
}

.card p{
    margin-top:10px;
    color:#64748b;
    font-size:15px;
    font-weight:500;
}

/* ================= TABLE ================= */

.section{

margin-top:35px;
background:white;
padding:25px;
border-radius:18px;
box-shadow:0 8px 20px rgba(0,0,0,.06);

}

.section h2{

margin-bottom:20px;
color:#1e293b;

}

table{

width:100%;
border-collapse:collapse;

}

th,td{

padding:15px;
text-align:left;
border-bottom:1px solid #eee;

}

th{

color:#64748b;
background:#f8fafc;

}

.badge{

background:#dcfce7;
color:#166534;
padding:6px 15px;
border-radius:20px;
font-size:13px;

}

@media(max-width:1000px){

.cards{

grid-template-columns:repeat(2,1fr);

}

}

@media(max-width:700px){

.cards{

grid-template-columns:1fr;

}

.sidebar{

position:relative;
width:100%;
height:auto;

}

.main{

margin-left:0;

}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">

<i class="fa-solid fa-briefcase"></i>

Career<span>Connect</span>

</div>

<div class="menu">

<a href="edashboard.php" class="active">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="post_job.php">
<i class="fa-solid fa-plus"></i>
Post Job
</a>

<a href="my_jobs.php">
<i class="fa-solid fa-briefcase"></i>
My Jobs
</a>

<a href="applicants.php">
<i class="fa-solid fa-users"></i>
Applicants
</a>

<a href="profile.php">
<i class="fa-solid fa-building"></i>
Company Profile
</a>

<a href="../logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

</div>

<!-- MAIN -->
<div class="main">

<div class="top">

<div>

<h1>
Welcome, <?php echo htmlspecialchars($name); ?> 👋
</h1>

</div>

<div class="profile">
Employer Panel
</div>

</div>

<a href="post_job.php" class="post-btn">
<i class="fa-solid fa-plus"></i>
Post New Job
</a>

<div class="cards">


<div class="card">

<i class="fa-solid fa-briefcase"></i>

<h2><?php echo $total_jobs; ?></h2>

<p>Jobs Posted</p>

</div>


<div class="card">

<i class="fa-solid fa-file-lines"></i>

<h2><?php echo $total_applications; ?></h2>

<p>Applications</p>

</div>


<div class="card">

<i class="fa-solid fa-users"></i>

<h2><?php echo $total_candidates; ?></h2>

<p>Candidates</p>

</div>


<div class="card">

<i class="fa-solid fa-star"></i>

<h2><?php echo $best_match; ?>%</h2>

<p>Best Match</p>

</div>


</div>
<!-- ================= RECENT JOBS ================= -->

<div class="section">

<h2>

Recent Jobs

</h2>

<table>

<thead>

<tr>

<th>Job Title</th>
<th>Location</th>
<th>Job Type</th>
<th>Posted Date</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($recent_jobs)>0){

while($job=mysqli_fetch_assoc($recent_jobs)){

?>

<tr>

<td>

<?php echo htmlspecialchars($job['Job_Title']); ?>

</td>

<td>

<?php echo htmlspecialchars($job['Location']); ?>

</td>

<td>

<?php echo htmlspecialchars($job['Job_Type']); ?>

</td>

<td>

<?php echo date("d M Y",strtotime($job['Posted_Date'])); ?>

</td>

<td>

<span class="badge">

Active

</span>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="5" style="text-align:center;padding:30px;">

No Jobs Posted Yet

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>   <!-- section -->

</div>   <!-- main -->

</body>
</html>