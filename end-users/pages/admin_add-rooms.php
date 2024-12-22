<?php
include '../../database/config.php';
session_start();

$usermail = $_SESSION['usermail'] ?? "";
if (!$usermail) {
    header("location: ../../index.php");
}

// Handle Delete
if (isset($_POST['delete'])) {
    $room_id = $_POST['room_id'];
    $delete_sql = "DELETE FROM rooms WHERE room_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $room_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle Edit
if (isset($_POST['edit'])) {
    $room_id = $_POST['room_id'];
    $room_name = trim($_POST['room_name']);
    $room_description = trim($_POST['room_description']);

    if (!empty($room_name) && !empty($room_description)) {
        $update_sql = "UPDATE rooms SET room_name = ?, room_description = ? WHERE room_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $room_name, $room_description, $room_id);
        $update_stmt->execute();
        $update_stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Handle Add (existing code)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete']) && !isset($_POST['edit'])) {
    $room_name = $_POST['room_name'] ?? '';
    $room_description = $_POST['room_description'] ?? '';

    if (empty($room_name) || empty($room_description)) {
        echo "<p class='text-red-500'>Error: Both Room Name and Description are required!</p>";
    } else {
        $sql = "INSERT INTO rooms (room_name, room_description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $room_name, $room_description);

        if ($stmt->execute()) {
            echo "<p class='text-green-500'>Room added successfully!</p>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p class='text-red-500'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

// Fetch rooms (existing code)
$sql = "SELECT room_id, room_name, room_description, created_at FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage-rooms</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <style>
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

        .input,
        .textarea {
            opacity: 1 !important;
            pointer-events: auto !important;
            width: 100%;
            padding: 8px;
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

        /* Default container layout: 2fr 1fr for larger screens */
        .container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        /* Form and table container styling */
        .form-container,
        .students-table {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }

        /* Common button styling */
        .button {
            padding: 0.5rem 1rem;
            background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-block;
        }


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
            margin-top: 0.5rem;
        }

        .button:hover {
            background-color: rgb(41 51 65 / var(--tw-bg-opacity));
        }


        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
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
                                <li>Add Rooms</li>
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
                    <li class="active">
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
                                <a href="#">
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
                    <li>
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

        <div class="container section main-section">
            <div class="students-table">
                <h2 class="text-xl font-semibold mb-4" style="text-align: center;">Room Categories </h2>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Name</th>
                                <th>Room Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr class="table-row">
                                        <td data-label="Room ID"><?php echo htmlspecialchars($row['room_id']); ?></td>
                                        <td data-label="Room Name"><?php echo htmlspecialchars($row['room_name']); ?></td>
                                        <td data-label="Room Description"><?php echo htmlspecialchars($row['room_description']); ?></td>
                                        <td data-label="Created At"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td data-label="Actions">
                                            <!-- Edit Button -->
                                            <button class="edit-button"
                                                onclick="openEditModal(<?php echo htmlspecialchars($row['room_id']); ?>, 
                '<?php echo htmlspecialchars($row['room_name'], ENT_QUOTES); ?>', 
                '<?php echo htmlspecialchars($row['room_description'], ENT_QUOTES); ?>')"
                                                class="button is-info">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="" method="POST" style="display:inline;">
                                                <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                                <br><button type="submit" name="delete" class="edit-button is-danger"
                                                    onclick="return confirm('Are you sure you want to delete this room?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">No rooms available</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Edit Modal -->
            <div id="editModal" class="modal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Edit Room</p>
                        <button class="delete" aria-label="close" onclick="closeEditModal()"></button>
                    </header>
                    <section class="modal-card-body">
                        <form id="editForm" method="POST">
                            <input type="hidden" name="room_id" id="edit_room_id">
                            <div class="field">
                                <label class="label">Room Name</label>
                                <div class="control">
                                    <input class="input" type="text" name="room_name" id="edit_room_name" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Room Description</label>
                                <div class="control">
                                    <textarea class="textarea" name="room_description" id="edit_room_description" required></textarea>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button type="submit" name="edit" class="button is-success">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Add Room Form -->
            <div>
                <div class="form-container">
                    <h2 class="text-xl font-semibold mb-4 md:mb-6">Add Room</h2> <!-- Ensure the title is visible in mobile and desktop views -->
                    <form method="POST">
                        <div class="field mb-4">
                            <label class="label">Room Name:</label>
                            <div class="control">
                                <input class="input" type="text" name="room_name" placeholder="Room Name" required>
                            </div>
                        </div>

                        <div class="field mb-4">
                            <label class="label">Room Description:</label>
                            <div class="control">
                                <textarea class="textarea" name="room_description" placeholder="Room Description" required></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <div class="buttons right nowrap">
                                <!-- Add Room Button -->
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                    <button type="submit" class="button is-success">Add Room</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <!-- Add JavaScript for modal functionality -->
    <script>
        function openEditModal(id, name, description) {
            document.getElementById('edit_room_id').value = id;
            document.getElementById('edit_room_name').value = name;
            document.getElementById('edit_room_description').value = description;
            document.getElementById('editModal').classList.add('is-active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('is-active');
        }

        // Close modal when clicking outside
        document.querySelector('.modal-background').addEventListener('click', closeEditModal);
    </script>

    <!-- Scripts -->
    <script type="text/javascript" src="../js/main.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Icons . Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>