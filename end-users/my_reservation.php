<?php include '../public/includes/hello_firstname.php' ?>
<?php include '../public/includes/new_reservation.php' ?>
<?php include './handle_request.php' ?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Reservation</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/soft-ui-dashboard-tailwind.min.css">
    <link rel="stylesheet" href="../public/css/style-all-1.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <style>
        .modal {
            display: none;
        }

        .modal.is-active {
            display: flex;
        }

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
            table-layout: fixed;
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

        .modal-card-head {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
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
                                <li>My Reservation</li>
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
                    <li>
                        <a href="./new_reservation.php">
                            <span class="icon"><i class="ti ti-report"></i></span>
                            <span class="menu-item-label">New Reservation</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
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


        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div>
                    <div>
                        <div class="all_container">
                            <div class="table-container m-10">
                                <div class="card">
                                    <header class="card-header">
                                        <div class="new-title-container">
                                            <p class="new-title">
                                                My Reservation
                                            </p>
                                        </div>
                                    </header>
                                    <table class="table is-fullwidth is-striped">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Year & Section</th>
                                                <th>Room</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($requests)): ?>
                                                <tr>
                                                    <td colspan="7" class="has-text-centered">No reservation requests found.</td>
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
                                                            $status = $request['status'] ?? 'pending';
                                                            $statusClass = [
                                                                'pending' => 'is-warning',
                                                                'Approved' => 'is-success',
                                                                'Rejected' => 'is-danger'
                                                            ][$status] ?? 'is-warning';
                                                            ?>
                                                            <span class="tag <?= $statusClass ?>"><?= htmlspecialchars($status) ?></span>
                                                        </td>
                                                        <!-- In your table row, modify the buttons display: -->
                                                        <td data-label="Actions">
                                                            <div class="buttons are-small">
                                                                <?php if ($request['status'] === 'pending'): ?>
                                                                    <button class="button is-info styled-button" onclick='editRequest(<?= json_encode($request, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                                        <span class="icon"><i class="ti ti-edit"></i></span>
                                                                    </button>
                                                                    <button class="button is-danger styled-button is-reset" onclick="deleteRequest(<?= $request['request_id'] ?>, '<?= $request['status'] ?>')">
                                                                        <span class="icon"><i class="ti ti-cancel"></i></span>
                                                                    </button>
                                                                <?php elseif ($request['status'] === 'Success'): ?>
                                                                    <button class="button is-info styled-button" disabled>
                                                                        <span class="icon"><i class="ti ti-edit"></i></span>
                                                                    </button>
                                                                    <button class="button is-danger styled-button is-reset" disabled>
                                                                        <span class="icon"><i class="ti ti-cancel"></i></span>
                                                                    </button>
                                                                <?php else: ?>
                                                                    <button class="button is-info styled-button" onclick='editRequest(<?= json_encode($request, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                                        <span class="icon"><i class="ti ti-edit"></i></span>
                                                                    </button>
                                                                    <button class="button is-danger styled-button is-reset" onclick="deleteRequest(<?= $request['request_id'] ?>, '<?= $request['status'] ?>')">
                                                                        <span class="icon"><i class="ti ti-cancel"></i></span>
                                                                    </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- Edit Modal -->
                                    <div id="editModal" class="modal">
                                        <div class="modal-background"></div>
                                        <div class="modal-card">
                                            <header class="modal-card-head">
                                                <header class="card-header">
                                                    <div class="new-title-container">
                                                        <p class="new-title">
                                                            Edit Reservation
                                                        </p>
                                                    </div>
                                                </header>
                                                <button class="delete" aria-label="close" onclick="closeModal()"></button>
                                            </header>
                                            <section class="modal-card-body">
                                                <form id="editForm" method="POST" action="./handle_request.php">
                                                    <input type="hidden" name="action" value="update">
                                                    <input type="hidden" name="request_id" id="edit_request_id">

                                                    <div class="field">
                                                        <label class="label">Full Name:</label>
                                                        <div class="control">
                                                            <input class="input" type="text" name="full_name" id="edit_full_name" readonly disabled style="background-color: #f5f5f5;">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Year & Section:</label>
                                                        <div class="control">
                                                            <input class="input" type="text" name="year_section" id="edit_year_section" readonly disabled style="background-color: #f5f5f5;">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Department:</label>
                                                        <div class="control">
                                                            <input class="input" type="text" name="department" id="edit_department" readonly disabled style="background-color: #f5f5f5;">
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Preferred Room:</label>
                                                        <div class="select">
                                                            <select name="room_preferred" id="edit_room_preferred" required>
                                                                <?php
                                                                $sql = "SELECT room_name FROM rooms";
                                                                $result = $conn->query($sql);
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<option value=\"" . htmlspecialchars($row['room_name']) . "\">" . htmlspecialchars($row['room_name']) . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Purpose:</label>
                                                        <div class="control">
                                                            <input class="input" type="text" name="purpose" id="edit_purpose" required>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">Start Time:</label>
                                                        <div class="control">
                                                            <input class="input" type="datetime-local" name="start_datetime" id="edit_start_datetime" required>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label class="label">End Time:</label>
                                                        <div class="control">
                                                            <input class="input" type="datetime-local" name="end_datetime" id="edit_end_datetime" required>
                                                        </div>
                                                    </div>

                                                    <div class="field is-grouped">
                                                        <div class="control">
                                                            <button type="submit" class="button is-success styled-button">Save Changes</button>
                                                        </div>
                                                        <div class="control">
                                                            <button type="button" class="button styled-button is-reset" onclick="closeModal()">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </section>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script>
        // Function to handle the request editing
        function editRequest(request) {
            // Ensure request is properly parsed if it's a string
            if (typeof request === 'string') {
                try {
                    request = JSON.parse(request);
                } catch (e) {
                    console.error('Error parsing request data:', e);
                    return;
                }
            }

            // Check if status is Success
            if (request.status === 'Success') {
                Swal.fire({
                    title: 'Cannot Modify Request',
                    text: 'This request has been approved and cannot be modified.',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Check if status is not pending
            if (request.status !== 'pending') {
                Swal.fire({
                    title: 'Cannot Modify Request',
                    text: 'You cannot modify this request as it is no longer in pending status.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Rest of your existing editRequest code...
            const setFieldValue = (id, value) => {
                const element = document.getElementById(id);
                if (element) {
                    element.value = value || '';
                }
            };

            setFieldValue('edit_request_id', request.request_id);
            setFieldValue('edit_full_name', request.full_name);
            setFieldValue('edit_year_section', request.year_section);
            setFieldValue('edit_department', request.department);
            setFieldValue('edit_room_preferred', request.room_preferred);
            setFieldValue('edit_purpose', request.purpose);

            if (request.start_datetime) {
                const startDate = new Date(request.start_datetime);
                setFieldValue('edit_start_datetime', startDate.toISOString().slice(0, 16));
            }

            if (request.end_datetime) {
                const endDate = new Date(request.end_datetime);
                setFieldValue('edit_end_datetime', endDate.toISOString().slice(0, 16));
            }

            const modal = document.getElementById('editModal');
            if (modal) {
                modal.classList.add('is-active');
            }
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            if (modal) {
                modal.classList.remove('is-active');
            }
        }
        // Function to delete the reservation
        function deleteRequest(requestId, status) {
            // Check if status is Success
            if (status === 'Success') {
                Swal.fire({
                    title: 'Cannot Delete Request',
                    text: 'This request has been approved and cannot be deleted.',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Check if status is not pending
            if (status !== 'pending') {
                Swal.fire({
                    title: 'Cannot Delete Request',
                    text: 'You cannot delete this request as it is no longer in pending status.',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Cancel request?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = './handle_request.php';

                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'delete';

                    const requestInput = document.createElement('input');
                    requestInput.type = 'hidden';
                    requestInput.name = 'request_id';
                    requestInput.value = requestId;

                    form.appendChild(actionInput);
                    form.appendChild(requestInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Rest of your existing code...
    </script>



    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>

</body>

</html>