<?php

session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="Employer"){
    header("Location: elogin.php");
    exit();
}

$name = $_SESSION['user_name'];
$employer_id = $_SESSION['user_id'];

$message = "";

if(isset($_POST['post_job'])){

    $job_title   = mysqli_real_escape_string($conn,$_POST['job_title']);
    $company     = mysqli_real_escape_string($conn,$_POST['company']);
    $location    = mysqli_real_escape_string($conn,$_POST['location']);
    $job_type    = mysqli_real_escape_string($conn,$_POST['job_type']);
    $salary      = mysqli_real_escape_string($conn,$_POST['salary']);
    $experience  = mysqli_real_escape_string($conn,$_POST['experience']);
    $summary     = mysqli_real_escape_string($conn,$_POST['summary']);
    $skills      = mysqli_real_escape_string($conn,$_POST['skills']);
    $apply_link  = mysqli_real_escape_string($conn,$_POST['apply_link']);

    $query = mysqli_query($conn,"
 INSERT INTO jobs
(
Job_Title,
Company,
Description,
Required_Skills,
Location,
Salary,
Experience,
Apply_Link,
Posted_Date,
Employer_ID,
Company_Name,
Job_Type
)
VALUES
(
'$job_title',
'$company',
'$summary',
'$skills',
'$location',
'$salary',
'$experience',
'$apply_link',
CURDATE(),
'$employer_id',
'$company',
'$job_type'
)
    ");

    if($query){

        $message='
        <div class="success-box">
            <i class="fa-solid fa-circle-check"></i>
            Job Posted Successfully.
        </div>';

    }else{

        $message='
        <div class="error-box">
            <i class="fa-solid fa-circle-xmark"></i>
            '.mysqli_error($conn).'
        </div>';

    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Post Job | CareerConnect</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="container">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="logo">

            <i class="fa-solid fa-briefcase"></i>

            <span>CareerConnect</span>

        </div>

        <ul>

            <li>

                <a href="edashboard.php">

                    <i class="fa-solid fa-house"></i>

                    Dashboard

                </a>

            </li>

            <li class="active">

                <a href="post_job.php">

                    <i class="fa-solid fa-plus"></i>

                    Post Job

                </a>

            </li>

            <li>

                <a href="my_jobs.php">

                    <i class="fa-solid fa-briefcase"></i>

                    My Jobs

                </a>

            </li>

            <li>

                <a href="applicants.php">

                    <i class="fa-solid fa-users"></i>

                    Applicants

                </a>

            </li>

            <li>

                <a href="profile.php">

                    <i class="fa-solid fa-building"></i>

                    Company Profile

                </a>

            </li>

            <li>

                <a href="../logout.php">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </a>

            </li>

        </ul>

    </aside>

    <!-- ================= MAIN ================= -->

    <main class="content">

        <!-- TOP BAR -->

        <div class="topbar">

            <div>

                <h2>Post New Job</h2>

                <p>Create a professional job listing.</p>

            </div>

            <div class="user">

                <i class="fa-solid fa-circle-user"></i>

                <?php echo htmlspecialchars($name); ?>

            </div>

        </div>

        <?php echo $message; ?>

        <div class="wrapper">

            <!-- LEFT -->

            <div class="left-panel">

                <h1>

                    Post a <span>Skill-Based</span> Job

                </h1>

                <p class="subtitle">

                    Complete the form below to publish your vacancy.

                </p>

                <form method="POST">

                    <div class="grid">

                        <div class="field">

                            <label>Job Title</label>

                            <input
                            type="text"
                            name="job_title"
                            id="job_title"
                            placeholder="Backend Developer"
                            required>

                        </div>

                        <div class="field">

                            <label>Company Name</label>

                            <input
                            type="text"
                            name="company"
                            id="company"
                            placeholder="CareerConnect"
                            required>

                        </div>

                        <div class="field">

                            <label>Location</label>

                            <input
                            type="text"
                            name="location"
                            id="location"
                            placeholder="Islamabad"
                            required>

                        </div>

                        <div class="field">

                            <label>Job Type</label>

                            <select
                            name="job_type"
                            id="job_type">

                                <option>Remote</option>
                                <option>Hybrid</option>
                                <option>On Site</option>
                                <option>Internship</option>
                                <option>Full Time</option>
                                <option>Part Time</option>

                            </select>

                        </div>

                        <div class="field">

                            <label>Salary</label>

                            <input
                            type="text"
                            name="salary"
                            id="salary"
                            placeholder="70000">

                        </div>

                        <div class="field">

                            <label>Experience</label>

                            <select
                            name="experience">

                                <option>Entry Level</option>
                                <option>Mid Level</option>
                                <option>Senior Level</option>

                            </select>

                        </div>

                    </div>

                    <label>Job Description</label>

                    <textarea
                    rows="5"
                    name="summary"
                    id="summary"
                    placeholder="Describe the job..."
                    required></textarea>

                    <label>Required Skills</label>

                    <textarea
                    rows="4"
                    name="skills"
                    id="skills"
                    placeholder="PHP, Laravel, MySQL..."
                    required></textarea>

                    <label>Application Email / Link</label>

                    <input
                    type="text"
                    name="apply_link"
                    id="apply_link"
                    placeholder="jobs@careerconnect.com">

                    <button
                    type="submit"
                    name="post_job">

                        <i class="fa-solid fa-paper-plane"></i>

                        Publish Job

                    </button>

                </form>

            </div>

            <!-- RIGHT -->

            <div class="right-panel">

                <h2>Live Preview</h2>

                <div class="preview-card">

                    <h3 id="p_title">Backend Developer</h3>

                    <p id="p_company">CareerConnect</p>

                    <div class="progress">

                        <div class="bar" id="progressBar"></div>

                    </div>

                    <p class="salary">

                        Rs.
                        <span id="p_salary">70000</span>

                    </p>

                    <p id="p_location">Islamabad</p>

                    <p id="p_type">Remote</p>

                    <hr>

                    <p id="p_summary">

                        Your description will appear here...

                    </p>

                    <strong>Skills</strong>

                    <p id="p_skills">

                        PHP, Laravel, MySQL

                    </p>

                </div>

            </div>

        </div>

    </main>

</div>
<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#0f172a;
color:#fff;
}

/* ================= CONTAINER ================= */

.container{
display:flex;
min-height:100vh;
}

/* ================= SIDEBAR ================= */

.sidebar{
width:260px;
background:#081120;
padding:30px 20px;
position:fixed;
left:0;
top:0;
bottom:0;
border-right:1px solid rgba(255,255,255,.08);
}

.logo{
display:flex;
align-items:center;
gap:12px;
font-size:24px;
font-weight:700;
margin-bottom:45px;
color:#22c55e;
}

.logo i{
font-size:28px;
}

.sidebar ul{
list-style:none;
}

.sidebar li{
margin-bottom:12px;
}

.sidebar a{
display:flex;
align-items:center;
gap:12px;
padding:14px 18px;
border-radius:12px;
text-decoration:none;
color:#cbd5e1;
transition:.3s;
font-size:15px;
font-weight:500;
}

.sidebar a:hover,
.sidebar .active a{
background:#22c55e;
color:#fff;
}

.sidebar a i{
width:22px;
text-align:center;
}

/* ================= MAIN ================= */

.content{
margin-left:260px;
width:100%;
padding:35px;
}

/* ================= TOPBAR ================= */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.topbar h2{
font-size:30px;
font-weight:700;
}

.topbar p{
color:#94a3b8;
margin-top:5px;
}

.user{
background:#1e293b;
padding:12px 18px;
border-radius:12px;
font-weight:600;
display:flex;
align-items:center;
gap:10px;
}

/* ================= WRAPPER ================= */

.wrapper{
display:grid;
grid-template-columns:2fr 1fr;
gap:30px;
}

/* ================= LEFT PANEL ================= */

.left-panel{
background:#162235;
padding:35px;
border-radius:20px;
box-shadow:0 15px 40px rgba(0,0,0,.30);
}

.left-panel h1{
font-size:34px;
margin-bottom:8px;
}

.left-panel h1 span{
color:#22c55e;
}

.subtitle{
color:#94a3b8;
margin-bottom:30px;
}

.grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:18px;
margin-bottom:20px;
}

.field{
display:flex;
flex-direction:column;
}

label{
font-size:14px;
margin-bottom:8px;
font-weight:500;
}

input,
select,
textarea{
width:100%;
padding:14px 16px;
border-radius:12px;
border:1px solid #334155;
background:#0f172a;
color:#fff;
outline:none;
font-size:15px;
transition:.3s;
}

input:focus,
select:focus,
textarea:focus{
border-color:#22c55e;
box-shadow:0 0 0 3px rgba(34,197,94,.2);
}

textarea{
resize:none;
margin-bottom:18px;
}

/* ================= BUTTON ================= */

button{
width:100%;
padding:15px;
background:#22c55e;
border:none;
border-radius:14px;
font-size:17px;
font-weight:600;
color:#fff;
cursor:pointer;
transition:.3s;
}

button:hover{
background:#16a34a;
transform:translateY(-2px);
}

/* ================= MESSAGE ================= */

.success-box{
background:#14532d;
padding:14px;
border-radius:12px;
margin-bottom:20px;
color:#dcfce7;
}

.error-box{
background:#7f1d1d;
padding:14px;
border-radius:12px;
margin-bottom:20px;
color:#fee2e2;
}

/* ================= RIGHT PANEL ================= */

.right-panel{
background:#162235;
padding:30px;
border-radius:20px;
height:fit-content;
position:sticky;
top:25px;
}

.right-panel h2{
margin-bottom:20px;
}

.preview-card{
background:#0f172a;
padding:25px;
border-radius:18px;
border:1px solid #334155;
}

.preview-card h3{
font-size:25px;
margin-bottom:10px;
}

.preview-card p{
color:#cbd5e1;
margin:10px 0;
}

.salary{
font-size:20px;
font-weight:700;
color:#22c55e !important;
}

.progress{
height:10px;
background:#334155;
border-radius:50px;
overflow:hidden;
margin:20px 0;
}

.bar{
width:60%;
height:100%;
background:#22c55e;
transition:.3s;
}

hr{
border:none;
height:1px;
background:#334155;
margin:18px 0;
}

/* ================= RESPONSIVE ================= */

@media(max-width:1100px){

.wrapper{
grid-template-columns:1fr;
}

.right-panel{
position:relative;
top:0;
}

}

@media(max-width:768px){

.sidebar{
position:relative;
width:100%;
height:auto;
}

.content{
margin-left:0;
}

.container{
flex-direction:column;
}

.grid{
grid-template-columns:1fr;
}

.topbar{
flex-direction:column;
align-items:flex-start;
gap:15px;
}

}

</style>
<script>

//======================
// INPUT FIELDS
//======================

const jobTitle = document.getElementById("job_title");
const company = document.getElementById("company");
const location = document.getElementById("location");
const jobType = document.getElementById("job_type");
const salary = document.getElementById("salary");
const summary = document.getElementById("summary");
const skills = document.getElementById("skills");

//======================
// PREVIEW ELEMENTS
//======================

const pTitle = document.getElementById("p_title");
const pCompany = document.getElementById("p_company");
const pLocation = document.getElementById("p_location");
const pType = document.getElementById("p_type");
const pSalary = document.getElementById("p_salary");
const pSummary = document.getElementById("p_summary");
const pSkills = document.getElementById("p_skills");

const progressBar = document.getElementById("progressBar");

//======================
// UPDATE LIVE PREVIEW
//======================

function updatePreview(){

    pTitle.innerHTML = jobTitle.value || "Backend Developer";

    pCompany.innerHTML = company.value || "CareerConnect";

    pLocation.innerHTML = location.value || "Pakistan";

    pType.innerHTML = jobType.value || "Remote";

    pSalary.innerHTML = salary.value || "70000";

    pSummary.innerHTML =
    summary.value || "Your complete job description will appear here.";

    pSkills.innerHTML =
    skills.value || "PHP, MySQL, HTML, CSS, JavaScript";

    let score = 0;

    if(jobTitle.value!="") score += 15;
    if(company.value!="") score += 15;
    if(location.value!="") score += 10;
    if(jobType.value!="") score += 10;
    if(salary.value!="") score += 10;
    if(summary.value.length>20) score += 20;
    if(skills.value.length>10) score += 20;

    progressBar.style.width = score + "%";

    if(score<40){

        progressBar.style.background="#ef4444";

    }

    else if(score<80){

        progressBar.style.background="#f59e0b";

    }

    else{

        progressBar.style.background="#22c55e";

    }

}

//======================
// EVENTS
//======================

jobTitle.addEventListener("keyup",updatePreview);
company.addEventListener("keyup",updatePreview);
location.addEventListener("keyup",updatePreview);
salary.addEventListener("keyup",updatePreview);
summary.addEventListener("keyup",updatePreview);
skills.addEventListener("keyup",updatePreview);

jobType.addEventListener("change",updatePreview);

//======================
// INITIAL LOAD
//======================

updatePreview();

</script>

</body>
</html>