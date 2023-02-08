<?php
session_start();

if(isset($_SESSION["uname"]))
{
    echo "Welcome, logged in as:  " .$_SESSION['uname']. "<br />" ;	
    header("Location: recipe_list.php");
    exit();
}

$validate = true;
$error = "";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Bday = "/^\d{1,2}\/\d{1,2}\/\d{4}$/";
$reg_uname = "/^[a-zA-Z0-9_-]+$/";
$email = "";


$target_dir = "img_dir/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);


if (isset($_POST["submitted"]) && $_POST["submitted"]) 
{
    $target_dir = "img_dir/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uname = trim($_POST["uname"]);
    $email = trim($_POST["email"]);
    $date = $_POST["DOB"];
    $password = trim($_POST["pswd"]);
       
    $db = new mysqli("localhost", "ogunleto", "Tomisco1", "ogunleto");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
        
    }
    
    $q1 = "SELECT * FROM User WHERE email = '$email'";
    $r1 = $db->query($q1);

    if($r1->num_rows > 0) {
        $validate = false;
    } 
    
    else 
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false) {
            $validate = false;
        }

        $unameMatch = preg_match($reg_uname, $uname);
        if($uname == null || $uname == "" || $unameMatch == false) {
            $validate = false;
        }
              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $pswdMatch == false) {
            $validate = false;
        }

     
    }
    
    if($validate == true) 
    {

        $q2 = "INSERT INTO Users (username, email, password, dob, profile_pic) VALUES ('$uname', '$email', '$password', '$date', '$target_file')";
       
        $r2 = $db->query($q2);
        
        if ($r2 === true) 
        {
            header("Location: login_page.php");
            $db->close();
            exit();
        }

    } 
    else 
    {
        $error = " email address is not available. Signup failed.";
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
        <section class ="top">
            <h1>Sign up page </h1>
        </section>
        
        <section class ="main">
            <form id="SignUp" enctype="multipart/form-data" action="sign_up.php" method="post">
                <input type="hidden" name="submitted" value="1"/>
                <table>

                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_email" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td> <input type="text" name="email" id="email" size="30" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_uname" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td> <input type="text" name="uname" id="uname" size="30" /></td>
                    </tr>
        
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_pswd" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td> <input type="password" name="pswd" id="pswd" size="30" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_pswdr" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Confirm Password: </td>
                        <td> <input type="password" name="pswdr" id="pswdr" size="30" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_profile" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Profile picture:</td>
                        <td> <input type="file" id="img" name="img" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Date of birth:</td>
                        <td> <input type="date" id="DOB" name="DOB" size="30"/></td>
                    </tr>
                </table>
                <input type="submit" value="SignUp"/><br>
            </form>
            
            
            <script type = "text/javascript"  src = "validate-r.js" ></script>

            <p>
                Click <a href="../index.html">here</a> to go back to the main page!
            </p>
            <p>
                Click <a href="login_page.php">here</a> to go back to the login page
            </p>
        </section>
       
        <section class="right">
            <p id="advice" class="help_text">
                This box provides advice on filling out the form on this page.
            </p>
        
        </section>
        
    </body>

</html>
