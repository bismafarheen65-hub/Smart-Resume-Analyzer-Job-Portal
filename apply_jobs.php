<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_name'] ?? "Student";

/* Check CV */
$check = mysqli_query($conn,"
SELECT CV_ID
FROM cv
WHERE User_ID='$user_id'
LIMIT 1
");

$cv_exists = mysqli_num_rows($check);

/* Fetch Jobs */
$jobs = mysqli_query($conn,"
SELECT *
FROM jobs
ORDER BY Posted_Date DESC
");

/* Dashboard Stats */
$total_jobs = mysqli_num_rows($jobs);

$remote = mysqli_query($conn,"
SELECT *
FROM jobs
WHERE Job_Type='Remote'
");

$remote_jobs = mysqli_num_rows($remote);

$companies = mysqli_query($conn,"
SELECT DISTINCT Company_Name
FROM jobs
");

$total_companies = mysqli_num_rows($companies);

/* Reset pointer */
mysqli_data_seek($jobs,0);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CareerConnect | Apply Jobs</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

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

html{
scroll-behavior:smooth;
}

body{
display:flex;
background:#eef4ff;
}

/* ================= Sidebar ================= */

.sidebar{

position:fixed;
left:0;
top:0;

width:260px;
height:100vh;

background:linear-gradient(180deg,#081028,#10214d,#1e3a8a);

padding:30px 20px;

overflow:auto;

box-shadow:8px 0 25px rgba(0,0,0,.25);

}

.logo{

text-align:center;

font-size:30px;

font-weight:700;

color:#fff;

margin-bottom:45px;

}

.logo span{

color:#38bdf8;

}

.sidebar a{

display:flex;

align-items:center;

gap:14px;

padding:15px 18px;

margin-bottom:12px;

color:#dbeafe;

text-decoration:none;

border-radius:14px;

transition:.35s;

font-size:15px;

font-weight:500;

}

.sidebar a:hover{

background:#2563eb;

color:#fff;

transform:translateX(8px);

}

.sidebar .active{

background:linear-gradient(135deg,#2563eb,#4f46e5);

color:#fff;

}

/* ================= Main ================= */

.main{

margin-left:260px;

width:100%;

padding:35px;

}

/* ================= Topbar ================= */

.topbar{

background:#fff;

border-radius:22px;

padding:25px 30px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:0 12px 30px rgba(0,0,0,.08);

}

.topbar h2{

font-size:30px;

color:#0f172a;

}

.topbar p{

color:#64748b;

margin-top:6px;

}

.user{

display:flex;

align-items:center;

gap:15px;

}

.avatar{

width:55px;

height:55px;

border-radius:50%;

background:linear-gradient(135deg,#2563eb,#06b6d4);

display:flex;

align-items:center;

justify-content:center;

font-size:22px;

font-weight:700;

color:#fff;

}

/* ================= Hero ================= */

.hero{

margin:30px 0;

padding:45px;

border-radius:25px;

background:linear-gradient(135deg,#2563eb,#7c3aed);

display:flex;

justify-content:space-between;

align-items:center;

color:#fff;

box-shadow:0 18px 40px rgba(37,99,235,.30);

}

.hero h1{

font-size:40px;

margin-bottom:12px;

}

.hero p{

font-size:17px;

opacity:.95;

}

.hero i{

font-size:95px;

opacity:.25;

}

/* ================= Stats ================= */

.stats{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:25px;

margin-bottom:30px;

}

.stat-card{

background:#fff;

border-radius:22px;

padding:30px;

text-align:center;

box-shadow:0 12px 25px rgba(0,0,0,.08);

transition:.35s;

}

.stat-card:hover{

transform:translateY(-8px);

}

.stat-card i{

font-size:34px;

margin-bottom:15px;

background:linear-gradient(135deg,#2563eb,#7c3aed);

-webkit-background-clip:text;

-webkit-text-fill-color:transparent;

}

.stat-card h2{

font-size:34px;

color:#0f172a;

}

.stat-card p{

color:#64748b;

margin-top:8px;

}
/* ================= SEARCH ================= */

.search-box{
position:relative;
margin:35px 0;
}

.search-box i{
position:absolute;
left:20px;
top:18px;
color:#64748b;
font-size:17px;
}

.search-box input{

width:100%;

padding:17px 20px 17px 55px;

border:none;

outline:none;

background:#fff;

border-radius:18px;

font-size:15px;

box-shadow:0 12px 25px rgba(0,0,0,.08);

transition:.35s;

}

.search-box input:focus{

box-shadow:0 0 0 5px rgba(37,99,235,.15);

}

/* ================= JOB GRID ================= */

.job-grid{

display:grid;

grid-template-columns:repeat(auto-fill,minmax(390px,1fr));

gap:28px;

}

/* ================= JOB CARD ================= */

.job-card{

background:#fff;

border-radius:22px;

padding:28px;

position:relative;

overflow:hidden;

box-shadow:0 12px 30px rgba(0,0,0,.08);

transition:.35s;

}

.job-card::before{

content:"";

position:absolute;

left:0;
top:0;

width:100%;
height:5px;

background:linear-gradient(90deg,#2563eb,#06b6d4,#7c3aed);

}

.job-card:hover{

transform:translateY(-10px);

box-shadow:0 22px 40px rgba(37,99,235,.18);

}

/* ================= HEADER ================= */

.job-header{

display:flex;

gap:18px;

align-items:center;

margin-bottom:20px;

}

.company-logo{

width:65px;
height:65px;

border-radius:18px;

background:linear-gradient(135deg,#2563eb,#7c3aed);

display:flex;

align-items:center;
justify-content:center;

color:white;

font-size:28px;

flex-shrink:0;

}

.job-title-box{

flex:1;

}

.job-title-box h3{

font-size:22px;

color:#0f172a;

margin-bottom:5px;

}

.company-name{

color:#2563eb;

font-weight:600;

font-size:15px;

}

/* ================= JOB INFO ================= */

.job-info{

display:grid;

grid-template-columns:repeat(2,1fr);

gap:12px;

margin:20px 0;

}

.info-item{

background:#f8fafc;

padding:12px;

border-radius:12px;

display:flex;

align-items:center;

gap:10px;

font-size:14px;

color:#475569;

}

.info-item i{

color:#2563eb;

}

/* ================= DESCRIPTION ================= */

.description{

margin:20px 0;

line-height:28px;

font-size:14px;

color:#64748b;

}

/* ================= SKILLS ================= */

.skills{

margin-top:18px;

}

.skill{

display:inline-block;

padding:8px 14px;

margin:5px;

background:#eff6ff;

border:1px solid #bfdbfe;

color:#1d4ed8;

border-radius:30px;

font-size:12px;

font-weight:600;

transition:.3s;

}

.skill:hover{

background:#2563eb;

color:white;

}

/* ================= AI TAG ================= */

.ai-badge{

display:inline-flex;

align-items:center;

gap:8px;

padding:8px 14px;

margin-bottom:15px;

background:#eef2ff;

color:#4f46e5;

border-radius:30px;

font-size:12px;

font-weight:600;

}

.ai-badge i{

font-size:12px;

}

/* ================= FOOTER ================= */

.card-footer{

margin-top:25px;

display:flex;

justify-content:space-between;

align-items:center;

}

.posted{

font-size:13px;

color:#64748b;

display:flex;

align-items:center;

gap:8px;

}

.posted i{

color:#2563eb;

}

/* ================= APPLY BUTTON ================= */

.apply-btn{

display:flex;

justify-content:center;

align-items:center;

gap:10px;

padding:14px;

text-decoration:none;

background:linear-gradient(135deg,#2563eb,#4f46e5);

color:white;

font-weight:600;

border-radius:14px;

transition:.35s;

box-shadow:0 12px 25px rgba(37,99,235,.25);

}

.apply-btn:hover{

transform:translateY(-4px);

box-shadow:0 18px 35px rgba(37,99,235,.35);

}

/* ================= EMPTY ================= */

.empty-state{

grid-column:1/-1;

background:white;

padding:70px;

border-radius:25px;

text-align:center;

box-shadow:0 12px 25px rgba(0,0,0,.08);

}

.empty-state i{

font-size:70px;

color:#2563eb;

margin-bottom:20px;

}

.empty-state h2{

color:#0f172a;

margin-bottom:10px;

}

.empty-state p{

color:#64748b;

}

/* ================= RESPONSIVE ================= */

@media(max-width:900px){

.job-grid{
grid-template-columns:1fr;
}

.hero{
flex-direction:column;
text-align:center;
gap:25px;
}

.stats{
grid-template-columns:1fr;
}

.card-footer{
flex-direction:column;
gap:15px;
align-items:flex-start;
}

.job-info{
grid-template-columns:1fr;
}

}
</style>
</head>

<body>
<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div class="logo">
        Career<span>Connect</span>
    </div>

    <a href="dashboard.php">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>

    <a href="create_cv.php">
        <i class="fa-solid fa-file-circle-plus"></i>
        Create CV
    </a>

    <a href="edit_cv.php">
        <i class="fa-solid fa-pen-to-square"></i>
        Edit CV
    </a>

    <a href="cv_status.php">
        <i class="fa-solid fa-chart-line"></i>
        CV Status
    </a>

    <a href="apply_jobs.php" class="active">
        <i class="fa-solid fa-briefcase"></i>
        Apply Jobs
    </a>

    <?php if($cv_exists > 0){ ?>

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

<!-- ================= TOPBAR ================= -->

<div class="topbar">

    <div>

        <h2>💼 Apply Jobs</h2>

        <p>
            AI Powered Career Recommendation System
        </p>

    </div>

    <div class="user">

        <div class="avatar">
            <?php echo strtoupper(substr($username,0,1)); ?>
        </div>

        <div>

            <h4>
                <?php echo htmlspecialchars($username); ?>
            </h4>

            <p style="font-size:13px;color:#64748b;">
                CareerConnect Candidate
            </p>

        </div>

    </div>

</div>

<!-- ================= HERO ================= -->

<div class="hero">

    <div>

        <h1>
            Find Your Dream Job 🚀
        </h1>

        <p>

            Analyze your resume using AI and discover
            jobs that perfectly match your skills.

        </p>

    </div>

    <div>

        <i class="fa-solid fa-briefcase"></i>

    </div>

</div>

<!-- ================= STATS ================= -->

<div class="stats">

    <div class="stat-card">

        <i class="fa-solid fa-briefcase"></i>

        <h2>

            <?php echo $total_jobs; ?>

        </h2>

        <p>Total Jobs</p>

    </div>

    <div class="stat-card">

        <i class="fa-solid fa-laptop-house"></i>

        <h2>

            <?php echo $remote_jobs; ?>

        </h2>

        <p>Remote Jobs</p>

    </div>

    <div class="stat-card">

        <i class="fa-solid fa-building"></i>

        <h2>

            <?php echo $total_companies; ?>

        </h2>

        <p>Companies</p>

    </div>

</div>

<!-- ================= SEARCH ================= -->

<div class="search-box">

    <i class="fa-solid fa-magnifying-glass"></i>

    <input

    type="text"

    id="searchJob"

    placeholder="Search by Job Title, Company, Skills or Location...">

</div>

<!-- ================= JOB GRID START ================= -->

<div class="job-grid">
<?php

if(mysqli_num_rows($jobs)>0){

while($row=mysqli_fetch_assoc($jobs)){

$skills = explode(",", $row['Required_Skills']);

?>

<div class="job-card">

    <div class="job-header">

        <div class="company-logo">
            <i class="fa-solid fa-building"></i>
        </div>

        <div class="job-title-box">

            <h3>
                <?php echo htmlspecialchars($row['Job_Title']); ?>
            </h3>

            <div class="company-name">
                <?php echo htmlspecialchars($row['Company_Name']); ?>
            </div>

        </div>

    </div>

    <div class="job-info">

        <div class="info-item">
            <i class="fa-solid fa-location-dot"></i>
            <?php echo htmlspecialchars($row['Location']); ?>
        </div>

        <div class="info-item">
            <i class="fa-solid fa-briefcase"></i>
            <?php echo htmlspecialchars($row['Job_Type']); ?>
        </div>

        <div class="info-item">
            <i class="fa-solid fa-money-bill-wave"></i>
            Rs. <?php echo htmlspecialchars($row['Salary']); ?>
        </div>

        <div class="info-item">
            <i class="fa-solid fa-user-clock"></i>
            <?php echo htmlspecialchars($row['Experience']); ?>
        </div>

    </div>

    <div class="ai-badge">

        <i class="fa-solid fa-wand-magic-sparkles"></i>

        AI Resume Match Available

    </div>

    <div class="description">

        <?php

        echo nl2br(htmlspecialchars(substr($row['Description'],0,180)));

        if(strlen($row['Description'])>180){
            echo "...";
        }

        ?>

    </div>

    <div class="skills">

        <?php

        foreach($skills as $skill){

            $skill = trim($skill);

            if($skill!=""){

        ?>

        <span class="skill">

            <?php echo htmlspecialchars($skill); ?>

        </span>

        <?php

            }

        }

        ?>

    </div>

    <div class="card-footer">

        <div class="posted">

            <i class="fa-regular fa-clock"></i>

            Posted:
            <?php echo date("d M Y",strtotime($row['Posted_Date'])); ?>

        </div>

       <a
href="analyze_resume.php?job_id=<?php echo $row['Job_ID']; ?>"
class="apply-btn">

<i class="fa-solid fa-wand-magic-sparkles"></i>

Analyze Resume

</a>
    </div>

</div>

<?php

}

}else{

?>

<div class="empty-state">

<i class="fa-solid fa-briefcase"></i>

<h2>No Jobs Available</h2>

<p>

Employers haven't posted any jobs yet.

Please check again later.

</p>

</div>

<?php

}

?>

</div>

<script>

const search=document.getElementById("searchJob");

search.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let cards=document.querySelectorAll(".job-card");

cards.forEach(function(card){

let text=card.innerText.toLowerCase();

card.style.display=text.includes(value) ? "block":"none";

});

});

</script>

</div>

</body>

</html>