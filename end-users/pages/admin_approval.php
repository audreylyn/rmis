<?php
include '../../database/config.php';

// Function to approve request
if (isset($_POST['approve_request'])) {
    $request_id = $_POST['request_id'];
    $updateSql = "UPDATE room_requests SET status = 'Success' WHERE request_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $stmt->close();

    // Prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Function to decline request
if (isset($_POST['decline_request'])) {
    $request_id = $_POST['request_id'];
    $updateSql = "UPDATE room_requests SET status = 'Declined' WHERE request_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $stmt->close();

    // Prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch room requests with pagination
$rowsPerPage = 7;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from the URL, default to 1
$startLimit = ($page - 1) * $rowsPerPage; // Calculate starting point

// Fetch total number of rows for pagination
$sqlCount = "SELECT COUNT(*) AS total FROM room_requests";
$countResult = $conn->query($sqlCount);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $rowsPerPage);

// Fetch the data for the current page
$sql = "SELECT * FROM room_requests LIMIT $startLimit, $rowsPerPage";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin-approval</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


    <style>
        /* Style the logo and text container */
        .logo {
            display: flex;
            align-items: center;
        }

        /* Style the logo image */
        .meyclogo {
            width: 40px;
            height: auto;
            margin-right: 10px;
        }

        /* Style the text */
        .logo p {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .exportexcel {
            height: 35px;
            width: auto;
            min-width: 120px;
            background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            border: none;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
            color: white;
            text-align: center;
            padding: 0 12px;
            transition: background-color 0.3s ease;
            margin-top: .4rem;
            margin-right: .5rem;
        }

        .exportexcel:hover {
            background-color: rgb(41 51 65 / var(--tw-bg-opacity));
        }

        .exportexcel i {
            margin-right: 8px;
            font-size: 18px;
        }
    </style>

    <script>
        // Pagination logic
        let currentPage = <?php echo $page; ?>;
        const rowsPerPage = <?php echo $rowsPerPage; ?>;
        const totalRows = <?php echo $totalRows; ?>;
        const totalPages = <?php echo $totalPages; ?>;

        function changePage(page) {
            currentPage = page;
            window.location.href = '?page=' + page; // Redirect to the correct page
        }

        function updatePagination() {
            const paginationContainer = document.querySelector('.table-pagination .buttons');
            paginationContainer.innerHTML = '';

            // Create page buttons dynamically
            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.type = 'button';
                button.classList.add('button');
                button.textContent = i;
                button.onclick = () => changePage(i);

                if (i === currentPage) {
                    button.classList.add('active');
                }

                paginationContainer.appendChild(button);
            }
        }

        window.onload = function() {
            updatePagination();
        };
    </script>

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
                                <li>Pending Approval</li>
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
                            <a class="navbar-item" href="../../logout.php">
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
                    <a href="#"><img class="meyclogo" src="../../public/assets/logo.webp" alt="logo"></a>
                    <p>MC RMIS</p>
                </div>
            </div>
            <div class="menu is-menu-main">
                <ul class="menu-list">
                    <li>
                        <a href="../admin.php">
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
                    <li class="active">
                        <a href="#">
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
                                <a href="./admin_add-rooms.php">
                                    <span>Add Rooms</span>
                                </a>
                            </li>
                            <li>
                                <a href="./admin_delete-rooms.php">
                                    <span>Delete Requests</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="--set-active-forms-html">
                        <a href="./admin_manage-accounts.php">
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
            <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        Pending Requests
                    </p>

                    <!-- Form to trigger export action -->
                    <form action="../excel_export.php" method="post">
                        <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit">
                            <i class="fas fa-file-excel"></i> Excel Convert <!-- Font Awesome Excel icon -->
                        </button>
                    </form>
                </header>
                <div class="card-content">
                    <table id="roomRequestsTable">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Year & Section</th>
                                <th>Department</th>
                                <th>Room Preferred</th>
                                <th>Purpose</th>
                                <th>Start Datetime</th>
                                <th>End Datetime</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all the rows
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr class="table-row">
                                        <td data-label="Full Name"><?php echo htmlspecialchars($row['full_name']); ?></td>
                                        <td data-label="Year & Section"><?php echo htmlspecialchars($row['year_section']); ?></td>
                                        <td data-label="Department"><?php echo htmlspecialchars($row['department']); ?></td>
                                        <td data-label="Room Preferred"><?php echo htmlspecialchars($row['room_preferred']); ?></td>
                                        <td data-label="Purpose"><?php echo htmlspecialchars($row['purpose']); ?></td>
                                        <td data-label="Start Datetime"><?php echo htmlspecialchars($row['start_datetime']); ?></td>
                                        <td data-label="End Datetime"><?php echo htmlspecialchars($row['end_datetime']); ?></td>
                                        <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td class="actions-cell">
                                            <div class="buttons right nowrap">
                                                <?php if ($row['status'] === 'pending'): ?>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                                        <button type="submit" name="approve_request" class="button small green">
                                                            <span class="icon"><i class="mdi mdi-check"></i></span>
                                                        </button>
                                                    </form>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                                        <button type="submit" name="decline_request" class="button small red">
                                                            <span class="icon"><i class="mdi mdi-close"></i></span>
                                                        </button>
                                                    </form>
                                                <?php elseif ($row['status'] === 'Success'): ?>
                                                    <span class="tag green">Approved</span>
                                                <?php elseif ($row['status'] === 'Declined'): ?>
                                                    <span class="tag red">Declined</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" style="text-align: center;">No room requests found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>



                    <!-- Pagination controls -->
                    <div class="table-pagination">
                        <div class="flex items-center justify-between">
                            <div class="buttons">
                                <button type="button" class="button" onclick="changePage(1)">1</button>
                                <button type="button" class="button" onclick="changePage(2)">2</button>
                                <button type="button" class="button" onclick="changePage(3)">3</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="../js/main.min.js"></script>

    <!-- Scripts (after body content for better performance) -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>


</body>

</html>