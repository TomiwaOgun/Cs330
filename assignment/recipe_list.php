<?php
session_start();

if(!isset($_SESSION["uname"]))
{	
    header("Location: login_page.php");
    exit();
}

$id = $_SESSION["id"];
$username = $_SESSION["uname"];
$avg_rate = 0;
$db = new mysqli("localhost", "ogunleto", "Tomisco1", "ogunleto");
if ($db->connect_error) {
    die ("Connection failed: " . $db->connect_error);
}

$q1 = "SELECT Users.username, Users.profile_pic, Recipes.recipe_name, Recipes.recipe_id, Recipes.DateCreated, Recipes.instructions, Recipes.ingredients, AVG(Ratings.rating) AS averageRating
FROM Recipes LEFT JOIN Users ON (Users.user_id = Recipes.user_id)
LEFT JOIN Ratings ON (Ratings.recipe_id = Recipes.recipe_id)
GROUP BY Recipes.recipe_id
ORDER BY Recipes.recipe_id DESC
LIMIT 20";   


 
$r1 = $db->query($q1);

$db->close();


?>


<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css"> 
        
    </head>

    <body class ="container">
        <section class ="top"> 
             <h1>Recipe list </h1>
        </section>

        <?php
        echo
            "<aside class='right'>
                <p id='username'>
                " . $username . "
                </p>
            </aside>"
        ?>
        
        <aside class="left">
            <a href="login_page.php">Login</a> <br>
            <a href="sign_up.php">Sign up</a> <br>
            <a href="post_recipe.php">Post recipe</a> <br>

        </aside>

        <section class = "main"> 
            <form class="search">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            
            <?php
            
            if ($r1->num_rows > 0) 
            {
                while ($row = $r1->fetch_assoc()) 
                {

                    echo 
                    "<article>
                    <p>
                        <img src = ". $row['profile_pic'] ." alt='icon'/> 
                        <a href='recipe_detail.php'>" . $row['recipe_name'] . "</a> by " . $row['username'] . "
                    </p>
                    <p>
                        " . $row['instructions'] . "
                    </p>
                    <p>
                        Average rating is " . $row['averageRating'] . "
                    </p>
                    
                    </article>
                    <br>";
                  
                   
                    $GLOBALS["recipe_id"] = $row["recipe_id"];
                    $_SESSION["recipe_id"] = $row["recipe_id"];
             
                }
               
            }
            ?>
            
            
       </section>
       
        

    </body>

</html>