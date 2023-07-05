<!-- 
	Created by: Yasumin Toothong (Millie) - 8/05/2023
	Modified last: Yasumin Toothong (Millie) - 23/05/2023
-->

<!DOCTYPE html>
<html>
    <head>
        <link href="styles/style.css" rel="stylesheet">
        <title>Insert Database</title>
    </head>

<header>
    <img class="headlogo" src="images/logo.png">
    <h1 id= "title" >CorpU University</h1>
     <div class="header-container">
      <nav> 
      <p class="menu"><a href="index.html"> <strong>Home Page</strong> </a></p>
      <p class="menu"><a href="benefit.html"><strong>Perks and Benefits</strong> </a> </p>
      <p class="menu"><a href="contact.html"><strong>Contact Us</strong></a>
   </nav>
  </div>
</header>
<body>
<?php
// This is to set variables to connect to the database
$host = "localhost";
$dbname = "corpu";
$username = "root";
$password = "";

// This is to create database connection using the provided credentials
$conn = mysqli_connect($host, $username, $password, $dbname);

// This is to check if the database connection fails and display an error message if it does
if (mysqli_connect_errno()) {
    die("Connection failed: ". mysqli_connect_error());
}

// This is a function to sanitise input data by removing leading/trailing whitespace, 
// backslashes, and converting special characters to HTML entities
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// This is to retrieve and sanitise variables for database insertion
if (!empty($_POST)) {
    $staff = sanitise_input($_POST['idnumber']);
    $firstname = sanitise_input($_POST['firstname']);
    $lastname = sanitise_input($_POST['lastname']);
    $contact = sanitise_input($_POST['mobilenumber']);
    $unit = sanitise_input($_POST['unit_id']);

    // This is to retrieve and sanitise schedule values as an array
    $schedule_values = isset($_POST['schedule']) && is_array($_POST['schedule']) ? $_POST['schedule'] : [];
    $schedule_string = "";
    foreach ($schedule_values as $value) {
        $schedule_string .= sanitise_input($value);
        if ($value !== end($schedule_values)) {
            $schedule_string .= ",";
        }
    }

    // This is to validate form data
    $errMsg = "";
    // Check if at least one checkbox is checked, if not check, the error message will be displayed
    if (!isset($_POST['schedule']) || empty($_POST['schedule'])) {
    $errMsg .= "<p class=\"errormsg\">⚠ You must select at least one schedule.</p>";
}

    // If the error message is not empty, it will display the message if any validation errors occur
    if ($errMsg != "") {
    echo "<p>$errMsg</p>";
    } else {
    // If there is no error message, insert data into the table
    $sql = "INSERT INTO timetable (staff_id, firstname, lastname, contact_no, unit_id, schedule) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssss', $staff, $firstname, $lastname, $contact, $unit, $schedule_string);
    
    // This is to execute the insert statement and display appropriate messages based on the result
    if (mysqli_stmt_execute($stmt)) {
        echo "<p class=\"errormsg\">Congratulations! Your application has been submitted. <br />You will receive an email once your schedule is confirmed.</p>";
    } else {
        echo "<p class=\"errormsg\">⚠Error: Application did not go through</p>";
    }
}
}
?>
</body>
</html>