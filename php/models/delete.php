<?php
require("php/models/dataManager.php");

$id = $_GET['id'];
delete($id);
header('location: admin');
