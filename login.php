<?php
session_start();

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Administrator
    if($email == "misbah112@gmail.com" && $password == "123")
    {
        $_SESSION['user'] = "admin";
        header("Location: admin_dashboard.php");
        exit();
    }

    // Accounts Manager
    elseif($email == "fiza123@gmail.com" && $password == "112")
    {
        $_SESSION['user'] = "manager";
        header("Location: manager_dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Wrong Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>AMS Login</title>

<style>

body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#9ad9ce;
}

.login-box{
    width:350px;
    background:white;
    padding:30px;
    margin:120px auto;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:#3f9d92;
    margin-bottom:20px;
}

label{
    display:block;
    font-weight:bold;
    margin-top:10px;
    margin-bottom:5px;
    color:#333;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
    margin-bottom:10px;
}

button{
    width:100%;
    padding:12px;
    background:#3f9d92;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#2d7f76;
}

</style>
</head>

<body>

<div class="login-box">

    <h2>AMS Login</h2>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="login">Login</button>

    </form>

</div>

</body>
</html>