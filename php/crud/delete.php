<?php
require ("php/datamanager/datamanager.php");

$id = $_GET['id'];
delete($id);
header('location: admin');
