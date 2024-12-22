<?php

include '../database/config.php';
session_start();

// page redirect
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail == true) {
} else {
    header("location: ../index.php");
}

// Query to count pending requests
$sql = "SELECT COUNT(*) AS pending_count FROM room_requests WHERE status = 'pending'";
$result = $conn->query($sql);

// Fetch the count
$pending_count = 0;
if ($result && $row = $result->fetch_assoc()) {
    $pending_count = $row['pending_count'];
}

// Query to count bookings 
$sql_booking = "SELECT COUNT(*) AS booking_count FROM room_requests WHERE status = 'Success'";
$result_booking = $conn->query($sql_booking);

// Fetch the booking count
$booking_count = 0;
if ($result_booking && $row_booking = $result_booking->fetch_assoc()) {
    $booking_count = $row_booking['booking_count'];
}

// Query to count students 
$sql_students = "SELECT COUNT(*) AS student_count FROM signup"; // Adjust the table and column names
$result_students = $conn->query($sql_students);

// Fetch the student count
$student_count = 0;
if ($result_students && $row_students = $result_students->fetch_assoc()) {
    $student_count = $row_students['student_count'];
}


// Count for all classrooms, including any variation of 'room'
$chartClassrooms = "SELECT COUNT(*) FROM room_requests WHERE (LOWER(room_preferred) LIKE 'classroom%' OR LOWER(room_preferred) LIKE 'room%') AND status = 'Success'";
$chartClassroomsRe = mysqli_query($conn, $chartClassrooms);
$chartClassroomsRow = mysqli_fetch_row($chartClassroomsRe)[0];

// Count for Computer Laboratory, including any variation of 'comlab'
$chartComputerLab = "SELECT COUNT(*) FROM room_requests WHERE (LOWER(room_preferred) LIKE 'computer laboratory%' OR LOWER(room_preferred) LIKE 'comlab%') AND status = 'Success'";
$chartComputerLabRe = mysqli_query($conn, $chartComputerLab);
$chartComputerLabRow = mysqli_fetch_row($chartComputerLabRe)[0];

// Count for Gymnasium, including any variation of 'gym'
$chartGymnasium = "SELECT COUNT(*) FROM room_requests WHERE (LOWER(room_preferred) LIKE 'gymnasium%' OR LOWER(room_preferred) LIKE 'gym%') AND status = 'Success'";
$chartGymnasiumRe = mysqli_query($conn, $chartGymnasium);
$chartGymnasiumRow = mysqli_fetch_row($chartGymnasiumRe)[0];

// Fetching the department-based pending requests
$query = "SELECT department, COUNT(*) AS request_count FROM room_requests WHERE status = 'pending' GROUP BY department";
$result = mysqli_query($conn, $query);

// Initialize arrays for department labels and data
$department_labels = [];
$department_data = [];
$department_colors = []; // Array to store the color for each department

while ($row = mysqli_fetch_assoc($result)) {
    $department_labels[] = $row['department'];
    $department_data[] = $row['request_count'];

    // Assign unique color for each department
    switch ($row['department']) {
        case 'Accountancy':
            $department_colors[] = 'rgba(76, 175, 80, 0.6)';
            break;
        case 'Business Administration':
            $department_colors[] = 'rgba(48, 169, 222, 0.6)';
            break;
        case 'Hospitality Management':
            $department_colors[] = 'rgba(255, 99, 71, 0.6)';
            break;
        case 'Education and Arts':
            $department_colors[] = 'rgba(255, 165, 0, 0.6)';
            break;
        case 'Criminal Justice':
            $department_colors[] = 'rgba(138, 43, 226, 0.6)';
            break;
        default:
            $department_colors[] = 'rgba(169, 169, 169, 0.6)'; // Default color for unknown departments
    }
}

// Convert PHP arrays to JavaScript-friendly JSON format
$department_labels_json = json_encode($department_labels);
$department_data_json = json_encode($department_data);
$department_colors_json = json_encode($department_colors);

