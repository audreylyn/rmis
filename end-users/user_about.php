<?php include '../public/includes/hello_firstname.php' ?>
<?php include '../public/includes/about.php' ?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="./css/main_2.css">
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
            margin-left: 2.5rem;
        }

        .modal-card-title {
            margin-left: 2.5rem;
            margin-bottom: 0;
        }

        .close {
            margin: 0 0 .7rem 0;
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
                                <li>About Me</li>
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

        <div class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen bg-gray-50 transition-all duration-200">
            <nav class="absolute z-20 flex flex-wrap items-center justify-between w-full px-6 py-2 text-white transition-all shadow-none duration-250 ease-soft-in lg:flex-nowrap lg:justify-start" navbar-profile navbar-scroll="true">
                <div class="flex items-center justify-between w-full px-6 py-1 mx-auto flex-wrap-inherit">

                </div>
            </nav>

            <div class="w-full px-6 mx-auto">
                <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl" style="background-image: url('../public/assets/curved.png'); background-position-y: 50%">
                </div>

                <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                            <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                                <img src="../public/assets/icons/acc_icon.svg" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
                            </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                            <div class="h-full">
                                <h5 class="mb-1"><?= htmlspecialchars($db_full_name); ?></h5>
                                <p class="mb-0 font-semibold leading-normal text-sm">Student</p>
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                            <div class="relative right-0">
                                <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl" nav-pills role="tablist">
                                    <li class="z-30 flex-auto text-center">
                                        <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700" nav-link active href="javascript:;" role="tab" aria-selected="true">
                                            <span class="ml-1"></span>
                                        </a>
                                    </li>
                                    <li class="z-30 flex-auto text-center">
                                        <a class="z-30 block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700" nav-link href="javascript:;" role="tab" aria-selected="false">
                                            <span class="ml-1"></span>
                                        </a>
                                    </li>
                                    <li class="z-30 flex-auto text-center">
                                        <a class="z-30 block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-slate-700" nav-link href="javascript:;" role="tab" aria-selected="false">
                                            <svg class="text-slate-700" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>profile</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                        <g transform="translate(1716.000000, 291.000000)">
                                                            <g transform="translate(304.000000, 151.000000)">
                                                                <polygon class="fill-slate-800" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                                <path class="fill-slate-800" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                                                <path class="fill-slate-800" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="ml-1">Profile</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                                    User Profile Management
                                                </p>
                                            </div>
                                        </header>
                                        <table class="table is-fullwidth is-striped">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Student Number</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($users)): ?>
                                                    <tr>
                                                        <td colspan="6" class="has-text-centered">No user data found.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($users as $user): ?>
                                                        <tr>
                                                            <td data-label="Student ID"><?= htmlspecialchars($user['StudentId']) ?></td>
                                                            <td data-label="First Name"><?= htmlspecialchars($user['FirstName']) ?></td>
                                                            <td data-label="Last Name"><?= htmlspecialchars($user['LastName']) ?></td>
                                                            <td data-label="Student Number"><?= htmlspecialchars($user['StudentNumber']) ?></td>
                                                            <td data-label="Email"><?= htmlspecialchars($user['Email']) ?></td>
                                                            <td data-label="Actions">
                                                                <div class="buttons are-small">
                                                                    <button class="button is-info styled-button" onclick='viewUser(<?= json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                                        <span class="icon"><i class="ti ti-eye"></i></span>
                                                                    </button>
                                                                    <button class="button is-info styled-button" onclick='editUser(<?= json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                                                        <span class="icon"><i class="ti ti-edit"></i></span>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <!-- View Modal -->
                                        <div id="viewModal" class="modal">
                                            <div class="modal-background" onclick="closeViewModal()"></div>
                                            <div class="modal-card" style="width: 30%; margin: auto;">
                                                <header class="modal-card-head has-text-centered" style="justify-content: center;">
                                                    <p class="modal-card-title" style="font-size: 1.2rem; font-weight: bold;">View User Profile</p>
                                                    <button class="delete" aria-label="close" onclick="closeViewModal()"></button>
                                                </header>
                                                <section class="modal-card-body" style="padding: 1rem;">
                                                    <div style="text-align: center;">
                                                        <p><strong>First Name:</strong> <span id="view_first_name"></span></p>
                                                        <p><strong>Last Name:</strong> <span id="view_last_name"></span></p>
                                                        <p><strong>Student Number:</strong> <span id="view_student_number"></span></p>
                                                        <p><strong>Email:</strong> <span id="view_email"></span></p>
                                                    </div>
                                                </section>
                                                <footer class="modal-card-foot" style="justify-content: center; padding: 1rem;">
                                                    <button class="button styled-button is-link close" onclick="closeViewModal()" style="padding: 0.5rem 1rem;">Close</button>
                                                </footer>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div id="editModal" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-card">
                                                <header class="modal-card-head">
                                                    <header class="card-header">
                                                        <div class="new-title-container">
                                                            <p class="new-title">
                                                                Edit User Profile
                                                            </p>
                                                        </div>
                                                    </header>
                                                    <button class="delete" aria-label="close" onclick="closeModal()"></button>
                                                </header>
                                                <section class="modal-card-body">
                                                    <form id="editForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="hidden" name="StudentId" id="edit_student_id">

                                                        <div class="field">
                                                            <label class="label">First Name:</label>
                                                            <div class="control">
                                                                <input class="input" type="text" name="FirstName" id="edit_first_name" required>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Last Name:</label>
                                                            <div class="control">
                                                                <input class="input" type="text" name="LastName" id="edit_last_name" required>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Student Number:</label>
                                                            <div class="control">
                                                                <input class="input" type="text" name="StudentNumber" id="edit_student_number" required>
                                                            </div>
                                                        </div>

                                                        <div class="field">
                                                            <label class="label">Email:</label>
                                                            <div class="control">
                                                                <input class="input" type="email" name="Email" id="edit_email" required>
                                                            </div>
                                                        </div>

                                                        <div class="field is-grouped">
                                                            <div class="control">
                                                                <button type="submit" name="edit_user" class="button is-success styled-button">Save Changes</button>
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


    </div>

    <script>
        function editUser(user) {
            document.getElementById('edit_student_id').value = user.StudentId;
            document.getElementById('edit_first_name').value = user.FirstName;
            document.getElementById('edit_last_name').value = user.LastName;
            document.getElementById('edit_student_number').value = user.StudentNumber;
            document.getElementById('edit_email').value = user.Email;

            document.getElementById('editModal').classList.add('is-active');
        }

        function closeModal() {
            document.getElementById('editModal').classList.remove('is-active');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('editModal');
            if (event.target.classList.contains('modal-background')) {
                closeModal();
            }
        });

        // Form validation
        document.getElementById('editForm').addEventListener('submit', function(event) {
            const studentNumber = document.getElementById('edit_student_number').value;
            const email = document.getElementById('edit_email').value;

            if (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address',
                    confirmButtonColor: '#d33'
                });
                event.preventDefault();
                return;
            }

            if (!studentNumber.match(/^\d{2}-\d{4}$/)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Student Number',
                    text: 'Please enter a valid student number (format: XX-XXXX)',
                    confirmButtonColor: '#d33'
                });
                event.preventDefault();
                return;
            }
        });

        function viewUser(user) {
            // Set modal content
            document.getElementById('view_first_name').textContent = user.FirstName;
            document.getElementById('view_last_name').textContent = user.LastName;
            document.getElementById('view_student_number').textContent = user.StudentNumber;
            document.getElementById('view_email').textContent = user.Email;

            // Show modal
            document.getElementById('viewModal').classList.add('is-active');
        }

        function closeViewModal() {
            // Hide modal
            document.getElementById('viewModal').classList.remove('is-active');
        }
    </script>




    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>

</body>

</html>