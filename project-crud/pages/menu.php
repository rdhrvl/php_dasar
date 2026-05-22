<?php

$query = mysqli_query($conn, "SELECT parent.name as parent_name, menus.* FROM menus LEFT JOIN menus as parent ON parent.id = menus.parent_id ORDER BY menus.id DESC");


$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM menus WHERE id='$id'");
    header("location:?page=menu");
    exit();
}

?>

<div class="card">
    <h5 class="card-header">
        Menu
    </h5>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=menu-create" class="btn btn-primary">Create New Menu</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "menu succsesfully created";
                $location = "?page=menu";
                echo statusSuccess($status, $location);
            }
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Parent Id</th>
                        <th>Name</th>
                        <th>url</th>
                        <th>icon</th>
                        <th>Order</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                        $status = $r['is_active'];
                    ?>
                        <tr>

                            <td><?= $index + 1 ?></td>
                            <td><?= $r['parent_name'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['url'] ?></td>
                            <td><i class="menu-icon tf-icons bx <?= $r['icon'] ?>"></i> <?= $r['icon'] ?></td>
                            <td><?= $r['sort_order'] ?></td>
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=menu-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=menu&delete=<?= $r['id'] ?>" method="post" class="d-inline">
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