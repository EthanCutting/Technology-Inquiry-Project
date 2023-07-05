<!-- 
	Created by: Yasumin Toothong (Millie) - 05/05/2023
    Add Authorization by: Isaraporn Limratchapong (Magic) - 10/05/2023
	Modified last: Isaraporn Limratchapong (Magic)  - 25/05/2023
-->
<!DOCTYPE html>
<html>
    <head>
        <link href="styles/style.css" rel="stylesheet">
        <title>Home</title>
    </head>

<header>
    <img class="headlogo" src="images/logo.png">
    <h1 id= "title" >CorpU University</h1>
     <div class="header-container">
      <nav> 
      <p class="menu"><a href="index.html"> <strong>Home Page</strong> </a></p>
      <p class="menu"><a href="benefit.html"><strong> Perks and Benefits</strong> </a> </p>
      <p class="menu"><a href="contact.html"><strong>Contact Us</strong></a>
   </nav>
  </div>
</header>
<body>
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "corpu";

// Create connection (Created by millie)
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection if it is not successful show error message
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!empty($_POST)){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Get the first letter of the username
    $first_letter = substr($username, 0, 1);
    
    // Check the first string of usernane, assign role to them, and then redirect to specific page according to the role (created by magic )
    if($first_letter == '1') {
        $role = 'admin';
        $redirect_url = 'stafftable.php';
    } else if ($first_letter == '2') {
        $role = 'teacher';
        $redirect_url = 'unitlist.html';
    } else {
        $role = '';
        $redirect_url = '';
    }

    // SQL query to retrieve all rows from table where username, password, role are matched  (created by magic)
    $query = "SELECT * FROM login WHERE username='$username' AND password=$password AND role='$role'";
    $result = mysqli_query($conn, $query);


    if(mysqli_num_rows($result) > 0) {
        // if there is matching row, then to user can sucessfully login to specific page(Created by millie)
        // if no matching row, then return error message
        header("Location: $redirect_url");
        echo "<p class=\"errormsg\">⚠ Login successful</p>";
        exit();
    } else {
        echo "<p class=\"errormsg\">⚠ Your account is invalid </p>";
    }
}
mysqli_close($conn);
?>

</body>
</html>