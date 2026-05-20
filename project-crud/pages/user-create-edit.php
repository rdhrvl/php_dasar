<?php
if (isset($_POST['create'])) {
    $name =  htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['password'];
    $confirm = $_POST['password_confirm'];
    $passHas = sha1($pass);

    if ($pass == $confirm) {
        $cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'
        
        ");

        if (mysqli_num_rows($cekEmail) > 0) {
            header('location:?page=user-create-edit');
        }
        mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name','$email','$passHas')");

        header('location:?page=users&status=success');
        exit();
    } else {
        header('location:?page=user-create-edit');
    }
}

if (isset($_GET['idEdit'])) {
    $id = $_GET['idEdit'] ?? '';
    $selectUser = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
    $rEdit = mysqli_fetch_assoc($selectUser);

    if (isset($_POST['save'])) {
        $name =  htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $pass = $_POST['password'];
        $confirm = $_POST['password_confirm'];
        $passHas = sha1($pass);

        if ($pass == '') {
            mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$id' ");
            header('location:?page=users');
            exit();
        } else {
            if ($pass == $confirm) {
                mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$passHas' WHERE id='$id' ");
                header('location:?page=users');
                exit();
            } else {
            }
        }
    }
}
?>

<div class="card">
    <div class="card-header text-center">
        <h2 class="card-title"><?= isset($_GET['idEdit']) ? 'Edit' : 'Create' ?> User</h2>
    </div>
    <div class="card-body">
        <form action="" method="post">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_GET['idEdit']) ? $rEdit['name'] : '' ?>" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= isset($_GET['idEdit']) ? $rEdit['email'] : '' ?>" required>
                </div>
            </div>
            <div class=" row justify-content-end mt-2">
                <div class="col-6">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="row justify-content-end mt-2">
                <div class="col-6">
                    <label for="" class="form-label">Password Confirm</label>
                    <input type="password" name="password_confirm" class="form-control">
                </div>
            </div>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" name="<?= isset($_GET['idEdit']) ? 'save' : 'create' ?>"><?= isset($_GET['idEdit']) ? 'Save' : 'Create' ?></button>
                <a href="?page=users" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>