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
// if (isset($_POST['submit'] 
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
      
      //   adding photos, first setting variables
        $addPhoto = $_FILES['addPhoto'];

        $fileName = $_FILES['addPhoto']['name'];
        $fileTmpName = $_FILES['addPhoto']['tmp_name'];
        $fileSize = $_FILES['addPhoto']['size'];
        $fileError = $_FILES['addPhoto']['error'];
        $fileType = $_FILES['addPhoto']['type'];

      //   defining files extensions
        $fileExt = explode( '.', $fileName );
        $fileActualExt = strtolower(end($fileExt));
// which extensions are allowed
        $allowed = array('jpg', 'jpeg', 'gif', 'png');

      // defining what criteria must be met, file size, name
      if (!empty($_POST["addPhoto"])) {
         if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
               if ($fileSize <= MAX_FILE_SIZE) {
                  // creating unique file name and path
                  $fileDestination = RECIPE_UPLOAD_PATH . time() . $addPhoto; 
                  // moving the the images folder
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  header("Location: drinks.php?uploadsuccess");
               } else {
                  echo "Your file is too big.";
               }
            } else {
               echo "There was an error uploading your file.";
            }
        } else {
           echo "You cannot upload files of this type.";
        }
      } else {
         echo "You didn't upload any file";
      }
 }
    

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // connecting to the server
require_once "config.php";
    
//  refering to application constants
require_once "appvars.php";
    
//Next query is to count the recipeID of a new recipe according to the amount of existing recipes
$query = "SELECT recipeID FROM recipe"; // to fetch recipeIDs from the table

$result = mysqli_query($conn, $query); // execute the query and store the result set 
      
    if ($result) 
    { 
        // return the number of rows in the table
        $row = mysqli_num_rows($result); 
          
           if ($row) 
              { 
                 $row++; //the number of rows will be added by one
              } 
              
        mysqli_free_result($result); // close the result
    } 



    // insert values into the table (user input)
     $sql = "INSERT INTO recipe (recipeID, RecipeName, Servings, PreparationTime, Ratings, Ingredients, Instructions, Images, DateAdded, TimeAdded)
     VALUES ('$row', '$dishName', '$Servings', '$CookingTime', '$rating', '$ingredients', '$instructions', '$addPhoto', CURDATE(), CURTIME())";  




  if ($conn->query($sql) === TRUE) {
   echo "";
   header("location: drinks.php");
 } else {
   echo "";
 }
 
 $conn->close();
  
?>


<!-- Navigation -->
<nav class="navbar navbar-custom p-3">
   <a class="navbar-brand">RecipeBook</a>
   <a href="drinks.php">Drinks</a>
   <a class="btn btn-primary" href="addnewrecipe.php" role="button">&#43; Add a recipe</a>
   <a class="btn btn-warning" href="deleterecipe.php" role="button">Delete a recipe</a>
   <a class="btn btn-success" href="updaterecipe.php" role="button">Update a recipe</a>
   <a class="btn btn-primary" href="logout.php" role="button">Logout</a>
</nav>


<!-- Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <h4>Add a new recipe</h4>
         <!-- This enctype attribute tells that we will be adding files like images -->
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="form-group">
               <div class="row">
               <div class="col">
                      <label for="addPhoto">Add a photo</label> 
                      <input type="hidden" name="max_file_size" value="MAX_FILE_SIZE">
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
                  <label>Number of servings</label><input type="text" class="form-control" name="Servings" value="<?php echo $Servings;?>">
                  <span class="error">* <?php echo $ServingsErr;?></span>
                  </div>
                  <div class="col">
                  <label>Cooking time (min)</label><input type="text" class="form-control" name="CookingTime" value="<?php echo $CookingTime;?>">
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