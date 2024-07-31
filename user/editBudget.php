<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getValuesByID.php');
include('controler/getBudget.php');
include('controler/getCategoryEnums.php');
include('controler/addEditBudget.php');
include('header.php');
?>

<!-- Begin Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Edit Budget</h6>
    </div>
    <div class="card-body">
        <?php
        include('message.php');
        ?>
        <form class="user" method="POST" action="">
            <div class="form-group row">
                <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="text" class="form-control" name="budget_name" id="budget_name" placeholder="Budget name" value="<?php echo $budgetName ?>" required>
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="number" class="form-control" name="budget_amount" id="budget_amount" placeholder="Amount" value="<?php echo $budgetAmount ?>" required>
                </div>
                <div class="col-sm-4">
                    <select class="form-control custom-select" name="budget_occurence" id="budget_occurence" required>
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
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control custom-select" name="budget_status" id="budget_status" required>
                        <option value="">Budget Status</option>
                        <!-- $statusEnum = explode(",", str_replace("'", "", substr($enums[1]['COLUMN_TYPE'], 5, -1))); -->
                        <?php
                        foreach ($statusEnum as $key => $value) {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control custom-select" name="budget_reminder_status" id="budget_reminder_status" required>
                        <option value="">Reminder Status</option>
                        <?php
                        foreach ($statusEnum as $key => $value) {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group col-sm-4">
                    <div class="input-group-text" id="budget_expire_date">Expiry date</div>
                    <input type="date" class="form-control" name="budget_expire_date" id="budget_expire_date" placeholder="Budget Expiry Date" value="<?php echo $reminderDate ?>" required>
                </div>
            </div>
            <div class="form-group">
                <!-- Description -->
                <textarea class="form-control" name="budget_description" id="budget_description" placeholder="Description" required><?php echo $budgetDescription ?></textarea>
            </div>

            <button type="submit" name="editBudget" class="btn btn-success">Update Budget</button>
        </form>
    </div>
</div>
<!-- End Page Content -->
<?php
include('footer.php');
?>