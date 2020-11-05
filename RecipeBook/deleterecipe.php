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

// define variable and set to empty value
$dishName = "";
$dishNameErr = "";

//  input validation
$dishName = test_input($_POST['dishName']);
if (!preg_match("/^[a-zA-Z-' ]*$/",$dishName)) {
    $dishNameErr = "Only letters and white space allowed";
  }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
//  sql to delete a record from recipe table
$sql = "DELETE FROM recipe WHERE RecipeName = '$dishName'";

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
         <h4>Delete a recipe</h4>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
            <div class="form-group">
               <label>Name of the dish you want to delete</label><input type="text" class="form-control" name="dishName" id="dishName" value="<?php echo $dishName;?>">
               <span class="error">* <?php echo $dishNameErr;?></span>
            </div>
            <button type="submit" class="btn btn-warning" name="submit" value="Submit">Delete recipe</button>
            <button type="cancel" class="btn btn-secondary" name="cancel" value="Cancel">Cancel</button>
         </form>

         <!-- The code below is displayed after the user deletes data -->
         
       
         <?php
            echo "<h4>You deleted this recipe:</h4>";
            echo $dishName;
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