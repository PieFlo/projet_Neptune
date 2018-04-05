<?php
session_start();
include('connectionBDD.php');
$query = $bdd->query("SELECT * FROM clients"); // mysql_fetch_query





?>