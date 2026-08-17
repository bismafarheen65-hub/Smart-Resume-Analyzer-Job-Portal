<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("../config/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="Employer"){

    header("Location: elogin.php");
    exit();

}

$name = $_SESSION['user_name'];
$employer_id = $_SESSION['user_id'];

/* DELETE JOB */

if(isset($_GET['delete'])){

    $job_id = (int)$_GET['delete'];

    mysqli_query($conn,"
    DELETE FROM jobs
    WHERE Job_ID='$job_id'
    AND Employer_ID='$employer_id'
    ");

    header("Location: my_jobs.php");
    exit();

}

/* FETCH JOBS */

$jobs = mysqli_query($conn,"
SELECT *
FROM jobs
WHERE Employer_ID='$employer_id'
ORDER BY Posted_Date DESC
");

$total_jobs = mysqli_num_rows($jobs);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Jobs | CareerConnect</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

/* ================= MAIN ================= */

.content{
margin-left:260px;
padding:35px;
width:100%;
}

/* ================= TOPBAR ================= */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.topbar h2{
font-size:32px;
font-weight:700;
}

.topbar p{
margin-top:5px;
color:#94a3b8;
}

.user{
background:#1e293b;
padding:12px 20px;
border-radius:12px;
display:flex;
align-items:center;
gap:10px;
font-weight:600;
}

/* ================= STATS ================= */

.stats{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-bottom:25px;
}

.stat-card{
background:#162235;
padding:22px;
border-radius:18px;
display:flex;
align-items:center;
gap:18px;
box-shadow:0 10px 25px rgba(0,0,0,.25);
}

.stat-card i{
font-size:35px;
color:#22c55e;
}

.stat-card h2{
font-size:30px;
margin-bottom:5px;
}

.stat-card p{
color:#94a3b8;
}

/* ================= SEARCH ================= */

.search-box{
margin-bottom:20px;
}

.search-box input{
width:100%;
padding:14px 18px;
background:#162235;
border:1px solid #334155;
border-radius:12px;
color:white;
outline:none;
font-size:15px;
}

.search-box input:focus{
border-color:#22c55e;
}

/* ================= TABLE ================= */

.table-box{
background:#162235;
padding:25px;
border-radius:20px;
overflow-x:auto;
box-shadow:0 15px 35px rgba(0,0,0,.30);
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#1e293b;
}

th{
padding:18px;
text-align:left;
color:#fff;
font-size:15px;
}

td{
padding:18px;
border-bottom:1px solid #263445;
color:#dbeafe;
}

tbody tr{
transition:.3s;
}

tbody tr:hover{
background:#1e293b;
}

/* ================= ACTION BUTTONS ================= */

.view,
.edit,
.delete{

display:inline-flex;
justify-content:center;
align-items:center;

width:38px;
height:38px;

border-radius:10px;

margin-right:8px;

text-decoration:none;
color:white;

transition:.3s;

}


.delete{
background:#ef4444;
}

.delete:hover{
background:#dc2626;
transform:scale(1.08);
}

/* ================= RESPONSIVE ================= */
@media(max-width:900px){

.container{
flex-direction:column;
}

.sidebar{
position:relative;
width:100%;
height:auto;
}

.content{
margin-left:0;
}

.stats{
grid-template-columns:1fr;
}

.topbar{
flex-direction:column;
align-items:flex-start;
gap:15px;
}

}

</style>

</head>

<body>

<div class="container">
    <!-- SIDEBAR -->

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

            <li>
                <a href="post_job.php">
                    <i class="fa-solid fa-plus"></i>
                    Post Job
                </a>
            </li>

            <li class="active">
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

    <!-- MAIN CONTENT -->

    <main class="content">

        <!-- TOP BAR -->

        <div class="topbar">

            <div>

                <h2>My Posted Jobs</h2>

                <p>Manage all jobs posted by your company.</p>

            </div>

            <div class="user">

                <i class="fa-solid fa-circle-user"></i>

                <?php echo htmlspecialchars($name); ?>

            </div>

        </div>

        <!-- STATS -->

        <div class="stats">

            <div class="stat-card">

                <i class="fa-solid fa-briefcase"></i>

                <div>

                    <h2><?php echo $total_jobs; ?></h2>

                    <p>Total Jobs</p>

                </div>

            </div>

            <div class="stat-card">

                <i class="fa-solid fa-circle-check"></i>

                <div>

                    <h2>Active</h2>

                    <p>Status</p>

                </div>

            </div>

            <div class="stat-card">

                <i class="fa-solid fa-calendar"></i>

                <div>

                    <h2><?php echo date("d M Y"); ?></h2>

                    <p>Today's Date</p>

                </div>

            </div>

        </div>

        <!-- SEARCH -->

        <div class="search-box">

            <input
            type="text"
            id="searchJob"
            placeholder="Search Job Title...">

        </div>

        <!-- TABLE -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Salary</th>
                        <th>Posted</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>
                <?php

if(mysqli_num_rows($jobs)>0){

    mysqli_data_seek($jobs,0);

    while($row=mysqli_fetch_assoc($jobs)){

?>

<tr>

    <td><?php echo htmlspecialchars($row['Job_Title']); ?></td>

    <td><?php echo htmlspecialchars($row['Company_Name']); ?></td>

    <td><?php echo htmlspecialchars($row['Location']); ?></td>

    <td><?php echo htmlspecialchars($row['Job_Type']); ?></td>

    <td>Rs. <?php echo htmlspecialchars($row['Salary']); ?></td>

    <td>
<?php
if(!empty($row['Posted_Date'])){
    echo date("d M Y", strtotime($row['Posted_Date']));
}
else{
    echo "No Date";
}
?>
</td>
    <td>

    <a class="delete"
    href="my_jobs.php?delete=<?php echo $row['Job_ID']; ?>"
    onclick="return confirm('Are you sure you want to delete this job?')">

        <i class="fa-solid fa-trash"></i>

    </a>

</td>
</tr>

<?php

    }

}else{

?>

<tr>

    <td colspan="7" style="text-align:center;padding:40px;">

        No Jobs Posted Yet.

    </td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</main>

</div>

<script>

const search=document.getElementById("searchJob");

search.addEventListener("keyup",function(){

    let value=this.value.toLowerCase();

    let rows=document.querySelectorAll("tbody tr");

    rows.forEach(function(row){

        let text=row.innerText.toLowerCase();

        row.style.display=text.includes(value) ? "" : "none";

    });

});

</script>

</body>

</html>