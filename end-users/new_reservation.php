<?php include '../public/includes/hello_firstname.php' ?>
<?php include '../public/includes/new_reservation.php' ?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Reservation</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/soft-ui-dashboard-tailwind.min.css">
    <link rel="stylesheet" href="../public/css/style-all-1.css">
    <!-- Add SweetAlert2 CSS and JS in the head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        form {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .field {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .all_container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .table-container {
            flex: 2;
            max-height: 100%;
            overflow-y: auto;
            margin-top: 1.5rem;
        }

        .main-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .card {
            height: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header-title {
            font-weight: bold;
            font-size: 1.2em;
        }


        .table {
            width: 100%;
        }

        .table th,
        .table td {
            padding: 12px 16px;
            text-align: left;
        }

        .table th {
            color: #363636;
            font-weight: 600;
        }

        .table td,
        .table th {
            border: 1px solid #dbdbdb;
            padding: 0.75em;
            vertical-align: middle;
        }

        .notification {
            margin-bottom: 15px;
        }

        .input,
        .select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .input:focus,
        .select:focus {
            border-color: #48c78e;
            box-shadow: 0 0 5px rgba(72, 199, 142, 0.6);
        }

        button {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        button.is-primary {
            background-color: #48c78e;
            color: #fff;
            border: none;
        }

        button.is-primary:hover {
            background-color: #40b67b;
        }

        button.is-light {
            background-color: #f0f0f0;
            color: #333;
            border: none;
        }

        button.is-light:hover {
            background-color: #e0e0e0;
        }


        .field.is-inline {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .field.is-inline .control {
            flex: 1;
        }

        .input.is-small {
            width: 100%;
        }


        select {
            border: none;
            outline: none;
            background: transparent;
            padding: 10px;
            font-size: 14px;
        }

        select:focus {
            border: none;
            box-shadow: 0 0 0 2px #48c78e;
        }

        .tag {
            border-radius: 4px;
            font-size: 0.875em;
            padding: 0.5em 0.75em;
            white-space: nowrap;
        }

        .tag.is-warning {
            background-color: #ffdd57;
            color: rgba(0, 0, 0, 0.7);
        }

        .tag.is-success {
            background-color: #48c78e;
            color: #fff;
        }

        .tag.is-danger {
            background-color: #f14668;
            color: #fff;
        }

        .thead {
            display: flex;
        }

        .titles th {
            flex: 1 1 0;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(243 244 246 / var(--tw-border-opacity));
        }

        .new-title-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .new-title {
            font-weight: bold;
            font-size: 1.2em;
            text-align: center;
            margin-top: 12px;
        }

        @media (max-width: 480px) {
            .new-title {
                font-size: 1em;
            }
        }


        @media (max-width: 1024px) {

            .all_container {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .table-container,
            .main-section {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 768px) {

            .field.is-inline {
                flex-direction: column;
            }

            .field.is-inline .control {
                margin-bottom: 10px;

            }

            .table-container {
                margin-top: 0;
            }

            .table th,
            .table td {
                font-size: 12px;
                padding: 8px 12px;
            }

            .table {
                font-size: 14px;
            }
        }

        .is-grouped {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
            gap: 1rem;
        }

        .styled-button {
            color: #fff;
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            width: auto;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .styled-button {
            background: linear-gradient(145deg, #d1a300, #9e8700);
        }

        .styled-button.is-reset {
            background: linear-gradient(145deg, rgba(242, 226, 162, 0.5), rgba(201, 160, 0, 0.5));
            color: #9e8700;
        }

        .styled-button:hover,
        .styled-button.is-reset:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }


        @media (max-width: 480px) {

            .card-header-title {
                font-size: 1em;
            }

            .input,
            .select {
                font-size: 12px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
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
                                <li>Student</li>
                                <li>New Reservation</li>
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
                        <a href="./user_about.php" class="navbar-link" title="Edit Profile">
                            <span>Hello, <?= htmlspecialchars($firstName); ?></span>
                        </a>
                    </div>
                </div>
            </div>

        </nav>

        <aside class="aside is-placed-left is-expanded sidebar">
            <div class="aside-tools">
                <div class="logo">
                    <a href="#"><img class="meyclogo" src="../public/assets/logo.webp" alt="logo"></a>
                    <p>MC RMIS</p>
                </div>
            </div>
            <div class="menu is-menu-main">
                <ul class="menu-list">
                    <li>
                        <a href="./users.php">
                            <span class="icon"><i class="ti ti-layout-dashboard"></i></span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <span class="icon"><i class="ti ti-report"></i></span>
                            <span class="menu-item-label">New Reservation</span>
                        </a>
                    </li>
                    <li>
                        <a href="./my_reservation.php">
                            <span class="icon"><i class="ti ti-heart-handshake"></i></span>
                            <span class="menu-item-label">My Reservation</span>
                        </a>
                    </li>
                </ul>

                <p class="menu-label" style="color: #fff;">About</p>
                <ul class="menu-list">
                    <li>
                        <a href="./about.php" class="has-icon">
                            <span class="icon"><i class="ti ti-info-square-rounded"></i></span>
                            <span class="menu-item-label">About</span>
                        </a>
                    </li>
                    <li>
                        <a href="../about_page/mission_values.php" class="has-icon">
                            <span class="icon"><i class="ti ti-target-arrow"></i></span>
                            <span class="menu-item-label">Mission & Values</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mx-4">
                <!-- load phantom colors for card after: -->
                <p class="invisible hidden text-gray-800 text-red-500 text-red-600 after"></p>
                <div class="after:opacity-65 after relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']" sidenav-card>
                    <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center" style="background-image: url('./images/green.jpg')"></div>
                    <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
                        <div class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
                            <i class="ti ti-help-square-rounded" style="color: #105738; font-size: 24px"></i>
                        </div>
                        <div class="transition-all duration-200 ease-nav-brand">
                            <h6 class="mb-0 text-white">Need help?</h6>
                            <p class="mt-0 mb-4 text-xs font-semibold leading-tight">Please check our FAQS</p>
                            <a href="./help.php" class="inline-block w-full px-8 py-2 mb-0 text-xs font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro hover:shadow-soft-2xl hover:scale-102">Help</a>
                        </div>
                    </div>
                </div>
                <!-- Log Out Button -->
                <a style="color: #105738;" class="inline-block w-full px-6 py-3 my-4 text-xs font-bold text-center uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-yellow-500 hover:bg-yellow-600 hover:scale-102 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50" href="../logout.php">
                    Log Out
                </a>
            </div>
        </aside>

        <div class="all_container">
            <div class="table-container m-10">
                <div class="card">
                    <header class="card-header">
                        <div class="new-title-container">
                            <p class="new-title">
                                Room requests
                            </p>
                        </div>
                    </header>
                    <table class="table is-fullwidth is-striped">
                        <thead>
                            <tr class="titles">
                                <th>Full Name</th>
                                <th>Year & Section</th>
                                <th>Room</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($requests)): ?>
                                <tr>
                                    <td colspan="8" class="has-text-centered">No reservation requests found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <td data-label="Full Name"><?= htmlspecialchars($request['full_name']) ?></td>
                                        <td data-label="Year & Section"><?= htmlspecialchars($request['year_section']) ?></td>
                                        <td data-label="Room Preferred"><?= htmlspecialchars($request['room_preferred']) ?></td>
                                        <td data-label="Start Datetime"><?= date('M d, Y h:i A', strtotime($request['start_datetime'])) ?></td>
                                        <td data-label="End Datetime"><?= date('M d, Y h:i A', strtotime($request['end_datetime'])) ?></td>
                                        <td data-label="Status">
                                            <?php
                                            $status = $request['status'] ?? 'Pending';
                                            $statusClass = [
                                                'Pending' => 'is-warning',
                                                'Approved' => 'is-success',
                                                'Rejected' => 'is-danger'
                                            ][$status] ?? 'is-warning';
                                            ?>
                                            <span class="tag <?= $statusClass ?>"><?= htmlspecialchars($status) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <section class="section main-section">
                <div class="card mb-6">
                    <header class="card-header">
                        <div class="new-title-container">
                            <p class="new-title">
                                Room Requisition Form
                            </p>
                        </div>
                    </header>


                    <div>
                        <?php if ($success_message): ?>
                            <div class="notification is-success is-light">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($error_message): ?>
                            <div class="notification is-danger is-light">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <!-- Full Name and Year & Section -->
                            <div class="field is-inline">
                                <div class="control">
                                    <label class="label">Full Name:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="full_name" placeholder="Full Name"
                                            value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label">Year & Section:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="year_section" placeholder="Year & Section"
                                            value="<?php echo isset($_POST['year_section']) ? htmlspecialchars($_POST['year_section']) : ''; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Department and Preferred Room -->
                            <div class="field is-inline">
                                <div class="control">
                                    <label class="label">Department:</label>
                                    <div class="select">
                                        <select name="department" required>
                                            <?php
                                            $departments = ['Accountancy', 'Business Administration', 'Hospitality Management', 'Education and Arts', 'Criminal Justice'];
                                            foreach ($departments as $dept) {
                                                $selected = (isset($_POST['department']) && $_POST['department'] == $dept) ? 'selected' : '';
                                                echo "<option value=\"$dept\" $selected>$dept</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label">Preferred Room:</label>
                                    <div class="select">
                                        <select name="room_preferred" required>
                                            <?php
                                            // Fetch available rooms from the database
                                            $sql = "SELECT room_name FROM rooms";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $room = $row['room_name'];
                                                    $selected = (isset($_POST['room_preferred']) && $_POST['room_preferred'] === $room) ? 'selected' : '';
                                                    echo "<option value=\"" . htmlspecialchars($room) . "\" $selected>" . htmlspecialchars($room) . "</option>";
                                                }
                                            } else {
                                                echo "<option value=\"\">No rooms available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Purpose -->
                            <div class="field">
                                <label class="label">Purpose:</label>
                                <div class="control">
                                    <input class="input" type="text" name="purpose" placeholder="e.g. For Study"
                                        value="<?php echo isset($_POST['purpose']) ? htmlspecialchars($_POST['purpose']) : ''; ?>" required>
                                </div>
                            </div>

                            <!-- Start Time and End Time -->
                            <div class="field is-inline">
                                <div class="control">
                                    <label class="label">Start Time:</label>
                                    <input class="input is-small" type="datetime-local" name="start_datetime" value="<?php echo isset($_POST['start_datetime']) ? htmlspecialchars($_POST['start_datetime']) : ''; ?>" required>
                                </div>
                                <div class="control">
                                    <label class="label">End Time:</label>
                                    <input class="input is-small" type="datetime-local" name="end_datetime" value="<?php echo isset($_POST['end_datetime']) ? htmlspecialchars($_POST['end_datetime']) : ''; ?>" required>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="styled-button" type="submit">Submit</button>
                                </div>
                                <div class="control">
                                    <button class="styled-button is-reset" type="reset">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </section>
        </div>


    </div>


    <!-- Add this script at the bottom of your page, just before </body> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($success_message): ?>
                Swal.fire({
                    title: 'Success!',
                    text: <?php echo json_encode($success_message); ?>,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>

            <?php if ($error_message): ?>
                Swal.fire({
                    title: 'Error!',
                    text: <?php echo json_encode($error_message); ?>,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>

            // Add form submission handler
            document.querySelector('form').addEventListener('submit', function(e) {
                // Show loading state
                Swal.fire({
                    title: 'Submitting...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetButton = document.querySelector('button[type="reset"]');
            const form = resetButton.closest('form');

            resetButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default reset behavior

                // Clear all text inputs and textareas
                form.querySelectorAll('input[type="text"], textarea').forEach(input => {
                    input.value = '';
                });

                // Reset datetime inputs to empty
                form.querySelectorAll('input[type="datetime-local"]').forEach(input => {
                    input.value = '';
                });

                // Reset select elements to first option
                form.querySelectorAll('select').forEach(select => {
                    select.selectedIndex = 0;
                });

                // Clear any success/error messages
                const notifications = document.querySelectorAll('.notification');
                notifications.forEach(notification => {
                    notification.style.display = 'none';
                });

                // Remove any validation styles that might have been applied
                form.querySelectorAll('.input, .select, .textarea').forEach(field => {
                    field.classList.remove('is-danger', 'is-success');
                });

                // Reset any help text to default state
                form.querySelectorAll('.help').forEach(help => {
                    help.textContent = help.dataset.default || '';
                });
            });
        });
    </script>

    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>

</body>

</html>