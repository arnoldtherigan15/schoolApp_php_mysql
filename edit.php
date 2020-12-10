<?php 
require 'function.php';
$id = $_GET["id"];
$mahasiswa = query("select * from mahasiswa where id = $id;")[0];
if(isset($_POST["submit"])) {
    if(editStudent($_POST) > 0) {
        echo "
        <script> 
            alert('Success Edit Data'); 
            window.location.href='index.php'; 
        </script>";
    } else {
        echo "
        <script> 
            alert('Error while creating student');
        </script>";
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>School App</title>
</head>
<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Happy School</h1>
            <p class="lead">A place to have fun. Say no to study</p>
        </div>
    </div>
    <div class="container d-flex flex-column align-items-center">
        <h2 class="text-center">Edit Student Data</h2>
        <form method="post" class="my-5 w-50" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mahasiswa['id']?>">
            <input type="hidden" name="gambarLama" value="<?= $mahasiswa['gambar']?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $mahasiswa['name']?>">
            </div>
            <div class="form-group">
                <label for="nrp">NRP</label>
                <input type="text" class="form-control" id="nrp" name="nrp" value="<?= $mahasiswa['nrp']?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $mahasiswa['email']?>">
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $mahasiswa['jurusan']?>">
            </div>
            <div class="d-flex align-items-end mb-4">
                <img class="mr-4 rounded" src="assets/<?= $mahasiswa['gambar']?>" alt="image" style="width:100px;">
                <div class="custom-file">
                    <input type="file" name="gambar" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</body>
</html>