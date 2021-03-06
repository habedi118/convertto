<?php
/*
* This template file is just for get related post in single page that have one post
* must add after loop
*/
  global $wp_query;
  global $posts_number;
  $posts_number = empty($posts_number)?10:$posts_number;


  if(have_posts()):
    while(have_posts()):
      the_post();
      $tax_arg = array(
        'relation' => 'OR',
      );
      // TODO: get the taxonomy
       $post_taxs = get_object_taxonomies($post);
      // TODO: get the post term of taxanomy
      foreach($post_taxs as $post_tax):
          $terms = get_the_terms($post,$post_tax);
          $terms_id = array();
          if(!empty($terms)):
              foreach($terms as $term):
                    array_push($terms_id,(int)$term->term_id);
              endforeach;
              $tax_temp =array(
                'taxonomy' => $post_tax,
                'field' =>    'term_id',
                'terms' => $terms_id,
                );
              array_push($tax_arg,$tax_temp);
          endif;
      endforeach;
      // TODO: ceate the array for passing the wp-query
      $queryArg = array(
        'post_type' => $post->post_type,
        'tax_query' => $tax_arg,
        'posts_per_page' => (int)$posts_number,
        'post__not_in' => array((int)get_the_ID()),

      );
    
      global $ha_slider;
      $ha_slider = new WP_Query($queryArg);
      if($ha_slider->have_posts()):
        while($ha_slider->have_posts()):
          $ha_slider->the_post();
          get_template_part("template-parts/portfolio/portfolio","singlepageitem");
        endwhile;

      endif;
      wp_reset_postdata();
    endwhile; //have posts while

  endif; //have post if
  wp_reset_postdata();
 ?>
