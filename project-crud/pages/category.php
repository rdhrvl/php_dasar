<?php

$query = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");



$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM categories WHERE id='$id'");
    header("location:?page=category");
    exit();
}

?>

<div class="card">
    <h5 class="card-header">
        Menu
    </h5>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=category-create" class="btn btn-primary">Create New category</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "Category succsesfully created";
                $location = "?page=category";
                echo statusSuccess($status, $location);
            } elseif (isset($_GET['status']) && $_GET['status'] == 'edited') {
                $status = "Category succsesfully Saved";
                $location = "?page=category";
                echo statusSuccess($status, $location);
            } elseif (isset($_GET['status']) && $_GET['status'] == 'category-exists') {
                $status = "Category name is already exists";
                $location = "?page=category";
                echo statusExist($status, $location);
            }

            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
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
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=category-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=category&delete=<?= $r['id'] ?>" method="post" class="d-inline">
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