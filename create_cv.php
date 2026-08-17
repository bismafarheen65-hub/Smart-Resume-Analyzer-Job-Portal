<?php
include("config/db.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['save_cv'])){

    $user_id = $_SESSION['user_id'];

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $cnic = $_POST['cnic'];
    $languages = $_POST['languages'];

    $profile_picture = "";

if(isset($_FILES['profile_picture']['name'])){

    $file = time() . $_FILES['profile_picture']['name'];
    $tmp = $_FILES['profile_picture']['tmp_name'];

    move_uploaded_file($tmp, "uploads/".$file);

    $profile_picture = $file;
}

    $skills = implode(",", $_POST['skills'] ?? []);
    $projects = implode(",", $_POST['projects'] ?? []);

    $education = json_encode([
        "degree" => $_POST['education'] ?? [],
        "institute" => $_POST['edu_institute'] ?? [],
        "date" => $_POST['edu_date'] ?? []
    ]);

    $certifications = json_encode([
        "name" => $_POST['certifications'] ?? [],
        "org" => $_POST['cert_org'] ?? [],
        "date" => $_POST['cert_date'] ?? []
    ]);

    $experience = json_encode([
        "title" => $_POST['experience_title'] ?? [],
        "company" => $_POST['experience_company'] ?? [],
        "date" => $_POST['experience_date'] ?? []
    ]);

    $query = "INSERT INTO cv 
(user_id, full_name, email, phone, address, cnic, languages, profile_picture, education, skills, certifications, projects, experience)
VALUES 
('$user_id','$full_name','$email','$phone','$address','$cnic','$languages','$profile_picture','$education','$skills','$certifications','$projects','$experience')";

   

    if(mysqli_query($conn, $query)){
        $message = "🎉 CV Saved Successfully!";
    } else {
        $message = "❌ Error saving CV!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>CV Builder</title>

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
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* TITLE */
h2{
    text-align:center;
    color:#333;
    margin-bottom:10px;
}

/* MESSAGE */
.message{
    text-align:center;
    color:green;
    font-weight:bold;
}

/* ===== PROGRESS BAR ===== */
.progress-wrapper{
    max-width:750px;
    margin:15px auto 25px auto;
    position:relative;
}

.step-line{
    position:absolute;
    top:22px;
    left:10%;
    right:10%;
    height:3px;
    background:#ddd;
    z-index:0;
}

.step-item{
    text-align:center;
    position:relative;
    z-index:1;
}

.step-circle{
    width:45px;
    height:45px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto;
    font-size:18px;
    font-weight:bold;
    color:white;
}

.step-done{ background:#28a745; }
.step-active{ background:#0d6efd; }
.step-pending{ background:#adb5bd; }

.step-label{
    margin-top:6px;
    font-size:13px;
    font-weight:600;
}

/* FORM STYLES */
.section{
    margin-bottom:20px;
    padding:18px;
    border-radius:12px;
    background:#f8f9ff;
    border-left:5px solid #667eea;
}

.section h3{
    color:#333;
    margin-bottom:10px;
}

label{
    font-size:13px;
    font-weight:bold;
    display:block;
    margin-top:8px;
}

input, textarea{
    width:100%;
    padding:10px;
    margin:6px 0;
    border:1px solid #ddd;
    border-radius:8px;
}

textarea{
    height:70px;
    resize:none;
}

/* BUTTONS */
button{
    padding:8px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    margin-top:6px;
}

.add-btn{
    background:#667eea;
    color:white;
}

.remove-btn{
    background:red;
    color:white;
    margin-left:5px;
}

.btn-row{
    display:flex;
    justify-content:space-between;
}

.next-btn{
    background:#667eea;
    color:white;
    width:48%;
}

.back-btn{
    background:#999;
    color:white;
    width:48%;
}

.save-btn{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
    width:100%;
    padding:12px;
}

/* STEP */
.step{display:none;}
.step.active{display:block;}

.item{
    display:flex;
    gap:8px;
    margin-bottom:6px;
}

.item input{
    flex:1;
}

</style>
</head>

<body>

<div class="container">

<h2>📄 Professional CV Builder</h2>

<?php if($message!=""){ ?>
<p class="message"><?php echo $message; ?></p>
<?php } ?>

<!-- ✅ EURO PASS STYLE PROGRESS BAR -->
<div class="progress-wrapper">

    <div class="step-line"></div>

    <div class="row text-center">

        <div class="col step-item">
            <div class="step-circle step-done">✔</div>
            <div class="step-label">Personal Info</div>
        </div>

        <div class="col step-item">
            <div class="step-circle step-active">✏</div>
            <div class="step-label">Education</div>
        </div>

        <div class="col step-item">
            <div class="step-circle step-pending">3</div>
            <div class="step-label">Experience</div>
        </div>

    </div>
</div>

<form method="POST" enctype="multipart/form-data">

<!-- STEP 1 -->
<div class="section step active" id="step1">
<h3>1️⃣ Personal Information</h3>

<label>Profile Picture</label>
<input type="file" name="profile_picture" accept="image/*">


<label>Full Name</label>
<input type="text" name="full_name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Phone</label>
<input type="text" name="phone">

<label>CNIC</label>
<input type="text" name="cnic">

<label>Languages</label>
<input type="text" name="languages">


<label>Address</label>
<textarea name="address"></textarea>

<div class="btn-row">
<button type="button" class="next-btn" onclick="nextStep()">Next ➡</button>
</div>
</div>

<!-- STEP 2 -->
<div class="section step" id="step2">
<h3>2️⃣ Education / Skills / Certificates / Projects</h3>

<label>Education</label>
<div id="eduBox"></div>
<button type="button" class="add-btn" onclick="addEdu()">+ Add Education</button>

<label>Skills</label>
<div id="skillsBox"></div>
<button type="button" class="add-btn" onclick="addSkill()">+ Add Skill</button>

<label>Certificates</label>
<div id="certBox"></div>
<button type="button" class="add-btn" onclick="addCert()">+ Add Certificate</button>

<label>Projects</label>
<div id="projBox"></div>
<button type="button" class="add-btn" onclick="addProj()">+ Add Project</button>

<div class="btn-row">
<button type="button" class="back-btn" onclick="prevStep()">⬅ Back</button>
<button type="button" class="next-btn" onclick="nextStep()">Next ➡</button>
</div>
</div>

<!-- STEP 3 -->
<div class="section step" id="step3">
<h3>3️⃣ Experience</h3>

<div id="expBox"></div>
<button type="button" class="add-btn" onclick="addExp()">+ Add Experience</button>

<div class="btn-row">
<button type="button" class="back-btn" onclick="prevStep()">⬅ Back</button>
</div>
<button type="submit" name="save_cv" class="save-btn">
    💾 Save CV
</button>

</div>

</form>
</div>

<script>

let step = 1;

function showStep(n){
    document.querySelectorAll(".step").forEach(s=>s.classList.remove("active"));
    document.getElementById("step"+n).classList.add("active");
}

function nextStep(){ step++; showStep(step); }
function prevStep(){ step--; showStep(step); }

function addEdu(){
    document.getElementById("eduBox").innerHTML += `
    <div class="item">
        <input type="text" name="education[]" placeholder="Degree">
        <input type="text" name="edu_institute[]" placeholder="Institute">
        <input type="date" name="edu_date[]">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">X</button>
    </div>`;
}

function addSkill(){
    document.getElementById("skillsBox").innerHTML += `
    <div class="item">
        <input type="text" name="skills[]" placeholder="Skill">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">X</button>
    </div>`;
}

function addCert(){
    document.getElementById("certBox").innerHTML += `
    <div class="item">
        <input type="text" name="certifications[]" placeholder="Certificate Name">
        <input type="text" name="cert_org[]" placeholder="Organizer">
        <input type="date" name="cert_date[]">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">X</button>
    </div>`;
}

function addProj(){
    document.getElementById("projBox").innerHTML += `
    <div class="item">
        <input type="text" name="projects[]" placeholder="Project">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">X</button>
    </div>`;
}

function addExp(){
    document.getElementById("expBox").innerHTML += `
    <div class="item">
        <input type="text" name="experience_title[]" placeholder="Job Title">
        <input type="text" name="experience_company[]" placeholder="Company">
        <input type="date" name="experience_date[]">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">X</button>
    </div>`;
}


</script>

</body>
</html>