<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('header.php');
include('controler/getCategories.php');
?>

<!-- Begin Page Content -->
<div class="card shadow mb-4">
                        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                            <a href="addCategory.php" class="btn btn-success btn-circle">
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
                                            <th>Occurence</th>
                                            <th>Status</th>
                                            <th>Reminder date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Name</th>
                                            <th>Amount (KES)</th>
                                            <th>Occurence</th>
                                            <th>Status</th>
                                            <th>Reminder date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                            <?php
                                            foreach ($categories as $category) {
                                                echo "<tr>";
                                                echo "<td>" . $category['category_name'] . "</td>";
                                                echo "<td>" . $category['category_estimated_amount'] . "</td>";
                                                echo "<td>" . $category['category_occurence'] . "</td>";
                                                echo "<td>" . $category['category_status'] . "</td>";
                                                echo "<td>" . $category['reminder_date'] . "</td>";
                                                echo "<td>
                                                <a href='editCategory.php?id=" . $category['id'] . "' class='btn btn-info btn-circle'>
                                                    <i class='fas fa-info-circle'></i>
                                                </a>
                                                <a href='controler/deleteCategory.php?id=" . $category['id'] . "' class='btn btn-danger btn-circle'>
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