<?php
session_start();
require 'config/database.php';

if (isset($_POST['create'])) {
    extract($_POST);
    if (!empty($email_address)) {
            $query = $pdo->prepare("INSERT INTO business_card(name, company_name, email_address, phone_number, profile_id) VALUES(:name, :company_name, :email_address, :phone_number, :profile_id)");
            $query->execute([
                'name' => $name,
                'company_name' => $company_name,
                'email_address' => $email_address,
                'phone_number' => $phone_number,
                'profile_id' => $_SESSION['user']
            ]);
       
       
        header("location:library.php");
    } else {
        $error =  "The email field is required";
    }
} 


?>

<?php include 'layouts/header.php' ?>
<h1 class="text-center my-5">New card</h1>
<?php if (isset($error)) { ?>
    <p class="text-danger text-center"><?= $error ?></p>
<?php } ?>
<form action="" method="post" class=" col-md-6 mx-auto">
    <div class="m-4">
        <label for="">Name: </label>
        <input class="form-control" type="text" name="name" value="<?php if (isset($_POST['name'])) echo $name ?>">
    </div>
    <div class=" m-4">
        <label for="">Company name: </label>
        <input class="form-control" type="text" name="company_name" value="<?php if (isset($_POST['company_name'])) echo $company_name ?>">
    </div>
    <div class="m-4">
        <label for="">Email address: </label>
        <input class="form-control" type="email" name="email_address" value="<?php if (isset($_POST['email_address'])) echo $email_address ?>">
    </div>
    <div class="m-4">
        <label for="">Phone: </label>
        <input class="form-control" type="text" name="phone_number" value="<?php if (isset($_POST['phone_number'])) echo $phone_number ?>">
    </div>
    <div class="m-4">
        <button class="btn btn-secondary w-100" type="submit" name="create">Create card</button>
    </div>
</form>
<?php include 'layouts/footer.php' ?>