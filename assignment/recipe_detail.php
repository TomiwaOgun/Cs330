<?php
session_start();

if(!isset($_SESSION["uname"]))
{	
    header("Location: login_page.php");
    exit();
}

$id = $_SESSION["id"];
$username = $_SESSION["uname"];
$Rid = $_SESSION["recipe_id"];
$db = new mysqli("localhost", "ogunleto", "Tomisco1", "ogunleto");
if ($db->connect_error) 
{
    die ("Connection failed: " . $db->connect_error);
}

$q1 = "SELECT Users.username, Users.profile_pic, Recipes.recipe_name, Recipes.recipe_id, Recipes.DateCreated, Recipes.instructions, Recipes.ingredients, AVG(Ratings.rating) AS averageRating
FROM Recipes LEFT JOIN Users ON (Users.user_id = Recipes.user_id)
LEFT JOIN Ratings ON (Ratings.recipe_id = Recipes.recipe_id)
WHERE Recipes.recipe_id = '$Rid'
GROUP BY Recipes.recipe_id
ORDER BY Recipes.recipe_id DESC";   

$r1 = $db->query($q1);

if (isset($_POST["submitted"]) && $_POST["submitted"]) 
{

    $rating = $_POST["rating"];
  
    //$row1 = $r1->fetch_assoc()
  
    $q2 = "INSERT INTO Ratings (user_id, recipe_id, rating) VALUES ('$username', '$Rid', '$rating')";
    $r2 = $db->query($q2);


    if ($r2 === true) 
    {
        header("Location: recipe_detail.php");
        $db->close();
        //exit();
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="style_sheet.css"> 
        
    </head>

    <body class ="container">
        <section class ="top"> 
             <h1>Recipe details</h1>
        </section>

        <?php
        echo
            "<aside class='right'>
                <p id='username'>
                username: " . $username . "
                </p>
            </aside>"
        ?>

        <aside class="left">
            <a href="recipe_list.php">Main</a> <br>
            <a href="post_recipe.php">Post recipe</a> <br>


        </aside>

        <section class = "main"> 
         
            <?php
            
            
            if ($r1->num_rows > 0) 
            {
                while ($row1 = $r1->fetch_assoc())
                {
                    echo
                    "<article>
                    <h1>
                        <img src = 'Icon.jpeg' alt='icon'/> 
                        " . $row1['recipe_name'] .  " by " . $row1['username'] .  " 
                    </h1>
                    <p>
                        " . $row1['ingredients'] .  "
                    </p>
                    <p>
                        " . $row1['instructions'] .  "
                    </p>
                    <p>
                        " . $row1['avergeRating'] .  "
                    </p>
                    <form id='Rating' action='' method='post'>
                    <input type='hidden' name='submitted' value='1'/>
                    <p>
                        <label for='rating'>Rating (between 1 and 5):</label>
                        <input type='number' id='rating' name='rating' min='1' max='5'>
                        <input type='submit' value='submit rating'/><br>
                    </p>
                    </form>
                    

                    </article> ";
                }
            }     
            
            ?>
            <br>   
        </section>
       
        

    </body>

</html>
