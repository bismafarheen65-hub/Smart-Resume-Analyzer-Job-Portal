<?php
include("config/db.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* ===== GET EXISTING CV ===== */
$result = mysqli_query($conn,"SELECT * FROM cv WHERE User_ID='$user_id' ORDER BY CV_ID DESC LIMIT 1");

$data = mysqli_fetch_assoc($result);

if(!$data){
    die("CV not found.");
}

/* ===== UPDATE CV ===== */

if(isset($_POST['update_cv'])){

    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $cnic = mysqli_real_escape_string($conn,$_POST['cnic']);
    $languages = mysqli_real_escape_string($conn,$_POST['languages']);

    /* Picture */

    $profile_picture = $data['profile_picture'];

    if(!empty($_FILES['profile_picture']['name'])){

        $file=time()."_".$_FILES['profile_picture']['name'];

        move_uploaded_file(
            $_FILES['profile_picture']['tmp_name'],
            "uploads/".$file
        );

        $profile_picture=$file;
    }

    /* Arrays */

    $skills = implode(",",$_POST['skills'] ?? []);

    $projects = implode(",",$_POST['projects'] ?? []);

    $education=json_encode([
        "degree"=>$_POST['education'] ?? [],
        "institute"=>$_POST['edu_institute'] ?? [],
        "date"=>$_POST['edu_date'] ?? []
    ]);

    $certifications=json_encode([
        "name"=>$_POST['certifications'] ?? [],
        "org"=>$_POST['cert_org'] ?? [],
        "date"=>$_POST['cert_date'] ?? []
    ]);

    $experience=json_encode([
        "title"=>$_POST['experience_title'] ?? [],
        "company"=>$_POST['experience_company'] ?? [],
        "date"=>$_POST['experience_date'] ?? []
    ]);

   $update = "UPDATE cv SET
full_name='$full_name',
email='$email',
phone='$phone',
address='$address',
cnic='$cnic',
languages='$languages',
profile_picture='$profile_picture',
education='$education',
skills='$skills',
certifications='$certifications',
projects='$projects',
experience='$experience'
WHERE User_ID='$user_id'";
    if(mysqli_query($conn,$update)){

        $message="✅ CV Updated Successfully";
$result=mysqli_query($conn,"SELECT * FROM cv WHERE User_ID='$user_id' LIMIT 1");
        $data=mysqli_fetch_assoc($result);

    }else{

        $message="❌ Failed to Update CV.";

    }

}

/* Decode */

$education=json_decode($data['education'],true);

$experience=json_decode($data['experience'],true);

$certifications=json_decode($data['certifications'],true);

$skills=explode(",",$data['skills']);

$projects=explode(",",$data['projects']);

?>
<!DOCTYPE html>
<html>
<head>

<title>Edit CV</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#667eea,#764ba2);
    padding:30px;
}

.container{
    width:750px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:10px;
}

.message{
    color:green;
    font-weight:bold;
    text-align:center;
}

.section{
    margin-bottom:20px;
    padding:18px;
    border-radius:12px;
    background:#f8f9ff;
    border-left:5px solid #667eea;
}

label{
    font-weight:bold;
    margin-top:8px;
    display:block;
}

input,textarea{
    width:100%;
    padding:10px;
    border:1px solid #ddd;
    border-radius:8px;
    margin-top:5px;
}

textarea{
    height:80px;
}

.btn-row{
    display:flex;
    justify-content:space-between;
}

.next-btn{
    width:48%;
    padding:10px;
    border:none;
    background:#667eea;
    color:white;
    border-radius:8px;
}

.back-btn{
    width:48%;
    padding:10px;
    border:none;
    background:#6c757d;
    color:white;
    border-radius:8px;
}

.save-btn{
    width:100%;
    padding:12px;
    background:#198754;
    color:white;
    border:none;
    border-radius:8px;
}

.step{
    display:none;
}

.step.active{
    display:block;
}

.item{
    display:flex;
    gap:8px;
    margin-bottom:8px;
}

.item input{
    flex:1;
}

.remove-btn{
    background:red;
    color:white;
    border:none;
    padding:6px 10px;
}

