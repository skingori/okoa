<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getCategoryEnums.php');
include('header.php');


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBudget'])) {
    $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    if ($userId) {
        $budget_user_id = $userId;
        $budgetName = $_POST['budget_name'];
        $budgetAmount = $_POST['budget_amount'];
        $budgetOccurence = $_POST['budget_occurence'];
        $budgetStatus = $_POST['budget_status'];
        $budgetReminderStatus = $_POST['budget_reminder_status'];
        $budgetExpireDate = $_POST['budget_expire_date'];
        $budgetDescription = $_POST['budget_description'];

        $insert = $con->query("INSERT INTO budget (budget_user_id, budget_name, budget_amount, budget_occurence, budget_status, budget_reminder_status, budget_expire_date, budget_description) VALUES ('$budget_user_id', '$budgetName', '$budgetAmount', '$budgetOccurence', '$budgetStatus', '$budgetReminderStatus', '$budgetExpireDate', '$budgetDescription')");

        if ($insert) {
            $_SESSION['message'] = "Budget added successfully";
            $_SESSION['message_type'] = "success";
            // header('Location: budget.php');

        } else {
            $_SESSION['message'] = "An error occurred. Please try again";
            $_SESSION['message_type'] = "error";
            // header('Location: addBudget.php');
        }
    }
}
?>

<!-- Begin Page Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Budget</h6>
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
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="budget_name" id="budget_name"
                            placeholder="Budget name" required>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="number" class="form-control" name="budget_amount" id="budget_amount"
                            placeholder="Amount" required>
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
                            <!-- $statusEnum = explode(",", str_replace("'", "", substr($enums[1]['COLUMN_TYPE'], 5, -1))); -->
                            <?php
                            foreach ($statusEnum as $key => $value) {
                                echo "<option value='" . $value . "'>" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="budget_expire_date" id="budget_expire_date"
                            placeholder="Budget expire date" required>
                    </div>
                </div>
                <div class="form-group">
                    <!-- Description -->
                    <textarea class="form-control" name="budget_description" id="budget_description"
                        placeholder="Description" required></textarea>
                </div>

                <button type="submit" name="addBudget" class="btn btn-success">New Budget</button>
            </form>
        </div>
    </div>
<!-- End Page Content -->
<?php
include('footer.php');
?>