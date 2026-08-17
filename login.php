<?php
include("config/db.php");
session_start();

$message = "";
$color = "red";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['Name'];

        header("Location: dashboard.php");
        exit();

    } else {
        $message = "❌ Invalid Email or Password!";
        $color = "red";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>CV Maker - Login</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#667eea,#764ba2);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    background:white;
    width:380px;
    padding:40px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
}

.header{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
}

.logo{
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
}

.input-box{
    display:flex;
    align-items:center;
    border:1px solid #ddd;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
}

.input-box input{
    border:none;
    outline:none;
    width:100%;
    font-size:14px;
}

.input-box i{
    margin-right:10px;
    color:#333;
    font-size:14px;
}

/* Eye icon */
.eye-icon{
    cursor:pointer;
    color:#777;
    margin-left:8px;
    font-size:14px;
}

/* Button */
button{
    width:100%;
    padding:12px;
    background:gray;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#555;
}

/* Message */
.message{
    font-size:14px;
    margin-bottom:10px;
    color:<?php echo $color; ?>;
}

/* Links */
a{
    text-decoration:none;
    color:#667eea;
    font-size:13px;
}

</style>

</head>

<body>

<div class="box">

    <div class="header">
        <img src="images/logo.png" class="logo">
        <h2>CV Maker</h2>
    </div>

    <p>Login to your account</p>

    <!-- MESSAGE FIXED POSITION -->
    <?php if(!empty($message)) { ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="input-box">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <!-- PASSWORD WITH EYE ICON -->
        <div class="input-box">
            <i class="fa fa-lock"></i>

            <input type="password" id="password" name="password" placeholder="Password" required>

            <i class="fa fa-eye eye-icon" id="toggleEye" onclick="togglePassword()"></i>
        </div>

        <button type="submit" name="login">Login</button>

    </form>

    <br>

    <a href="register.php">Create new account</a><br>
    <a href="forgot.php">Forgot Password?</a>

</div>

<script>
function togglePassword(){
    let pass = document.getElementById("password");
    let eye = document.getElementById("toggleEye");

    if(pass.type === "password"){
        pass.type = "text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    } else {
        pass.type = "password";
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    }
}
</script>

</body>
</html>