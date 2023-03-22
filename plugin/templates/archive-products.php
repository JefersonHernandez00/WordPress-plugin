<?php
/*
Template Name: Products Archive
*/
?>
<head>
  <meta charset="utf-8" />
  <title>Products</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="apple-touch-icon" href="icon.png" />
  <!-- Montserrat Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
  rel="stylesheet" />
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
  rel="stylesheet"
  />
  
  <link rel="stylesheet" type="text/css" href="../wp-content/plugins/plugin/public/css/products-public.css">
  <meta name="theme-color" content="#fafafa" />
</head>

<?php

$args = array(
  'post_type' => 'products',
  'posts_per_page' => -1
);

$query = new WP_Query( $args );
?>

<body>

  <section class="products__filter">
    <div class="products__filter-header">
      <div class="container filter-header__container">
        <div class="filter-header__titles">
          <h4 class="filter__result">Results Found <?php echo wp_count_posts( 'products' )->publish; ?>
          </h4>
        </div>
        <div class="filter__menu">
          <p class="filter-by">Filter By:</p>
          <ul>
            <li>
              <select class="form-select" aria-label="Default select example">
                <option selected>SKU</option>
                <?php
                  $posts = get_posts(array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'products',
                    'orderby'          => 'title',
                    'order'            => 'ASC',
                  ));
                  foreach ($posts as $post) {
                    $sku = get_post_meta($post->ID, 'sku', true);
                    echo '<option value="' . $post->ID . '">' . $sku . '</option>';
                  }
                ?>
              </select>
            </li>
            <li>
              <select class="form-select" aria-label="Default select example">
                <option selected>Category</option>
                <option value="1">Category Title</option>
                <option value="2">Category Title</option>
                <option value="3">Category Title</option>
                <option value="4">Category Title</option>
                <option value="5">Category Title</option>
              </select>
            </li>
            <li>
              <select class="form-select" aria-label="Default select example">
                <option selected>Rating</option>
                <?php
                  $posts = get_posts(array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'products',
                    'orderby'          => 'title',
                    'order'            => 'ASC',
                  ));
                  foreach ($posts as $post) {
                    $rating = get_post_meta($post->ID, 'rating', true);
                    echo '<option value="' . $post->ID . '">' . $rating . '</option>';
                  }
                ?>
              </select>
            </li>
          </ul>
          <a href="#" class="order__by-btn">
            <img src="../wp-content/plugins/plugin/public/img/order-btn.png" alt="order__by-icon" />
          </a>
        </div>
      </div>
    </div>
    <!-- Data Table -->
    <div class="product__datatable">
      <div class="container">
        <div class="datatable__container">
          <!-- Table Top Titles -->
          <div class="datatable__filter">
            <ul>
              <li class="title">
                Title
                <span></span>
              </li>
              <li class="table-sku">
                SKU
                <span></span>
              </li>
              <li class="table-category">
                Category
                <span></span>
              </li>
              <li class="table-saller">
                Seller
                <span></span>
              </li>
              <li class="table-rating">
                Rating
                <span></span>
              </li>
              <li class="table-document">
                Document
                <span></span>
              </li>
            </ul>
          </div>

          <div id="primary" class="content-area">
            <main id="main" class="site-main">
              <?php if ( $query->have_posts() ) : ?>
                <div class="products-container">
                  <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                    <!-- Single Products -->
                    <div class="single__product">
                      <ul class="single__product-tab">
                        <li class="product__title">
                          <span class="open-close__icon"> </span>
                          <span class="product__title-text">
                            <?php the_title(); ?>
                          </span>
                        </li>
                        <li class="product__sku"><?php echo get_post_meta( get_the_ID(), 'sku', true ); ?></li>
                        <li class="product__category">
                          Category Title
                        </li>
                        <li class="product__seller">Seller</li>
                        <?php 
                          $rating = get_post_meta( get_the_ID(), 'rating', true );
                          $rating_html = '';
                          if ( !empty($rating) && $rating >= 1 && $rating <= 5 ) {
                            for ( $i=1; $i<=5; $i++ ) {
                              if ( $i <= $rating ) {
                                $rating_html .= '<span><img src="../wp-content/plugins/plugin/public/img/star-icon.png" alt="star-icon" /></span>';
                              } else {
                                $rating_html .= '';
                              }
                            }
                          }
                        ?>
                        <li class="product__rating <?php echo !empty($rating_html) ? 'rated' : ''; ?>">
                          <?php echo $rating_html; ?>
                        </li>

                        <li class="product__document">
                          <img src="../wp-content/plugins/plugin/public/img/pdf-icon.svg" alt="icon" />
                        </li>
                      </ul>
                      <!-- Single Product Details -->
                      <div class="single__product-details">
                        <div class="single__product-detailsContent">
                          <!-- Proudct Thumbnail -->
                          <div class="product-details__thumb">
                            <h3 class="thumb-title"><?php the_title(); ?></h3>
                            <div class="thumb-image" data-video=<?php echo esc_html( get_post_meta( get_the_ID(), 'video', true ) ); ?>>
                              <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
                            </div>
                          </div>
                          <!-- Proudct Text -->
                          <div class="product-details__text">
                            <div class="details__text-header">
                              <a href="<?php the_permalink(); ?>" class="btn-find__details"> Find Details </a>
                              <h4 class="price"><?php echo get_post_meta( get_the_ID(), 'price', true ); ?></h4>
                            </div>
                            <div class="details__text-content">
                              <h3>About the headline</h3>
                              
                              <?php the_content(); ?>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php else : ?>
                <p>No products found.</p>
              <?php endif; ?>
            </main>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- modal -->
  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 760px; height: 400px; padding: 0 !important;">
      <div class="modal-content" style="width: 760px; height: 400px;">
        <div class="modal-body d-flex align-items-center" style="width: 760px; height: 400px; padding: 0 !important;">
          <iframe width="760" height="400" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in- picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
<!-- end modal -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
 integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
 crossorigin="anonymous"
 referrerpolicy="no-referrer"
 ></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../wp-content/plugins/plugin/public/js/products-public.js"></script>
</body>



