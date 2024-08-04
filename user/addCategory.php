<?php
require_once('../connection/db.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/addEditCategories.php');
include('controler/getCategoryEnums.php');

include('header.php');
?>

<!-- Begin Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
    </div>
    <div class="card-body">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-" . $_SESSION['message_type'] . " alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                " . $_SESSION['message'] . "
                </div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>
        <form class="user" method="POST" action="">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category name" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control" name="category_estimated_amount" id="category_estimated_amount" placeholder="Amount" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="form-control custom-select" name="category_status" id="category_status" required>
                        <option value="">Category Status</option>
                        <?php
                        foreach ($statusEnum as $key => $value) {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select class="form-control custom-select" name="category_occurence" id="category_occurence" required>
                        <option value="">Select Occurrence</option>
                        <?php
                        foreach ($occurenceEnum as $key => $value) {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group col-sm-6">
                    <div class="input-group-text form-control" id="budget_expire_date">Reminder date</div>
                    <input type="date" class="form-control" name="reminder_date" id="reminder_date" placeholder="Reminder date" required>
                </div>
                <!-- Date created at -->
                <div class="input-group col-sm-6">
                <div class="input-group-text form-control" id="budget_expire_date">Created at?</div>
                    <input type="date" class="form-control" name="category_created_at" id="category_created_at" placeholder="Date" required>
                </div>
            </div>
            <div class="form-group">
                <!-- Description -->
                <textarea class="form-control" name="category_description" id="category_description" placeholder="Description" required>N/A</textarea>
            </div>

            <button type="submit" name="add" class="btn btn-success">Add Category</button>
        </form>
    </div>
</div>
<!-- End Page Content -->
<?php
include('footer.php');
?>