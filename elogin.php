<?php

session_start();
include("../config/db.php");

$message="";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"
    SELECT * FROM users
    WHERE Email='$email'
    AND role='Employer'
    ");

    if(mysqli_num_rows($query)>0){

        $user = mysqli_fetch_assoc($query);
        if($password == $user['Password']){

            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['user_name'] = $user['Name'];
            $_SESSION['role'] = "Employer";

            header("Location: edashboard.php");
            exit();

        }else{

            $message = "Incorrect Password";

        }

    }else{

        $message = "Employer account not found";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Employer Login</title>

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

.box{

width:420px;
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
color:white;
font-size:16px;
border-radius:10px;
cursor:pointer;
font-weight:600;

}

button:hover{

background:#15803d;

}

.msg{

text-align:center;
color:red;
margin-bottom:15px;

}

a{

display:block;
text-align:center;
margin-top:20px;
text-decoration:none;
color:#16a34a;

}

</style>

</head>

<body>

<div class="box">

<h2>Employer Login</h2>

<p class="msg">
<?php echo $message; ?>
</p>

<form method="POST">

<input
type="email"
name="email"
placeholder="Email Address"
required>

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="Password"
required>

<i class="fa-solid fa-eye" id="eye"></i>

</div>

<button type="submit" name="login">
Login
</button>

</form>

<a href="eregister.php">
Create New Employer Account
</a>

</div>

<script>

let eye=document.getElementById("eye");
let password=document.getElementById("password");

eye.onclick=function(){

    if(password.type==="password"){

        password.type="text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");

    }else{

        password.type="password";
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");

    }

}

</script>

</body>
</html>