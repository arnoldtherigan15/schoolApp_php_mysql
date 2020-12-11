<?php 
require 'function.php';
$notfound = true;
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC;");
if(count($mahasiswa)>0) {
    $notfound = false;
}
if(isset($_POST["keywoard"])) {
    $mahasiswa = search($_POST["keywoard"]);
    if(count($mahasiswa)>0) {
        $notfound = false;        
    } else {
        $notfound = true;
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
        <div class="container text-center">
            <h1 class="display-4">Happy School</h1>
            <p class="lead">A place to have fun. Say no to study</p>
        </div>
    </div>
    <div class="container">
    <div class="d-flex align-items-center mb-4">
        <h5 class="w-25 text-center" style="text-decoration:underline;">
            <a class="text-dark" href="addForm.php">Add New Student</a>
        </h5>
        <form method="post" class="w-75">
            <div class="md-form mt-0">
                <input class="form-control" name="keywoard" type="text" placeholder="Search" aria-label="Search">
            </div>
        </form>
    </div>
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
            <?php if(!$notfound):?>
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
                            <a class="btn btn-outline-warning" 
                                href="edit.php?id=<?= $person['id']?>">Edit</a>
                            <a class="text-danger btn btn-outline-danger" href="delete.php?id=<?= $person['id']?>"
                                onclick="return confirm('are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach?>
                <?php else :?>
                    <tr>
                        <td colspan="7"><h4>No Data ...</h4></td>
                    </tr>
                        
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>
</html>