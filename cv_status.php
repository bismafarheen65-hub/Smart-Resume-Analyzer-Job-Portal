<?php
include("config/db.php");
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,"SELECT * FROM cv WHERE User_ID='$user_id' ORDER BY CV_ID DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);

if(!$data){
    die("No CV Found!");
}

$fields=[
"full_name","email","phone","cnic","languages",
"skills","education","experience",
"certifications","projects","profile_picture"
];

$total=count($fields);
$filled=0;

foreach($fields as $field){
    if(!empty($data[$field])){
        $filled++;
    }
}

$remaining=$total-$filled;
$percent=round(($filled/$total)*100);
?>

<!DOCTYPE html>
<html>
<head>

<title>CV Status Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,sans-serif;
}

body{
background:#eef2f7;
display:flex;
}

/* Sidebar */

.sidebar{
width:250px;
background:#111827;
height:100vh;
padding:25px;
color:white;
position:fixed;
left:0;
top:0;
}

.logo{
font-size:24px;
font-weight:700;
margin-bottom:35px;
}

.menu a{
display:block;
padding:13px 15px;
margin-bottom:8px;
text-decoration:none;
color:#d1d5db;
border-radius:10px;
transition:.3s;
}

.menu a:hover,
.menu .active{
background:#2563eb;
color:white;
}

/* Main */

.main{
margin-left:250px;
width:100%;
padding:30px;
}

/* Top */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.user h3{
font-size:18px;
}

.user span{
font-size:13px;
color:#64748b;
}

/* Header */

.header{
background:linear-gradient(135deg,#1d4ed8,#2563eb);
padding:30px;
border-radius:20px;
display:flex;
justify-content:space-between;
align-items:center;
color:white;
box-shadow:0 15px 30px rgba(37,99,235,.20);
}

.header h2{
font-size:30px;
margin-bottom:10px;
}

.header p{
opacity:.9;
}

.badge{
display:inline-block;
margin-top:15px;
padding:7px 15px;
border-radius:30px;
background:white;
color:#2563eb;
font-weight:600;
}

/* Progress Circle */

.circle{
width:140px;
height:140px;
border-radius:50%;
background:
conic-gradient(
#22c55e <?php echo $percent;?>%,
rgba(255,255,255,.2) 0
);

display:flex;
justify-content:center;
align-items:center;
}

.circle div{

width:100px;
height:100px;
background:white;
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
font-size:26px;
font-weight:700;
color:#111827;

}

/* Cards */

.cards{

display:grid;
grid-template-columns:repeat(4,1fr);
gap:18px;
margin-top:25px;

}

.card{

background:white;
padding:22px;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.06);
transition:.3s;

}

.card:hover{

transform:translateY(-6px);

}

.card p{

color:#64748b;
font-size:14px;

}

.card h3{

margin-top:8px;
font-size:28px;

}

/* Grid */

.grid{

display:grid;
grid-template-columns:1fr 1fr;
gap:20px;
margin-top:25px;

}

.box{

background:white;
padding:25px;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.06);

}

.bar{

height:8px;
background:#e5e7eb;
border-radius:30px;
overflow:hidden;
margin:8px 0 18px;

}

