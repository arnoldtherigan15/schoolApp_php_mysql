<?php 
require 'function.php';
$mahasiswa = query("select * from mahasiswa;");


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
    <div class="container">
    <h5 style="text-decoration:underline;">
        <a class="text-dark" href="addForm.php">Add New Student</a>
    </h5>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">NRP</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mahasiswa as $person): ?>
                    <tr>
                        <th scope="row"><?= $person["id"]?></th>
                        <td>
                            <img src="./assets/<?= $person["gambar"]?>" alt="avatar" class="img-thumbnail" style="width:100px">
                        </td>
                        <td><?= $person["name"]?></td>
                        <td><?= $person["nrp"]?></td>
                        <td><?= $person["email"]?></td>
                        <td><?= $person["jurusan"]?></td>
                        <td>
                            <button type="button" class="btn btn-outline-warning">Edit</button>
                            <button type="button" class="btn btn-outline-danger">Delete</button>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</body>
</html>