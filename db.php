<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"ams_db"
);

if(!$conn)
{
    die("Database Connection Failed");
}

?>