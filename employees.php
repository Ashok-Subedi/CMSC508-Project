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
