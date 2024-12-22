<?php include '../public/includes/hello_firstname.php' ?>
<?php include '../public/includes/user_dashboard.php' ?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/soft-ui-dashboard-tailwind.min.css">
    <link rel="stylesheet" href="../public/css/style-all-1.css">

    <style>
        /* Notification bell container */
        .notification-bell {
            position: relative;
            display: inline-block;
            margin-right: 20px;
        }

        /* Bell icon styling */
        .bell-icon {
            cursor: pointer;
            padding: 10px;
            position: relative;
            background: transparent;
            border: none;
            display: flex;
            align-items: center;
            transition: transform 0.2s ease;
        }

        .bell-icon:hover {
            transform: scale(1.05);
        }

        .bell-icon i {
            font-size: 24px;
            color: #333;
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 4px;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Notification dropdown */
        .notification-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            width: 320px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .notification-dropdown.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Notification header */
        .notification-header {
            padding: 16px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
        }

        .notification-header span {
            font-weight: 600;
            color: #333;
        }

        .notification-header a {
            color: #666;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s ease;
        }

        .notification-header a:hover {
            color: #333;
        }

        /* Notification list */
        .notification-list {
            max-height: 360px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        /* Notification item */
        .notification-item {
            padding: 16px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: background-color 0.2s ease;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-item i {
            font-size: 20px;
            color: #666;
            margin-top: 2px;
        }

        .notification-content {
            flex: 1;
        }

        .notification-content p {
            margin: 0;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }

        .notification-content small {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Status styles */
        .notification-item.Approved i {
            color: #28a745;
        }

        .notification-item.Declined i {
            color: #dc3545;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bellRing {
            0% {
                transform: rotate(0);
            }

            15% {
                transform: rotate(5deg);
            }

            30% {
                transform: rotate(-5deg);
            }

            45% {
                transform: rotate(4deg);
            }

            60% {
                transform: rotate(-4deg);
            }

            75% {
                transform: rotate(2deg);
            }

            85% {
                transform: rotate(-2deg);
            }

            92% {
                transform: rotate(1deg);
            }

            100% {
                transform: rotate(0);
            }
        }

        .bell-animation {
            animation: bellRing 0.8s ease;
        }

        .card-header {
            border-bottom-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(243 244 246 / var(--tw-border-opacity));
        }

        .new-title {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 12px;
            margin-left: .9rem;
        }

        .card-header {
            border-bottom-width: 1px;
            --tw-border-opacity: 1;
            border-color: rgb(243 244 246 / var(--tw-border-opacity));
        }

        .new-title {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 12px;
            margin-left: .9rem;
        }
    </style>

    <script>
        let currentPage = <?php echo $page; ?>;
        const rowsPerPage = <?php echo $rowsPerPage; ?>;
        const totalRows = <?php echo $totalRows; ?>;
        const totalPages = <?php echo $totalPages; ?>;

        function changePage(page) {
            currentPage = page;
            window.location.href = '?page=' + page;
        }

        function updatePagination() {
            const paginationContainer = document.querySelector('.table-pagination .buttons');
            paginationContainer.innerHTML = '';

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
                                <li>Student</li>
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
                        <a href="./user_about.php" class="navbar-link" title="Edit Profile">
                            <span>Hello, <?= htmlspecialchars($firstName); ?></span>
                        </a>
                    </div>
                    <div class="navbar-item dropdown has-divider">
                        <div class="notification-bell">
                            <button class="bell-icon" id="bellIcon">
                                <i class="ti ti-bell"></i>
                                <?php
                                $notification_sql = "SELECT COUNT(*) as count FROM room_requests 
                                WHERE full_name = ? 
                                AND (status = 'Success' OR status = 'Declined') 
                                AND notification_read = 0";

                                $stmt = $conn->prepare($notification_sql);
                                $stmt->bind_param("s", $db_full_name);
                                $stmt->execute();
                                $notification_count = $stmt->get_result()->fetch_assoc()['count'];

                                ?>
                                <div class="notification-badge" id="notificationBadge"
                                    <?php echo $notification_count == 0 ? 'style="display:none;"' : ''; ?>>
                                    <span id="notificationCount"><?php echo $notification_count; ?></span>
                                </div>
                            </button>

                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="notification-header">
                                    <span>Request Updates</span>
                                    <a href="#" id="markAllRead">Mark all as read</a>
                                </div>
                                <div class="notification-list" id="notificationList">
                                    <?php
                                    // Get recent status updates
                                    $notifications_sql = "SELECT *, 
                                        CASE 
                                        WHEN status = 'Success' THEN CONCAT('Your room request for ', room_preferred, ' has been Approved')
                                        WHEN status = 'Declined' THEN CONCAT('Your room request for ', room_preferred, ' has been Declined')
                                        END as message
                                    FROM room_requests 
                                    WHERE full_name = ? 
                                    AND (status = 'Success' OR status = 'Declined') 
                                    AND notification_read = 0 
                                    ORDER BY start_datetime DESC 
                                    LIMIT 5";

                                    $stmt = $conn->prepare($notifications_sql);
                                    $stmt->bind_param("s", $db_full_name);
                                    $stmt->execute();
                                    $notifications = $stmt->get_result();


                                    if ($notifications->num_rows > 0) {
                                        while ($notification = $notifications->fetch_assoc()) {
                                            $statusClass = $notification['status'] === 'Success' ? 'Approved' : 'Declined';
                                    ?>
                                            <div class="notification-item <?php echo $statusClass; ?>">
                                                <i class="ti ti-<?php echo $statusClass === 'Approved' ? 'check' : 'x'; ?>"></i>
                                                <div class="notification-content">
                                                    <p>
                                                        <?php
                                                        echo "Your room request for " . htmlspecialchars($notification['room_preferred']) .
                                                            " has been " . strtolower($notification['status']);
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="notification-item">
                                            <p>No recent notifications</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
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
                    <li class="active">
                        <a href="#">
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

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">My Bookings</p>
                                        <h5 class="mb-0 font-bold">
                                            <?php echo htmlspecialchars($stats['booking_count'] ?? 0); ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-700 to-green-500 s-b">
                                        <div class="s-b_icons">
                                            <img src="../public/assets/icons/clipboard-list.svg" alt="Bookings">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Pending Requests</p>
                                        <h5 class="mb-0 font-bold">
                                            <?php echo htmlspecialchars($stats['pending_count'] ?? 0); ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-700 to-green-500 s-b">
                                        <div class="s-b_icons">
                                            <img src="../public/assets/icons/hourglass.svg" alt="Pending">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Cancelled Requests</p>
                                        <h5 class="mb-0 font-bold">
                                            <?php echo htmlspecialchars($stats['cancelled_count'] ?? 0); ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-700 to-green-500 s-b">
                                        <div class="s-b_icons">
                                            <img src="../public/assets/icons/copy-x.svg" alt="Cancelled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card4 -->
                <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Rooms</p>
                                        <h5 class="mb-0 font-bold">
                                            <?php echo htmlspecialchars($total_rooms); ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-700 to-green-500 s-b">
                                        <div class="s-b_icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-buildings">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" />
                                                <path d="M16 8h2c1 0 2 1 2 2v11" />
                                                <path d="M3 21h18" />
                                                <path d="M10 12v0" />
                                                <path d="M10 16v0" />
                                                <path d="M10 8v0" />
                                                <path d="M7 12v0" />
                                                <path d="M7 16v0" />
                                                <path d="M7 8v0" />
                                                <path d="M17 12v0" />
                                                <path d="M17 16v0" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards row 2 -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap -mx-3">
                                <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                                    <div class="flex flex-col h-full">
                                        <h5 class="pt-2 mb-3 font-bold">Quick Start Guide</h5>
                                        <p class=" mb-12 mt-1">Reserve rooms in three simple steps: easily select the room, choose the perfect time slot, and submit your request with ease. Track and manage your bookings conveniently on your personalized dashboard!
                                        </p>
                                    </div>
                                </div>
                                <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                                    <div class="h-full bg-gradient-to-tl s-b-yellow rounded-xl relative">
                                        <div class="relative flex items-center justify-center h-full">
                                            <!-- Image with default width and media query for responsiveness -->
                                            <img class="relative z-20 custom-img" src="./images/1.png" alt="rocket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                    <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                        <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('./assets/img/ivancik.jpg')">
                            <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl s-b-yellow opacity-80"></span>
                            <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                                <h5 class="pt-2 mb-5 font-bold" style="color: #000;">RMIS Features</h5>
                                <p style="color: #000;">
                                    Experience streamlined room management with our comprehensive booking system. Access real-time availability, instant confirmations, and detailed facility information.
                                </p>
                                <!-- Shortened note with an icon inside a white rounded container -->
                                <div class="mt-5 text-sm text-gray-600 flex items-center bg-white shadow-md p-2 rounded-lg">
                                    <!-- Icon -->
                                    <i class="ti ti-info-circle mr-2 text-yellow-500"></i>
                                    <span>Bookings require 24-hour advance notice.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="card has-table">
                            <div class="new-title-container">
                                <p class="new-title">
                                    Recent Bookings
                                </p>
                            </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
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
                                                    <td data-label="Status" class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"><?php echo htmlspecialchars($row['status']); ?></span>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="8" style="text-align: center;">No room requests found</td>
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
                                            <!-- Pagination buttons will be dynamically inserted here -->
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
        document.addEventListener('DOMContentLoaded', function() {
            const bellIcon = document.getElementById('bellIcon');
            const dropdown = document.getElementById('notificationDropdown');
            const markAllRead = document.getElementById('markAllRead');
            const notificationList = document.getElementById('notificationList');
            const notificationCount = document.getElementById('notificationCount');
            const notificationBadge = document.getElementById('notificationBadge');
            let isDropdownOpen = false;

            // Function to toggle dropdown
            function toggleDropdown(e) {
                e.stopPropagation();
                isDropdownOpen = !isDropdownOpen;
                dropdown.style.display = isDropdownOpen ? 'block' : 'none';

                if (isDropdownOpen) {
                    setTimeout(() => {
                        dropdown.classList.add('show');
                        bellIcon.querySelector('i').classList.add('bell-animation');
                    }, 10);
                } else {
                    dropdown.classList.remove('show');
                    bellIcon.querySelector('i').classList.remove('bell-animation');
                }
            }

            // Mark all notifications as read
            function markAllNotificationsRead() {
                // AJAX call to mark notifications as read would go here
                notificationList.innerHTML = '<div class="notification-item"><p>No recent notifications</p></div>';

                // Hide notification badge
                notificationBadge.style.display = 'none';

                // Optional: Send server request to mark notifications as read
                // You would add an AJAX call here to update the server-side state
            }

            // Event Listeners
            if (bellIcon) bellIcon.addEventListener('click', toggleDropdown);
            if (markAllRead) markAllRead.addEventListener('click', function(e) {
                e.preventDefault();
                markAllNotificationsRead();
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (isDropdownOpen && dropdown && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                    setTimeout(() => {
                        dropdown.style.display = 'none';
                    }, 300);
                    isDropdownOpen = false;
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isDropdownOpen) {
                    dropdown.classList.remove('show');
                    setTimeout(() => {
                        dropdown.style.display = 'none';
                    }, 300);
                    isDropdownOpen = false;
                }
            });

            // Prevent dropdown from closing when clicking inside
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>


</body>

</html>