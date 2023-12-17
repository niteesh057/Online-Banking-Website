<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bank</title>
    <!-- favicon -->
    <link rel="icon" href="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png">
    <!-- linking bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo"><img src="https://res.cloudinary.com/dwficcf7f/image/upload/v1681638409/mybank_tkz6wk.png" alt="My_Bank_Logo" class="img-fluid">&nbsp MY BANK</a> 
            <!--  &nbsp(non-braking space)-->

            <nav id="navbar" class="navbar">
                <ul class="ul">
                    <li class="li"><a class="nav-link scrollto active" href="#home">Home</a></li>   
                    <li class="li"><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li class="li"><a class="nav-link scrollto" href="about.php">About</a></li>
                    <li class="li"><a class="nav-link scrollto" href="#contact">Support</a></li>
                    <li class="li"><a class="getstarted scrollto" href="login.php">&nbsp Login &nbsp</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- home section -->
    <section id="home" class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <div class="text-center">
                <h1>Online Banking Website</h1>
                <h2>Niteesh 21BCE9461</h2>
                </div>
                <div class="homebtn justify-content-center">
                <div><a href="createaccount.php" class="btn-get-started scrollto createbtn"><strong>Create Account</strong></a></div>
                <div><a href="login.php" class="btn-get-started scrollto createbtn">&nbsp &nbsp &nbsp <strong>Login</strong> &nbsp &nbsp &nbsp</a></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
                <div class="d-flex flex-column align-items-center">
                <img src="https://static.vecteezy.com/system/resources/previews/007/744/641/original/bank-building-line-art-flat-cartoon-style-illustration-financial-house-isolated-on-white-background-vector.jpg" alt="bank_image" class="img-fluid animated mx-auto">
                </div>
            </div>
            </div>
        </div>
    </section>


    <!-- main section -->
    <main>
        <!-- services section -->
        <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
              <h2>Services</h2>
              <p>We Provide Worlds Best Baking Services to our Customer. We use the secure and powerful server for safe online banking, we provide fastest and secure bank to bank transaction service</p>
            </div>

            <div class="row gy-4">
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                  <h4>Secure Payment</h4>
                  <p>The Security of Customer is the Number One Priority for us</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box">
                  <h4>Online Banking</h4>
                  <p>Our Bank allows there customer to access their account 24/7 without having to visit a physical branch with the help of online banking </p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box">
                  <h4>24 x 7 Service</h4>
                  <p>Our team would love to solve your problems at any instance of the day</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- contact section -->
        <section id="contact" class="contact section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Contact</h2>
                    <p>For Any query related to bank or account please contact us. We will try to solve your all problems</p>
                </div>
 
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Our Address</h3>
                            <p>Amaravathi, India 522237</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Email Us</h3>
                            <p>niteeshch57@gmail.com</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Call Us</h3>
                            <p>+91 7918947819</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer id="footer">
        <div class="container">
            <div class="copyright-wrap d-md-flex py-4">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>MY BANK</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits"></div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="https://twitter.com/Niteesh057?t=lZJ5Vt3WR_tH4_JZK7eoLA&s=09" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="https://m.facebook.com/niteesh.ch.1" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="https://www.instagram.com/kamado_tanjiro569/" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/niteesh-ch-1420b4249" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- back-to-top-arrow -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script>
        window.addEventListener('scroll', function() {
            var scrollDistance = window.scrollY;
            if (scrollDistance > 100) {
                document.querySelector('.back-to-top').classList.add('active');
            } else {
                document.querySelector('.back-to-top').classList.remove('active');
            }
        });

        document.querySelector('.back-to-top').addEventListener('click', function(event) {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <!-- Vendor JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- scrolling buttons -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>  
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/validate.js@0.13.1/validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.0.1/dist/purecounter.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.0.1/dist/purecounter.min.js"></script>

    <!-- Template Main JS File -->
    <script src="main.js"></script>
    <script src="contact.js"></script>
</body>
</html>