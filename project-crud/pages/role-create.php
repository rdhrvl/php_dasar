<?php
if (isset($_POST['create'])) {
    $name =  htmlspecialchars($_POST['name']);
    $status = htmlspecialchars($_POST['status']);
    $desc = htmlspecialchars($_POST['description']);

    mysqli_query($conn, "INSERT INTO roles (name, is_active, description) VALUES ('$name','$status','$desc')");
    header('location:?page=role&status=success');
}

$id = $_GET['edit'] ?? '';
// $id = isset($_GET['idEdit']) ? $_GET['idEdit'] : '';
$selectRole = mysqli_query($conn, "SELECT * FROM roles WHERE id='$id'");
$edit = mysqli_fetch_assoc($selectRole);


if (isset($_POST['save'])) {
    $name =  htmlspecialchars($_POST['name']);
    $status = htmlspecialchars($_POST['status']);
    $desc = htmlspecialchars($_POST['description']);

    mysqli_query($conn, "UPDATE roles SET name='$name', is_active='$status', description='$desc' WHERE id='$id' ");
    header('location:?page=role');
}

?>

<div class="card">
    <h5 class="card-header">
        <?= isset($_GET['edit']) ? 'Edit' : 'Create New' ?> Role
    </h5>
    <div class="card-body">
        <form action="" method="post">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_GET['edit']) ? $edit['name'] : '' ?>" placeholder="Name" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Status *</label>
                    <select class="form-select mb-3" aria-label="Default select" name="status">
                        <option <?= !$id ? 'selected' : '' ?>>Status Select</option>
                        <option value="1" <?= $id ? ($edit['is_active'] == 1) ? 'selected' : '' : 'selected' ?>>Active</option>
                        <option value="0" <?= $id ? ($edit['is_active'] == 0) ? 'selected' : '' : 'selected' ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class=" row mt-3">
                <div class="col-6">
                    <label for="" class="form-label">Description *</label>
                    <!-- <input type="textarea" name="description" class="form-control"> -->
                    <textarea name="description" id="" class="form-control" placeholder="Description"><?= $id ? $edit['description'] : '' ?></textarea>
                </div>

            </div>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary" name="<?= isset($_GET['edit']) ? 'save' : 'create' ?>"><?= isset($_GET['edit']) ? 'Save' : 'Create' ?></button>
                <a href="?page=role" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>