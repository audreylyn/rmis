<?php include '../public/includes/hello_firstname.php' ?>


<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Reservation</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
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
        .contact-container {
            margin-left: 2rem;
        }

        .contact-title {
            color: #105738;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #105738;
            box-shadow: 0 0 0 3px rgba(16, 87, 56, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            background: #105738;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            width: 100%;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #0c4229;
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Loading spinner */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Error state */
        .form-control.error {
            border-color: #ff3e3e;
        }

        .error-message {
            color: #ff3e3e;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
        }

        .faq-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .faq {
            background-color: transparent;
            border: 1px solid #9fa4a8;
            border-radius: 10px;
            margin: 20px 0;
            padding: 30px;
            position: relative;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .faq.active {
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .faq.active::before,
        .faq.active::after {
            content: '\f075';
            font-family: 'Font Awesome 5 Free';
            color: #105738;
            font-size: 7rem;
            position: absolute;
            opacity: 0.1;
            top: 20px;
            left: 20px;
            z-index: 0;
        }

        .faq.active::before {
            top: -10px;
            left: -30px;
            transform: rotateY(180deg);
        }

        .faq-title {
            margin: 0 35px 0 0;
        }

        .faq-text {
            display: none;
            margin: 30px 0 0;
        }

        .faq.active .faq-text {
            display: block;
        }

        .faq-toggle {
            background-color: transparent;
            border: 0;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            padding: 0;
            position: absolute;
            top: 30px;
            right: 30px;
            height: 30px;
            width: 30px;
        }

        .faq-toggle:focus {
            outline: 0;
        }

        .faq-toggle .fa-times {
            display: none;
        }

        .faq.active .faq-toggle .fa-times {
            color: #fff;
            display: block;
        }

        .faq.active .faq-toggle .fa-chevron-down {
            display: none;
        }

        .faq.active .faq-toggle {
            background-color: #9fa4a8;
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
                                <li>Help</li>
                                <li>Contact Us</li>
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
                    <div class="faq-container">
                        <div class="faq">
                            <h3 class="faq-title">How do I book a room?</h3>
                            <p class="faq-text">
                                To book a room, log in to the MC RMIS portal, navigate to the "New Reservation" section, and fill out the Room Requisition Form. Once submitted, the admin will be notified.
                            </p>
                            <button class="faq-toggle">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="faq">
                            <h3 class="faq-title">Can I edit or cancel my booking?</h3>
                            <p class="faq-text">
                                Yes, you can edit or cancel your booking by visiting the "My Reservation" section in the MC RMIS portal. Select the booking you wish to modify.
                            </p>
                            <button class="faq-toggle">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="faq">
                            <h3 class="faq-title">What should I do if my login credentials don’t work?</h3>
                            <p class="faq-text">
                                If you are unable to log in, contact the admin at meycauayancollege@gmail.com.
                            </p>
                            <button class="faq-toggle">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="faq">
                            <h3 class="faq-title">How do I report an issue with the MC RMIS?</h3>
                            <p class="faq-text">
                                To report an issue, email our support team at meycauayancollege@gmail.com with a detailed description of the problem.
                            </p>
                            <button class="faq-toggle">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="table-container m-10">
                <div class=" is-fullwidth is-striped">
                    <div class="faq-container">
                        <div class="contact-container">
                            <form id="contactForm">
                                <h2 class="contact-title">Contact Us</h2>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" required>
                                    <div class="error-message">Please enter your name</div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" required>
                                    <div class="error-message">Please enter a valid email</div>
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" id="subject" class="form-control" required>
                                    <div class="error-message">Please enter a subject</div>
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea id="message" class="form-control" required></textarea>
                                    <div class="error-message">Please enter your message</div>
                                </div>

                                <button type="submit" class="submit-btn" id="submitBtn">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>

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