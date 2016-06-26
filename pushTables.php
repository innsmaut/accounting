<?php
// Here we will push some data into tables to test how whole thing works

$testUsers = array(
array(1, 1),
array(2, 2),
);

$testEarnings = array(
array(1, '2016-01-05', 5.19),
array(2, '2016-01-25', 7.32),
array(1, '2016-01-25', 44.90),
array(2, '2016-01-05', 23.03),
array(1, '2016-02-05', 12.14),
array(1, '2016-02-25', 37.00),
array(2, '2016-02-25', 25.43),
array(2, '2016-02-05', 25.04),
array(1, '2016-03-05', 7.74),
array(2, '2016-03-25', 3.97),
array(1, '2016-03-05', 67.00),
array(1, '2016-03-05', 32.90),
array(2, '2016-04-05', 74.89),
array(1, '2016-04-05', 25.06),
array(2, '2016-04-25', 23.54),
array(2, '2016-04-25', 7.13),
array(1, '2016-05-05', 15.16),
array(1, '2016-05-25', 5.13),
array(2, '2016-05-05', 8.09),
array(1, '2016-05-25', 45.11),
array(1, '2016-06-25', 32.99),
array(2, '2016-06-05', 5.55),
array(2, '2016-06-05', 7.85),
array(1, '2016-06-05', 11.02),
array(2, '2016-06-25', 12.23),
array(1, '2016-06-05', 22.41),
array(1, '2016-06-25', 25.10),
array(2, '2016-06-25', 13.50),
array(2, '2016-06-25', 26.06),
array(1, '2016-06-25', 20.16),
);

$testPayed = array(
array(1, 9.00),
array(2, 20.00),
array(1, 55.00),
array(2, 50.00),
array(2, 10.00),
array(2, 22.00),
array(1, 100.00),
array(2, 27.00),
);

$servernme = "localhost";
$username = "username";
$password = "password";
$database = "accounting";

$conn = new mysqli($servernme, $username, $password, $database);

for ($i=0; $i<2; $i++) {
    $x = $testUsers[$i][0];
    $y = $testUsers[$i][1];
    $sql = "INSERT INTO users(user_id, hold_rule) VALUES ($x, $y)";
    if ($conn->query($sql)=== false) { 
        echo ("Error at input data into users: " . $conn->error);
    }
};

for ($i=0; $i<30; $i++) {
    $x = $testEarnings[$i][0];
    $y = $testEarnings[$i][1];
    $z = $testEarnings[$i][2];
    $sql = "INSERT INTO earnings(user_id, date, earned) VALUES ($x, '$y', $z)";
    if ($conn->query($sql)=== false) { 
        echo ("Error at input data into Earnings: " . $conn->error);
    }
};

for ($i=0; $i<8; $i++) {
    $x = $testPayed[$i][0];
    $y = $testPayed[$i][1];
    $sql = "INSERT INTO payments(user_id, paid_amount) VALUES ($x, $y)";
    if ($conn->query($sql)=== false) { 
        echo ("Error at input data into Payed: " . $conn->error);
    }
};
$conn->close();
?>
