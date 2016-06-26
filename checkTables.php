<?php
// Create DB and required test tables

$servernme = "localhost";
$username = "username";
$password = "password";
$database = "accounting";

$conn = new mysqli($servernme, $username, $password);

// Let's check the connection.
if ($conn->connect_error) {
    die ("Connection error: " . $conn_>connect_error);
} else {
    $conn = new mysqli($servernme, $username, $password, $database);
    if ($conn->connect_error) {
        // If there is no database, create one.
        $conn = new mysqli($servernme, $username, $password);
        $sql = "CREATE DATABASE $database";
        if ($conn->query($sql) === true) {
            echo "Database created";
        } else {
            die ("Eror in creating database: " . $conn->error);
        }
    }
    // Trying to get access to database once again
    $conn = new mysqli($servernme, $username, $password, $database);
    if ($conn->connect_error) {
        die ("Unexpected error while connecting to existing database: " . $conn->connect_error);
    }

    // Creating tables, that we need
    $sql = "CREATE TABLE users(
    user_id INT,
    hold_rule SMALLINT
    )";
    if ($conn->query($sql) === true) {
        echo ("Table 'Users' created");
    } else {
        //echo ("Error while creating table 'Users': " . $conn->error);
    }

    $sql = "CREATE TABLE earnings(
    user_id INT,
    date DATE,
    earned DECIMAL(8, 2)
    )";
    if ($conn->query($sql) === true) {
        echo ("Table 'Earnings' created");
    } else {
        //echo ("Error while creating table 'Earnings': " . $conn->error);
    }

    $sql = "CREATE TABLE payments(
    user_id INT,
    paid_amount DECIMAL(8, 2)
    )";
    if ($conn->query($sql) === true) {
        echo ("Table 'Payments' created");
    } else {
        //echo ("Error while creating table 'Payments': " . $conn->error);
    }
}

$conn->close();
?>