<?php
// get_product.php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Siapkan statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT produk.*, kategori.kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.id WHERE produk.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-gallery product-gallery-vertical d-flex justify-content-center">
                    <div class="product-img-large">
                        <div class="qv-large img-large common">
                            <div class="img-large-wrapper ms-5">
                                <img src="assets/img/products/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="img-fluid mw-100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-details ps-lg-4">
                    <h2 class="product-title mb-3"><?php echo htmlspecialchars($row['nama_produk']); ?></h2>
                    <div class="product-price-wrapper mb-4">
                        <span class="product-price regular-price">$<?php echo number_format($row['harga'], 2); ?></span>
                    </div>
                    <div class="product-sku product-meta mb-1">
                        <strong class="label">Stock:</strong> <?php echo htmlspecialchars($row['stok']); ?>
                    </div>
                    <div class="product-vendor product-meta mb-3">
                        <strong class="label">Category:</strong> <?php echo htmlspecialchars($row['kategori']); ?>
                    </div>
                    <div class="product-vendor product-meta mb-3">
                        <strong class="label">Description:</strong>
                        <?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?>
                    </div>

                    <div
                        class="misc d-flex align-items-end justify-content-between mt-4">
                        <div
                            class="quantity d-flex align-items-center justify-content-between">
                            <button class="qty-btn dec-qty">
                                <img src="assets/img/icon/minus.svg" alt="minus" />
                            </button>
                            <input
                                class="qty-input"
                                type="number"
                                name="qty"
                                value="1"
                                min="0" />
                            <button class="qty-btn inc-qty">
                                <img src="assets/img/icon/plus.svg" alt="plus" />
                            </button>
                        </div>
                        <div class="message-popup d-flex align-items-center">
                            <span class="message-popup-icon">
                                <!-- Icon Tetap Sama -->
                                <svg
                                    width="24"
                                    height="25"
                                    viewBox="0 0 24 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1.5 4.25V16.25H4.5V20.0703L5.71875 19.0859L9.25781 16.25H16.5V4.25H1.5ZM3 5.75H15V14.75H8.74219L8.53125 14.9141L6 16.9297V14.75H3V5.75ZM18 7.25V8.75H21V17.75H18V19.9297L15.2578 17.75H9.63281L7.75781 19.25H14.7422L19.5 23.0703V19.25H22.5V7.25H18Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <span class="message-popup-text ms-2">Message</span>
                        </div>
                    </div>

                    <form class="product-form" action="#">
                        <div
                            class="product-form-buttons d-flex align-items-center justify-content-between mt-4">
                            <button
                                type="submit"
                                class="position-relative btn-atc btn-add-to-cart loader">
                                ADD TO CART
                            </button>
                            <a href="#" class="product-wishlist">
                                <!-- Wishlist Icon Tetap Sama -->
                                <svg
                                    class="icon icon-wishlist"
                                    width="26"
                                    height="22"
                                    viewBox="0 0 26 22"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                        fill="#00234D"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="buy-it-now-btn mt-2">
                            <button
                                type="submit"
                                class="position-relative btn-atc btn-buyit-now">
                                BUY IT NOW
                            </button>
                        </div>
                    </form>

                    <div class="guaranteed-checkout">
                        <strong class="label mb-1 d-block">Guaranteed safe checkout:</strong>
                        <ul
                            class="list-unstyled checkout-icon-list d-flex align-items-center flex-wrap">
                            <li class="checkout-icon-item">
                                <!-- Visa Icon -->
                                <svg
                                    width="38"
                                    height="24"
                                    viewBox="0 0 38 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_205_2246)">
                                        <path
                                            opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black" />
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="#FEFEFE" />
                                        <path
                                            d="M15 19C18.866 19 22 15.866 22 12C22 8.13401 18.866 5 15 5C11.134 5 8 8.13401 8 12C8 15.866 11.134 19 15 19Z"
                                            fill="#EB001B" />
                                        <path
                                            d="M23 19C26.866 19 30 15.866 30 12C30 8.13401 26.866 5 23 5C19.134 5 16 8.13401 16 12C16 15.866 19.134 19 23 19Z"
                                            fill="#F79E1B" />
                                        <path
                                            d="M22 12C22 9.59999 20.8 7.49999 19 6.29999C17.2 7.59999 16 9.69999 16 12C16 14.3 17.2 16.5 19 17.7C20.8 16.5 22 14.4 22 12Z"
                                            fill="#FF5F00" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_205_2246">
                                            <rect width="38" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                            <li class="checkout-icon-item">
                                <!-- MasterCard Icon -->
                                <svg
                                    width="38"
                                    height="24"
                                    viewBox="0 0 38 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_205_2252)">
                                        <path
                                            opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black" />
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="#FEFEFE" />
                                        <path
                                            d="M23.9 8.3C24.1 7.3 23.9 6.6 23.3 6C22.7 5.3 21.6 5 20.2 5H16.1C15.8 5 15.6 5.2 15.5 5.5L14 15.6C14 15.8 14.1 16 14.3 16H17L17.4 12.6L19.2 10.4L23.9 8.3Z"
                                            fill="#003087" />
                                        <path
                                            d="M23.8996 8.29999L23.6996 8.49999C23.1996 11.3 21.4996 12.3 19.0996 12.3H17.9996C17.6996 12.3 17.4996 12.5 17.3996 12.8L16.7996 16.7L16.5996 17.7C16.5996 17.9 16.6996 18.1 16.8996 18.1H18.9996C19.2996 18.1 19.4996 17.9 19.4996 17.7V17.6L19.8996 15.2V15.1C19.8996 14.9 20.1996 14.7 20.3996 14.7H20.6996C22.7996 14.7 24.3996 13.9 24.7996 11.5C24.9996 10.5 24.8996 9.69999 24.3996 9.09999C24.2996 8.59999 24.0996 8.39999 23.8996 8.29999Z"
                                            fill="#012169" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_205_2252">
                                            <rect width="38" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                            <li class="checkout-icon-item">
                                <!-- American Express Icon -->
                                <svg
                                    width="38"
                                    height="24"
                                    viewBox="0 0 38 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_205_2258)">
                                        <path
                                            opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black" />
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="#FF6B6C" />
                                        <path
                                            d="M8.971 10.268L9.745 12.144H8.203L8.971 10.268ZM25.046 10.346H22.069V11.173H24.998V12.412H22.075V13.334H25.052V14.073L27.129 11.828L25.052 9.488L25.046 10.346ZM10.983 8.006H14.978L15.865 9.941L16.687 8H27.057L28.135 9.19L29.25 8H34.013L30.494 11.852L33.977 15.68H29.143L28.065 14.49L26.94 15.68H10.03L9.536 14.49H8.406L7.911 15.68H4L7.286 8H10.716L10.983 8.006ZM19.646 9.084H17.407L15.907 12.62L14.282 9.084H12.06V13.894L10 9.084H8.007L5.625 14.596H7.18L7.674 13.406H10.27L10.764 14.596H13.484V10.661L15.235 14.602H16.425L18.165 10.673V14.603H19.623L19.647 9.083L19.646 9.084ZM28.986 11.852L31.517 9.084H29.695L28.094 10.81L26.546 9.084H20.652V14.602H26.462L28.076 12.864L29.624 14.602H31.499L28.987 11.852H28.986Z"
                                            fill="#FEFEFE" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_205_2258">
                                            <rect width="38" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                            <li class="checkout-icon-item">
                                <!-- Discover Icon -->
                                <svg
                                    width="38"
                                    height="24"
                                    viewBox="0 0 38 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_205_2274)">
                                        <path
                                            opacity="0.07"
                                            d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                            fill="black" />
                                        <path
                                            d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                            fill="#FEFEFE" />
                                        <path
                                            d="M28.3 10.1H28C27.6 11.1 27.3 11.6 27 13.1H28.9C28.6 11.6 28.6 10.9 28.3 10.1ZM31.2 16H29.5C29.4 16 29.4 16 29.3 15.9L29.1 15L29 14.8H26.6C26.5 14.8 26.4 14.8 26.4 15L26.1 15.9C26.1 16 26 16 26 16H23.9L24.1 15.5L27 8.7C27 8.2 27.3 8 27.8 8H29.3C29.4 8 29.5 8 29.5 8.2L30.9 14.7C31 15.1 31.1 15.4 31.1 15.8C31.2 15.9 31.2 15.9 31.2 16ZM17.8 15.7L18.2 13.9C18.3 13.9 18.4 14 18.4 14C19.1 14.3 19.8 14.5 20.5 14.4C20.7 14.4 21 14.3 21.2 14.2C21.7 14 21.7 13.5 21.3 13.1C21.1 12.9 20.8 12.8 20.5 12.6C20.1 12.4 19.7 12.2 19.4 11.9C18.2 10.9 18.6 9.5 19.3 8.8C19.9 8.4 20.2 8 21 8C22.2 8 23.5 8 24.1 8.2H24.2C24.1 8.8 24 9.3 23.8 9.9C23.3 9.7 22.8 9.5 22.3 9.5C22 9.5 21.7 9.5 21.4 9.6C21.2 9.6 21.1 9.7 21 9.8C20.8 10 20.8 10.3 21 10.5L21.5 10.9C21.9 11.1 22.3 11.3 22.6 11.5C23.1 11.8 23.6 12.3 23.7 12.9C23.9 13.8 23.6 14.6 22.8 15.2C22.3 15.6 22.1 15.8 21.4 15.8C20 15.8 18.9 15.9 18 15.6C17.9 15.8 17.9 15.8 17.8 15.7ZM25.4381 12.817V12.571L24.0991 12.641C23.3941 12.677 22.9841 12.967 22.9841 13.457C22.9841 13.901 23.3601 14.147 24.0181 14.147C24.9111 14.147 25.4381 13.667 25.4381 12.817ZM27.7541 17.417V16.498C27.7544 16.4787 27.7589 16.4598 27.7674 16.4425C27.7759 16.4252 27.7881 16.41 27.8031 16.398C27.8181 16.3859 27.8355 16.3772 27.8541 16.3726C27.8728 16.3679 27.8922 16.3674 27.9111 16.371C28.0691 16.4 28.2291 16.415 28.3901 16.415C28.6659 16.4301 28.9387 16.3519 29.1646 16.193C29.3905 16.034 29.5562 15.8037 29.6351 15.539L29.7021 15.328C29.7121 15.2995 29.7121 15.2685 29.7021 15.24L27.5571 9.76899C27.5447 9.73897 27.544 9.70537 27.5551 9.67483C27.5662 9.64429 27.5883 9.61902 27.6171 9.60399C27.6362 9.59392 27.6575 9.58876 27.6791 9.58899H28.7191C28.7458 9.58906 28.7719 9.59722 28.7938 9.6124C28.8158 9.62757 28.8326 9.64905 28.8421 9.67399L30.2981 13.533C30.3071 13.5589 30.324 13.5813 30.3465 13.5971C30.3689 13.6129 30.3957 13.6213 30.4231 13.621C30.4505 13.621 30.4772 13.6125 30.4995 13.5967C30.5219 13.581 30.5389 13.5587 30.5481 13.533L31.8131 9.68499C31.8217 9.65846 31.8386 9.63539 31.8613 9.61919C31.884 9.60298 31.9113 9.5945 31.9391 9.59499H33.0151C33.0474 9.59518 33.0785 9.60702 33.1028 9.62833C33.127 9.64965 33.1428 9.679 33.1471 9.71099C33.1495 9.73233 33.1468 9.75394 33.1391 9.77399L30.8441 15.85C30.3161 17.263 29.4111 17.623 28.4141 17.623C28.2249 17.6282 28.036 17.606 27.8531 17.557C27.8225 17.5495 27.7955 17.5312 27.7772 17.5055C27.7588 17.4798 27.7503 17.4484 27.7531 17.417H27.7541ZM8.56913 6.39999C7.20462 6.38979 5.88755 6.9001 4.88613 7.82699C4.84351 7.86575 4.81692 7.91902 4.81155 7.97637C4.80619 8.03372 4.82244 8.09101 4.85713 8.13699L5.47513 8.97599C5.49515 9.00428 5.52116 9.02781 5.55131 9.04492C5.58145 9.06202 5.615 9.07227 5.64956 9.07494C5.68411 9.07762 5.71883 9.07264 5.75125 9.06038C5.78367 9.04812 5.81299 9.02887 5.83713 9.00399C6.19705 8.64659 6.6245 8.36438 7.09457 8.17381C7.56464 7.98324 8.06793 7.88812 8.57513 7.89399C10.6951 7.89399 11.8021 9.47799 11.8021 11.044C11.8021 12.744 10.6391 13.942 8.96713 13.965C7.67513 13.965 6.70113 13.115 6.70113 11.991C6.70223 11.7068 6.76683 11.4264 6.89019 11.1703C7.01354 10.9143 7.19255 10.689 7.41413 10.511C7.4613 10.4723 7.49125 10.4165 7.49744 10.3558C7.50362 10.2951 7.48553 10.2344 7.44713 10.187L6.79713 9.37199C6.7775 9.34693 6.75301 9.32611 6.72513 9.31076C6.69725 9.29541 6.66655 9.28586 6.63488 9.28268C6.60321 9.27951 6.57123 9.28277 6.54085 9.29228C6.51048 9.30178 6.48234 9.31733 6.45813 9.33799C6.06003 9.65733 5.73821 10.0615 5.51613 10.521C5.29484 10.9795 5.17966 11.4819 5.17913 11.991C5.17913 13.926 6.83413 15.443 8.95413 15.455H8.98413C11.5011 15.423 13.3211 13.571 13.3211 11.04C13.3211 8.79299 11.6541 6.39999 8.56913 6.39999Z"
                                            fill="#FEFEFE" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_205_2274">
                                            <rect width="38" height="24" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<p>Product not found.</p>";
    }

    $stmt->close();
} else {
    echo "<p>No product ID provided.</p>";
}

$conn->close();
?>