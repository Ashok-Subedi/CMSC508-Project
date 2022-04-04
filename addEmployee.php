<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
    <h1>Add Employees</h1>
    
</body>
</html>

<?php 

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='addEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Phone</td><td><input name='phone_number' type='text' size='25'></td></tr>";
    echo "<tr><td>Salary</td><td><input name='salary' type='number' min='0.01' step='0.01' size='8'></td></tr>";
    echo "<tr><td>Manager</td><td>";
        
    // Retrieve list of employees as potential manager of the new employee
    $stmt = $conn->prepare("SELECT employee_id, first_name, last_name FROM employees");
    $stmt->execute();
    
    echo "<select name='manager_id'>";
    
    echo "<option value='-1'>No manager</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[employee_id]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";

    echo "<tr><td>Supervisior</td><td>";
    $stmt = $conn->prepare("SELECT employee_id, first_name, last_name FROM employees");
    $stmt->execute();

    echo "<select name='supervisior_id'>";
    
    echo "<option value='-1'>No supervisior</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[employee_id]'>$row[first_name] $row[last_name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td>Store</td><td>";
    
    // Retrieve list of departments
    $stmt = $conn->prepare("SELECT store_id, store_name FROM store");
    $stmt->execute();
    
    echo "<select name='store_id'>";
    
    echo "<option value='-1'>No store</option>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[store_id]'>$row[store_name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td>Location</td><td>";
    
    // Retrieve list of jobs
    $stmt = $conn->prepare("SELECT location_id, street_address FROM locations");
    $stmt->execute();
    
    echo "<select name='location_id'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[location_id]'>$row[street_address]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, phone_number, hire_date, supervisior_id, salary, location_id, manager_id, store_id)
                                VALUES (:first_name, :last_name, :email, :phone_number, CURDATE(), :supervisior_id, :salary, :location_id, :manager_id,  :store_id)");

        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':phone_number', $_POST['phone_number']);
        $stmt->bindValue(':store_id', $_POST['store_id']);
        $stmt->bindValue(':location_id', $_POST['location_id']);
        $stmt->bindValue(':salary', $_POST['salary']);
        
        if($_POST['manager_id'] != -1) {
            $stmt->bindValue(':manager_id', $_POST['manager_id']);
        } else {
            $stmt->bindValue(':manager_id', null, PDO::PARAM_INT);
        }

        if($_POST['supervisior_id'] != -1) {
            $stmt->bindValue(':supervisior_id', $_POST['supervisior_id']);
        } else {
            $stmt->bindValue(':supervisior_id', null, PDO::PARAM_INT);
        }
        
        if($_POST['location_id'] != -1) {
            $stmt->bindValue(':location_id', $_POST['location_id']);
        } else {
            $stmt->bindValue(':location_id', null, PDO::PARAM_INT);
        }
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";    
}
?>