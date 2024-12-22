<?php include '../public/includes/hello_firstname.php' ?>


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

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .welcome-banner {
            background: linear-gradient(rgba(16, 87, 56, 0.05), rgba(16, 87, 56, 0.1));
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 60px;
            text-align: center;
        }

        .welcome-title {
            color: #105738;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .welcome-text {
            color: #444;
            font-size: 1.1em;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .about-image {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 60px;
            padding: 0 1rem;
        }

        .feature-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.10);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            color: #105738;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .feature-title {
            color: #333;
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        .tech-banner {
            background: #105738;
            color: white;
            padding: 40px;
            border-radius: 20px;
            margin-top: 60px;
            text-align: center;
        }

        .tech-title {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #fff;
        }

        .tech-description {
            font-size: 1.1em;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 60px 0;
            }

            .welcome-title {
                font-size: 2em;
            }

            .welcome-banner {
                padding: 30px;
            }

            .features-grid {
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
                                <li>Student</li>
                                <li>About</li>
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
                <div class=" is-fullwidth is-striped">
                    <section class="about-section">
                        <div class="welcome-banner">
                            <h1 class="welcome-title">Welcome to MC RMIS</h1>
                            <p class="welcome-text">
                                Your one-stop solution for seamless room booking and facility management. Designed to cater to the needs of students, faculty, and event organizers, MC RMIS simplifies the process of reserving spaces and managing room availability.
                            </p>
                        </div>

                        <div class="about-content">
                            <div class="about-image">
                                <img src="../public/assets/carousel_3.jpg" alt="MC RMIS Dashboard">
                            </div>

                            <div class="about-text">
                                <p class="welcome-text">
                                    MC RMIS is committed to transforming traditional room management processes by providing an easy-to-use, efficient, and transparent platform. Whether it's for meetings, classes, or events, we ensure that your booking experience is hassle-free and productive.
                                    <br><br>
                                    MC RMIS goes beyond simple room booking by offering tools that enhance collaboration and planning. With features designed to accommodate diverse needs, it empowers users to manage schedules, allocate resources effectively, and adapt to changing requirements.
                                </p>
                            </div>
                        </div>

                        <div class="features-grid">
                            <div class="feature-card">
                                <i class="fas fa-calendar-check feature-icon"></i>
                                <h3 class="feature-title">Effortless Booking Process</h3>
                                <p class="feature-description">
                                    Book rooms in just a few clicks with our streamlined reservation system.
                                </p>
                            </div>

                            <div class="feature-card">
                                <i class="fas fa-sync-alt feature-icon"></i>
                                <h3 class="feature-title">Real-time Updates</h3>
                                <p class="feature-description">
                                    Stay informed with instant updates on room availability and booking status.
                                </p>
                            </div>

                            <div class="feature-card">
                                <i class="fas fa-chart-bar feature-icon"></i>
                                <h3 class="feature-title">Comprehensive Reports</h3>
                                <p class="feature-description">
                                    Access detailed analytics and reports on room usage and occupancy.
                                </p>
                            </div>
                        </div>

                        <div class="tech-banner">
                            <h2 class="tech-title">Cutting-edge Technology</h2>
                            <p class="tech-description">
                                Developed with cutting-edge technology, MC RMIS aims to be your reliable partner in space management, delivering innovation and efficiency in every aspect of room management.
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </div>


    </div>

    <script>
        const toggles = document.querySelectorAll('.faq-toggle')

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                toggle.parentNode.classList.toggle('active')
            })
        })

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Basic validation
            if (!name || !email || !subject || !message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields!',
                });
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address',
                });
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="loading"></span>Sending...';
            submitBtn.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                // Reset form
                document.getElementById('contactForm').reset();
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: 'We will get back to you soon.',
                    confirmButtonColor: '#105738'
                });
            }, 2000);
        });

        // Add focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('label').style.color = '#105738';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('label').style.color = '#333';
            });
        });
    </script>

    <!-- Scripts  -->
    <script type="text/javascript" src="./js/main.min.js"></script>

</body>

</html>