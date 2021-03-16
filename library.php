<?php
session_start();
include 'filters/auth_filter.php';
require 'config/database.php';

$query = $pdo->prepare("SELECT * FROM business_card WHERE profile_id = :id");
$query->execute(['id' => $_SESSION['user']]);
$businessCards = $query->fetchAll();

?>

<?php include 'layouts/header.php' ?>
<h1 class="text-center m-4">Your Library</h1>
<p class="text-center"><a href="addBusinessCard.php" class="text-secondary"><i class="fas fa-plus"></i> Add new Card </a></p>
<div class=" container mt-5">
    <?php if (count($businessCards)) { ?>
        <div class="row">
            <?php foreach ($businessCards as $businessCard) { ?>
                <div class="col-md-4 my-4 mx-auto">
                    <div class="card" style="width: 400px;height: 240px;">
                        <div class="card-body">
                            <p class="card-title">
                            <p><b><i class="fas fa-user"></i> Name: </b><?= empty($businessCard['name']) ? 'No name for the moment' : $businessCard['name'] ?>
                            </p>
                            <p class="card-text">
                            <p><b><i class="fas fa-building"></i> Company name: </b><?= empty($businessCard['company_name']) ? 'No Company name for the moment' : $businessCard['company_name'] ?></p>

                            <p><b><i class="fas fa-envelope"></i> Email address: </b><?= $businessCard['email_address'] ?></p>
                            <p><b><i class="fas fa-phone-square-alt"></i> Phone number</b><?= empty($businessCard['phone_number']) ? 'No phone number for the moment' : $businessCard['phone_number'] ?></p>

                            <p class="my-2"><a href="updateCard.php?id=<?= $businessCard['id'] ?>" class="text-primary">Update card</a> <a href="deleteCard.php?id=<?= $businessCard['id'] ?>" class="text-danger">Delete card</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h2 class="text-center">No card yet!</h2>
    <?php }  ?>
</div>
<?php include 'layouts/footer.php' ?>