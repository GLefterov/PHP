<?php
//This script retrieves all the records from the users table

$page_title = 'View the current users';
//include('includes/header.html');

//Page header:
echo '<h1> Registered users </h1>';
 
require('../mysqli_connect.php');

//Make the query:
$q = "SELECT last_name, first_name, user_id FROM users";
$r = @mysqli_query($dbc, $q);

if($r){
    echo '<table width="60%">
    <thead>
    <tr> 
    <th align="left"><strong>Edit</strong></th>
    <th align="left"><strong>Delete</strong></th>
    <th align="left"> Name </th>
    </tr>
    </thead>
    <tbody>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
    echo '<tr> 
    <td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
    <td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>

    <td align="left">' . $row['last_name'] . '</td>
    <td align="left">' . $row['first_name'] . '</td>
    ';
    
}
echo '</tbody></table>';

mysqli_free_result($r);
}
else{
    echo '<p class="error"> The current users could not be retrieved! We apologize for any inconvenience. </p>';

    echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
}
mysqli_close($dbc);
include('includes/footer.html');
?>



