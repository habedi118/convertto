<?php
/*
* this is template part of portfolio post type
*/


$terms = get_the_terms($post,'portfolio_cat');
if(!empty($terms)):
    foreach($terms as $term):
    $termid =  ((int)$term->parent == 0)?$term->term_id:0;
    endforeach;
endif;


?>
<!-- start protofile item  -->

<div class="col-12 col-sm-11 mx-sm-auto mx-md-0 col-md-5 col-lg-4 col-xl-3 my-2 protofile-item"
      termid=<?php echo $termid ?>
    >

  <div class="w-100">
    <div class="w-100">

      <?php the_post_thumbnail("portfolio-item",['class' => 'maskimg img-fluid']); ?>

    </div>

    <div class="h-100 protofile-text  flex-column justify-content-center text-center text-2 container-fluid  ">
      <h5><?php the_title(); ?></h5>
      <div class="pt-2 fr9">
          <?php the_excerpt(); ?>
      </div>
      <a href="<?php the_permalink(); ?>" class="btn bg-3 text-2 hover-text-2 hover-bg-5"> دیدن نمونه کار </a>
    </div>
  </div>

</div>

<!-- End protofile item -->
