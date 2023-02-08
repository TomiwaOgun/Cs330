<?php
session_start();

if(isset($_SESSION["uname"]))
{
   
    header("Location: recipe_list.php");
    exit();
}
$validate = true;
$reg_uname = "/^[a-zA-Z0-9_-]+$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$uname = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"]) {
    $uname = trim($_POST["uname"]); 
    $password = trim($_POST["pswd"]);
    
    $db = new mysqli("localhost", "ogunleto", "Tomisco1", "ogunleto");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $q = "SELECT * FROM Users WHERE username = '$uname' AND password = '$password' ";
       
    $r = $db->query($q);
    $row = $r->fetch_assoc();
    if($uname != $row["uname"] && $password != $row["password"]) {
        $validate = false;

    } else {
        $unameMatch = preg_match($reg_uname, $uname);
        if($uname == null || $uname == "" || $unameMatch == false) {
            $validate = false;
        }
        
        $pswdLen = strlen($password);
        $passwordMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false) {
            $validate = false;
        }
    }
    
    if($validate == true) {
        session_start();
        $_SESSION["uname"] = $row["username"];
        $_SESSION["id"] = $row["user_id"];
        header("Location: recipe_list.php");
        $db->close();
        exit();

    } else {
        $error = "The username/password combination was incorrect. Login failed.";
        echo $error;
        $db->close();
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css">
        <script type="text/javascript" src="validate.js"></script>
    </head>

    <body class ="container">
        <section class="top">
            <h1>Login page </h1>
        </section>
        <section class="main">
            <form id="Login" action="" method="post">
                <input type="hidden" name="submitted" value="1"/>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_uname" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td> <input type="text" name="uname" size="30" /></td>
                    </tr>
        
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_pswd" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td> <input type="password" name="pswd" size="30" /></td>
                    </tr>
            
                </table>
                <input type="submit" value="Login"/><br>
            </form>
            <script type = "text/javascript"  src = "login-r.js" ></script>
            <p>
                Click <a href="sign_up.php">here</a> to go signup!
            </p>
        </section>
    </body>

</html>
