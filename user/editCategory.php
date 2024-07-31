<?php
require_once('../connection/db.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}
include('controler/getValuesById.php');
include('controler/addEditCategories.php');
include('controler/getCategoryEnums.php');

include('header.php');
?>

<!-- Begin Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Categories</h6>
    </div>
    <div class="card-body">
        <?php
        include('message.php');
        ?>
        <form class="user" method="POST" action="">
            <div class="form-group row">
                <div class="col-sm-5 mb-3 mb-sm-0">
                    
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category name" value="<?php echo $categoryName ?>" required>
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="number" class="form-control" name="category_estimated_amount" id="category_estimated_amount" placeholder="Amount" value="<?php echo $categoryEstimatedAmount ?>" required>
                </div>
                <div class="col-sm-4">
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
                <div class="col-sm-5 mb-3 mb-sm-0">
                    <select class="form-control custom-select" name="category_status" id="category_status" required>
                        <option value="">Category Status</option>
                        <?php
                        foreach ($statusEnum as $key => $value) {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input type="date" class="form-control" name="reminder_date" id="reminder_date" placeholder="Reminder date" value="<?php echo $reminderDate ?>" required>
                </div>
            </div>
            <div class="form-group">
                <!-- Description -->
                <textarea class="form-control" name="category_description" id="category_description" placeholder="Description" required><?php echo $categoryDescription ?></textarea>
            </div>

            <button type="submit" name="edit" class="btn btn-success">Update Category</button>
        </form>
    </div>
</div>
<!-- End Page Content -->
<?php
include('footer.php');
?>