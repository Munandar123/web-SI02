<?php
// about.php
session_start();
include 'config.php';

// Mengambil data dari tabel 'About' dengan id=1
$sql = "SELECT * FROM About WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $about = $result->fetch_assoc();
} else {
  // Jika data tidak ditemukan, gunakan data default
  $about = [
    'img' => 'default-about.jpg',
    'judul' => 'About Us',
    'deskripsi' => 'Description not available.'
  ];
}

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <title>Blanja - About</title>
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
                  <li class="menu-list-item nav-item active">
                    <a class="nav-link" href="#">About us</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
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
          <li>About Us</li>
        </ul>
      </div>
    </div>
    <!-- breadcrumb end -->

    <main id="MainContent" class="content-for-layout">
      <div class="about-page">
        <!-- about hero start -->
        <div class="about-hero mt-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-12">
                <div class="about-hero-content">
                  <!-- judul -->
                  <h2 class="about-hero-title"><?php echo htmlspecialchars($about['judul']); ?></h2>
                  <!-- deskripsi -->
                  <p class="about-hero-subtitle">
                    <?php echo nl2br(htmlspecialchars($about['deskripsi'])); ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-12">
                <div class="about-hero-img">
                  <!-- image -->
                  <img src="assets/img/about/<?php echo htmlspecialchars($about['img']); ?>" alt="About Us Image" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- about hero end -->
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
                <a href="about-us.php">Privacy policy</a>
              </li>
              <li class="footer-menu-item">
                <a href="about-us.php">Terms & Conditions</a>
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