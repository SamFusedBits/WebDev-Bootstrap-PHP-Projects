<?php
$con = mysqli_connect("localhost:3306","root","") or die("Connection failed!!!");               //Replace with your username and password(if any)
if($con)
echo"<br>Connection to database is Successful !!!";
else
echo"<br>Connection Failed !!!";


  if($con->query("create database if not exists ict"))
  echo "<br> Database created!!!";
  else
  echo "<br> Database you want to create already exists!!!";

// columns team name/country, no. of matches, matches won, lost, points

    if($con->query("use ict"))
        echo "<BR> ict selected for usage";
    else
        echo "<BR> ict doesn't exist!!!";

    echo "<HR><BR> creating table";
    $query= "create table if not exists ict2023(uname varchar(15),uno int(5),uwon int(5),ulost int(5),upoints int(5))";


    if($con->query($query))
        echo "<BR> table created !!!";
    else
        echo "<BR> table already exists !!!";
    
    if($stmt=$con->query("show tables")){

        echo "<hr><BR> there are total: ", $stmt->num_rows, " tables in database mysql";

        while($tab=$stmt->fetch_assoc()){
            echo "<BR> ", $tab["Tables_in_ict"];
        }
    }

   
    $ins_query = "insert into ict2023(uname,uno, uwon, ulost, upoints) values('India',12,11,1,11),('New Zealand',09,06,03,09),('Australia',12,12,0,12),('England',08,07,01,07)";
    if($con->query($ins_query))
     echo"<hr><br> team created";
    else
     echo"<br> problem while creating !!!";
    
    $show_query="select * from ict2023";
    if($stmt=$con->query($show_query)){
        echo"<hr><br>Table has: ",$stmt->num_rows, "records";
      
        while($rec=$stmt->fetch_assoc()){
            echo"<br>",$rec["uname"], " ", $rec["uno"], " ", $rec["uwon"], " ", $rec["ulost"], " ", $rec["upoints"];
        }
    }
    

?>