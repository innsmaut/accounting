<?php 
 //Uncomment first file to create database and tables, and second to push test data into tables.
 //include 'checkTables.php'; 
 //include 'pushTables.php';
 include 'getDataFromTables.php';
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
        <style>
            table, th, tr {
               border:  1px solid black;
               text-align: center;
               vertical-align: top
            }
        </style>
    </head>
    <body>
            <?php
                echo ("
        <h4>Accounting data</h4>
        <table>
            <tr>
                <th>UserID</th>
                <th>Earned</th>
                <th>Paid</th>
                <th>To pay</th>
                <th>Ballance</th>
                <th>To pay next time</th>
            </tr>
                ");
                for ($i = 0; $i < $length; $i++){
                    echo ("
            <tr>
                <td>$uid[$i]</td>
                <td onclick='this.childNodes[1].hidden = Math.abs(this.childNodes[1].hidden - 1);'>$earnbyid[$i]
                    <ol hidden>
                    ");
                    for ($y = 0; $y < 8; $y++) {
                        $k = $earnperiod[$i][$y];
                        echo ("<li>".$k."</li>");
                    }
                echo ("
                    </ol>
                </td>
                <td>$paidtoid[$i]</td>
                <td>$topaynow[$i]</td>
                <td>$ballanceid[$i]</td>
                <td>$topaynext[$i]</td>
            </tr>
                    ");
                }
                echo ("</table>");
            ?>

    </body>
</html>
