<?php
$conn = mysqli_connect('localhost','root','','customer') or die('connection failed');
if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $website = mysqli_real_escape_string($conn, $_POST['website']);
   $skills = mysqli_real_escape_string($conn, $_POST['skills']);

   $select = mysqli_query($conn, "SELECT * FROM `enroll` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }
   else{
         $insert = mysqli_query($conn, "INSERT INTO `enroll`(name, email, gender, website, skills) VALUES('$name', '$email',  '$gender' , '$website', '$skills')") or die('query failed');
         if($insert){
            $message[] = 'Enrolled successfully!';
         }else{
            $message[] = 'Enrollment failed!';
         }
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="style.css">

</head>
<body class="body" style="bgcolor='green'">
   
<div class="form-container">

   <form action=" " method="post" enctype="multipart/form-data" class="form">
      <h3>Enroll now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" autocomplete="off" required><br>
      <input type="email" name="email" placeholder="enter email" class="box" autocomplete="off" required><br>
      <input type="text" name="gender" placeholder="Gender" class="box" autocomplete="off" required><br>
      <input type="link" name="website" placeholder="enter website link" autocomplete="off" class="box" required><br>
      <input type="text" name="skills" placeholder="enter skills" class="box"  autocomplete="off"required><br>
      <input type="submit" name="submit" value="Enroll Now" class="btn" href="register.php" onclick = "alert('Enrolled Successfully')">
      <input type="reset" name="clear" value="clear" class="btn" >
   </form>

</div>
<h1 class="head">Enrollment Details</h1>
<div class=div2 >
   <?php
   $sqlget = "select * from enroll";
   $sqldata=mysqli_query($conn,$sqlget)or die('error getting');
   ?>
   <table>
   <tr><th>NAME &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;</th><th>EMAIL &emsp; &emsp; 
      &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; </th>
   <th>GENDER &emsp; &emsp; &emsp;</th><th>WEBSITE LINK  &emsp; &emsp; &emsp; &emsp;</th><th>Skills</th></tr>
   <?php
   while($fetch=mysqli_fetch_assoc($sqldata)){
      echo "\r\n";
      echo  "<tr>";
      echo "<td>{$fetch['name']}</td>";
      echo "<td>{$fetch['email']}</td>";
      echo "<td>{$fetch['gender']}</td>";
      echo "<td>{$fetch['website']}</td>";
      echo "<td>{$fetch['skills']}</td>";
      echo " </tr>";
      echo "\n";
  }
  ?>
  </table>
   </div>
</body>
</html>