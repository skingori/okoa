<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

include('controler/getCategoryEnums.php');
include('header.php');


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST['category_name'];
        $categoryEstimatedAmount = $_POST['category_estimated_amount'];
        $categoryOccurence = $_POST['category_occurence'];
        $categoryStatus = $_POST['category_status'];
        $categoryDescription = $_POST['category_description'];
        $reminderDate = $_POST['reminder_date'];

        echo $categoryName;
        echo $categoryEstimatedAmount;
        echo $categoryOccurence;
        echo $categoryStatus;
        echo $categoryDescription;
        echo $reminderDate;


        $insert = $con->query("INSERT INTO categories (category_name, category_estimated_amount, category_occurence, category_status, category_description, reminder_date) VALUES ('$categoryName', '$categoryEstimatedAmount', '$categoryOccurence', '$categoryStatus', '$categoryDescription', '$reminderDate')");

        if ($insert) {
            $_SESSION['message'] = "Category added successfully";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "An error occurred. Please try again";
            $_SESSION['message_type'] = "error";
        }
}
?>

<!-- Begin Page Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="">
                <div class="form-group row">
                    <div class="col-sm-5 mb-3 mb-sm-0">
                        <input type="text" class="form-control" name="category_name" id="category_name"
                            placeholder="Category name" required>
                    </div>
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <input type="number" class="form-control" name="category_estimated_amount" id="category_estimated_amount"
                            placeholder="Amount" required>
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
                            <option value="">Select Status</option>
                            <!-- $statusEnum = explode(",", str_replace("'", "", substr($enums[1]['COLUMN_TYPE'], 5, -1))); -->
                            <?php
                            foreach ($statusEnum as $key => $value) {
                                echo "<option value='" . $value . "'>" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <input type="date" class="form-control" name="reminder_date" id="reminder_date"
                            placeholder="Reminder date" required>
                    </div>
                </div>
                <div class="form-group">
                    <!-- Description -->
                    <textarea class="form-control" name="category_description" id="category_description"
                        placeholder="Description" required></textarea>
                </div>

                <button type="submit" name="add" class="btn btn-success">Add Category</button>
            </form>
        </div>
    </div>
<!-- End Page Content -->
<?php
include('footer.php');
?>