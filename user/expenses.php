<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('header.php');
include('controler/getExpenses.php');
?>

<!-- Begin Page Content -->

<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> -->
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Expenses</h6>
                            <a href="addExpense.php" class="btn btn-success btn-circle">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount (KES)</th>
                                            <th>Category</th>
                                            <th>Budget Amount (KES)</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Name</th>
                                            <th>Amount (KES)</th>
                                            <th>Category</th>
                                            <th>Budget Amount (KES)</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            <?php
                                            foreach ($expenses as $expense) {
                                                echo "<tr>";
                                                echo "<td>" . $expense['expense_name'] . "</td>";
                                                echo "<td>" . $expense['expense_amount'] . "</td>";
                                                echo "<td>" . $expense['expense_category_name'] . "</td>";
                                                echo "<td>" . $expense['budget_amount'] . "</td>";
                                                echo "<td>" . $expense['expense_created_at'] . "</td>";
                                                echo "<td>
                                                <a href='editExpense.php?id=" . $expense['id'] . "' class='btn btn-info btn-circle'>
                                                    <i class='fas fa-info-circle'></i>
                                                </a>
                                                <a href='controler/deleteExpense.php?id=" . $expense['id'] . "' class='btn btn-danger btn-circle'>
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
