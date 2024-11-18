<?php
// index.php
session_start();
include 'config.php';

// Fungsi untuk mengambil data berdasarkan bagian
function getDataByBagian($conn, $bagian)
{
  $stmt = $conn->prepare("SELECT * FROM Home WHERE bagian = ?");
  $stmt->bind_param("s", $bagian);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
  $stmt->close();
  return $data;
}

// Mengambil data untuk setiap bagian
$slideshows = [];
for ($i = 1; $i <= 3; $i++) {
  $slideshows[] = getDataByBagian($conn, 'slideshow' . $i);
}

$trustedBadges = [];
for ($i = 1; $i <= 3; $i++) {
  $trustedBadges[] = getDataByBagian($conn, 'trustedbadge' . $i);
}

// Mengambil setiap banner secara terpisah
$banner1 = getDataByBagian($conn, 'banner1');
$banner2 = getDataByBagian($conn, 'banner2');
$banner3 = getDataByBagian($conn, 'banner3');

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <title>Blanja - eCommerce</title>
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
    /* [CSS sama seperti yang Anda berikan sebelumnya] */
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
                  <li class="menu-list-item nav-item active">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="product.php">Product</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="about-us.php">About us</a>
                  </li>
                  <li class="menu-list-item nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="col-lg-3 col-md-8 col-8">
              <div class="header-action d-flex align-items-center justify-content-end active">
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

    <main id="MainContent" class="content-for-layout">
      <!-- slideshow start -->
      <div class="slideshow-section position-relative">
        <div
          class="slideshow-active activate-slider"
          data-slick='{
                    "slidesToShow": 1, 
                    "slidesToScroll": 1, 
                    "dots": true,
                    "arrows": true,
                    "responsive": [
                        {
                        "breakpoint": 768,
                        "settings": {
                            "arrows": false
                        }
                        }
                    ]
                }'>
          <?php foreach ($slideshows as $slide): ?>
            <div class="slide-item slide-item-bag position-relative">
              <img
                class="slide-img d-none d-md-block"
                src="assets/img/home/<?php echo htmlspecialchars($slide['img']); ?>"
                alt="<?php echo htmlspecialchars($slide['judul']); ?>" />
              <img
                class="slide-img d-md-none"
                src="assets/img/home/<?php echo htmlspecialchars($slide['img']); ?>"
                alt="<?php echo htmlspecialchars($slide['judul']); ?>" />
              <div class="content-absolute content-slide">
                <div
                  class="container height-inherit d-flex align-items-center justify-content-<?php echo strpos($slide['bagian'], '1') !== false ? 'end' : (strpos($slide['bagian'], '2') !== false ? 'end' : 'center'); ?>">
                  <div class="content-box slide-content slide-content-1 py-4<?php echo strpos($slide['bagian'], '2') !== false || strpos($slide['bagian'], '3') !== false ? ' text-center' : ''; ?>">
                    <h2
                      class="slide-heading heading_72 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp">
                      <?php echo htmlspecialchars($slide['judul']); ?>
                    </h2>
                    <p
                      class="slide-subheading heading_24 animate__animated animate__fadeInUp"
                      data-animation="animate__animated animate__fadeInUp">
                      <?php echo htmlspecialchars($slide['deskripsi']); ?>
                    </p>
                    <a
                      class="btn-primary slide-btn animate__animated animate__fadeInUp"
                      href="product.php"
                      data-animation="animate__animated animate__fadeInUp">SHOP NOW</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="activate-arrows"></div>
        <div class="activate-dots dot-tools"></div>
      </div>
      <!-- slideshow end -->

      <!-- trusted badge start -->
      <div class="trusted-section mt-100 overflow-hidden">
        <div class="trusted-section-inner">
          <div class="container">
            <div class="row justify-content-center trusted-row">
              <?php foreach ($trustedBadges as $badge): ?>
                <div class="col-lg-4 col-md-6 col-12">
                  <div class="trusted-badge rounded p-0">
                    <div class="trusted-icon">
                      <img
                        class="icon-trusted"
                        src="assets/img/home/<?php echo htmlspecialchars($badge['img']); ?>"
                        alt="<?php echo htmlspecialchars($badge['judul']); ?>" />
                    </div>
                    <div class="trusted-content">
                      <h2 class="heading_18 trusted-heading">
                        <?php echo htmlspecialchars($badge['judul']); ?>
                      </h2>
                      <p
                        class="text_16 trusted-subheading trusted-subheading-2">
                        <?php echo htmlspecialchars($badge['deskripsi']); ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- trusted badge end -->

      <!-- banner start -->
      <div class="grid-banner mt-100 overflow-hidden">
        <div class="collection-tab-inner mt-0">
          <div class="container">
            <div class="grid-container-2">
              <!-- Banner 1 -->
              <?php if ($banner1): ?>
                <a
                  class="grid-item grid-item-1 position-relative rounded mt-0 d-flex"
                  href="product.php"
                  data-aos="fade-right"
                  data-aos-duration="700">
                  <img
                    class="banner-img rounded"
                    src="assets/img/home/<?php echo htmlspecialchars($banner1['img']); ?>"
                    alt="<?php echo htmlspecialchars($banner1['judul']); ?>" />
                  <div class="content-absolute content-slide">
                    <div class="container height-inherit d-flex">
                      <div class="content-box banner-content p-4">
                        <h2 class="heading_34 primary-color">
                          <?php echo htmlspecialchars($banner1['judul']); ?>
                        </h2>
                        <p class="text_14 mt-2 primary-color">
                          <?php echo htmlspecialchars($banner1['deskripsi']); ?>
                        </p>
                        <span class="text_12 mt-4 link-underline d-block primary-color">
                          VIEW MORE
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              <?php endif; ?>

              <!-- Banner 2 -->
              <?php if ($banner2): ?>
                <a
                  class="grid-item grid-item-2 position-relative rounded mt-0 d-flex"
                  href="product.php"
                  data-aos="fade-right"
                  data-aos-duration="700">
                  <img
                    class="banner-img rounded"
                    src="assets/img/home/<?php echo htmlspecialchars($banner2['img']); ?>"
                    alt="<?php echo htmlspecialchars($banner2['judul']); ?>" />
                  <div class="content-absolute content-slide">
                    <div class="container height-inherit d-flex justify-content-end">
                      <div class="content-box banner-content p-4 text-end">
                        <h2 class="heading_34 primary-color">
                          <?php echo htmlspecialchars($banner2['judul']); ?>
                        </h2>
                        <p class="text_14 mt-2 primary-color">
                          <?php echo htmlspecialchars($banner2['deskripsi']); ?>
                        </p>
                        <span class="text_12 mt-4 link-underline d-block primary-color">
                          VIEW MORE
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              <?php endif; ?>

              <!-- Banner 3 -->
              <?php if ($banner3): ?>
                <a
                  class="grid-item grid-item-3 position-relative rounded mt-0 d-flex"
                  href="product.php"
                  data-aos="fade-left"
                  data-aos-duration="700">
                  <img
                    class="banner-img rounded"
                    src="assets/img/home/<?php echo htmlspecialchars($banner3['img']); ?>"
                    alt="<?php echo htmlspecialchars($banner3['judul']); ?>" />
                  <div class="content-absolute content-slide">
                    <div class="container height-inherit d-flex">
                      <div class="content-box banner-content p-4">
                        <h2 class="heading_34 primary-color">
                          <?php echo htmlspecialchars($banner3['judul']); ?>
                        </h2>
                        <p class="text_14 mt-2 primary-color">
                          <?php echo htmlspecialchars($banner3['deskripsi']); ?>
                        </p>
                        <span class="text_12 mt-4 link-underline d-block primary-color">
                          VIEW MORE
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- banner end -->
    </main>

    <!-- footer start -->
    <footer class="mt-100 overflow-hidden footer-style-2">
      <div class="footer-bottom bg-5">
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