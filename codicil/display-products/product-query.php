<?php
function perform_product_query($query_args, $atts, $TierValue, $SplitValue, $TypeValue, $SplitSource, $PackagedSource) {
  $output = '';
  // Run the query
  $product_query = new WP_Query($query_args);

  // Declare the $products array and output variable
  $output .= '<div class="product_column">';
  $products = array();

  if ($product_query->have_posts()) {
    while ($product_query->have_posts()) {
      $product_query->the_post();
      $title = get_the_title();
    
      // Add text to the title based on $_GET variables
      if ($TypeValue == 'Air Conditioner') {
        if ($SplitSource == 'Natural Gas') {
          $title .= ' + Gas Furnace Split System';
        } elseif ($SplitSource == 'Electric') {
          $title .= ' + Air Handling Unit Split System';
        }
      } elseif ($TypeValue == 'Heat Pump') {
        if ($SplitSource == 'Natural Gas') {
          $title .= ' + Gas Furnace Split System';
        } elseif ($SplitSource == 'Electric') {
          $title .= ' + Air Handling Unit Split System';
        }
      } elseif ($TypeValue == 'Packaged Unit') {
        if ($PackagedSource == 'Natural Gas') {
          $title .= ' + Gas Heat Split System';
        } elseif ($PackagedSource == 'Electric') {
          $title .= ' + Electric Heat Split System';
        }
      }
    
      $excerpt = get_the_excerpt();
      $price = 0;
      if ($TierValue == '1') {
        $price = get_field('hvac_product_price_1');
      } elseif ($TierValue == '2') {
        $price = get_field('hvac_product_price_2');
      } elseif ($TierValue == '3') {
        $price = get_field('hvac_product_price_3');
      } elseif ($TierValue == '4') {
        $price = get_field('hvac_product_price_4');
      } elseif ($TierValue == '5') {
        $price = get_field('hvac_product_price_5');
      } elseif ($TierValue == '6') {
        $price = get_field('hvac_product_price_6');
      }
      // Push the product data into the $products array
      $products[] = [
        'title' => $title,
        'excerpt' => $excerpt,
        'price' => $price,
        'thumbnail' => get_the_post_thumbnail()
      ];
    }
    // Sort the products by price
    usort($products, function ($a, $b) {
      return $a['price'] - $b['price'];
    });
    // Generate the output using the sorted $products array
    foreach ($products as $product) {
      $output .= '<label>';
      $output .= '<div class="div-box-product">';
      $output .= $product['thumbnail'];
      $output .= '<h2>' . $product['title'] . '</h2>';
      if (isset($product['price']) && !empty($product['price'])) {
        $output .= '<div class="price" style="font-weight:bold;">$' . $product['price'] . '</div>';
      } else {
        $output .= '<div class="price-lost" style="font-weight:bold;">Price not available</div>';
      }
      $output .= '<p>' . $product['excerpt'] . '</p>';
      $output .= '<input type="radio" name="product" value="' . $product['title'] . '" onclick="updateProductTitle(\'' . $product['title'] . '\', \'' . $product['price'] . '\')"></input>';
      $output .= '</div>';
      $output .= '</label>';
    }
    $output .= '</div>';
  } else {
    $output .= '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url(__FILE__) . 'assets/css/404.css">';
    ob_start();
    include plugins_url( 'assets/html/404-product.html', __FILE__ );
    $output .= ob_get_clean(); // Append the captured HTML output to the $output variable
  }
  wp_reset_postdata();

  return $output;
}