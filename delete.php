<?php 
require 'function.php';
$id = $_GET["id"];
if(deleteStudent($id) > 0) {
    echo "
        <script> 
            alert('delete data success'); 
            window.location.href='index.php'; 
        </script>";
} else {
    echo "
        <script> 
            alert('delete data error'); 
            window.location.href='index.php'; 
        </script>";
}
 ?>