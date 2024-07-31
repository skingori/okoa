<?php
require_once('../connection/db.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getCategories.php');
include('controler/addEditExpenses.php');
include('controler/getBudget.php');
include('controler/getValuesByID.php');
include('header.php');


?>

<!-- Begin Page Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Expense</h6>
        </div>
        <div class="card-body">
            <!-- message -->
            <?php
            include('message.php');
            ?>
            <form class="user" method="POST" action="">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="expense_name" id="expense_name"
                            placeholder="Expense name" value="<?php echo $expenseName ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="number" class="form-control" name="expense_amount" id="expense_amount"
                            placeholder="Amount spent" value="<?php echo $expenseAmount ?>" required>
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
                        placeholder="Description" required><?php echo $expenseDescription ?></textarea>
                </div>

                <button type="submit" name="editExpense" class="btn btn-success">Update Expense</button>
            </form>
        </div>
    </div>
<!-- End Page Content -->
<?php
include('footer.php');
?>