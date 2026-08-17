<?php

session_start();

include("../config/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="Employer"){

    header("Location: elogin.php");
    exit();

}

$employer_id=$_SESSION['user_id'];
$name=$_SESSION['user_name'];

$message="";

/* Fetch User */

$result=mysqli_query($conn,"
SELECT *
FROM users
WHERE User_ID='$employer_id'
");

$user=mysqli_fetch_assoc($result);

/* Update Profile */

if(isset($_POST['save'])){

    $company=mysqli_real_escape_string($conn,$_POST['company']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $website=mysqli_real_escape_string($conn,$_POST['website']);

    mysqli_query($conn,"
    UPDATE users
    SET

    Name='$company',
    Phone='$phone',
    Address='$address'

    WHERE User_ID='$employer_id'
    ");

    $message="Profile Updated Successfully.";

    $result=mysqli_query($conn,"
    SELECT *
    FROM users
    WHERE User_ID='$employer_id'
    ");

    $user=mysqli_fetch_assoc($result);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Profile | CareerConnect</title>

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

.container{
display:flex;
min-height:100vh;
}

/* Sidebar */

.sidebar{
width:260px;
background:#081120;
padding:30px 20px;
position:fixed;
left:0;
top:0;
bottom:0;
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
}

.sidebar a:hover,
.sidebar .active a{
background:#22c55e;
color:#fff;
}

/* Main */

.content{
margin-left:260px;
width:100%;
padding:35px;
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
font-weight:600;
}

</style>

</head>

<body>

<div class="container">

<!-- Sidebar -->

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

<li>
<a href="applicants.php">
<i class="fa-solid fa-users"></i>
Applicants
</a>
</li>

<li class="active">
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

<!-- Main -->

<main class="content">

<div class="topbar">

<div>

<h2>Company Profile</h2>

<p>Manage your company information.</p>

</div>

<div class="user">

<i class="fa-solid fa-circle-user"></i>

<?php echo htmlspecialchars($name); ?>

</div>

</div>
<?php

if($message!=""){

?>

<div style="
background:#16a34a;
padding:15px;
border-radius:12px;
margin-bottom:20px;
font-weight:600;
">

<i class="fa-solid fa-circle-check"></i>

<?php echo $message; ?>

</div>

<?php

}

?>

<div class="profile-card">

<h3>

<i class="fa-solid fa-building"></i>

Company Information

</h3>

<form method="POST">

<div class="row">

<div class="field">

<label>Company Name</label>

<input
type="text"
name="company"
value="<?php echo htmlspecialchars($user['Name']); ?>"
required>

</div>

<div class="field">

<label>Email Address</label>

<input
type="email"
value="<?php echo htmlspecialchars($user['Email']); ?>"
readonly>

</div>

</div>

<div class="row">

<div class="field">

<label>Phone Number</label>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($user['Phone']); ?>">

</div>

<div class="field">

<label>Website</label>

<input
type="text"
name="website"
placeholder="https://www.company.com">

</div>

</div>

<div class="field">

<label>Company Address</label>

<textarea
name="address"
rows="4"><?php echo htmlspecialchars($user['Address']); ?></textarea>

</div>

<button
type="submit"
name="save">

<i class="fa-solid fa-floppy-disk"></i>

Save Profile

</button>

</form>

</div>
<style>

/* ================= PROFILE CARD ================= */

.profile-card{

background:#162235;
padding:30px;
border-radius:20px;
box-shadow:0 15px 35px rgba(0,0,0,.30);

}

.profile-card h3{

font-size:24px;
margin-bottom:25px;
color:#fff;

}

.row{

display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
margin-bottom:20px;

}

.field{

display:flex;
flex-direction:column;

}

.field label{

margin-bottom:8px;
font-size:15px;
font-weight:500;
color:#cbd5e1;

}

.field input,
.field textarea{

width:100%;
padding:14px 16px;
border:1px solid #334155;
border-radius:12px;
background:#0f172a;
color:#fff;
font-size:15px;
outline:none;
transition:.3s;

}

.field input:focus,
.field textarea:focus{

border-color:#22c55e;

}

.field textarea{

resize:none;

}

button{

margin-top:25px;
padding:14px 25px;
border:none;
border-radius:12px;
background:#22c55e;
color:#fff;
font-size:16px;
font-weight:600;
cursor:pointer;
transition:.3s;

}

button:hover{

background:#16a34a;
transform:translateY(-2px);

}

button i{

margin-right:8px;

}

/* ================= RESPONSIVE ================= */

@media(max-width:900px){

.row{

grid-template-columns:1fr;

}

.content{

margin-left:0;

}

.sidebar{

position:relative;
width:100%;
height:auto;

}

.container{

flex-direction:column;

}

}

</style>

</main>

</div>

</body>

</html>