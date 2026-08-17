<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Resume Analyzer & Job Portal</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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

    background:#f8fafc;
    color:#1e293b;

}


/* NAVBAR */

.navbar{

    width:100%;
    padding:20px 8%;
    display:flex;
    justify-content:space-between;
    align-items:center;

    background:#0f172a;
    color:white;

}


.logo{

    font-size:24px;
    font-weight:700;

}


.logo span{

    color:#38bdf8;

}


.navbar ul{

    list-style:none;
    display:flex;
    gap:35px;

}


.navbar ul li a{

    color:white;
    text-decoration:none;
    font-size:15px;

}


.navbar ul li a:hover{

    color:#38bdf8;

}



/* HERO */


.hero{

    min-height:90vh;

    background:
    linear-gradient(135deg,#0f172a,#2563eb);

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:70px 8%;

    color:white;

}


.hero-text{

    width:55%;

}


.hero-text h1{

    font-size:55px;
    line-height:1.2;
    font-weight:800;

}


.hero-text h1 span{

    color:#38bdf8;

}


.hero-text p{

    margin-top:20px;

    font-size:18px;

    color:#dbeafe;

    line-height:30px;

}



.buttons{

    margin-top:35px;

}



.btn{

    display:inline-block;

    padding:15px 35px;

    border-radius:10px;

    text-decoration:none;

    margin-right:15px;

    font-weight:600;

    transition:.3s;

}



.job{

    background:#2563eb;
    color:white;

}


.employer{

    background:#22c55e;
    color:white;

}



.btn:hover{

    transform:translateY(-5px);

}




/* HERO IMAGE */


.hero-card{

    width:350px;

    height:350px;

    background:rgba(255,255,255,.15);

    backdrop-filter:blur(15px);

    border-radius:30px;

    display:flex;

    justify-content:center;

    align-items:center;

    box-shadow:0 20px 40px rgba(0,0,0,.2);

}



.hero-card i{

    font-size:140px;

    color:white;

}





/* STATS */


.stats{

    display:flex;

    justify-content:center;

    gap:30px;

    margin-top:-60px;

    position:relative;

}


.stat{

    background:white;

    width:220px;

    padding:25px;

    text-align:center;

    border-radius:15px;

    box-shadow:0 10px 25px rgba(0,0,0,.1);

}


.stat h2{

    color:#2563eb;

    font-size:35px;

}


.stat p{

    color:#64748b;

}




/* FEATURES */


.section{

    padding:80px 8%;

}


.section-title{

    text-align:center;

    margin-bottom:50px;

}


.section-title h2{

    font-size:38px;

}


.section-title p{

    color:#64748b;

}




.features{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:25px;

}



.feature{

    background:white;

    padding:30px;

    border-radius:20px;

    text-align:center;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    transition:.3s;

}



.feature:hover{

    transform:translateY(-10px);

}



.feature i{

    font-size:45px;

    color:#2563eb;

    margin-bottom:20px;

}


.feature h3{

    margin-bottom:10px;

}



/* ROLE SECTION */


.roles{

    display:flex;

    gap:40px;

    justify-content:center;

}



.role-card{

    width:400px;

    padding:40px;

    border-radius:25px;

    color:white;

    text-align:center;

}


.seeker{

    background:linear-gradient(135deg,#2563eb,#6366f1);

}


.company{

    background:linear-gradient(135deg,#16a34a,#22c55e);

}


.role-card i{

    font-size:70px;

    margin-bottom:20px;

}


.role-card h2{

    font-size:30px;

}



.role-card p{

    margin:20px 0;

    line-height:30px;

}



.role-btn{

    background:white;

    color:#2563eb;

    padding:12px 30px;

    border-radius:10px;

    text-decoration:none;

    font-weight:600;

}




/* FOOTER */


footer{

    background:#0f172a;

    color:white;

    text-align:center;

    padding:25px;

}




@media(max-width:900px){

.hero{

flex-direction:column;

text-align:center;

}


.hero-text{

width:100%;

}


.features{

grid-template-columns:1fr;

}


.roles{

flex-direction:column;

align-items:center;

}


}


</style>


</head>


<body>



<!-- NAVBAR -->

<nav class="navbar">


<div class="logo">

Smart Resume <span>Analyzer</span>

</div>


<ul>

<li><a href="#">Home</a></li>

<li><a href="#features">Features</a></li>


</ul>


</nav>





<!-- HERO -->


<section class="hero">


<div class="hero-text">


<h1>

Smart Resume Analyzer

<br>

<span>& Job Portal</span>

</h1>


<p>

Build ATS-friendly resumes, analyze your skills,

find matching jobs and help companies hire

the best candidates through intelligent matching.

</p>



<div class="buttons">


<a href="login.php" class="btn job">

<i class="fa-solid fa-user"></i>

Job Seeker

</a>



<a href="employer/eregister.php" class="btn employer" >

<i class="fa-solid fa-building"></i>

Employer

</a>


</div>


</div>




<div class="hero-card">

<i class="fa-solid fa-file-circle-check"></i>

</div>



</section>






<!-- STATS -->


<div class="stats">


<div class="stat">

<h2>10K+</h2>

<p>Resumes Created</p>

</div>


<div class="stat">

<h2>500+</h2>

<p>Jobs Posted</p>

</div>


<div class="stat">

<h2>95%</h2>

<p>Match Accuracy</p>

</div>


<div class="stat">

<h2>100+</h2>

<p>Companies</p>

</div>


</div>






<!-- FEATURES -->


<section class="section" id="features">


<div class="section-title">

<h2>Powerful Features</h2>

<p>Everything you need for career growth and hiring</p>

</div>



<div class="features">


<div class="feature">

<i class="fa-solid fa-file-lines"></i>

<h3>Resume Builder</h3>

<p>Create professional ATS friendly resumes.</p>

</div>



<div class="feature">

<i class="fa-solid fa-chart-line"></i>

<h3>Resume Analysis</h3>

<p>Check resume score and improvements.</p>

</div>



<div class="feature">

<i class="fa-solid fa-briefcase"></i>

<h3>Job Matching</h3>

<p>Find jobs according to your skills.</p>

</div>



<div class="feature">

<i class="fa-solid fa-users"></i>

<h3>Employer Portal</h3>

<p>Post jobs and hire candidates.</p>

</div>


</div>


</section>






<!-- ROLE -->


<section class="section">


<div class="section-title">

<h2>Choose Your Role</h2>

</div>



<div class="roles">


<div class="role-card seeker">


<i class="fa-solid fa-user-graduate"></i>


<h2>Job Seeker</h2>


<p>

✔ Create Resume<br>

✔ Resume Analysis<br>

✔ Find Matching Jobs<br>

✔ Apply Easily

</p>


<a href="login.php" class="role-btn">

Continue

</a>


</div>





<div class="role-card company">


<i class="fa-solid fa-building"></i>


<h2>Employer</h2>


<p>

✔ Post Jobs<br>

✔ Manage Applicants<br>

✔ Find Candidates<br>

✔ Hire Talent

</p>


<a href="employer/login.php" class="role-btn">

Continue

</a>


</div>



</div>


</section>






<footer>

Smart Resume Analyzer & Job Portal

<br>

Powered by PHP | MySQL | HTML | CSS | JavaScript

<br><br>

© 2026 All Rights Reserved

</footer>



</body>

</html>