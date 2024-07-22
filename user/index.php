<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../sessions.php');
    exit();
}

// Get budget
include('controler/getBudget.php');
// Get categories
include('controler/getCategories.php');
// Get expenses
include('controler/getExpenses.php');

$userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
$monthlyBudget = $con->query("SELECT SUM(budget_amount) FROM budget WHERE MONTH(budget_created_at) = MONTH(CURRENT_DATE()) AND budget_user_id = $userId")->fetchColumn() ?? 0;
$annualBudget = $con->query("SELECT SUM(budget_amount) FROM budget WHERE YEAR(budget_created_at) = YEAR(CURRENT_DATE()) AND budget_user_id = $userId")->fetchColumn() ?? 0;

$monthlyExpenses = $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = MONTH(CURRENT_DATE()) AND expense_user_id = $userId")->fetchColumn() ?? 0;
$annualExpenses = $con->query("SELECT SUM(expense_amount) FROM expenses WHERE YEAR(expense_created_at) = YEAR(CURRENT_DATE()) AND expense_user_id = $userId")->fetchColumn() ?? 0;
$categories = $con->query("SELECT category_name FROM categories")->fetchAll(PDO::FETCH_ASSOC);

$totalExpenses = $con->query("SELECT SUM(expense_amount) FROM expenses WHERE expense_user_id = $userId")->fetchColumn() ?? 0;
$totalBudget = $con->query("SELECT SUM(budget_amount) FROM budget")->fetchColumn();
$totalCategoriesEstimatedAmount = $con->query("SELECT SUM(category_estimated_amount) FROM categories")->fetchColumn();
$annualCategoriesEstimatedAmount = $con->query("SELECT SUM(category_estimated_amount) FROM categories WHERE YEAR(created_at) = YEAR(CURRENT_DATE())")->fetchColumn();

// Get the expenses for each month of the current year, if the month has no expenses, set the value to 0

$expenses = [
    'January' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 1")->fetchColumn()?? 0,
    'February' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 2")->fetchColumn() ?? 0,
    'March' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 3")->fetchColumn() ?? 0,
    'April' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 4")->fetchColumn() ?? 0,
    'May' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 5")->fetchColumn() ?? 0,
    'June' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 6")->fetchColumn() ?? 0,
    'July' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 7")->fetchColumn() ?? 0,
    'August' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 8")->fetchColumn() ?? 0,
    'September' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 9")->fetchColumn() ?? 0,
    'October' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 10")->fetchColumn() ?? 0,
    'November' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 11")->fetchColumn() ?? 0,
    'December' => $con->query("SELECT SUM(expense_amount) FROM expenses WHERE MONTH(expense_created_at) = 12")->fetchColumn() ?? 0,
];

include('header.php');
?>

<!-- Page Heading -->
<!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Expenses (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <!-- Monthly Expeses -->
                            <?php
                            if ($monthlyExpenses) {
                                echo "KES", $monthlyExpenses;
                            } else {
                                $monthlyExpenses = 0;
                                echo "KES", $monthlyExpenses;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Expenses (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <!-- Annual Expenses -->
                            <?php
                            echo "KES", $annualExpenses;
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Budget (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <!-- Monthly Budget -->
                            <?php
                            echo "KES", $monthlyBudget;
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bugdet (Estimates)
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <!-- Monthy budget - Monthly Expenses -->
                                    <?php
                                    if ($monthlyBudget > $monthlyExpenses) {
                                        $estimates = $monthlyBudget - $monthlyExpenses;
                                        echo "KES", $estimates;
                                    } else if ($monthlyBudget < $monthlyExpenses) {
                                        // mark this as a negative value and make it red in color
                                        $estimates = $monthlyBudget - $monthlyExpenses;
                                        echo "<span style='color: red;'>KES", $estimates, "</span>";
                                    } else {
                                        echo "KES", 0;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <?php
                                    
                                    if (!$monthlyBudget == 0 && !$monthlyExpenses == 0) {
                                        $percentage = ($monthlyExpenses / $monthlyBudget) * 100;
                                        if ($percentage <= 50) {
                                            echo "<div class='progress-bar bg-success' role='progressbar' style='width: $percentage%' aria-valuenow='$percentage' aria-valuemin='0' aria-valuemax='100'></div>";
                                        } elseif ($percentage > 50 && $percentage <= 75) {
                                            echo "<div class='progress-bar bg-warning' role='progressbar' style='width: $percentage%' aria-valuenow='$percentage' aria-valuemin='0' aria-valuemax='100'></div>";
                                        } elseif ($percentage > 75) {
                                            echo "<div class='progress-bar bg-danger' role='progressbar' style='width: $percentage%' aria-valuenow='$percentage' aria-valuemin='0' aria-valuemax='100'></div>";
                                        }
                                    } else {
                                        echo "<div class='progress-bar bg-success' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>";
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Allocations Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Budget
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Expense
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> categories
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>
<!-- Page level plugins -->
<!-- <script src="../js/demo/chart-area-okoa.js"></script> -->
<!-- <script src="../js/demo/chart-pie-demo.js"></script> -->
<script>
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Budget", "Expense", "Categories"],
            datasets: [{
                data: [<?php echo $annualBudget; ?>, <?php echo $annualExpenses ?>, <?php echo $annualCategoriesEstimatedAmount; ?>],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
// AREA CHART
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $expenses['January']; ?>, <?php echo $expenses['February']; ?>, <?php echo $expenses['March']; ?>, <?php echo $expenses['April']; ?>, <?php echo $expenses['May']; ?>, <?php echo $expenses['June']; ?>, <?php echo $expenses['July']; ?>, <?php echo $expenses['August']; ?>, <?php echo $expenses['September']; ?>, <?php echo $expenses['October']; ?>, <?php echo $expenses['November']; ?>, <?php echo $expenses['December']; ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'KES' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': KES' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>
<?php
// include('pieChart.php');
include('footer.php');
?>