<?php
include("config/db.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['user_id'])){
    $user_id = (int)$_GET['user_id'];
}else{
    $user_id = $_SESSION['user_id'];
}

/* FETCH CV */
$query = mysqli_query($conn,"SELECT * FROM cv WHERE User_ID='$user_id' ORDER BY CV_ID DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);

if(!$data){
    die("No CV found!");
}

/* JSON SAFE */
$edu  = !empty($data['education']) ? json_decode($data['education'], true) : [];
$cert = !empty($data['certifications']) ? json_decode($data['certifications'], true) : [];
$exp  = !empty($data['experience']) ? json_decode($data['experience'], true) : [];

/* TEMPLATE */
/* TEMPLATE */
$template = $_GET['template'] ?? 'modern';

/* Check if Employer is viewing Applicant CV */
$isEmployerView = isset($_GET['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>CV Preview</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
    font-family:Arial;
}

/* TOP BAR */
.top-bar{
    width:850px;
    max-width:95%;
    margin:20px auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BUTTONS */
.btn-group a{
    text-decoration:none;
    padding:8px 12px;
    margin-right:5px;
    border-radius:6px;
    font-size:14px;
    border:1px solid #667eea;
    color:#667eea;
}

.btn-group a.active{
    background:#667eea;
    color:white;
}

/* DOWNLOAD */
.download-btn{
    background:#28a745;
    color:white;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
}

/* CV BOX */
.cv-box{
    width:850px;
    max-width:95%;
    margin:10px auto 30px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}
</style>
</head>

<body>

<?php if(!$isEmployerView){ ?>

<!-- TOP BAR -->
<div class="top-bar">

    <div class="btn-group">
        <a href="preview.php?template=simple"
           class="<?php echo ($template=='simple') ? 'active' : ''; ?>">
           Simple
        </a>

        <a href="preview.php?template=modern"
           class="<?php echo ($template=='modern') ? 'active' : ''; ?>">
           Modern
        </a>

        <a href="preview.php?template=advanced"
           class="<?php echo ($template=='advanced') ? 'active' : ''; ?>">
           Advanced
        </a>
    </div>

    <a class="download-btn"
       href="generate_pdf.php?user_id=<?php echo $user_id; ?>&template=<?php echo $template; ?>">
       Download PDF
    </a>

</div>

<?php } ?>
<!-- CV BOX -->
<div class="cv-box">

<?php
if($template == "simple"){
    include("templates/simple.php");
}
elseif($template == "modern"){
    include("templates/modern.php");
}
elseif($template == "advanced"){
    include("templates/advanced.php");
}
else{
    include("templates/modern.php");
}
?>

</div>

</body>
</html>