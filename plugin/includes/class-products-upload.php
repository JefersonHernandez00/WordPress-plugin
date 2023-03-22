<?php

/**
 * we upload 5 records to our CPT
 */
function auto_populate_products_on_activation() {

  // Check if posts already exist, return if true
  $check_posts = get_posts( array(
    'post_type' => 'products',
    'post_status' => 'publish',
    'posts_per_page' => 1,
  ) );
  if ( $check_posts ) {
    return;
  }

  for ( $i = 0; $i < 5; $i++ ) {
    $product = array(
      'post_title' => 'Product ' . ( $i + 1 ),
      'post_content' => '

      <p>
      This is a demo product
      </p>
      <ul>
      <li>
      Act as One Team - By fostering inclusion,
      collaboration and respect
      </li>
      <li>
      Drive for Excellence - By being agile, innovative and
      efficient
      </li>
      <li>
      Do What´s Right - By acting safely, ethically and
      sustainably
      </li>
      </ul>
      ',
      'post_type' => 'products',
      'post_status' => 'publish',
    );

    $product_id = wp_insert_post( $product );
    if ( $product_id ) {
      update_post_meta( $product_id, 'sku', 'SKU-0' . ( $i + 1 ) );
      update_post_meta( $product_id, 'rating', ( $i + 1 ));
      update_post_meta( $product_id, 'price', '$' . ( $i + 1 ) * 10 . '.00');
      update_post_meta( $product_id, 'video', 'https://www.youtube.com/embed/ueSfRUnIfRY' );



 // Check if image already exists in the media library
$image_url = plugins_url( '../public/img/thumb-image.jpg', __FILE__ );
$image_id = attachment_url_to_postid( $image_url );

if ( ! $image_id ) {
  // Insert image into the database if it doesn't exist
  $upload_dir = wp_upload_dir();
  $image_data = file_get_contents($image_url);
  $filename = basename($image_url);
  if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
  } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
  }
  file_put_contents( $file, $image_data );

  // Get ID of newly uploaded image
  $wp_filetype = wp_check_filetype( $filename, null );
  $attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title' => sanitize_file_name( $filename ),
    'post_content' => '',
    'post_status' => 'inherit'
  );
  $image_id = wp_insert_attachment( $attachment, $file, $product_id );
}

// Set featured image
set_post_thumbnail( $product_id, $image_id );




    }

  }

}
add_action( 'after_setup_theme', 'auto_populate_products_on_activation' );



