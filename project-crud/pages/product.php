<?php

$query = mysqli_query($conn, "SELECT products.*, categories.name as category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY id DESC");



$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'] ?? 0;
    $cekFoto = mysqli_query($conn, "SELECT image FROM products WHERE id='$id'");
    $rowFoto = mysqli_fetch_assoc($cekFoto);
    if ($rowFoto) {
        $foto = $rowFoto['image'];
        if (file_exists("assets/uploads/" . $foto) && !empty($foto)) {
            unlink("assets/uploads/" . $foto);
        }
    }

    $delete = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
    if ($delete) {
        header("location:?page=product");
        exit();
    }
}

?>

<div class="card">
    <h5 class="card-header">
        Menu
    </h5>
    <div class="card-body">
        <div class="mb-2" align="right">
            <a href="?page=product-create" class="btn btn-primary">Create New product</a>
        </div>
        <div class="table-responsive">
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                $status = "product succsesfully created";
                $location = "?page=product";
                echo statusSuccess($status, $location);
            } elseif (isset($_GET['status']) && $_GET['status'] == 'edited') {
                $status = ($_GET['product_name'] ?? 'Data') . " successfully Saved";
                $location = "?page=product";
                echo statusSuccess($status, $location);
            } elseif (isset($_GET['status']) && $_GET['status'] == 'product-exists') {
                $status = ($_GET['name'] ?? 'Data') . " is already exists";
                $location = "?page=product";
                echo statusExist($status, $location);
            }

            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rows as $index => $r) {
                    ?>
                        <tr>

                            <td><?= $index + 1 ?></td>
                            <td><img src="assets/uploads/<?= $r['image'] ?>" width="150"></td>
                            <td><?= $r['product_name'] ?></td>
                            <td><?= $r['category_name'] ?></td>
                            <td><?= $r['qty'] ?></td>
                            <td>Rp. <?= number_format($r['price'], 2, ',', '.') ?></td>
                            <td><?= $r['unit'] ?></td>
                            <td><?= getStatus($r['is_active']) ?></td>
                            <td>
                                <a href="?page=product-create&edit=<?= $r['id'] ?>" class="btn btn-success">Edit</a>
                                <form action="?page=product&delete=<?= $r['id'] ?>" method="post" class="d-inline">
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