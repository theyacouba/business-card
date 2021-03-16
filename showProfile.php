<?php
session_start();
include 'filters/auth_filter.php';
include "config/database.php";


$query = $pdo->prepare("SELECT * FROM profile WHERE id = :id");
$query->execute([
    'id' => $_SESSION['user']
]);
$profile = $query->fetch();

?>

<?php include 'layouts/header.php' ?>

<main class="mt-5">
<h1 class="text-center my-5">Your profile</h1>
    <div class="col-md-5 mx-auto text-center">
        <div class="card" style="width: 600px;height: 230px;">
            <div class="card-body">
                <p><b><i class="fas fa-user"></i> Name:</b> <?= empty($profile['name']) ? "No name for the moment" : $profile['name'] ?></p>
                <p class="card-text">
                <p><b><i class="fas fa-building"></i> Company name:</b> <?= empty($profile['company_name']) ? "(No name for the moment)" : $profile['company_name'] ?></p>
                <p><b><i class="fas fa-envelope"></i> Email address:</b> <?= empty($profile['email_address']) ? "(No Email address for the moment)" : $profile['email_address'] ?></p>
                <p><b><i class="fas fa-phone-square-alt"></i> Phone number:</b> <?= empty($profile['phone_number']) ? "(No phone number for the moment)" : $profile['phone_number'] ?></p>
                <a href="updateProfile.php?id=<?= $profile['id'] ?>" class="text-info">Update profile</a>
            </div>
        </div>
    </div>
</main>
<?php include 'layouts/footer.php' ?>