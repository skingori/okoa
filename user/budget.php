<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('header.php');
include('controler/getBudget.php');
?>

<!-- Begin Page Content -->
<div class="card shadow mb-4">
                        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Budget</h6>
                            <!-- <a href="addBudget.php" class="btn btn-success btn-circle">
                                
                            </a> -->
                            <div class="btn-group" role="group" aria-label="Test">
  <a href="addBudget.php" class="btn btn-primary btn-circle"><i class="fas fa-plus"></i></a>
  <a href="addBudget.php" class="btn btn-success btn-circle"><i class="fas fa-print"></i></a>
</div>
                        </div>
                        <div class="card-body">
                            <!-- message -->
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
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount (KES)</th>
                                            <th>Occurence</th>
                                            <th>Status</th>
                                            <th>Expiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Name</th>
                                            <th>Amount (KES)</th>
                                            <th>Occurence</th>
                                            <th>Status</th>
                                            <th>Expiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            <?php
                                            // Get Budget
                                            foreach ($budgets as $budget) {
                                                echo "<tr>";
                                                echo "<td>" . $budget['budget_name'] . "</td>";
                                                echo "<td>" . $budget['budget_amount'] . "</td>";
                                                echo "<td>" . $budget['budget_occurence'] . "</td>";
                                                echo "<td>" . $budget['budget_status'] . "</td>";
                                                echo "<td>" . $budget['budget_expire_date'] . "</td>";
                                                echo "<td>
                                                <a href='editBudget.php?budgetID=" . $budget['id'] . "' class='btn btn-info btn-circle'>
                                                    <i class='fas fa-info-circle'></i>
                                                </a>
                                                <a href='delete.php?budgetID=" . $budget['id'] . "' class='btn btn-danger btn-circle'>
                                                    <i class='fas fa-trash'></i>
                                                </a>
                                            </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- End of Main Content -->

<?php
include('footer.php');
?>