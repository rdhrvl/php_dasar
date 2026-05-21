<?php

$query = mysqli_query($conn, "SELECT * FROM roles ORDER BY id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM roles WHERE id='$id'");
    header("location:?page=role");
    exit();
}

?>

<div class="card">
    <h5 class="card-header">
        Roles
    </h5>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=role-create" class="btn btn-primary">Create New Role</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "Role succsesfully created";
                $location = "?page=role";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        $status = $r['is_active'];
                    ?>
                        <tr>

                            <td><?= $index + 1 ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['description'] ?></td>
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=role-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=role&delete=<?= $r['id'] ?>" method="post" class="d-inline">
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