.add-btn{
    background:#667eea;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    margin-top:8px;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Your CV</h2>

<?php
if($message!=""){
    echo "<p class='message'>$message</p>";
}
?>

<form method="POST" enctype="multipart/form-data">

<!-- STEP 1 -->

<div class="section step active" id="step1">

<h3>1️⃣ Personal Information</h3>

<label>Profile Picture</label>

<input type="file" name="profile_picture" accept="image/*">

<label>Full Name</label>

<input
type="text"
name="full_name"
value="<?php echo htmlspecialchars($data['full_name']); ?>"
required>

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo htmlspecialchars($data['email']); ?>"
required>

<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo htmlspecialchars($data['phone']); ?>">

<label>CNIC</label>

<input
type="text"
name="cnic"
value="<?php echo htmlspecialchars($data['cnic']); ?>">

<label>Languages</label>

<input
type="text"
name="languages"
value="<?php echo htmlspecialchars($data['languages']); ?>">

<label>Address</label>

<textarea
name="address"><?php echo htmlspecialchars($data['address']); ?></textarea>

<div class="btn-row">

<button
type="button"
class="next-btn"
onclick="nextStep()">

Next →

</button>

</div>

</div>
<!-- STEP 2 -->
<div class="section step" id="step2">

<h3>2️⃣ Education / Skills / Certificates / Projects</h3>

<!-- EDUCATION -->

<label>Education</label>

<div id="eduBox">

<?php

if(!empty($education['degree'])){

for($i=0;$i<count($education['degree']);$i++){

?>

<div class="item">

<input type="text"
name="education[]"
placeholder="Degree"
value="<?php echo htmlspecialchars($education['degree'][$i]); ?>">

<input type="text"
name="edu_institute[]"
placeholder="Institute"
value="<?php echo htmlspecialchars($education['institute'][$i]); ?>">

<input type="date"
name="edu_date[]"
value="<?php echo $education['date'][$i]; ?>">

<button type="button"
class="remove-btn"
onclick="this.parentElement.remove()">X</button>

</div>

<?php
}
}
?>

</div>

<button type="button"
class="add-btn"
onclick="addEdu()">

+ Add Education

</button>

<br><br>

<!-- SKILLS -->

<label>Skills</label>

<div id="skillsBox">

<?php

foreach($skills as $skill){

if(trim($skill)!=""){

?>

<div class="item">

<input
type="text"
name="skills[]"
value="<?php echo htmlspecialchars($skill); ?>">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

<?php
}
}
?>

</div>

<button
type="button"
class="add-btn"
onclick="addSkill()">

+ Add Skill

</button>

<br><br>

<!-- CERTIFICATES -->

<label>Certificates</label>

<div id="certBox">

<?php

if(!empty($certifications['name'])){

for($i=0;$i<count($certifications['name']);$i++){

?>

<div class="item">

<input
type="text"
name="certifications[]"
placeholder="Certificate"

value="<?php echo htmlspecialchars($certifications['name'][$i]); ?>">

<input
type="text"
name="cert_org[]"
placeholder="Organization"

value="<?php echo htmlspecialchars($certifications['org'][$i]); ?>">

<input
type="date"
name="cert_date[]"

value="<?php echo $certifications['date'][$i]; ?>">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

<?php
}
}
?>

</div>

<button
type="button"
class="add-btn"
onclick="addCert()">

+ Add Certificate

</button>

<br><br>

<!-- PROJECTS -->

<label>Projects</label>

<div id="projBox">

<?php

foreach($projects as $project){

if(trim($project)!=""){

?>

<div class="item">

<input
type="text"
name="projects[]"

value="<?php echo htmlspecialchars($project); ?>">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

<?php
}
}
?>

</div>

<button
type="button"
class="add-btn"
onclick="addProj()">

+ Add Project

</button>

<div class="btn-row" style="margin-top:20px;">

<button
type="button"
class="back-btn"
onclick="prevStep()">

← Back

</button>

<button
type="button"
class="next-btn"
onclick="nextStep()">

Next →

</button>

</div>

</div>
<!-- STEP 3 -->
<div class="section step" id="step3">

<h3>3️⃣ Experience</h3>

<div id="expBox">

<?php

if(!empty($experience['title'])){

for($i=0;$i<count($experience['title']);$i++){

?>

<div class="item">

<input
type="text"
name="experience_title[]"
placeholder="Job Title"
value="<?php echo htmlspecialchars($experience['title'][$i]); ?>">

<input
type="text"
name="experience_company[]"
placeholder="Company"
value="<?php echo htmlspecialchars($experience['company'][$i]); ?>">

<input
type="date"
name="experience_date[]"
value="<?php echo $experience['date'][$i]; ?>">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

<?php
}
}
?>

</div>

<button
type="button"
class="add-btn"
onclick="addExp()">

+ Add Experience

</button>

<div class="btn-row" style="margin-top:20px;">

<button
type="button"
class="back-btn"
onclick="prevStep()">

← Back

</button>

</div>

<br>

<button
type="submit"
name="update_cv"
class="save-btn">

💾 Update CV

</button>

</div>

</form>

</div>

<script>

let step=1;

function showStep(n){

document.querySelectorAll(".step").forEach(function(s){
s.classList.remove("active");
});

document.getElementById("step"+n).classList.add("active");

}

function nextStep(){

if(step<3){
step++;
showStep(step);
}

}

function prevStep(){

if(step>1){
step--;
showStep(step);
}

}

function addEdu(){

document.getElementById("eduBox").insertAdjacentHTML("beforeend",`

<div class="item">

<input type="text" name="education[]" placeholder="Degree">

<input type="text" name="edu_institute[]" placeholder="Institute">

<input type="date" name="edu_date[]">

<button type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

`);

}

function addSkill(){

document.getElementById("skillsBox").insertAdjacentHTML("beforeend",`

<div class="item">

<input type="text" name="skills[]" placeholder="Skill">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

`);

}

function addCert(){

document.getElementById("certBox").insertAdjacentHTML("beforeend",`

<div class="item">

<input type="text" name="certifications[]" placeholder="Certificate">

<input type="text" name="cert_org[]" placeholder="Organization">

<input type="date" name="cert_date[]">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

`);

}

function addProj(){

document.getElementById("projBox").insertAdjacentHTML("beforeend",`

<div class="item">

<input type="text" name="projects[]" placeholder="Project">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

`);

}

function addExp(){

document.getElementById("expBox").insertAdjacentHTML("beforeend",`

<div class="item">

<input type="text" name="experience_title[]" placeholder="Job Title">

<input type="text" name="experience_company[]" placeholder="Company">

<input type="date" name="experience_date[]">

<button
type="button"
class="remove-btn"
onclick="this.parentElement.remove()">

X

</button>

</div>

`);

}

</script>

</body>
</html>