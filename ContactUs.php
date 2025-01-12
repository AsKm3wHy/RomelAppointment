<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/ContactUs.css">
    <title>Romel Photograph</title>

</head>

<body>

    <header>
        <div class="inner">
            <div class="logo"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123024/wwf-logo.png"></div>
            <div class="burger"></div>
            <nav>
                <a href="index.php">Package</a>
                <a href="Appointment.php">Appointment</a>
                <a class="active" href="ContactUs.php">Contact Us</a>
                <a href="#">FAQ</a>
            </nav>
            <!-- <a href="#" class="donate-link">Donate</a> -->
        </div>
    </header>

    <main>
        <div id="slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="contact-form">
                            <h2>Contact Us</h2>
                            <form action="submit_form.php" method="POST">
                                <div class="form-group">
                                    <label class="white" for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your full name" required>
                                </div>
                                <div class="form-group">
                                    <label class="white" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label class="white" for="message">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5"
                                        placeholder="Enter your message" required></textarea>
                                </div>
                                <button type="submit" class="submit-btn">Send Message</button>
                            </form>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="divider d-none d-md-block"></div>

                    <div class="col-md-6 col-lg-5">
                        <div class="address mt-5 mt-md-0">
                            <h4>Our Address</h4>
                            <p>
                                1234 Street Name, City, State, 12345<br>
                                Phone: (123) 456-7890<br>
                                Email: contact@yourcompany.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>