?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <!-- morish bar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <style>
        .logo {
            display: flex;
            align-items: center;
        }

        .meyclogo {
            width: 40px;
            height: auto;
            margin-right: 10px;
        }

        .logo p {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .chartbox {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
        }

        canvas {
            width: 100%;
            height: auto;
            display: block;
            max-width: 100%;
        }

        .bookroomchart {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            max-width: 31rem;
            height: auto;
            padding: 10px;
            background-color: #ccdff4;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .departmentChart {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            max-width: 44rem;
            height: auto;
            padding: 10px;
            background-color: #ccdff4;
            border-radius: 10px;
            box-sizing: border-box;
        }


        @media (max-width: 768px) {
            .chartbox {
                flex-direction: column;
                align-items: center;
            }

            .bookroomchart,
            .departmentChart {
                max-width: 100%;
                margin-bottom: 1rem;
            }
        }
    </style>


</head>

<body>

    <div id="app">

        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item mobile-aside-button">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
                <div class="navbar-item">
                    <section class="is-title-bar">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                            <ul>
                                <li>Admin</li>
                                <li>Dashboard</li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
            <div class="navbar-brand is-right">
                <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-menu" id="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item dropdown has-divider">
                        <a class="navbar-link">
                            <span class="icon">
                                <i class="mdi mdi-menu"></i>
                            </span>
                            <span>Hello, Admin</span>
                            <span class="icon">
                                <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="../logout.php">
                                <span class="icon"><i class="mdi mdi-logout"></i></span>
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside class="aside is-placed-left is-expanded">
            <div class="aside-tools">
                <div class="logo">
                    <a href="#"><img class="meyclogo" src="../public/assets/logo.webp" alt="logo"></a>
                    <p>MC RMIS</p>
                </div>
            </div>
            <div class="menu is-menu-main">
                <ul class="menu-list">
                    <li class="active">
                        <a href="#">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                    <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                                    <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
                                    <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                                    <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
                                </svg> </span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu-list">
                    <li class="--set-active-forms-html">
                        <a href="./pages/admin_approval.php">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                    <path d="M3 16m0 1a1 1 0 0 1 1 -1h1a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3"></path>
                                </svg></span>
                            <span class="menu-item-label">Pending Approval</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg></span>
                            <span class="menu-item-label">Manage Rooms</span>
                            <span class="icon"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul>
                            <li>
                                <a href="./pages/admin_add-rooms.php">
                                    <span>Add Rooms</span>
                                </a>
                            </li>
                            <li>
                                <a href="./pages/admin_delete-rooms.php">
                                    <span>Delete Rooms</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="--set-active-forms-html">
                        <a href="./pages/admin_manage-accounts.php">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg></span>
                            <span class="menu-item-label">Manage Accounts</span>
                        </a>
                    </li>
                </ul>

            </div>
        </aside>



        <section class="section main-section">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>Booking</h3>
                                <h1><?php echo $booking_count; ?></h1> <!-- Display the booking count here -->
                            </div>
                            <span class="icon widget-icon text-green-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2">
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M9 12l.01 0"></path>
                                    <path d="M13 12l2 0"></path>
                                    <path d="M9 16l.01 0"></path>
                                    <path d="M13 16l2 0"></path>
                                </svg> </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>Students</h3>
                                <h1><?php echo $student_count; ?></h1> <!-- Display the student count here -->
                            </div>
                            <span class="icon widget-icon text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2">
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg> </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>Pending</h3>
                                <h1><?php echo $pending_count; ?></h1> <!-- Display the count here -->
                            </div>
                            <span class="icon widget-icon text-red-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="40" height="40" stroke-width="2">
                                    <path d="M6.5 7h11"></path>
                                    <path d="M6.5 17h11"></path>
                                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                                </svg> </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your form and other content -->

            <!-- Canvas for the Doughnut Chart -->

            <div class="chartbox">
                <div class="bookroomchart">
                    <h3 style="text-align: center; margin: 10px 0;">Booked Room</h3>
                    <canvas id="bookroomchart" width="400" height="400"></canvas>
                </div>
                <div class="departmentChart">
                    <h3 style="text-align: center; margin: 10px 0;">Pending Requests in all Departments</h3>
                    <canvas id="departmentChart" width="400" height="200"></canvas>
                </div>
            </div>



            <script>
                const labels = [
                    'Classrooms',
                    'Computer Laboratory',
                    'Gymnasium',
                ];

                // Create gradient background for each section of the chart
                const ctx = document.getElementById('bookroomchart').getContext('2d');

                // Gradient for Classrooms
                const gradientClassrooms = ctx.createLinearGradient(0, 0, 0, 400);
                gradientClassrooms.addColorStop(0, 'rgba(50, 205, 50, 1)'); // Green
                gradientClassrooms.addColorStop(1, 'rgba(255, 255, 0, 1)'); // Yellow

                // Gradient for Computer Laboratory
                const gradientComputerLab = ctx.createLinearGradient(0, 0, 0, 400);
                gradientComputerLab.addColorStop(0, 'rgba(30, 144, 255, 1)'); // Blue
                gradientComputerLab.addColorStop(1, 'rgba(135, 206, 250, 1)'); // Light Blue

                // Gradient for Gymnasium
                const gradientGymnasium = ctx.createLinearGradient(0, 0, 0, 400);
                gradientGymnasium.addColorStop(0, 'rgba(255, 99, 132, 1)'); // Red
                gradientGymnasium.addColorStop(1, 'rgba(255, 159, 64, 1)'); // Orange

                // Data
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Room Reservations',
                        backgroundColor: [
                            gradientClassrooms, // For Classrooms
                            gradientComputerLab, // For Computer Lab
                            gradientGymnasium, // For Gymnasium
                        ],
                        borderColor: 'black',
                        data: [<?php echo $chartClassroomsRow ?>, <?php echo $chartComputerLabRow ?>, <?php echo $chartGymnasiumRow ?>],
                    }]
                };

                // Chart configuration
                const doughnutchart = {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                        },
                    }
                };

                // Create the chart
                const myChart = new Chart(
                    document.getElementById('bookroomchart'),
                    doughnutchart
                );
                // Use the PHP arrays in JavaScript
                const departmentLabels = <?php echo $department_labels_json; ?>;
                const departmentData = <?php echo $department_data_json; ?>;
                const departmentColors = <?php echo $department_colors_json; ?>;

                // Create an array of datasets, one for each department
                const datasets = departmentLabels.map((department, index) => ({
                    label: department,
                    data: [departmentData[index]], // Each department gets its own data point
                    backgroundColor: departmentColors[index], // Unique color for each department
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }));

                // Department requests chart data
                const ctx2 = document.getElementById('departmentChart').getContext('2d');
                const departmentChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: [''], // One label for the entire chart
                        datasets: datasets // Use the datasets array to plot each department
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom', // Display legends at the top
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>



        </section>

    </div>

    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript" src="js/chart.sample.min.js"></script>

    <!-- Icons . Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->


</body>

</html>