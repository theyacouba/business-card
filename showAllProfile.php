<?php
session_start();
include 'filters/auth_filter.php';
require 'config/database.php';

$query = $pdo->prepare("SELECT * FROM profile WHERE id != :id");
$query->execute([
    'id' => $_SESSION['user']
]);
$profiles = $query->fetchAll();

?>

<?php include 'layouts/header.php' ?>
<h1 class="text-center m-4">Profiles</h1>
<div class=" container mt-5">
    <?php if (count($profiles)) { ?>
        <div class="row">
            <?php foreach ($profiles as $profile ) { ?>
                <div class="col-md-4 my-4 mx-auto">
                    <div class="card" style="width: 400px;height: 240px;">
                        <div class="card-body">
                            <p class="card-title">
                            <p><b><i class="fas fa-user"></i> Name: </b><?= empty($profile['name']) ? 'No name for the moment' : $profile['name'] ?>
                            </p>
                            <p class="card-text">
                            <p><b><i class="fas fa-building"></i> Company name: </b><?= empty($profile['company_name']) ? 'No Company name for the moment' : $profile['company_name'] ?></p>

                            <p><b><i class="fas fa-envelope"></i> Email address: </b><?= $profile['email_address'] ?></p>
                            <p><b><i class="fas fa-phone-square-alt"></i> Phone number</b><?= empty($profile['phone_number']) ? 'No phone number for the moment' : $profile['phone_number'] ?></p>
                            <p class="my-2"><a href="exchange.php?profile2=<?= $profile['id'] ?>" class="text-danger">Exchange profile</a></p>

                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h2 class="text-center">No other profile!</h2>
    <?php }  ?>
</div>
<?php include 'layouts/footer.php' ?>