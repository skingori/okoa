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
include('controler/getDynamicChartLabels.php');
include('header.php');
?>


<!-- Begin Page Content -->

<!-- Create a page with a expense table that have two inputs on top to search for report based on the date selections, and the report should have a total column at the bottom" -->

<div class="card shadow mb-4">
    <div class="card-header py-3 card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Expense Report</h6>
    </div>

    <!-- Add a Expense   -->
    <div class="row">
        <div class="card-body">
            <form class="user" method="POST" action="">
                <!-- Use a grouped inputs with aligned search button -->
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date" required>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <input type="date" class="form-control" name="end_date" id="end_date" placeholder="End Date" required>
                    </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <button class="btn btn-success btn-circle" type="submit" name="getDate">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
        </div>
    </div>
    <!-- message -->
    <?php
    include('message.php');
    ?>
    <div class="row">
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-uppercase">Name</th>
                    <th scope="col" class="text-uppercasetext-end">Amount (KES)</th>
                    <th scope="col" class="text-uppercase text-end">Category</th>
                    <th scope="col" class="text-uppercase text-end">Budget Amount</th>
                    <th scope="col" class="text-uppercase text-end">Date Created</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                    <?php
                    foreach ($expenses as $expense) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $expense['expense_name'] . "</th>";
                        echo "<td class='text-end'>" . $expense['expense_amount'] . "</td>";
                        echo "<td class='text-end'>" . $expense['expense_category_name'] . "</td>";
                        echo "<td class='text-end'>" . $expense['budget_amount'] . "</td>";
                        echo "<td class='text-end'>" . $expense['expense_created_at'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                <tr>
                    <td colspan="4" class="text-end">Total Budget</td>
                    <td class="text-end">362</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Budget Balance</td>
                    <td class="text-end">15</td>
                </tr>
                <tr>
                    <th scope="row" colspan="4" class="text-uppercase text-end">Total Expenses</th>
                    <td class="text-end">$495.1</td>
                </tr>
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>
<!-- End Page Content -->
<script src="../vendor/chart.js/Chart.min.js"></script>
<script>
    // Create a Stacked Bar Chart to show the expenses and budget as data sets
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
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $chartLabels; ?>],
            datasets: [{
                label: "Expenses",
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
                data: [<?php echo $expensesTotalAmount; ?>],
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
                display: true
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
include('footer.php');
?>