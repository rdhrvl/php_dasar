<?php

$selectUser = mysqli_query($conn, "SELECT * FROM users");

$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);


if (isset($_POST['idDelete'])) {
    $id = $_GET['idDelete'];
    $delete = mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header("location:?page=users");
    exit();
}

?>

<div class="card">
    <div class="card-header text-center">
        <h2 class="card-title">Users</h2>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <a href="?page=user-create-edit" class="btn btn-primary">Create</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "Data Berhasil Ditambah";
                $location = "?page=users";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                    ?>
                        <tr>

                            <td><?= $index + 1 ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td>
                                <a href="?page=user-create-edit&idEdit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=users&idDelete=<?= $r['id'] ?>" method="post" class="d-inline">
                                    <button class="btn btn-danger" onclick="return confirm('ARE YOU SURE?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>