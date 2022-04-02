<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='addEmployee.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
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

    echo "<tr><td>Customer</td><td>";

    // Retrieve list of jobs
    $stmt = $conn->prepare("SELECT customer_id, concat(first_name, ', ', last_name) Name FROM customers");
    $stmt->execute();

    echo "<select name='customer_id'>";

    while ($row = $stmt->fetch()) {
        echo "<option value='$row[customer_id]'>$row[Name]</option>";
    }

    echo "</select>";
    echo "</td></tr>";

    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";

    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {

    try {
        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, hire_date, job_id, salary, manager_id, store_id)
                                VALUES (:first_name, :last_name, :email, CURDATE(), :job_id, :salary, :manager_id, :store_id)");

        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':customer_id', $_POST['customer_id']);
        $stmt->bindValue(':salary', $_POST['salary']);

        if ($_POST['manager_id'] != -1) {
            $stmt->bindValue(':manager_id', $_POST['manager_id']);
        } else {
            $stmt->bindValue(':manager_id', null, PDO::PARAM_INT);
        }

        if ($_POST['store_id'] != -1) {
            $stmt->bindValue(':store_id', $_POST['store_id']);
        } else {
            $stmt->bindValue(':store_id', null, PDO::PARAM_INT);
        }

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";
}
