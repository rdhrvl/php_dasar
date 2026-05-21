<?php
if (isset($_POST['create'])) {
    $name =  htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $passHas = sha1($password);

    if ($password !== $password_confirm) {
        header('location:?page=user-create-edit&status=password_not_match');
        exit();
    }
    $cekEmail = mysqli_query($conn, "SELECT users.email FROM users WHERE email='$email'");

    if (mysqli_num_rows($cekEmail) > 0) {
        header('location:?page=user-create-edit&status=email_exists');
        exit();
    }

    mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name','$email','$passHas')");
    header('location:?page=users&status=success');
}

$id = $_GET['idEdit'] ?? '';
// $id = isset($_GET['idEdit']) ? $_GET['idEdit'] : '';
$selectUser = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$rEdit = mysqli_fetch_assoc($selectUser);


if (isset($_POST['save'])) {
    $name =  htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $passHas = sha1($password);

    if (empty($password)) {
        mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$id' ");
        header('location:?page=users');
        exit();
    } else {
    }
    if ($password !== $password_confirm) {
        header('location:?page=user-create-edit&idEdit=' . $id . '&status=password_not_match');
        exit();
    }
    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$passHas' WHERE id='$id' ");
    header('location:?page=users');
}

$status = $_GET['status'] ?? '';
?>

<div class="card">
    <h5 class="card-header">
        <?= isset($_GET['idEdit']) ? 'Edit' : 'Create New' ?> User
    </h5>
    <div class="card-body">
        <?php
        if ($status == 'password_not_match') {
        ?>
            <div class="alert alert-warning">
                Password do not match
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        if ($status == 'email_exists') {
        ?>
            <div class="alert alert-warning">
                Email already exists
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>

        <form action="" method="post">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_GET['idEdit']) ? $rEdit['name'] : '' ?>" placeholder="Name" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="<?= isset($_GET['idEdit']) ? $rEdit['email'] : '' ?>" placeholder="Email" required>
                </div>
            </div>
            <div class=" row mt-3">
                <div class="col-6">
                    <label for="" class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" <?= $id ? '' : 'required' ?>>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Confirm Password *</label>
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" <?= $id ? '' : 'required' ?>>
                </div>
                <?php
                if ($id) { ?>
                    <div class="mt2 text-secondary">
                        <p>Leave Blank if you dont want change the password</p>
                    </div>
                <?php
                } ?>

            </div>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" name="<?= isset($_GET['idEdit']) ? 'save' : 'create' ?>"><?= isset($_GET['idEdit']) ? 'Save' : 'Create' ?></button>
                <a href="?page=users" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>