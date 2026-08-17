<?php

include("../config/db.php");

$message="";

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $company = mysqli_real_escape_string($conn,$_POST['company']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = "Employer";


    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");


    if(mysqli_num_rows($check)>0){

        $message="Email already exists";

    }
    else{


        $query = mysqli_query($conn,

        "INSERT INTO users(name,email,password,role)

        VALUES('$name','$email','$password','$role')"

        );


       if($query){

    $message="Registration Successful! You can login now.";

}
else{

    $message="Registration Failed";

}


    }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Employer Registration</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">



<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}


body{

height:100vh;

background:linear-gradient(135deg,#16a34a,#22c55e);

display:flex;

justify-content:center;

align-items:center;

}



.container{

width:430px;

background:white;

padding:35px;

border-radius:20px;

box-shadow:0 15px 35px rgba(0,0,0,.2);

}



h2{

text-align:center;

color:#166534;

margin-bottom:25px;

}



input{

width:100%;

padding:13px;

margin-bottom:15px;

border:1px solid #ddd;

border-radius:10px;

font-size:14px;

}


/* PASSWORD EYE */

.password-box{

position:relative;

}


.password-box input{

padding-right:45px;

}


.password-box i{

position:absolute;

right:15px;

top:14px;

cursor:pointer;

color:#64748b;

}



button{

width:100%;

padding:13px;

background:#16a34a;

border:none;

border-radius:10px;

color:white;

font-size:16px;

font-weight:600;

cursor:pointer;

}



button:hover{

background:#15803d;

}



p.msg{

text-align:center;

color:red;

margin-bottom:10px;

}



a{

display:block;

text-align:center;

margin-top:18px;

color:#16a34a;

text-decoration:none;

}



</style>


</head>


<body>


<div class="container">


<h2>
Employer Registration
</h2>


<p class="msg">

<?php echo $message; ?>

</p>



<form method="POST">


<input type="text" 
name="name"
placeholder="Employer Name"
required>


<input type="text"
name="company"
placeholder="Company Name"
required>



<input type="email"
name="email"
placeholder="Email Address"
required>




<div class="password-box">

<input type="password"
name="password"
id="password"
placeholder="Password"
required>


<i class="fa-solid fa-eye" id="eye"></i>

</div>




<button name="register">

Register

</button>


</form>



<a href="elogin.php">

Already have account? Login

</a>



</div>



<script>


let eye = document.getElementById("eye");

let password = document.getElementById("password");


eye.onclick = function(){


    if(password.type === "password"){


        password.type="text";


        eye.classList.remove("fa-eye");

        eye.classList.add("fa-eye-slash");


    }

    else{


        password.type="password";


        eye.classList.remove("fa-eye-slash");

        eye.classList.add("fa-eye");


    }


}


</script>



</body>

</html>