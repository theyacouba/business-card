<?php
session_start();

require 'config/database.php';

if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($name) && !empty($password) && !empty($password_confirm)) {
        if (mb_strlen($password) < 4 && mb_strlen($password_confirm) < 4) {
            $error = "Password too short";
        } else if ($password !== $password_confirm) {
            $error = "Passwords do not match ";
        } else {
            $query =  $pdo->prepare("INSERT INTO profile(name,company_name, email_address, phone_number, password) 
            VALUES(:name, :company_name, :email_address, :phone_number, :password)");
            $query->execute([
                'name' => $name,
                'company_name' => $company_name,
                'email_address' => $email_address,
                'phone_number' => $phone_number,
                'password' => sha1($password)
            ]);
            header("location:profileConnection.php");
        }
    } else {
        $error = "The name and the passwords are required";
    }
}
?>

<?php include 'layouts/header.php' ?>

<h1 class="text-center my-5">Profil creation</h1>
<?php if (isset($error)) { ?>
    <p class="text-center text-danger"><?= $error ?></p>
<?php } ?>
<form action="" method="POST" class=" col-md-6 mx-auto">
    <div class="row m-3">
        <div class="col"> <label for="">Name *</label>
            <input type="text" name="name" class="form-control" value="<?php if (isset($_POST['name'])) echo $_POST['name'] ?>">
        </div>
        <div class="col"> <label for="">Company name</label>
            <input type="text" name="company_name" class="form-control" value="<?php if (isset($_POST['company_name'])) echo $_POST['company_name'] ?>">
        </div>
    </div>
    <div class="m-4">
        <label for="">Email address</label>
        <input type="email" name="email_address" class="form-control" value="<?php if (isset($_POST['email_address'])) echo $_POST['email_address'] ?>">
    </div>
    <div class="m-4">
        <label for="">Phone number</label>
        <input type="text" name="phone_number" class="form-control" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number'] ?>">
    </div>
    <div class="row m-3">
        <div class="col"> <label for="">password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col"> <label for="">Password confirmation</label>
            <input type="password" class="form-control" name="password_confirm">
        </div>
    </div>
    <div class="m-4">
        <button type="submit" name="create" class="btn btn-secondary w-100">Create</button>
    </div>
</form>
<?php include 'layouts/footer.php' ?>