<?php
$query = mysqli_query($conn, "SELECT parent.name as parent_name, menus.* FROM menus LEFT JOIN menus as parent ON parent.id = menus.parent_id ORDER BY menus.id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST['create'])) {
    $name =  htmlspecialchars($_POST['name']);
    $parent = htmlspecialchars($_POST['parent_id']) ?: 'NULL';
    $url = htmlspecialchars($_POST['url']);
    $icon = htmlspecialchars($_POST['icon']);
    $order = htmlspecialchars($_POST['sort_order']);
    $status = htmlspecialchars($_POST['is_active']);

    mysqli_query($conn, "INSERT INTO menus (name, parent_id, url, icon, sort_order, is_active) VALUES ('$name',$parent,'$url', '$icon', '$order', '$status')");
    header('location:?page=menu&status=success');
}

$id = $_GET['edit'] ?? '';
// $id = isset($_GET['idEdit']) ? $_GET['idEdit'] : '';
$selectMenu = mysqli_query($conn, "SELECT * FROM menus WHERE id='$id'");
$edit = mysqli_fetch_assoc($selectMenu);


if (isset($_POST['save'])) {
    $name =  htmlspecialchars($_POST['name']);
    $parent = htmlspecialchars($_POST['parent_id']) ?: 'NULL';
    $url = htmlspecialchars($_POST['url']);
    $icon = htmlspecialchars($_POST['icon']);
    $order = htmlspecialchars($_POST['sort_order']);
    $status = htmlspecialchars($_POST['is_active']);

    mysqli_query($conn, "UPDATE menus SET name='$name', parent_id=$parent, url='$url', icon='$icon', sort_order='$order', is_active='$status' WHERE id='$id' ");
    header('location:?page=menu');
}

?>

<div class="card">
    <h5 class="card-header">
        <?= isset($_GET['edit']) ? 'Edit' : 'Create New' ?> Menu
    </h5>
    <div class="card-body">
        <form action="" method="post">

            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($_GET['edit']) ? $edit['name'] : '' ?>" placeholder="Name" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Parent *</label>
                    <select class="form-select mb-3" aria-label="Default select" name="parent_id">
                        <option value="" selected>Select Parent</option>
                        <?php

                        foreach ($rows as $parent) {
                        ?>
                            <option value="<?= $parent['id'] ?>" <?= ($edit['parent_id'] == $parent['id']) ? 'selected' : '' ?>>
                                <?= $parent['name'] ?>
                            </option>
                        <?php
                        }

                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">URL *</label>
                    <input type="text" name="url" class="form-control" value="<?= isset($_GET['edit']) ? $edit['url'] : '' ?>" placeholder="url">
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Icon *</label>
                    <input type="text" name="icon" class="form-control" value="<?= isset($_GET['edit']) ? $edit['icon'] : '' ?>" placeholder="Icon" required>
                </div>
                <div class="col-6">
                    <label for="" class="form-label">Sort Order *</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= isset($_GET['edit']) ? $edit['sort_order'] : '' ?>" placeholder="Order">
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
                <a href="?page=menu" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</div>