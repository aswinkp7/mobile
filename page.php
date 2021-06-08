<?php 
   get_header();
   pageBanner();
   ?>
   

  <div class="container container--narrow page-section">
     
     <?php 
     $theid = wp_get_post_parent_id(get_the_ID());
      if ($theid) { ?>
          
          <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theid);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php get_the_title($theid);?> </a> <span class="metabox__main"><?php the_title();?></span></p>
    </div>

      <?php
        }
       ?>


      <?php 
      $testArray = get_pages(array(
          'child_of' => get_the_ID()
      ));
      
      if($theid or $testArray) {

      ?>
      <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theid); ?>"> <?php echo get_the_title($theid);?> </a></h2>
      <ul class="min-list">
        <?php
        if($theid) {
            $findchildrenof = $theid ;
            } else {
                $findchildrenof = get_the_ID();
            }
        wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findchildrenof,
            'sort_column' => 'menu_order'
        )); 
        ?>
      </ul>
    </div>
<?php 
      }
      ?>

    <div class="generic-content">
      <?php the_content();?>
    </div>

  </div>

  
<?php 
  get_footer();
  ?>