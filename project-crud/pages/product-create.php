<?php
$query = mysqli_query($conn, "SELECT products.product_name as product_name, products.*, categories.name as category_name, categories.id as category_id FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

$categories = mysqli_query($conn, "SELECT * FROM categories");
$categoryRows = mysqli_fetch_all($categories, MYSQLI_ASSOC);


if (isset($_POST['create'])) {
    $categoryId =  htmlspecialchars($_POST['category_id']);
    $name =  htmlspecialchars($_POST['product_name']);
    $image = time() . '_' . $_FILES['image']['name'];
    $quantity =  htmlspecialchars($_POST['qty']);
    $price =  htmlspecialchars($_POST['price']);
    $unit =  htmlspecialchars($_POST['unit']);
    $status = htmlspecialchars($_POST['is_active']);

    $tmp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_name, "assets/uploads/" . $image);

    $cek = mysqli_query($conn, "SELECT * FROM products WHERE product_name='$name'");
    if (mysqli_num_rows($cek) > 0) {
        header('location:?page=product-create&status=product-exists');
        exit();
    }
    $update = mysqli_query($conn, "INSERT INTO products (category_id, product_name, image, qty, price, unit, is_active) VALUES ('$categoryId','$name','$image','$quantity','$price','$unit','$status')");
    if ($update) {
        header('location:?page=product&status=success');
        exit();
    }
}

$id = $_GET['edit'] ?? '';
// $id = isset($_GET['idEdit']) ? $_GET['idEdit'] : '';
$selectproducts = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$edit = mysqli_fetch_assoc($selectproducts);


if (isset($_POST['save'])) {
    $categoryId =  htmlspecialchars($_POST['category_id']);
    $name =  htmlspecialchars($_POST['product_name']);
    if ($_FILES['image']['name'] != '') {
        $image = time() . '_' . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if (file_exists("assets/uploads/" . $edit['image']) && !empty($edit['image'])) {
            unlink("assets/uploads/" . $edit['image']);
        }
        move_uploaded_file($tmp_name, "assets/uploads/" . $image);
    } else {
        $image = $edit['image'];
    }

    $quantity =  htmlspecialchars($_POST['qty']);
    $price =  htmlspecialchars($_POST['price']);
    $unit =  htmlspecialchars($_POST['unit']);
    $status = htmlspecialchars($_POST['is_active']);


    $cek = mysqli_query($conn, "SELECT * FROM products WHERE product_name='$name' AND id!='$id'");
    if (mysqli_num_rows($cek) > 0) {
        isset($_GET['edit']) ? header('location:?page=product-create&edit=' . urlencode($id) . '&status=product-exists&product_name=' . urlencode($name)) : header('location:?page=product-create&status=product-exists&product_name=' . urlencode($name));
        exit();
    }
    $update = mysqli_query($conn, "UPDATE products SET category_id='$categoryId', product_name='$name', image='$image', qty='$quantity', price='$price', unit='$unit', is_active='$status' WHERE id='$id'");

    if ($update) {
        header('location:?page=product&status=edited&product_name=' . urlencode($name));
        exit();
    }
}

?>

<div class="card">
    <h5 class="card-header">
        <?= isset($_GET['edit']) ? 'Edit' : 'Create New' ?> product
    </h5>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" name="product_name" class="form-control" value="<?= isset($_GET['edit']) ? $edit['product_name'] : '' ?>" placeholder="Name" required>
                    <?php
                    if (isset($_GET['status']) && $_GET['status'] == 'product-exists') {
                        $status = ($_GET['name'] ?? 'Data') . " is already exists";
                        echo inputFailed($status);
                    }
                    ?>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Category *</label>
                    <select class="form-select mb-3" aria-label="Default select" name="category_id">
                        <option value="">Select Category</option>
                        <?php

                        foreach ($categoryRows as $key => $category) {
                        ?>
                            <option value="<?= $category['id'] ?>" <?= (($edit['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" url="<?= isset($_GET['edit']) ? $edit['image'] : '' ?>" value="" placeholder="Image">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Quantity</label>
                    <input type="number" name="qty" class="form-control" value="<?= isset($_GET['edit']) ? $edit['qty'] : '' ?>" placeholder="Quantity" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?= isset($_GET['edit']) ? $edit['price'] : '' ?>" placeholder="Price" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Unit</label>
                    <input type="text" name="unit" class="form-control" value="<?= isset($_GET['edit']) ? $edit['unit'] : '' ?>" placeholder="unit" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Status *</label>
                    <?php $activeStatus = $edit['is_active'] ?? 1 ?>
                    <select class="form-select mb-3" aria-label="Default select" name="is_active">
                        <option>Status Select</option>
                        <option value="1" <?= ($activeStatus) ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= ($activeStatus == 0) ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class=" row mt-3">

            </div>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" name="<?= isset($_GET['edit']) ? 'save' : 'create' ?>"><?= isset($_GET['edit']) ? 'Save' : 'Create' ?></button>
                <a href="?page=product" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>