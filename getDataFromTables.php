<?php
//Here we will extract some data.

$servernme = "localhost";
$username = "username";
$password = "password";
$database = "accounting";

$conn = new mysqli($servernme, $username, $password, $database);

$sql = "SELECT user_id FROM users";
$result = $conn->query($sql);
$length = $result->num_rows;
// Get main stats for all users.
for ($i = 0; $i < $length; $i++) {
    $uid[$i] = $i + 1;
    $earnbyid[$i] = getTotal($i, $conn, 'earned', 'earnings', "");
    $paidtoid[$i] = getTotal($i, $conn, 'paid_amount', 'payments', "");
    $ballanceid[$i] = $earnbyid[$i] - $paidtoid[$i];
    $hold_rule[$i] = getTotal($i, $conn, 'hold_rule', 'users', "");
    //Cases depends on counter being odd or not, and on current number of the day in month.
    for ($j = 0; $j < 8; $j++) {
        if ($j%2==0) {
            $cond = " AND (((DAY(CURDATE())>=16 AND MONTH(CURDATE())-MONTH(date)=0+$j/2 AND DAY(date)<=16)) OR 
                           ((DAY(CURDATE())<16 AND MONTH(CURDATE())-MONTH(date)=1+$j/2 AND DAY(date)>16)))";
        } else {
            $cond = " AND (((DAY(CURDATE())>=16 AND MONTH(CURDATE())-MONTH(date)=(1+$j)/2 AND DAY(date)>16)) OR 
                           ((DAY(CURDATE())<16 AND MONTH(CURDATE())-MONTH(date)=(1+$j)/2 AND DAY(date)<=16)))";
        };
        $earnperiod[$i][$j] = getTotal($i, $conn, 'earned', 'earnings', $cond);
    }
    //Calculating data that depends on hold rule
    for ($k = 0; $k < 8; $k++) {
        if ($k < 8  - $hold_rule[$i]) {
            $topaynow[$i] += $earnperiod[$i][$k];
        } else {
            $topaynext[$i] += $earnperiod[$i][$k];
        }
    };
};

// Function to get data from tables
function getTotal($uid, $conn, $column, $tab, $addcond) {
    $uid = 1+$uid;
    $sql = "SELECT SUM($column) AS summary FROM $tab WHERE user_id=$uid".$addcond;
    if ($conn->query($sql)->error === true) {
        return $conn->error;
    } else {
        $assoc = mysqli_fetch_assoc($conn->query($sql));
        if ($assoc["summary"]!==NULL) {
            return $assoc["summary"];
        } else {
            return 0;
        }
    };
}
$conn->close();
?>