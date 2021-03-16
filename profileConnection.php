<?php
session_start();
include 'config/database.php';

if (isset($_POST['show'])) {
    extract($_POST);
    if (!empty($name) && !empty($password)) {
        $query = $pdo->prepare("SELECT * FROM profile WHERE name = :name AND password = :password");
        $query->execute([
            'name' => $name,
            'password' => sha1($password)
        ]);
        $profile = $query->fetchAll();
        if (count($profile)) {
            $profile = current($profile);
            $_SESSION['user'] = $profile['id'];
            header("location:showprofile.php");
        } else {
            $error = "Profile not found";
        }
    } else {
        $error = "The fields are required";
    }
}

?>

<?php include 'layouts/header.php' ?>
<?php if (isset($error)) { ?>
    <p class="text-danger text-center my-5"><?= $error ?></p>
<?php } ?>
<form action="" method="post" class="col-md-4 mx-auto">
    <div class="m-4">
        <label for="">Name</label>
        <input type="text" class="form-control" name="name" value="<?php if (isset($_POST['name'])) echo $name ?>">
    </div>
    <div class="m-4">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="m-4">
        <button class="btn btn-secondary w-100" type="submit" name="show">Voir mon profile</button>
        <small>Or create your <a href="addprofile.php">profile</a></small>
    </div>
    <?php include 'layouts/footer.php' ?>