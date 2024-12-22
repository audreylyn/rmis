<?php
include '../../database/config.php';

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Transaction for delete action
    if ($action == 'delete' && isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];

        $conn->begin_transaction();

        try {
            // Delete the user from the signup table
            $sql = "DELETE FROM signup WHERE StudentId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $student_id);
            $stmt->execute();

            $conn->commit();

            // Use JavaScript for SweetAlert notification
            echo "<script>
                    window.onload = function() {
                        swal('Success!', 'Account deleted successfully!', 'success').then(() => {
                            window.location.href = './admin_manage-accounts.php';
                        });
                    }
                  </script>";
        } catch (Exception $e) {
            $conn->rollback();

            echo "<script>
                    window.onload = function() {
                        swal('Error!', 'Error deleting account: " . addslashes($e->getMessage()) . "', 'error');
                    }
                  </script>";
        }
    }

    // Handle account editing
    if ($action == 'edit' && isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $conn->begin_transaction();

        try {
            // Prepare the update SQL
            if ($password) {
                $sql = "UPDATE signup SET FirstName = ?, LastName = ?, Email = ?, Password = ? WHERE StudentId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssi", $first_name, $last_name, $email, $password, $student_id);
            } else {
                $sql = "UPDATE signup SET FirstName = ?, LastName = ?, Email = ? WHERE StudentId = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $first_name, $last_name, $email, $student_id);
            }

            $stmt->execute();

            $conn->commit();

            echo "<script>
                    window.onload = function() {
                        swal('Success!', 'Account updated successfully!', 'success').then(() => {
                            window.location.href = './admin_manage-accounts.php';
                        });
                    }
                  </script>";
        } catch (Exception $e) {
            $conn->rollback();

            echo "<script>
                    window.onload = function() {
                        swal('Error!', 'Error updating account: " . addslashes($e->getMessage()) . "', 'error');
                    }
                  </script>";
        }
    }
}

// Fetch students to display
$sql = "SELECT * FROM signup";
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

    <style>
        .edit-button {
            padding: 0.5rem 1rem;
            background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .edit-button.is-danger {
            margin-right: 0.5rem;
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
                                <li>Manage Accounts</li>
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
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        Manage Accounts
                    </p>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td data-label="Student Number"><?php echo htmlspecialchars($row['StudentNumber']); ?></td>
                                        <td data-label="First Name"><?php echo htmlspecialchars($row['FirstName']); ?></td>
                                        <td data-label="Last Name"><?php echo htmlspecialchars($row['LastName']); ?></td>
                                        <td data-label="Email"><?php echo htmlspecialchars($row['Email']); ?></td>
                                        <td class="actions-cell">
                                            <div class="buttons right nowrap">
                                                <!-- Edit Account Button -->
                                                <button class="edit-button is-danger" onclick="editAccount(
                                            '<?php echo $row['StudentId']; ?>',
                                            '<?php echo htmlspecialchars($row['FirstName']); ?>',
                                            '<?php echo htmlspecialchars($row['LastName']); ?>',
                                            '<?php echo htmlspecialchars($row['Email']); ?>'
                                        )" class="button is-primary">Edit</button>

                                                <!-- Delete Account Button -->
                                                <button class="edit-button" onclick="deleteAccount(<?php echo $row['StudentId']; ?>)">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">No student accounts found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Edit Account Modal -->
        <div id="editModal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Account</p>
                    <button class="delete" aria-label="close" onclick="closeEditModal()"></button>
                </header>
                <section class="modal-card-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="student_id" id="editStudentId">

                        <div class="field">
                            <label class="label">First Name</label>
                            <div class="control">
                                <input class="input" type="text" name="first_name" id="editFirstName" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Last Name</label>
                            <div class="control">
                                <input class="input" type="text" name="last_name" id="editLastName" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="email" id="editEmail" required>
                            </div>
                        </div>
                    </form>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" onclick="submitEditForm()">Save Changes</button>
                    <button class="button" onclick="closeEditModal()">Cancel</button>
                </footer>
            </div>
        </div>



    </div>

    <script>
        function editAccount(studentId, firstName, lastName, email) {
            document.getElementById('editStudentId').value = studentId;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editEmail').value = email;
            document.getElementById('editModal').classList.add('is-active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('is-active');
        }

        function submitEditForm() {
            document.getElementById('editForm').submit();
        }

        function deleteAccount(studentId) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this account!",
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

                        var studentIdInput = document.createElement('input');
                        studentIdInput.type = 'hidden';
                        studentIdInput.name = 'student_id';
                        studentIdInput.value = studentId;
                        form.appendChild(studentIdInput);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
        }
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Scripts  -->
    <script type="text/javascript" src="../js/main.min.js"></script>
    <!-- Scripts (after body content for better performance) -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Icons . Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>