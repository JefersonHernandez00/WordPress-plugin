<?php

/**
 * Create a custom post type, taxonomies and custom fields
 */

// Register Custom Post Type
function create_post_type_products() {
  register_post_type( 'products',
    array(
      'labels' => array(
        'name'                  => _x( 'products', 'Post Type General Name', 'products' ),
        'singular_name'         => _x( 'product', 'Post Type Singular Name', 'products' ),
        'menu_name'             => __( 'Products', 'products' ),
        'name_admin_bar'        => __( 'Products', 'products' ),
        'archives'              => __( 'Item Archives', 'products' ),
        'attributes'            => __( 'Item Attributes', 'products' ),
        'parent_item_colon'     => __( 'Parent Item:', 'products' ),
        'all_items'             => __( 'All Products', 'products' ),
        'add_new_item'          => __( 'Add New Item', 'products' ),
        'add_new'               => __( 'Add Product', 'products' ),
        'new_item'              => __( 'New Item', 'products' ),
        'edit_item'             => __( 'Edit Item', 'products' ),
        'update_item'           => __( 'Update Item', 'products' )
      ),
      'public' => true,
      'has_archive' => true,
      'description'           => __( 'products acme', 'products' ),
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-store',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'supports' => array('title', 'editor', 'thumbnail'),
    )
  );
}
add_action( 'init', 'create_post_type_products' );



function create_products_taxonomies() {
  $labels = array(
    'name' => _x( 'Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'separate_items_with_commas' => __( 'Separate Category with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Category', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Category', 'text_domain' ),
    'search_items'               => __( 'Search Category', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No Category', 'text_domain' ),
    'items_list'                 => __( 'Category list', 'text_domain' ),
    'items_list_navigation'      => __( 'Category list navigation', 'text_domain' ),
  );
  register_taxonomy( 'category_products', 'products', array(
    'labels' => $labels,
    'hierarchical' => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  ) );
  
  $labels = array(
    'name' => _x( 'Seller', 'taxonomy general name' ),
    'singular_name' => _x( 'Seller', 'taxonomy singular name' ),
     'separate_items_with_commas' => __( 'Separate Seller with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Seller', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Seller', 'text_domain' ),
    'search_items'               => __( 'Search Seller', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No Seller', 'text_domain' ),
    'items_list'                 => __( 'Seller list', 'text_domain' ),
    'items_list_navigation'      => __( 'Seller list navigation', 'text_domain' ),
  );
  register_taxonomy( 'seller_products', 'products', array(
    'labels' => $labels,
    'hierarchical' => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  ) );
}
add_action( 'init', 'create_products_taxonomies', 0 );


function add_custom_fields_productos() {
  add_meta_box( 'productos_custom_fields', 'Productos Custom Fields', 'wp_custom_attachment', 'products', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_custom_fields_productos' );

function wp_custom_attachment() {

  //  $document = get_post_meta(get_the_ID(), 'document', true); 

 $sku = get_post_meta( get_the_ID(), 'sku', true );
 $rating = get_post_meta( get_the_ID(), 'rating', true );
 $price = get_post_meta( get_the_ID(), 'price', true );
 $video = get_post_meta( get_the_ID(), 'video', true );

 ?>
 <table>
  <tr>
    <td><label for="sku">SKU:</label></td>
    <td><input type="text" name="sku" id="sku" value="<?php echo esc_attr( $sku ); ?>"></td>
  </tr>
  <tr>
    <td><label for="rating">Rating:</label></td>
    <td><input type="number" name="rating" id="rating" value="<?php echo esc_attr( $rating ); ?>"></td>
  </tr>
  <tr>
    <td><label for="price">Price:</label></td>
    <td><input type="text" name="price" id="price" value="<?php echo esc_attr( $price ); ?>"></td>
  </tr>
  <tr>
    <td><label for="video">Video:</label></td>
    <td><input type="text" name="video" id="video" value="<?php echo esc_attr( $video ); ?>"></td>
  </tr>
</table>


<?php




wp_nonce_field(plugin_basename(__FILE__), 'document_nonce');

$document = [];
$document = get_post_meta(get_the_ID(), 'document', true); 
if($document && isset($document['url'])):
  $html .= 'Current file attached <a href="'.$document['url'].'" target="_blank">Preview file</a>'; 
endif;


$html = '';
$html .= '<p class="description">';
$html .= 'Upload your PDF here.';
$html .= '</p>';
$html .= '<input type="file" id="document" name="document" value="" size="25" />';

echo $html;

} // end wp_custom_attachment



function save_custom_fields_productos( $post_id ) {

  /* --- security verification --- */
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return $post_id;
  }

  /* - end security verification - */
  
  
  if ( array_key_exists( 'sku', $_POST ) ) {
    update_post_meta( $post_id, 'sku', sanitize_text_field( $_POST['sku'] ) );
  }
  if ( array_key_exists( 'rating', $_POST ) ) {
    update_post_meta( $post_id, 'rating', sanitize_text_field( $_POST['rating'] ) );
  }
  if ( array_key_exists( 'price', $_POST ) ) {
    update_post_meta( $post_id, 'price', sanitize_text_field( $_POST['price'] ) );
  }
  if ( array_key_exists( 'video', $_POST ) ) {
    update_post_meta( $post_id, 'video', sanitize_text_field( $_POST['video'] ) );
  }
  if ( array_key_exists( 'document', $_POST ) ) {
    update_post_meta( $post_id, 'document', sanitize_text_field( $_POST['document'] ) );
  }

  if (!empty($_FILES['document']['name'])) {
    $supported_types = array('application/pdf');
    $arr_file_type = wp_check_filetype(basename($_FILES['document']['name']));
    $uploaded_type = $arr_file_type['type'];

    if (in_array($uploaded_type, $supported_types)) {
      $file_name = $_FILES['document']['name'];
      $upload_dir = wp_upload_dir();
      $i = 1;
      while (file_exists($upload_dir['path'] . '/' . $file_name)) {
        $file_name = preg_replace('/\.[^.]+$/', '', $_FILES['document']['name']) . '-' . $i . '.' . $arr_file_type['ext'];
        $i++;
      }
      $upload = wp_upload_bits($file_name, null, file_get_contents($_FILES['document']['tmp_name']));

      if (isset($upload['error']) && $upload['error'] != 0) {
        wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
      } else {
        update_post_meta($post_id, 'document', $upload);
      }
    } else {
      wp_die("The file type that you've uploaded is not a PDF.");
    }
  }

  if (!$upload['error']) {
    $wp_filetype = wp_check_filetype($upload['file'], null );
    $file_name = preg_replace('/\.[^.]+$/', '', basename($upload['file']));
    if (!empty($file_name)) {
      $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_parent' => $post_id,
        'post_title' => $file_name,
        'post_content' => '',
        'post_status' => 'inherit'
      );
      $attachment_id = wp_insert_attachment($attachment, $upload['file'], $post_id);

      if (!is_wp_error($attachment_id)) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
        wp_update_attachment_metadata( $attachment_id,  $attachment_data );
      }
    }
  }
}
add_action( 'save_post', 'save_custom_fields_productos' );

/**
This code is a WordPress action hook that adds the enctype attribute with a value of "multipart/form-data" to the post edit form. This attribute is required when a form allows file uploads.
*/
function update_edit_form() {
  echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');