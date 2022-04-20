<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
</body>
</html>
<?php 

require_once('config.php');
echo "<h1>Employee Lists</h1>";
// Show all employees


$stmt = $conn->prepare("SELECT employee_id, first_name, last_name, phone_number  FROM employees ORDER BY first_name, last_name");
$stmt->execute();

echo "<table style='border: solid 2px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th><th> Contact </th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch()) {
    echo "<tr><td>$row[employee_id] </td><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[phone_number]</td></tr>";
}

echo "</tbody>";
echo "</table>";
