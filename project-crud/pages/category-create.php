<?php
$query = mysqli_query($conn, "SELECT category.name as category_name, categories.* FROM categories LEFT JOIN categories as category ON category.id = categories.id ORDER BY categories.id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST['create'])) {
    $name =  htmlspecialchars($_POST['name']);
    $status = htmlspecialchars($_POST['is_active']);

    $cek = mysqli_query($conn, "SELECT * FROM categories WHERE name='$name'");
    if (mysqli_num_rows($cek) > 0) {
        header('location:?page=category-create&status=category-exists');
        exit();
    }
    $update = mysqli_query($conn, "INSERT INTO categories (name, is_active) VALUES ('$name','$status')");

    if ($update) {
        header('location:?page=category&status=success');
        exit();
    }
}

$id = $_GET['edit'] ?? '';
// $id = isset($_GET['idEdit']) ? $_GET['idEdit'] : '';
$selectCategories = mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'");
$edit = mysqli_fetch_assoc($selectCategories);


if (isset($_POST['save'])) {
    $name =  htmlspecialchars($_POST['name']);
    $status = htmlspecialchars($_POST['is_active']);

    $cek = mysqli_query($conn, "SELECT * FROM categories WHERE name='$name' AND id!='$id'");
    if (mysqli_num_rows($cek) > 0) {
        isset($_GET['edit']) ? header('location:?page=category-create&edit=' . urlencode($id) . '&status=category-exists&name=' . urlencode($name)) : header('location:?page=category-create&status=category-exists&name=' . urlencode($name));
        exit();
    }
    $update = mysqli_query($conn, "UPDATE categories SET name='$name', is_active='$status' WHERE id='$id'");

    if ($update) {
        header('location:?page=category&status=edited&name=' . urlencode($name));
        exit();
    }
}

?>

<div class="card">
    <h5 class="card-header">
        <?= isset($_GET['edit']) ? 'Edit' : 'Create New' ?> Category
    </h5>
    <div class="card-body">
        <form action="" method="post">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_GET['edit']) ? $edit['name'] : '' ?>" placeholder="Name" required>
                    <?php
                    if (isset($_GET['status']) && $_GET['status'] == 'category-exists') {
                        $status = ($_GET['name'] ?? 'Data') . " is already exists";
                        echo inputFailed($status);
                    }
                    ?>
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
                <a href="?page=category" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>