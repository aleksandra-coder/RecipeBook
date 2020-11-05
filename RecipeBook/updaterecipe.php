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

<?php 
  // connecting to the server
  require_once "config.php";
    
  //  refering to application constants
  require_once "appvars.php";

// define variables and set to empty values
$dishNameErr = $ServingsErr = $CookingTimeErr = $ingredientsErr = $instructionsErr = $addPhotoErr = "";
$dishName = $Servings = $CookingTime = $rating = $ingredients = $instructions = $addPhoto = "";

//  input validation

$dishName = test_input($_POST['dishName']);
if (!preg_match("/^[a-zA-Z-' ]*$/",$dishName)) {
    $dishNameErr = "Only letters and white space allowed";
  }

$CookingTime = test_input($_POST["CookingTime"]);
  //   check if CookingTime is a number or a numeric string
if(!is_numeric($CookingTime)) {
    $CookingTimeErr = "Only numbers are allowed";
    }

$Servings = test_input($_POST["Servings"]);
    //   check if Servings is a number or a numeric string
if(!is_numeric($Servings)) {
      $ServingsErr = "Only numbers are allowed";
      }

$rating = test_input($_POST["rating"]);

$ingredients = test_input($_POST["ingredients"]);
                    
$instructions = test_input($_POST["instructions"]);
                
$addPhoto = test_input($_POST["addPhoto"]);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//  sql to update records from recipe table
$sql = "UPDATE recipe SET Servings ='$Servings', PreparationTime ='$CookingTime', Ratings = '$rating', Ingredients ='$ingredients', Instructions ='$instructions', Images ='$addPhoto' WHERE RecipeName = '$dishName'";

if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "". $conn->error;
  }
  
  $conn->close();
   
?>

<!-- Navigation -->
<nav class="navbar navbar-custom p-3">
   <a class="navbar-brand">RecipeBook</a>
   <a href="drinks.php">Drinks</a>
</nav>


<!-- Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <h4>Update your recipe</h4>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
               <div class="row">
               <div class="col">
                      <label for="addPhoto">Change a photo</label> 
                  </div>
                  <div class="col">
                     <input type="file" class="form-control-file" id="addPhoto" name="addPhoto">
                  </div>
                </div>
            </div>
            <div class="form-group">
               <label>Name of the dish</label><input type="text" class="form-control" name="dishName" id="dishName" value="<?php echo $dishName;?>">
               <span class="error">* <?php echo $dishNameErr;?></span>
            </div>           
            <div class="form-group">
               <div class="row">
                  <div class="col">
                  <label>Change number of servings</label><input type="text" class="form-control" name="Servings" value="<?php echo $Servings;?>">
                  <span class="error">* <?php echo $ServingsErr;?></span>
                  </div>
                  <div class="col">
                  <label>Change cooking time (min)</label><input type="text" class="form-control" name="CookingTime" value="<?php echo $CookingTime;?>">
                  <span class="error">* <?php echo $CookingTimeErr;?></span>
                  </div>
                  <div class="col">
                  <label>Change rating</label><select class="form-control"  id="rating" name="rating">
                        <option selected>Rating</option>
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
               <label for="exampleFormControlTextarea1">Update ingredients</label>
               <textarea class="form-control" name="ingredients" id="ingredients" rows="3" value="<?php echo $ingredients;?>"></textarea>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Update instructions</label>
               <textarea class="form-control" name="instructions" id="instructions" rows="3" value="<?php echo $instructions;?>"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="submit" value="Submit">Update recipe</button>
         </form>
         <br>
         
         <!-- The code below is displayed after the user types data into the fields -->
         
         <?php
            echo "<h4>Your updated recipe:</h4>";
            echo $dishName;
            echo "<br>";
            echo $Servings;
            echo "<br>";
            echo $CookingTime;
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

<footer class="footer-copyright text-center py-3">
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