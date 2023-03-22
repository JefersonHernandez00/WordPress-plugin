<?php
/*
Template Name: Products single
*/
//get_header();
?>



<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <?php
    while ( have_posts() ) :
      the_post();

      $sku = get_post_meta( get_the_ID(), 'sku', true );
      $rating = get_post_meta( get_the_ID(), 'rating', true );
      $price = get_post_meta( get_the_ID(), 'price', true );
      $video = get_post_meta( get_the_ID(), 'video', true );
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->


        <!-- Proudct Thumbnail -->
        <div class="product-details__thumb">
          <div class="thumb-image" data-video=<?php echo esc_html( get_post_meta( get_the_ID(), 'video', true ) ); ?>>
            <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
          </div>
        </div>



        <div class="entry-content">
          <table>
            <tr>
              <td><label for="sku">SKU:</label></td>
              <td><?php echo esc_html( $sku ); ?></td>
            </tr>
            <tr>
              <td><label for="rating">Rating:</label></td>
              <td><?php echo esc_html( $rating ); ?></td>
            </tr>
            <tr>
              <td><label for="price">Price:</label></td>
              <td><?php echo esc_html( $price ); ?></td>
            </tr>
            <tr>
              <td><label for="video">Video:</label></td>
              <td><?php echo esc_html( $video ); ?></td>
            </tr>
          </table>
          <?php the_content(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
          <?php
          edit_post_link(
            sprintf(
              wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Edit <span class="screen-reader-text">%s</span>', 'theme-slug' ),
                array(
                  'span' => array(
                    'class' => array(),
                  ),
                )
              ),
              get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
          );
          ?>
        </footer><!-- .entry-footer -->

  <?php endwhile; // End of the loop.
  ?>

</main><!-- #main -->
</div><!-- #primary -->