.fill{

height:100%;
background:linear-gradient(90deg,#2563eb,#3b82f6);

}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">
CV Maker
</div>

<div class="menu">

<a href="#">Dashboard</a>
<a href="#">Create CV</a>
<a href="#">Edit CV</a>
<a href="#" class="active">CV Status</a>
<a href="#">View CV</a>

</div>

</div>

<div class="main">

<div class="topbar">

<h2>CV Status Dashboard</h2>

<div class="user">

<h3><?php echo $data['full_name']; ?></h3>
<span>Welcome Back</span>

</div>

</div>

<div class="header">

<div>

<h2>Your CV Progress</h2>

<p>
Track your CV completion and improve your profile.
</p>

<span class="badge">
<?php echo $percent;?>% Completed
</span>

</div>

<div class="circle">

<div>

<?php echo $percent;?>%

</div>

</div>

</div>
<!-- CARDS -->
<div class="cards">

    <div class="card">
        <p>Total Fields</p>
        <h3><?php echo $total; ?></h3>
    </div>

    <div class="card">
        <p>Completed</p>
        <h3><?php echo $filled; ?></h3>
    </div>

    <div class="card">
        <p>Remaining</p>
        <h3><?php echo $remaining; ?></h3>
    </div>

    <div class="card">
        <p>Profile Status</p>
        <h3>
        <?php
        if($percent>=80){
            echo "<span style='color:#16a34a;'>Excellent</span>";
        }
        elseif($percent>=60){
            echo "<span style='color:#2563eb;'>Good</span>";
        }
        elseif($percent>=40){
            echo "<span style='color:#f59e0b;'>Average</span>";
        }
        else{
            echo "<span style='color:#dc2626;'>Needs Improvement</span>";
        }
        ?>
        </h3>
    </div>

</div>


<!-- CONTENT -->
<div class="grid">

    <!-- Missing Fields -->
    <div class="box">

        <h2 style="margin-bottom:20px;">Missing Sections</h2>

        <?php
        $missing = false;

        foreach($fields as $field){

            if(empty($data[$field])){

                $missing = true;
        ?>

                <p style="font-weight:600;">
                    <?php echo ucwords(str_replace("_"," ",$field)); ?>
                </p>

                <div class="bar">
                    <div class="fill" style="width:35%;background:#ef4444;"></div>
                </div>

        <?php

            }

        }

        if(!$missing){

            echo "<p style='color:#16a34a;font-weight:600;font-size:18px;'>
            🎉 Congratulations! Your CV is fully completed.
            </p>";

        }

        ?>

    </div>



    <!-- Overview -->
    <div class="box">

        <h2 style="margin-bottom:20px;">Completion Overview</h2>

        <p>Profile Completion</p>

        <div class="bar">
            <div class="fill" style="width:<?php echo $percent; ?>%;"></div>
        </div>

        <p style="margin-top:15px;">Completion Percentage</p>

        <h1 style="margin:15px 0;color:#2563eb;">
            <?php echo $percent; ?>%
        </h1>

        <hr style="margin:20px 0;border:none;border-top:1px solid #e5e7eb;">

     <h3>Personalized Suggestions</h3>

<div style="margin-top:15px; line-height:2;">

<?php

$education = strtolower(trim($data['education']));

switch (true) {

    case strpos($education, "computer engineering") !== false:
    case strpos($education, "computer science") !== false:
    case strpos($education, "software engineering") !== false:

        echo "• Strengthen your C++, Java or Python programming skills.<br>";
        echo "• Build more software development projects.<br>";
        echo "• Learn Web Development or Mobile App Development.<br>";
        echo "• Improve problem-solving and DSA skills.<br>";
        echo "• Create a GitHub portfolio to showcase your work.<br>";
        break;

    case strpos($education, "electrical") !== false:

        echo "• Learn MATLAB, Proteus and PLC programming.<br>";
        echo "• Work on embedded systems and IoT projects.<br>";
        echo "• Improve circuit design skills.<br>";
        echo "• Add hardware-based projects to your CV.<br>";
        break;

    case strpos($education, "civil") !== false:

        echo "• Improve AutoCAD and Revit skills.<br>";
        echo "• Learn ETABS and Primavera.<br>";
        echo "• Include construction or surveying projects.<br>";
        echo "• Add site management experience if available.<br>";
        break;

    case strpos($education, "mechanical") !== false:

        echo "• Improve SolidWorks and AutoCAD skills.<br>";
        echo "• Add machine design projects.<br>";
        echo "• Learn CNC and manufacturing software.<br>";
        echo "• Include industrial internship experience.<br>";
        break;

    case strpos($education, "pharmacy") !== false:

        echo "• Add clinical pharmacy experience.<br>";
        echo "• Mention laboratory and research skills.<br>";
        echo "• Include pharmaceutical software knowledge.<br>";
        echo "• Add hospital or community pharmacy training.<br>";
        break;

    case strpos($education, "english") !== false:

        echo "• Improve academic and creative writing skills.<br>";
        echo "• Add proofreading and editing experience.<br>";
        echo "• Mention presentation and communication skills.<br>";
        echo "• Include teaching or content writing experience.<br>";
        break;

    case strpos($education, "bba") !== false:
    case strpos($education, "mba") !== false:

        echo "• Improve leadership and management skills.<br>";
        echo "• Learn Advanced Microsoft Excel.<br>";
        echo "• Add marketing or business analysis projects.<br>";
        echo "• Include internship or management experience.<br>";
        break;

    default:

        echo "• Add skills related to your field of study.<br>";
        echo "• Include professional certifications.<br>";
        echo "• Mention relevant projects and achievements.<br>";
}
?>

    </div>

</div>

</div>

</body>
</html>