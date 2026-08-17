<?php
include("config/db.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$check = mysqli_query($conn,"SELECT CV_ID FROM cv WHERE User_ID='$user_id' LIMIT 1");
$cv_exists = mysqli_num_rows($check);

$username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "User";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard | CV Maker</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:#eef2f7;
display:flex;

}

/*================ SIDEBAR ================*/

.sidebar{

position:fixed;
left:0;
top:0;

width:250px;
height:100vh;

background:#0f172a;

padding:30px 20px;

overflow:auto;

}

.logo{

font-size:28px;
font-weight:700;
text-align:center;
color:white;
margin-bottom:45px;

}

.logo span{

color:#38bdf8;

}

.sidebar a{

display:flex;
align-items:center;
gap:12px;

padding:14px 18px;

margin-bottom:10px;

text-decoration:none;

color:#cbd5e1;

border-radius:12px;

transition:.35s;

font-size:15px;

}

.sidebar a i{

width:22px;

text-align:center;

}

.sidebar a:hover{

background:#2563eb;

color:white;

transform:translateX(8px);

}

.sidebar .active{

background:#2563eb;

color:white;

}

/*================ MAIN ================*/

.main{

margin-left:250px;

width:100%;

padding:35px;

}

/*================ TOPBAR ================*/

.topbar{

background:white;

padding:20px 28px;

border-radius:18px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.topbar h2{

font-size:30px;

color:#0f172a;

}

.topbar p{

margin-top:5px;

color:#64748b;

font-size:14px;

}

.user{

display:flex;

align-items:center;

gap:15px;

}

.avatar{

width:48px;

height:48px;

border-radius:50%;

background:linear-gradient(135deg,#2563eb,#38bdf8);

display:flex;

justify-content:center;

align-items:center;

font-size:20px;

font-weight:bold;

color:white;

box-shadow:0 8px 20px rgba(37,99,235,.35);

}

/*================ HERO ================*/

.hero{

margin-top:28px;

padding:35px;

border-radius:24px;

background:linear-gradient(135deg,#2563eb,#1d4ed8,#0f172a);

display:flex;

justify-content:space-between;

align-items:center;

color:white;

box-shadow:0 20px 45px rgba(37,99,235,.28);

overflow:hidden;

}

.hero h1{

font-size:34px;

margin-bottom:12px;

}

.hero p{

max-width:600px;

line-height:30px;

opacity:.95;

}

.hero-icon{

font-size:90px;

opacity:.18;

}

/*================ CARDS ================*/

.cards{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

gap:22px;

margin-top:30px;

}

.card{

background:white;

border-radius:20px;

padding:28px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

transition:.35s;

animation:fade .6s ease;

}

.card:hover{

transform:translateY(-8px);

box-shadow:0 20px 40px rgba(0,0,0,.12);

}

.card i{

font-size:42px;

margin-bottom:18px;

color:#2563eb;

}

.card h3{

margin-bottom:10px;

color:#0f172a;

}

.card p{

color:#64748b;

line-height:25px;

font-size:14px;

}

.btn{
display:inline-flex;
align-items:center;
justify-content:center;
padding:7px 14px;
font-size:12px;
font-weight:600;
border-radius:8px;
text-decoration:none;
color:white;
width:100px;
height:36px;
transition:0.3s;
}

.btn:hover{

transform:translateY(-3px);

}

.blue{background:#2563eb;}

.green{background:#16a34a;}

.orange{background:#f59e0b;}

.purple{background:#7c3aed;}

.red{background:#ef4444;}

/*================ QUICK STATS ================*/

.quick{

margin-top:40px;

}

.quick-grid{

display:grid;

grid-template-columns:repeat(4,1fr);

gap:20px;

margin-top:20px;

}

.stat{

background:white;

padding:25px;

border-radius:18px;

text-align:center;

box-shadow:0 10px 25px rgba(0,0,0,.08);

transition:.35s;

}

.stat:hover{

transform:translateY(-6px);

}

.stat i{

font-size:34px;

margin-bottom:12px;

color:#2563eb;

}

.stat h3{

margin:8px 0;

color:#0f172a;

}

.stat p{

color:#64748b;

font-size:14px;

}

/*================ FOOTER ================*/

.footer{

margin-top:40px;

background:white;

padding:18px;

border-radius:16px;

text-align:center;

color:#64748b;

box-shadow:0 10px 25px rgba(0,0,0,.06);

}

@keyframes fade{

from{

opacity:0;

transform:translateY(35px);

}

to{

opacity:1;

transform:translateY(0);

}

}

</style>

</head>

<body>
<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

<div class="logo">
CV <span>Maker</span>
</div>

<a href="dashboard.php" class="active">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="create_cv.php">
<i class="fa-solid fa-file-circle-plus"></i>
Create CV
</a>

<a href="apply_jobs.php">
<i class="fa-solid fa-briefcase"></i>
Apply Jobs
</a>

<a href="my_applications.php">
<i class="fa-solid fa-file-lines"></i>
My Applications
</a>

<a href="edit_cv.php">
<i class="fa-solid fa-pen-to-square"></i>
Edit CV
</a>

<a href="cv_status.php">
<i class="fa-solid fa-chart-line"></i>
CV Status
</a>

<?php if($cv_exists>0){ ?>

<a href="preview.php">
<i class="fa-solid fa-eye"></i>
View CV
</a>

<?php } ?>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

<!-- ================= MAIN ================= -->

<div class="main">

<!-- ================= TOP BAR ================= -->

<div class="topbar">

<div>

<h2>Dashboard</h2>

<p>
Welcome back! Manage your CV professionally.
</p>

</div>

<div class="user">

<div class="avatar">

<?php
echo strtoupper(substr($username,0,1));
?>

</div>

<div>

<h4 style="margin-bottom:3px;">

<?php echo $username; ?>

</h4>

<span style="color:#64748b;font-size:13px;">

Professional CV Builder

</span>

</div>

</div>

</div>

<!-- ================= HERO SECTION ================= -->

<div class="hero">

<div>

<h1>

👋 Welcome,
<?php echo $username; ?>

</h1>

<p>

Create, edit and manage your professional CV with ease.
Keep your resume updated and increase your chances of getting hired.

</p>

</div>

<div class="hero-icon">

<i class="fa-solid fa-file-lines"></i>

</div>

</div>

<!-- ================= DASHBOARD CARDS ================= -->

<div class="cards">
<!-- ================= CREATE CV ================= -->

<div class="card">

<i class="fa-solid fa-file-circle-plus"></i>

<h3>Create CV</h3>

<p>
Start building a professional CV with your personal,
education, skills and experience details.
</p>

<a href="create_cv.php" class="btn blue">
Create CV
</a>

</div>


<!-- ================= EDIT CV ================= -->

<div class="card">

<i class="fa-solid fa-pen-to-square"></i>

<h3>Edit CV</h3>

<p>
Update your existing CV anytime by adding
new education, skills or experience.
</p>

<a href="edit_cv.php" class="btn green">
Edit CV
</a>

</div>


<!-- ================= CV STATUS ================= -->

<div class="card">

<i class="fa-solid fa-chart-line"></i>

<h3>CV Status</h3>

<p>
Check your CV completion percentage,
missing sections and personalized suggestions.
</p>

<a href="cv_status.php" class="btn orange">
View Status
</a>

</div>
<!-- ================= APPLY JOBS ================= -->

<div class="card">

<i class="fa-solid fa-briefcase"></i>

<h3>Apply Jobs</h3>

<p>
Browse available jobs that match your CV and apply directly.
</p>

<a href="apply_jobs.php" class="btn red">
Apply Jobs
</a>

</div>

<!-- ================= VIEW CV ================= -->

<?php if($cv_exists > 0){ ?>

<div class="card">

<i class="fa-solid fa-eye"></i>

<h3>View CV</h3>

<p>
Preview your saved CV before printing
or sharing it with employers.
</p>

<a href="preview.php" class="btn purple">
View CV
</a>

</div>

<?php } ?>

</div>

<!-- ================= QUICK OVERVIEW ================= -->

<div class="quick">

<h2 style="color:#0f172a;">
Quick Overview
</h2>

<div class="quick-grid">
<!-- ================= QUICK OVERVIEW CARDS ================= -->

<div class="stat">

<i class="fa-solid fa-circle-check"></i>

<h3>

<?php echo ($cv_exists>0) ? "CV Created" : "No CV"; ?>

</h3>

<p>

Current CV Status

</p>

</div>

<div class="stat">

<i class="fa-solid fa-user-pen"></i>

<h3>

Profile Ready

</h3>

<p>

Keep your information updated.

</p>

</div>

<div class="stat">

<i class="fa-solid fa-shield-halved"></i>

<h3>

Secure

</h3>

<p>

Your CV data is securely stored.

</p>

</div>

<div class="stat">

<i class="fa-solid fa-rocket"></i>

<h3>

Career Ready

</h3>

<p>

Build a strong professional profile.

</p>

</div>

</div>

</div>

<!-- ================= FOOTER ================= -->

<div class="footer">

<p>

© <?php echo date("Y"); ?>

CV Maker System 

</p>

</div>

</div>

</body>
</html>