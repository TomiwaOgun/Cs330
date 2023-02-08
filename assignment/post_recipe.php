<?php
session_start();

if(!isset($_SESSION["uname"]))
{	
    header("Location: login_page.php");
    exit();
}


if (isset($_POST["submitted"]) && $_POST["submitted"]) {
    $recipe_name = trim($_POST["rt"]);
    $ingredients = trim($_POST["ingredients"]);
    $instructions = trim($_POST["instructions"]);
    $username = $_SESSION["uname"];

    $db = new mysqli("localhost", "ogunleto", "Tomisco1", "ogunleto");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $q = "SELECT * FROM Recipes WHERE recipe_name = '$recipe_name'";
       
    $r = $db->query($q);
    $row = $r->fetch_assoc();

    if($r1->num_rows > 0) {
        $validate = false;

    } 
    
    $rn_Len = strlen($recipe_name);
    if($recipe_name == null || $recipe_name == "" || $rn_Len > 50) 
    {
        $validate = false;
    }
        
    if($ingredients == null || $ingredients == "") 
    {
        $validate = false;
    }

    if($instructions == null || $instructions == "") 
    {
        $validate = false;
    }
    
    
    if($validate == true) {
        $q2 = "INSERT INTO Recipes (user_id, recipe_name, instructions, ingredients) VALUES ((SELECT user_id FROM Users WHERE username = '$username'), '$recipe_name', '$ingredients', '$instructions')";
       
        $r2 = $db->query($q2);
        $_SESSION["recipe_name"] = $row["recipe_name"];
        if ($r2 === true) {
            header("Location: recipe_list.php");
            $db->close();
            exit();
        }

    } 
    else {
        $error = "error has occured";
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
            <h1>Post Recipe </h1>
        </section>
        
        <aside class="right">
            <p id="username">
                Username
            </p>
        </aside>
        
        <section class ="main">
            <form id="Recipe" action="" method="post" >
                <input type="hidden" name="submitted" value="1"/>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_name" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Name of recipe:</td>
                        <td> <input type="text" id="recipe_name" name="rt" size="30"/></td>
                        <td> <p>Max characters is 50. Current character count: <b id="character_count">0</b> </p> </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_ing" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>list ingredients:</td>
                        <td> <textarea id="ingredients" name="ingredients" rows="5" cols="50"></textarea></td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><label id="msg_ins" class="err_msg"></label></td>
                    </tr>
                    <tr>
                        <td>Preperation instructions:</td>
                        <td> <textarea id="instructions" name="instructions" rows="5" cols="50"></textarea></td>
                    </tr>
                </table>

                <br><br>
                <input type="submit" value="submit"/><br>
            </form>
        </section>
        <section>
            <p id="advice" class="help_text">
                This box provides advice on filling out the form on this page.
            </p>
        
        </section>


        <script type = "text/javascript"  src = "post-r.js" ></script>
        <aside class="left">
            <a href="recipe_list.html">Main</a> <br>
            

        </aside>
       
    

    </body>

</html>
