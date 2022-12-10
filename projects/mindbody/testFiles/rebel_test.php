<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php require_once 'myFunc.php'; ?>

<form action="rebel_test.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

<?php 
   echo $_POST['name']; 
   echo $_POST['email'];   
?>

</body>
</html> 

