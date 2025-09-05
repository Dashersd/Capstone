<?php
// webpage.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'MARSIANS TAEKWONDO GYM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Styles/webpage.css">
    <style>
    /* Mobile top navigation customization */
    @media (max-width: 767.98px) {
        .mobile-topnav { background-color: #000 !important; }
        .mobile-topnav .nav-link, .mobile-topnav .navbar-brand { transition: color .2s ease; }
        .mobile-topnav .nav-link:hover, .mobile-topnav .navbar-brand:hover { color: #00ff00 !important; }
        .mobile-topnav .navbar-toggler { border-color: #00ff00; }
        .mobile-topnav .navbar-toggler:hover, .mobile-topnav .navbar-toggler:focus { box-shadow: 0 0 0 .125rem rgba(0, 255, 0, .5); }
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top d-md-none mobile-topnav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#home">
                <img src="Picture/Logo2.png" alt="Logo" width="28" height="28" class="d-inline-block">
                D'MARSIANS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMainNav" aria-controls="mobileMainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mobileMainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#offers">Offer</a></li>
                    <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="archive.php">Archive</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacts">Contacts</a></li>
                </ul>
                <a class="btn btn-success ms-md-3 mt-2 mt-md-0" href="#register">Register Now</a>
            </div>
        </div>
    </nav>
    <!-- HEADER & HERO SECTION -->
    <header class="main-header">
        <div class="logo-section d-flex align-items-center gap-2 flex-wrap">
            <img src="Picture/Logo2.png" alt="Logo" class="logo img-fluid">
            <div class="gym-title">
                <h1>D'MARSIANS<br>TAEKWONDO GYM</h1>
                <p class="subtitle">Empowering Students Through Discipline & Strength</p>
            </div>
        </div>
        <nav class="main-nav d-none d-md-flex flex-wrap gap-2 justify-content-center">
            <a href="#home">HOME</a>
            <a href="#about">ABOUT</a>
            <a href="#offers">OFFER</a>
            <a href="#schedule">SCHEDULE</a>
            <a href="archive.php">ARCHIVE</a>
            <a href="#contacts">CONTACTS</a>
        </nav>
        <a href="#register" class="register-btn d-none d-md-inline-block">REGISTER NOW!</a>
    </header>
    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>D'MARSIANS<br>TAEKWONDO GYM</h2>
            <p>Empowering Students Through Discipline & Strength</p>
            <a href="#register" class="hero-register-btn">REGISTER NOW!</a>
        </div>
    </section>

    <!-- ACHIEVEMENTS HORIZONTAL SCROLL -->
    <section id="achievements" class="achievements-section container">
        <h2>ACHIEVEMENTS</h2>
        <div class="achievements-carousel d-md-none">
            <div class="carousel-scroll" id="achievements-carousel-scroll">
                <!-- JS will inject achievement cards here -->
            </div>
            <div class="carousel-dots" id="achievements-carousel-dots"></div>
            <a href="archive.php?category=achievement" class="see-more-btn">SEE MORE</a>
        </div>
        <div class="achievements-grid d-none d-md-block">
            <div id="achievements-grid" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
            <a href="archive.php?category=achievement" class="see-more-btn">SEE MORE</a>
        </div>
    </section>

    <!-- EVENTS HORIZONTAL SCROLL -->
    <section id="events" class="events-section container">
        <h2>EVENTS</h2>
        <div class="events-carousel d-md-none">
            <div class="carousel-scroll" id="events-carousel-scroll">
                <!-- JS will inject event cards here -->
            </div>
            <div class="carousel-dots" id="events-carousel-dots"></div>
            <a href="archive.php?category=event" class="see-more-btn">SEE MORE</a>
        </div>
        <div class="events-grid d-none d-md-block">
            <div id="events-grid" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"></div>
            <a href="archive.php?category=event" class="see-more-btn">SEE MORE</a>
        </div>
    </section>

    <!-- INSTRUCTOR SECTION -->
    <section id="instructor" class="instructor-section container">
        <h2 class="section-title">MEET OUR INSTRUCTOR</h2>
        <div class="instructor-profile">
            <div class="row align-items-center justify-content-center gy-4">
                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <img src="Picture/1.png" alt="Instructor" class="instructor-photo img-fluid">
                </div>
                <div class="col-12 col-md-7 text-center text-md-start">
                    <div class="instructor-info">
                        <h3>
                            Mr. Marcelino <span class="highlight">"Mars"</span> Pescadera Maglinao Jr.
                        </h3>
                        <p>
                            Head Coach Mars, a certified Taekwondo 3rd Dan Black Belt<br>
                            with 23 years of experience
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT WE OFFER -->
    <section id="offers" class="offers-section container">
        <h2>WHAT WE OFFER</h2>
        <div class="offers-list row g-3 justify-content-center">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/9.png" alt="Offer 1" class="img-fluid">
                    <h3>Beginner to Advanced Taekwondo Training</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">Comprehensive classes for all skill levels, from new students to advanced practitioners.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/10.png" alt="Offer 2" class="img-fluid">
                    <h3>Self-Defense Techniques</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">Practical self-defense skills for real-life situations, taught by experienced instructors.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/11.png" alt="Offer 3" class="img-fluid">
                    <h3>Belt Promotion & Certification</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">Official belt testing and certification to recognize your progress and achievements.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/6.png" alt="Offer 4" class="img-fluid">
                    <h3>Physical Fitness & Conditioning</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">Improve strength, flexibility, and endurance through dynamic martial arts workouts.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/7.png" alt="Offer 5" class="img-fluid">
                    <h3>Sparring (Kyorugi)</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">Competitive and non-contact Taekwondo sparring to develop agility and strategy.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="offer-card">
                    <img src="Picture/8.png" alt="Offer 6" class="img-fluid">
                    <h3>Patterns (Poomsae)</h3>
                    <span class="offer-accent"></span>
                    <div class="offer-desc">A series of choreographed movements to develop focus, discipline, and technique.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT US, SCHEDULE, MEMBERSHIP, HOURS -->
    <section id="about" class="about-section container">
        <div class="about-inner">
            <div class="about-header">
                <div class="row align-items-center gy-4">
                    <div class="col-12 col-md-4 d-flex justify-content-center">
                        <img src="Picture/Logo2.png" alt="About Icon" class="about-icon img-fluid">
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="about-text text-center text-md-start">
                            <h2 class="section-title">ABOUT US</h2>
                            <p>
                                Welcome to D'Marsians Taekwondo Team, where we provide top-notch martial arts training for students of all ages. Our goal is to instill discipline, confidence, and physical fitness while ensuring a safe and engaging learning environment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-stats row g-3 mt-3">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="stat-card h-100" id="schedule">
                        <h3><span class="icon">&#128197;</span> Rank's Schedule</h3>
                        <ul>
                            <li>Beginner: Tuesday, Thursday, & Friday<br>5:00 PM - 6:00 PM</li>
                            <li>Intermediate: Monday, Wednesday, & Friday<br>5:00 PM - 6:00 PM</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="stat-card h-100">
                        <h3><span class="icon">&#128181;</span> Membership Price</h3>
                        <ul>
                            <li>Enrollment Fee: 700.00</li>
                            <li>Monthly Fee: 700.00</li>
                            <li>Trial Session: 150.00</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="stat-card h-100">
                        <h3><span class="icon">&#128337;</span> Opening Hours</h3>
                        <ul>
                            <li>Monday - Friday: 6:30 AM - 9:00 AM</li>
                            <li>Saturday: 5:30 PM - 9:00 PM</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REGISTRATION FORM -->
    <section id="register" class="register-section container">
        <h2>REGISTER NOW</h2>
        <p class="register-note">Parent/Guardians must pre-enroll their child(ren) by filling in the registration form below.</p>
        <form class="register-form" id="registerForm" action="save_student.php" method="post">
            <input class="w-100" type="text" name="student_name" placeholder="Student's Full Name" required>
            <input class="w-100" type="text" name="address" placeholder="Address" required>
            <input class="w-100" type="text" name="parent_name" placeholder="Parent's Full Name" required>
            <input class="w-100" type="text" name="phone" placeholder="Phone Number" required>
            <input class="w-100" type="text" name="email" placeholder="Email" required>
            <input class="w-100" type="text" name="parent_phone" placeholder="Parent's Phone Number" required>
            <input class="w-100" type="text" name="school" placeholder="School" required>
            <select class="w-100" name="class" required style="background: rgba(20, 111, 20, 0.14); color: #fff; border-radius: 6px; border: none; padding: 12px 16px; font-size: 1rem; box-shadow: 0 0 0 1.5px #0f0 inset;">
                <option value="" disabled selected>Class</option>
                <option value="Poomsae">Poomsae</option>
                <option value="Kyorugi">Kyorugi</option>
            </select>
            <input class="w-100" type="text" name="parent_email" placeholder="Parent's Email" required>
            <select class="w-100" name="belt_rank" required style="background: rgba(20, 111, 20, 0.14); color: #fff; border-radius: 6px; border: none; padding: 12px 16px; font-size: 1rem; box-shadow: 0 0 0 1.5px #0f0 inset;">
                <option value="" disabled selected>Belt Rank</option>
                <option value="White">White</option>
                <option value="Yellow">Yellow</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
                <option value="Red">Red</option>
                <option value="Black">Black</option>
            </select>
            <select class="w-100" name="enroll_type" required style="background: rgba(20, 111, 20, 0.14); color: #fff; border-radius: 6px; border: none; padding: 12px 16px; font-size: 1rem; box-shadow: 0 0 0 1.5px #0f0 inset;">
                <option value="" disabled selected>Enroll or Trial Session</option>
                <option value="Enroll">Enroll</option>
                <option value="Trial Session">Trial Session</option>
            </select>
            <button class="w-100" type="submit">SUBMIT</button>
        </form>
        <p class="register-disclaimer">*Notice: After submitting the form, please wait for a confirmation email from D'Marsians Taekwondo Gym to verify your successful registration.</p>
    </section>

    <!-- CONTACTS, MAP, FOOTER -->
    <section id="contacts" class="footer-section container-fluid">
        <div class="footer-map-bg"></div>
        <div class="footer-contact-bar">
            <div class="footer-contact-info">
                <div>
                    <span>CALL US</span><br>
                    <strong>0938-172-1987</strong>
                </div>
                <div>
                    <span>97 Rizal Ave, Pagadian City</span><br>
                    <strong>Pagadian City, 7016 Zamboanga del Sur</strong>
                </div>
                <div>
                    <span>OPENING HOURS</span><br>
                    <strong>MON-SAT: 8AM - 9PM</strong>
                </div>
            </div>
        </div>
        <div class="footer-bg">
            <div class="footer-content container">
                <img src="Picture/Logo2.png" alt="Footer Logo" class="footer-logo img-fluid">
                <p>Thank you for visiting D'Marsians Taekwondo Team! We are committed to providing high-quality martial arts training for all ages, fostering discipline, confidence, and physical fitness in a safe and supportive environment. Join us and be part of our growing Taekwondo family!</p>
                <p class="footer-address">97 Rizal Ave, Pagadian City, 7016 Zamboanga del Sur<br>0938-172-1987<br>dmarsians.taekwondo@gmail.com</p>
                <p class="copyright">&copy; 2024 D'MARSIANS TAEKWONDO GYM. All rights reserved.</p>
            </div>
        </div>
    </section>

    <!-- Popup Modal -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-modal">
            <div class="check-animation">
                <i class="fas fa-check check-icon"></i>
            </div>
            <h3>Registration Submitted!</h3>
            <p>Please proceed to D'Marsians Taekwondo Gym to continue your transaction.</p>
            <button class="popup-close-btn" onclick="closePopup()">OK</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Scripts/webpage.js"></script>
    <script>
    function renderMobileCarousel(posts, containerId, dotsId) {
        const container = document.getElementById(containerId);
        const dots = document.getElementById(dotsId);
        if (!container) return;
        const carouselId = `${containerId}-carousel`;
        const items = posts.map((post, idx) => {
            const imageSrc = post.image_path ? post.image_path : 'https://via.placeholder.com/400x300.png/2d2d2d/ffffff?text=No+Image';
            return (
                `<div class="carousel-item${idx === 0 ? ' active' : ''}">`
              +   `<div class="carousel-card${idx === 0 ? ' active' : ''}">`
              +     `<img src="${imageSrc}" alt="${post.title}">`
              +     `<div class="carousel-text">`
              +       `<h3>${post.title}</h3>`
              +       `<p>${post.description}</p>`
              +     `</div>`
              +   `</div>`
              + `</div>`
            );
        }).join('');
        container.innerHTML = (
            `<div id="${carouselId}" class="carousel slide" data-bs-touch="true" data-bs-ride="carousel">`
          +   `<div class="carousel-inner">${items}</div>`
          +   `<button class="carousel-control-prev" type="button" data-bs-target="#${carouselId}" data-bs-slide="prev">`
          +     `<span class="carousel-control-prev-icon" aria-hidden="true"></span>`
          +     `<span class="visually-hidden">Previous</span>`
          +   `</button>`
          +   `<button class="carousel-control-next" type="button" data-bs-target="#${carouselId}" data-bs-slide="next">`
          +     `<span class="carousel-control-next-icon" aria-hidden="true"></span>`
          +     `<span class="visually-hidden">Next</span>`
          +   `</button>`
          + `</div>`
        );
        if (dots) { dots.innerHTML = ''; dots.style.display = 'none'; }
    }

    function renderDesktopGrid(posts, gridId) {
        const grid = document.getElementById(gridId);
        if (!grid) return;
        grid.innerHTML = posts.map((post) => {
            const imageSrc = post.image_path ? post.image_path : 'https://via.placeholder.com/400x300.png/2d2d2d/ffffff?text=No+Image';
            return (
                `<div class="col">`
              +   `<div class="card h-100 text-white post-card">`
              +     `<img class="card-img-top img-fluid" src="${imageSrc}" alt="${post.title}" style="aspect-ratio: 4 / 3; object-fit: cover;">`
              +     `<div class="card-body">`
              +       `<h5 class="card-title">${post.title}</h5>`
              +       `<p class="card-text small mb-0">${post.description}</p>`
              +     `</div>`
              +   `</div>`
              + `</div>`
            );
        }).join('');
        grid.classList.add('row', 'row-cols-1', 'row-cols-sm-2', 'row-cols-md-3', 'g-3');
    }

    // Fetch and render Achievements
    fetch('get_posts.php?category=achievement')
        .then(res => res.json())
        .then(posts => {
            renderMobileCarousel(posts, 'achievements-carousel-scroll', 'achievements-carousel-dots');
            renderDesktopGrid(posts, 'achievements-grid');
        });

    // Fetch and render Events
    fetch('get_posts.php?category=event')
        .then(res => res.json())
        .then(posts => {
            renderMobileCarousel(posts, 'events-carousel-scroll', 'events-carousel-dots');
            renderDesktopGrid(posts, 'events-grid');
        });

    // Popup functions
    function showPopup() {
        const popup = document.getElementById('popupOverlay');
        popup.style.display = 'flex';
    }

    function closePopup() {
        const popup = document.getElementById('popupOverlay');
        popup.style.display = 'none';
    }

    // Close popup when clicking outside
    document.getElementById('popupOverlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('registerForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                const enrollType = form.elements['enroll_type'].value;
                const submitButton = form.querySelector('button[type="submit"]');
                
                if (enrollType === 'Enroll') {
                    e.preventDefault();
                    
                    // Add loading state to button
                    submitButton.classList.add('loading');
                    submitButton.textContent = 'SUBMITTING...';
                    
                    const formData = new FormData(form);
                    fetch('submit_enrollment_request.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        // Remove loading state
                        submitButton.classList.remove('loading');
                        submitButton.textContent = 'SUBMIT';
                        
                        if (result.status === 'success') {
                            // Show popup instead of alert
                            showPopup();
                            form.reset();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    })
                    .catch(error => {
                        // Remove loading state
                        submitButton.classList.remove('loading');
                        submitButton.textContent = 'SUBMIT';
                        alert('Error submitting form: ' + error.message);
                    });
                } else if (enrollType === 'Trial Session') {
                    e.preventDefault();
                    // Add loading state to button
                    submitButton.classList.add('loading');
                    submitButton.textContent = 'SUBMITTING...';
                    const formData = new FormData(form);
                    fetch('register_trial_session.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        // Remove loading state
                        submitButton.classList.remove('loading');
                        submitButton.textContent = 'SUBMIT';
                        if (result.status === 'success') {
                            // Show popup instead of alert
                            showPopup();
                            form.reset();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    })
                    .catch(error => {
                        // Remove loading state
                        submitButton.classList.remove('loading');
                        submitButton.textContent = 'SUBMIT';
                        alert('Error submitting form: ' + error.message);
                    });
                }
                // If no enroll type selected, let the form submit as normal
            });
        }
    });
    </script>
</body>
</html> 