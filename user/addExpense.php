<?php
require_once('../connection/db.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getBudget.php');
include('controler/getCategories.php');
include('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addExpense'])) {
    $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    if ($userId) {
        $expense_user_id = $userId;
        $expenseName = $_POST['expense_name'];
        $expenseAmount = $_POST['expense_amount'];
        $expenseCategory = $_POST['expense_category'];
        $expenseBudget = $_POST['budget_id'];
        $expenseDescription = $_POST['expense_description'];

        $insert = $con->query("INSERT INTO expenses (expense_user_id, expense_name, expense_amount, expense_category_name, expense_budget_id, expense_description) VALUES ('$expense_user_id', '$expenseName', '$expenseAmount', '$expenseCategory', '$expenseBudget', '$expenseDescription')");

        if ($insert) {
            $_SESSION['message'] = "Expense added successfully";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "An error occurred. Please try again";
            $_SESSION['message_type'] = "error";
        }
    }
}
?>

<!-- Begin Page Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add Expense</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="expense_name" id="expense_name"
                            placeholder="Expense name" required>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="number" class="form-control" name="expense_amount" id="expense_amount"
                            placeholder="Amount spent" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control custom-select" name="expense_category" id="expense_category" required>
                            <option value="">Select Category</option>
                            <?php
                            foreach ($categories as $category) {
                                echo "<option value='" . $category['category_name'] . "'>" . $category['category_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control custom-select" name="budget_id" id="budget_id" required>
                            <option value="">Select Budget</option>
                            <?php
                            foreach ($budgets as $budget) {
                                echo "<option value='" . $budget['id'] . "'>" ."Name:&nbsp". $budget['budget_name']."&nbsp"."Expiry:". $budget['budget_expire_date']. "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <!-- Description -->
                    <textarea class="form-control" name="expense_description" id="expense_description"
                        placeholder="Description" required></textarea>
                </div>

                <button type="submit" name="addExpense" class="btn btn-success">Add Expense</button>
            </form>
        </div>
    </div>
<!-- End Page Content -->
<script>
    $(document).ready(function() {
        $('#budget_id').on('change', function (e) {
            var budget_id = e.target.value;
            $.get('controler/getBudget.php?budget_id=' + budget_id, function(data) {
                $('#budget_amount').val(data.budget_amount);
            });
        });
    });
</script>
<?php
include('footer.php');
?>