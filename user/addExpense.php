<?php
require_once('../connection/db.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getBudget.php');
include('controler/getCategories.php');
include('controler/addEditExpenses.php');
include('header.php');
?>

<!-- Begin Page Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add Expense</h6>
        </div>
        <div class="card-body">
            <!-- message -->
            <?php
            include('message.php');
            ?>
            <form class="user" method="POST" action="">
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="expense_name" id="expense_name"
                            placeholder="Expense name" required>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <input type="number" class="form-control" name="expense_amount" id="expense_amount"
                            placeholder="Amount spent" required>
                    </div>
                    <div class="input-group col-sm-4">
                    <div class="input-group-text form-control" id="budget_expire_date">Dated at?</div>
                        <input type="date" class="form-control" name="expense_created_at" id="expense_created_at"
                            placeholder="Date" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <select class="form-control custom-select" name="expense_category" id="expense_category" required>
                            <option value="">Select Category</option>
                            <!-- List only Active categories by category_status -->
                            <?php
                            foreach ($categories as $category) {
                                if ($category['category_status'] == 'active' || $category['category_status'] == 'Active') {
                                    echo "<option value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Add a button to add a new category -->
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <a href="addCategory.php" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control custom-select" name="budget_id" id="budget_id" required>
                            <option value="">Select Budget</option>
                            <?php
                            foreach ($budgets as $budget) {
                                if ($budget['budget_status'] == 'active' || $budget['budget_status'] == 'Active') {
                                    echo "<option value='" . $budget['id'] . "'>" ."Name:&nbsp". $budget['budget_name']."&nbsp".",Date Created:". $budget['budget_created_at']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Add a button to add a new budget -->
                    <div class="col-sm-3">
                        <a href="addBudget.php" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <!-- Description -->
                    <textarea class="form-control" name="expense_description" id="expense_description"
                        placeholder="Description" required>N/A</textarea>
                </div>

                <button type="submit" name="addExpense" class="btn btn-success">Add Expense</button>
            </form>
        </div>
    </div>
<!-- End Page Content -->
<?php
include('footer.php');
?>