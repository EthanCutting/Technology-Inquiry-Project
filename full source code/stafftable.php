<!-- 
	Created by: Yasumin Toothong (Millie) - 8/05/2023
	Modified last: Yasumin Toothong (Millie) - 23/05/2023
-->

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8" />
<meta name="description" content="Technology Inquiry Project" />
<meta name="keywords" content="HTML, CSS, JS" />
<meta name="author" content="Team" />
<title>Sessional Staff Interested</title>
<link href="styles/style.css" rel="stylesheet">
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
    <div id="staffborder">
    <h1 id="stafftitle">List of Staff Interested in Units</h1>
    <p id="staffdesc">Below is a table displaying the list of staff who are interested in the units:</p>
    <table id="stafftable"> <!--This is to create a table for the list of staff-->
           <tr>
               <th scope="col">Staff ID</th>
               <th scope="col">First Name</th>
               <th scope="col">Last Name</th>
               <th scope="col">Contact Number</th>
               <th scope="col">Unit ID</th>
               <th scope="col">Schedule</th>
               <th scope="col">Status</th>
               <th scope="col">Action</th>
               <th scope="col">Delete</th>
           </tr>
       <?php
// This is to set up connection to the database
$conn = mysqli_connect("localhost", "root", "", "corpu");

// This is to check if the connection was successful and if not, display an error message and stop
if ($conn->error) {
    die("Connection failed: " . $conn->error);
}

// This is to check if the application ID and status are set for updating
if (isset($_GET['app_id']) && isset($_GET['status'])) {
    $appid = $_GET['app_id'];
    $status = $_GET['status'];
    
    // SQL for updating the status in the database
    $sql = "UPDATE timetable SET status='$status' WHERE app_id='$appid'";
    $conn->query($sql);
    
    // Redirect back to the staff table page
    header("location: stafftable.php");
    die();
}

// This is to check if the 'delete' parameter is set in the URL to initiate the deletion process
if (isset($_GET['delete'])) {
    $delete = $_GET['delete']; // Store the value of the 'delete' parameter for further processing

    // SQL for deleting the record from the database
    $sql = "DELETE FROM timetable WHERE app_id='$delete'";
    $conn->query($sql);

    // Redirect back to the staff table page
    header("location: stafftable.php");
    die();
}

// This is to show all records from the "timetable" table
$sql = "SELECT * FROM timetable";

// This is to execute the query and store the result in the "$result" variable
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // This is to iterate over each row and display the data in an HTML table row
    while ($row = $result->fetch_assoc()) {
        $status = '';
        if ($row["status"] == 1) {
            $status = 'Pending'; // status 1 means pending
        } elseif ($row['status'] == 2) {
            $status = 'Accept'; // status 2 means accept
        } elseif ($row['status'] == 3) {
            $status = 'Reject'; // status 3 means reject
        }
        // This is to display table rows with staff data
        echo '<tr>';
        echo '<td>' . $row["staff_id"] . '</td>';
        echo '<td>' . $row["firstname"] . '</td>';
        echo '<td>' . $row["lastname"] . '</td>';
        echo '<td>' . $row["contact_no"] . '</td>';
        echo '<td>' . $row["unit_id"] . '</td>';
        echo '<td>' . $row["schedule"] . '</td>';
        echo '<td>' . $status . '</td>';
        echo '<td>';
        echo '<select id="my-dropdown" onchange="status_update(this.options[this.selectedIndex].value,' . $row['app_id'] . ')">';
        echo '<option value="">Update Status</option>';
        echo '<option value="1">Pending</option>';
        echo '<option value="2">Accept</option>';
        echo '<option value="3">Reject</option>';
        echo '</select>';
        echo '</td>';
        echo '<td>';
        echo '<button class="delete" onclick="delete_row(' . $row['app_id'] . ')">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }
    echo "</table>"; // close the HTML table
} else {
    echo "";
}

// This is to close the database connection
$conn->close();
?>
</table>
</div>
<script type="text/javascript">  
    // JavaScript function to update status
    function status_update(value,appid){  
           let url = "stafftable.php";  
           // Redirects to the PHP script with the app ID and new status as query parameters
           window.location.href= url+"?app_id="+appid+"&status="+value; 
      }
    // JavaScript function to delete a row
    function delete_row(appid) {
            let confirm_delete = confirm("Are you sure you want to delete this record?");
            if (confirm_delete) {
                let url = "stafftable.php";
                // Redirects to the PHP script with the app ID as a query parameter for deletion
                window.location.href = url + "?delete=" + appid; 
            }}
 </script>  
</body>
</html>