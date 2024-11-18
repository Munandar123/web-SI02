<?php
// contact.php
session_start();
include 'config.php';

// Mengambil data dari tabel 'Contact' dengan id=1
$sql = "SELECT * FROM Contact WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $contact = $result->fetch_assoc();
} else {
  // Jika data tidak ditemukan, gunakan data default
  $contact = [
    'email' => 'info@blanja.com',
    'lokasi' => 'Alamat Tidak Tersedia',
    'phone' => 'Nomor Telepon Tidak Tersedia'
  ];
}

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <title>Blanja - Contact</title>
  <!-- meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="meta description" />
  <link
    rel="shortcut icon"
    href="assets/img/favicon.png"
    type="image/x-icon" />
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <!-- all css -->
  <style>
    :root {
      --primary-color: #00234d;
      --secondary-color: #f76b6a;

      --btn-primary-border-radius: 0.25rem;
      --btn-primary-color: #fff;
      --btn-primary-background-color: #00234d;
      --btn-primary-border-color: #00234d;
      --btn-primary-hover-color: #fff;
      --btn-primary-background-hover-color: #00234d;
      --btn-primary-border-hover-color: #00234d;
      --btn-primary-font-weight: 500;

      --btn-secondary-border-radius: 0.25rem;
      --btn-secondary-color: #00234d;
      --btn-secondary-background-color: transparent;
      --btn-secondary-border-color: #00234d;
      --btn-secondary-hover-color: #fff;
      --btn-secondary-background-hover-color: #00234d;
      --btn-secondary-border-hover-color: #00234d;
      --btn-secondary-font-weight: 500;

      --heading-color: #000;
      --heading-font-family: "Poppins", sans-serif;
      --heading-font-weight: 700;

      --title-color: #000;
      --title-font-family: "Poppins", sans-serif;
      --title-font-weight: 400;

      --body-color: #000;
      --body-background-color: #fff;
      --body-font-family: "Poppins", sans-serif;
      --body-font-size: 14px;
      --body-font-weight: 400;

      --section-heading-color: #000;
      --section-heading-font-family: "Poppins", sans-serif;
      --section-heading-font-size: 48px;
      --section-heading-font-weight: 600;

      --section-subheading-color: #000;
      --section-subheading-font-family: "Poppins", sans-serif;
      --section-subheading-font-size: 16px;
      --section-subheading-font-weight: 400;
    }
  </style>

  <link rel="stylesheet" href="assets/css/vendor.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="body-wrapper">
    <!-- header start -->
    <header class="sticky-header border-btm-black header-1">
      <div class="header-bottom">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-4">
              <div class="header-logo">
                <a href="index.php" class="logo-main">
                  <img
                    src="assets/img/logo.png"
                    loading="lazy"
                    alt="blanja" />
                </a>
              </div>
            </div>
            <div class="col-lg-6 d-lg-block d-none">
              <nav class="site-navigation">
                <ul class="main-menu list-unstyled justify-content-center">
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="product.php">Product</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="about-us.php">About us</a>
                  </li>
                  <li class="menu-list-item nav-item active">
                    <a class="nav-link" href="#">Contact</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="col-lg-3 col-md-8 col-8">
              <div
                class="header-action d-flex align-items-center justify-content-end">
                <?php if (isset($_SESSION['user_id'])): ?>
                  <!-- Jika pengguna sudah login, tampilkan tombol Logout -->
                  <a
                    class="header-action-item header-wishlist ms-4 d-none d-lg-block"
                    href="logout.php">
                    <svg
                      class="icon icon-users"
                      width="10"
                      height="11"
                      viewBox="0 0 10 11"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z"
                        fill="#000" />
                    </svg>
                    <span>Logout</span>
                  </a>
                <?php else: ?>
                  <!-- Jika pengguna belum login, tampilkan tombol Login -->
                  <a
                    class="header-action-item header-wishlist ms-4 d-none d-lg-block"
                    href="login.php">
                    <svg
                      class="icon icon-users"
                      width="10"
                      height="11"
                      viewBox="0 0 10 11"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z"
                        fill="#000" />
                    </svg>
                    <span>Login</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- header end -->

    <!-- breadcrumb start -->
    <div class="breadcrumb">
      <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
          <li><a href="/">Home</a></li>
          <li>
            <svg
              class="icon icon-breadcrumb"
              width="64"
              height="64"
              viewBox="0 0 64 64"
              fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <g opacity="0.4">
                <path
                  d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                  fill="#000" />
              </g>
            </svg>
          </li>
          <li>Contact US</li>
        </ul>
      </div>
    </div>
    <!-- breadcrumb end -->

    <main id="MainContent" class="content-for-layout">
      <div class="contact-page">
        <!-- contact box start -->
        <div class="contact-box mt-100">
          <div class="contact-box-wrapper">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-12">
                  <div class="contact-item">
                    <div class="contact-icon">
                      <svg
                        width="50"
                        height="45"
                        viewBox="0 0 50 45"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M0.5 0.25V28.25H7.5V37.1641L10.3438 34.8672L18.6016 28.25H35.5V0.25H0.5ZM4 3.75H32V24.75H17.3984L16.9062 25.1328L11 29.8359V24.75H4V3.75ZM39 7.25V10.75H46V31.75H39V36.8359L32.6016 31.75H19.4766L15.1016 35.25H31.3984L42.5 44.1641V35.25H49.5V7.25H39Z"
                          fill="#00234D" />
                      </svg>
                    </div>
                    <div class="contact-details">
                      <h2 class="contact-title">Mail Address</h2>
                      <!-- email -->
                      <a class="contact-info" href="mailto:<?php echo htmlspecialchars($contact['email']); ?>">
                        <?php echo htmlspecialchars($contact['email']); ?>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                  <div class="contact-item">
                    <div class="contact-icon">
                      <svg
                        width="36"
                        height="42"
                        viewBox="0 0 36 42"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M18 0.265625L16.4141 4.09375L2.41406 37.3438L0.828125 41.0625L4.60156 39.6406L18 34.6094L31.3984 39.6406L35.1719 41.0625L33.5859 37.3438L19.5859 4.09375L18 0.265625ZM18 9.17969L28.8281 34.9375L18.6016 31.1094L18 30.8906L17.3984 31.1094L7.17188 34.9375L18 9.17969Z"
                          fill="#00234D" />
                      </svg>
                    </div>
                    <div class="contact-details">
                      <h2 class="contact-title">Office Location</h2>
                      <!-- lokasi -->
                      <p class="contact-info">
                        <?php echo nl2br(htmlspecialchars($contact['lokasi'])); ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                  <div class="contact-item">
                    <div class="contact-icon">
                      <svg
                        width="46"
                        height="47"
                        viewBox="0 0 46 47"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M10.149 0.75C9.23299 0.75 8.33065 1.07812 7.5787 1.67969L7.46932 1.73438L7.41463 1.78906L1.94588 7.42188L2.00057 7.47656C0.312094 9.03516 -0.207437 11.3662 0.524009 13.3828C0.530844 13.3965 0.517173 13.4238 0.524009 13.4375C2.00741 17.6826 5.80135 25.8789 13.2115 33.2891C20.649 40.7266 28.9547 44.3701 33.0631 45.9766H33.1178C35.2437 46.6875 37.5474 46.1816 39.1881 44.7734L44.7115 39.25C46.1607 37.8008 46.1607 35.2852 44.7115 33.8359L37.6021 26.7266L37.5474 26.6172C36.0982 25.168 33.5279 25.168 32.0787 26.6172L28.5787 30.1172C27.314 29.5088 24.2994 27.9502 21.4146 25.1953C18.5504 22.4609 17.0875 19.3164 16.5474 18.0859L20.0474 14.5859C21.5172 13.1162 21.5445 10.6689 19.9928 9.22656L20.0474 9.17188L19.8834 9.00781L12.8834 1.78906L12.8287 1.73438L12.7193 1.67969C11.9674 1.07812 11.065 0.75 10.149 0.75ZM10.149 4.25C10.2789 4.25 10.4088 4.31152 10.5318 4.41406L17.5318 11.5781L17.6959 11.7422C17.6822 11.7285 17.7984 11.9131 17.5865 12.125L13.2115 16.5L12.3912 17.2656L12.774 18.3594C12.774 18.3594 14.7838 23.7393 19.0084 27.7656L19.3912 28.0938C23.4586 31.8057 28.2506 33.8359 28.2506 33.8359L29.3443 34.3281L34.5396 29.1328C34.8404 28.832 34.7857 28.832 35.0865 29.1328L42.2506 36.2969C42.5514 36.5977 42.5514 36.4883 42.2506 36.7891L36.8912 42.1484C36.0846 42.8389 35.2301 42.9824 34.2115 42.6406C30.2467 41.082 22.5426 37.6982 15.6724 30.8281C8.74764 23.9033 5.13143 16.0488 3.80526 12.2344C3.53866 11.5234 3.73006 10.4707 4.35213 9.9375L4.46151 9.82812L9.7662 4.41406C9.88924 4.31152 10.0191 4.25 10.149 4.25Z"
                          fill="#00234D" />
                      </svg>
                    </div>
                    <div class="contact-details">
                      <h2 class="contact-title">Phone Number</h2>
                      <!-- phone -->
                      <a class="contact-info" href="tel:<?php echo htmlspecialchars($contact['phone']); ?>">
                        <?php echo htmlspecialchars($contact['phone']); ?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- contact box end -->

            <!-- contact form start -->
            <div class="contact-form-section mt-100">
              <div class="container">
                <div class="contact-form-area">
                  <div class="section-header mb-4">
                    <h2 class="section-heading">Drop us a line</h2>
                    <p class="section-subheading">
                      We would like to hear from you.
                    </p>
                  </div>
                  <div class="contact-form--wrapper">
                    <form action="#" class="contact-form">
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <fieldset>
                            <input type="text" name="fullname" placeholder="Full name" required />
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12">
                          <fieldset>
                            <input type="email" name="email" placeholder="Email Address*" required />
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12">
                          <fieldset>
                            <input type="text" name="subject" placeholder="Type a subject" required />
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12">
                          <fieldset>
                            <input type="text" name="phone" placeholder="Phone Number" />
                          </fieldset>
                        </div>
                        <div class="col-md-12 col-12">
                          <fieldset>
                            <textarea
                              name="message"
                              cols="20"
                              rows="6"
                              placeholder="Write your message here*"
                              required></textarea>
                          </fieldset>
                          <button
                            type="submit"
                            class="position-relative review-submit-btn contact-submit-btn">
                            SEND MESSAGE
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- contact form end -->
          </div>
    </main>

    <!-- footer start -->
    <footer class="mt-100 overflow-hidden">
      <div class="footer-bottom bg-4">
        <div class="container">
          <div
            class="footer-bottom-inner d-flex flex-wrap justify-content-md-between justify-content-center align-items-center">
            <ul
              class="footer-bottom-menu list-unstyled d-flex flex-wrap align-items-center mb-0">
              <li class="footer-menu-item">
                <a href="#">Privacy policy</a>
              </li>
              <li class="footer-menu-item">
                <a href="#">Terms & Conditions</a>
              </li>
            </ul>
            <p class="copyright footer-text">
              ©<span class="current-year"></span> Blanja Company.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer end -->

    <!-- scrollup start -->
    <button id="scrollup">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#fff"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
      </svg>
    </button>
    <!-- scrollup end -->

    <!-- all js -->
    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/main.js"></script>
  </div>
</body>

</html>