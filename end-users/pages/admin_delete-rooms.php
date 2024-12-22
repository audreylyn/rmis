<?php
include '../../database/config.php';

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Transaction for delete action
    if ($action == 'delete' && isset($_POST['request_id'])) {
        $request_id = $_POST['request_id'];

        $conn->begin_transaction();

        try {
            // Delete the user from the signup table
            $sql = "DELETE FROM room_requests WHERE request_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $request_id);
            $stmt->execute();

            $conn->commit();

            // Use JavaScript for SweetAlert notification
            echo "<script>
                    window.onload = function() {
                        swal('Success!', 'Room request deleted successfully!', 'success').then(() => {
                            window.location.href = './admin_delete-rooms.php';
                        });
                    }
                  </script>";
        } catch (Exception $e) {
            $conn->rollback();

            echo "<script>
                    window.onload = function() {
                        swal('Error!', 'Error deleting rooms: " . addslashes($e->getMessage()) . "', 'error');
                    }
                  </script>";
        }
    }
}

// Fetch students to display
$sql = "SELECT * FROM room_requests";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en" class="">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin-approval</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- CSS Links -->
    <link rel="stylesheet" href="../css/main.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css"> <!-- Icons -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> <!-- jQuery -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> <!-- DataTables Bootstrap -->


    <style>
        .form-control {
            margin-top: .5rem;
            margin-right: .5rem;
            width: 200px;
            border-radius: 10px;
            border: 2px solid #007bff;
            /* Use a solid border color */
            background-color: #f8f9fa;
            /* Light background color */
            padding: 6px 10px;
            font-size: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
            /* Subtle shadow */
        }

        .form-control:focus {
            outline: none;
            border-color: #0056b3;
            /* Darker blue when focused */
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
            /* More intense focus shadow */
        }

        .form-control::placeholder {
            color: #888;
            /* Placeholder color */
            opacity: 1;
        }



        /* Common button styling */
        .button {
            padding: 0.5rem .7rem;
            background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-block;
        }


        .button:hover {
            background-color: rgb(41 51 65 / var(--tw-bg-opacity));
        }

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

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal.is-active {
            display: flex;
        }

        .modal-card {
            background: white;
            margin: auto;
            width: 90%;
            max-width: 500px;
            z-index: 10000;
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
                                <li>Manage Rooms</li>
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
                    <li>
                        <a href="./admin_approval.php">
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
                    <li class="active">
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
                <div class="card-content">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Full Name</th>
                                <th>Year & Section</th>
                                <th>Department</th>
                                <th>Room Preferred</th>
                                <th>Purpose</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td data-label="Request ID"><?php echo htmlspecialchars($row['request_id']); ?></td>
                                        <td data-label="Full Name"><?php echo htmlspecialchars($row['full_name']); ?></td>
                                        <td data-label="Year & Section"><?php echo htmlspecialchars($row['year_section']); ?></td>
                                        <td data-label="Department"><?php echo htmlspecialchars($row['department']); ?></td>
                                        <td data-label="Room Preferred"><?php echo htmlspecialchars($row['room_preferred']); ?></td>
                                        <td data-label="Purpose"><?php echo htmlspecialchars($row['purpose']); ?></td>
                                        <td data-label="Start Time"><?php echo htmlspecialchars($row['start_datetime']); ?></td>
                                        <td data-label="End Time"><?php echo htmlspecialchars($row['end_datetime']); ?></td>
                                        <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td class="actions-cell">
                                            <div class="buttons right nowrap">
                                                <!-- Delete Request Button -->
                                                <button onclick="deleteRequest(<?php echo $row['request_id']; ?>)" class="button is-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;">No room requests found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": false,
                "info": true,
                "ordering": true,
                "searching": true,
            });
        });
    </script>


    <script>
        function deleteRequest(request_id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this room request!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Create a form dynamically to submit delete action
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '';

                        var actionInput = document.createElement('input');
                        actionInput.type = 'hidden';
                        actionInput.name = 'action';
                        actionInput.value = 'delete';
                        form.appendChild(actionInput);

                        var request_idInput = document.createElement('input');
                        request_idInput.type = 'hidden';
                        request_idInput.name = 'request_id';
                        request_idInput.value = request_id;
                        form.appendChild(request_idInput);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
        }
    </script>





    <!-- Custom and Additional Scripts -->
    <script type="text/javascript" src="../js/main.min.js"></script> <!-- Custom JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script> <!-- Pace Loader -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script> <!-- Animate On Scroll -->

</body>

</html>