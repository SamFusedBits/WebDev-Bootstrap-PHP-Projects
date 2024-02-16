<?php
$uname = $_REQUEST["uname"];
$uno = $_REQUEST["uno"];
$uwon = $_REQUEST["uwon"];
$ulost = $_REQUEST["ulost"];
$upoints = $_REQUEST["upoints"];
$action = $_REQUEST["action"];

if ($action == "Register"){
    insertUser($uname, $uno, $uwon, $ulost, $upoints);}
else if ($action == "ShowAll"){
    showAll();}
else if ($action == "update"){
    updateUser($uname, $uno, $uwon, $ulost, $upoints);}
else if ($action == "search"){
    searchUser($uname);}

function insertUser($uname, $uno, $uwon, $ulost, $upoints)
{
    $con = mysqli_connect("localhost:3306", "root", "", "ict");             //Replace with your username and database name

    if ($con) {
        $query = "insert into ict2023 values('$uname','$uno','$uwon','$ulost','$upoints')";

        if ($con->query($query))
            echo "<div class='alert alert-success' role='alert'>Record inserted successfully!</div>";
        else
            echo "<div class='alert alert-danger' role='alert'>Problem registering the team.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Database connection failed!</div>";
    }
}

function showAll()
{
    $con = mysqli_connect("localhost:3306", "root", "", "ict");

    if ($stmt = $con->query("select * from ict2023")) {
        echo "<div class='container mt-5'>";
        echo "<h1 class='text-center text-primary'>Records from ICC Table 2023</h1><hr>";
        echo "<h3 class='text-center text-danger'>There are total: " . $stmt->num_rows . " teams in the system</h3>";

        echo "<table class='table table-bordered table-striped table-info'>";
        echo "
            <thead>
            <th class='text-center'>Team Name</th>
            <th class='text-center'>No. of Matches Played</th>
            <th class='text-center'>Matches Won</th>
            <th class='text-center'>Matches Lost</th>
            <th class='text-center'>Total Points</th>
            </thead>";

        while ($rec = $stmt->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='text-center'>" . $rec['uname'] . "</td>";
            echo "<td class='text-center'>" . $rec['uno'] . "</td>";
            echo "<td class='text-center'>" . $rec['uwon'] . "</td>";
            echo "<td class='text-center'>" . $rec['ulost'] . "</td>";
            echo "<td class='text-center'>" . $rec['upoints'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}

function updateUser($uname, $uno, $uwon, $ulost, $upoints)
{
    $con = mysqli_connect("localhost:3306", "root", "", "ict");

    if ($con) {
        $query = "UPDATE ict2023 SET ";

        if (!empty($uno)) {
            $query .= "uno='$uno', ";
        }

        if (!empty($uwon)) {
            $query .= "uwon='$uwon', ";
        }

        if (!empty($ulost)) {
            $query .= "ulost='$ulost', ";
        }

        if (!empty($upoints)) {
            $query .= "upoints='$upoints', ";
        }
        // remove last comma and space from query string
        $query=rtrim("$query", ", ");

        // Add the WHERE clause
        $query .= " WHERE uname='$uname'";

        if ($con->query($query)) {
            echo "<div class='alert alert-success' role='alert'>Record updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Problem updating the team:   </div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Database connection failed!</div>";
    } if ($con->query($query)){
        echo"Query used  : ($query)";
        echo"<h2>Updated Records:</h2>";
        ShowAll();
    }
}


function searchUser($uname)
{
    $con = mysqli_connect("localhost:3306", "root", "", "ict");

    if ($con) {
        $query = "SELECT * FROM ict2023 WHERE uname='$uname'";

        $result = $con->query($query);

        if ($result) {
            echo "<div class='container mt-5'>";
            echo "<h2 class='text-center text-info'>Search Results</h2><hr>";
            echo "<table class='table table-bordered table-striped table-warning'>";
            echo "
            <thead>
            <th class='text-center'>Team Name</th>
            <th class='text-center'>No. of Matches Played</th>
            <th class='text-center'>Matches Won</th>
            <th class='text-center'>Matches Lost</th>
            <th class='text-center'>Total Points</th>
            </thead>";

            while ($rec = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='text-center'>" . $rec['uname'] . "</td>";
                echo "<td class='text-center'>" . $rec['uno'] . "</td>";
                echo "<td class='text-center'>" . $rec['uwon'] . "</td>";
                echo "<td class='text-center'>" . $rec['ulost'] . "</td>";
                echo "<td class='text-center'>" . $rec['upoints'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>No results found.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Database connection failed!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICC Worldcup Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>
