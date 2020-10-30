<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
        
    <title>RecipeBook</title>
     
</head>
<body>

<!-- php code here -->

<?php
// define variables and set to empty values
$dishNameErr = $ServingsErr = $CookingTimeErr = $categoryErr = $ingredientsErr = $instructionsErr = "";
$dishName = $Servings = $CookingTime = $category = $ingredients = $instructions = "";

// checking if fields are left empty and if required to fill out, the message is displayed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["dishName"])) {
      $dishNameErr = "Dish name is required";
    } else {
      $dishName = test_input($_POST["dishName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$dishName)) {
        $dishNameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["Servings"])) {
        $Servings = "";
    } else {
        $Servings = test_input($_POST["Servings"]);
      //   check if servings is a number or a numeric string
        if(!is_numeric($Servings)) {
            $ServingsErr = "Only numbers are allowed";
        }
      }
    
    if (empty($_POST["CookingTime"])) {
        $CookingTime = "";
    } else {
        $CookingTime = test_input($_POST["CookingTime"]);
        //   check if CookingTime is a number or a numeric string
        if(!is_numeric($CookingTime)) {
          $CookingTimeErr = "Only numbers are allowed";
          }
      }

      if (empty($_POST["rating"])) {
         $rating = "";
     } else {
         $rating = test_input($_POST["rating"]);
         }

    if (empty($_POST["category"])) {
        $categoryErr = "Category is required";
    } else {
        $category = test_input($_POST["category"]);
        }

        if (empty($_POST["recipeID"])) {
         $recipeIDErr = "Dish number is required";
     } else {
         $recipeID = test_input($_POST["recipeID"]);
         }
     
    
    if (empty($_POST["ingredients"])) {
        $ingredientsErr = "Ingredients are required";
    } else {
        $ingredients = test_input($_POST["ingredients"]);
        }
        
        
    if (empty($_POST["instructions"])) {
        $instructionsErr = "Instructions are required";
    } else {
        $instructions = test_input($_POST["instructions"]);
        }
    
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // connecting to the server
$servername = "127.0.0.1:51010";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "localdb";
  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// insert values into the table (user input)
$sql = "INSERT INTO recipe (recipeID, RecipeName, Servings, PreparationTime, Ratings)
VALUES ('$recipeID', '$dishName', '$Servings', '$CookingTime', '$rating')";



  if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
 } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 $conn->close();
  
?>


<!-- Navigation -->
<nav class="navbar navbar-custom">
   <a class="navbar-brand">RecipeBook</a>
   <a href="drinks.php">Drinks</a>
   <a class="btn btn-primary" href="addnew.php" role="button">&#43; Add a recipe</a>
</nav>


<!-- Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <h4>Add a new recipe</h4>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <div class="form-group">
               <div class="row">
               <div class="col">
                      <label for="addPhoto">Add a photo</label> 
                  </div>
                  <div class="col">
                     <input type="file" class="form-control-file" id="addPhoto">
                  </div>
                </div>
            </div>
            <div class="form-group">
            <!-- I changed the type from email to text -->
            <!-- I added to all the fields name variables so they can be executed by php to display the inserted data -->
               <label>Name of the dish</label><input type="text" class="form-control" name="dishName" id="dishName" value="<?php echo $dishName;?>">
               <span class="error">* <?php echo $dishNameErr;?></span>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col"> 
               <select class="form-control" id="category" name="category" value="<?php echo $category;?>">
               <span class="error">* <?php echo $categoryErr;?></span>
                  <option selected>Category</option>
                  <option>Drinks</option>
                  <option disabled>Starters/Snacks</option>
                  <option disabled>Salads</option>
                  <option disabled>Main Courses</option>
                  <option disabled>Desserts</option>
               </select>
                  </div>
                  <div class="col">
                  <label>Dish number</label><input type="text" class="form-control" name="recipeID" value="<?php echo $recipeID;?>">
                  <span class="error">* <?php echo $recipeIDErr;?></span>   
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col">
                  <label>Number of servings</label><input type="text" class="form-control" name="Servings" value="<?php echo $Servings;?>">
                  <span class="error">* <?php echo $ServingsErr;?></span>
                  </div>
                  <div class="col">
                  <label>Cooking time</label><input type="text" class="form-control" name="CookingTime" value="<?php echo $CookingTime;?>">
                  <span class="error">* <?php echo $CookingTimeErr;?></span>
                  </div>
                  <div class="col">
                  <label>Rating</label><select class="form-control"  id="rating" name="rating">
                        value="<?php echo $rating;?>"<option selected>Rating</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Ingredients</label>
               <textarea class="form-control" name="ingredients" id="ingredients" rows="3" value="<?php echo $ingredients;?>"></textarea>
               <span class="error">* <?php echo $ingredientsErr;?></span>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Instructions</label>
               <textarea class="form-control" name="instructions" id="instructions" rows="3" value="<?php echo $instructions;?>"></textarea>
               <span class="error">* <?php echo $instructionsErr;?></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Add recipe</button>
         </form>
         <br>
         
         <!-- The code below is displayed after the user types data into the fields -->
         
         <?php
            echo "<h4>Your Input:</h4>";
            echo $dishName;
            echo "<br>";
            echo $Servings;
            echo "<br>";
            echo $CookingTime;
            echo "<br>";
            echo $category;
            echo "<br>";
            echo $rating;
            echo "<br>";
            echo $ingredients;
            echo "<br>";
            echo $instructions;
         ?>

      </div>
   </div>
</div>

<footer id="sticky-footer" class="py-4">
    <div class="container number-center">
      <small>Copyright &copy; Laura Pelkonen &amp; Aleksandra Postola 
         <?php
            echo date ('Y');
            ?>
         RecipeBook</small>
    </div>
  </footer>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>