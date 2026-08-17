<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="Employer"){

    header("Location: elogin.php");
    exit();

}

$name = $_SESSION['user_name'];
$employer_id = $_SESSION['user_id'];
$query = mysqli_query($conn,"
SELECT
    applications.*,
    users.Name,
    users.Email,
    jobs.Job_Title,
    cv.user_id AS cv_user
FROM applications
INNER JOIN jobs
    ON applications.Job_ID = jobs.Job_ID
INNER JOIN users
    ON applications.user_id = users.User_ID
LEFT JOIN cv
    ON applications.user_id = cv.user_id
WHERE jobs.Employer_ID='$employer_id'
ORDER BY applications.Applied_Date DESC
");

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Applicants | CareerConnect</title>

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

/* CONTAINER */

.container{
display:flex;
min-height:100vh;
}

/* SIDEBAR */

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

/* MAIN */

.content{
margin-left:260px;
padding:35px;
width:100%;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.topbar h2{
font-size:30px;
}

.topbar p{
color:#94a3b8;
margin-top:5px;
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

/* TABLE */

.table-box{
background:#162235;
padding:25px;
border-radius:20px;
box-shadow:0 15px 35px rgba(0,0,0,.30);
overflow-x:auto;
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
}

td{
padding:18px;
border-bottom:1px solid #263445;
color:#dbeafe;
}

tbody tr:hover{
background:#1e293b;
transition:.3s;
}

.badge{
background:#22c55e;
color:#fff;
padding:5px 12px;
border-radius:20px;
font-size:13px;
}

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

            <li>

                <a href="my_jobs.php">

                    <i class="fa-solid fa-briefcase"></i>

                    My Jobs

                </a>

            </li>

            <li class="active">

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

        <div class="topbar">

            <div>

                <h2>Applicants</h2>

                <p>Manage all job applications received.</p>

            </div>

            <div class="user">

                <i class="fa-solid fa-circle-user"></i>

                <?php echo htmlspecialchars($name); ?>

            </div>

        </div>

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>Applicant Name</th>

                        <th>Email</th>

                        <th>Applied Job</th>

                        <th>Resume</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                   <?php
if(mysqli_num_rows($query)>0){

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?php echo htmlspecialchars($row['Name']); ?></td>

<td><?php echo htmlspecialchars($row['Email']); ?></td>

<td><?php echo htmlspecialchars($row['Job_Title']); ?></td>

<td>
<a href="../preview.php?user_id=<?php echo $row['cv_user']; ?>" target="_blank">
View Resume
</a>
</td>

<td>
<span class="badge">
<?php echo htmlspecialchars($row['Status']); ?>
</span>
</td>

</tr>

<?php
}
}else{
?>

<tr>

<td colspan="5" style="text-align:center;padding:50px;">

No Applicants Yet

</td>

</tr>

<?php } ?>

                </tbody>

            </table>

        </div>

    </main>

</div>
<script>

// Future Search Feature
// (Applications aane ke baad yahan search/filter add karenge)

</script>

</body>

</html>