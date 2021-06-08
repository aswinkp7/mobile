
<?php 
get_header();
pageBanner();

while(have_posts()) {
    the_post(); ?>
    
  <div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('/program');?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs <?php get_the_title();?> </a> <span class="metabox__main"><?php the_title();  ?></span></p>
    </div>
      <div class="generic-content"><?php the_content(); ?></div>

      <?php 
           $relatedprofessors = new wp_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby'   => 'title',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                  'key'=> 'related_program',
                  'compare'=> 'LIKE',
                  'value' => '"' . get_the_ID() .  '"'

              )
            )
            ));
                if($relatedprofessors->have_posts()){
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium">'. get_the_title() . ' Professors</h2>';
            echo '<ul class="professor-cards">';
            while($relatedprofessors -> have_posts() ) {
            $relatedprofessors->the_post(); ?>
            
            <li class="professor-card__list-item">
                <a  class="professor-card" href="<?php the_permalink(); ?>">
              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape')?>">
              <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
        </li> 
       
            <?php 
            }
            echo '</ul>';
        }
           
           
           wp_reset_postdata();
           
           $today = date('Ymd');
           $homepageevents = new wp_Query(array(
             'posts_per_page' => 2,
             'post_type' => 'event',
             'meta_key' => 'event_date_',
             'orderby'   => 'meta_value_num',
             'order' => 'ASC',
             'meta_query' => array(
               array(
                'key' => 'event_date_',
                'compare' => '>=',
                'value' => $today,
                'type'   => 'numeric'
               ),
               array(
                   'key'=> 'related_program',
                   'compare'=> 'LIKE',
                   'value' => '"' . get_the_ID() .  '"'

               )
             )
             ));
                  
             if($homepageevents -> have_posts()) {
             echo '<hr class="section-break">';
             echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
            while($homepageevents -> have_posts() ) {
             $homepageevents->the_post(); 
             get_template_part('template-parts/content-event');
            
             
             }
            }
            wp_reset_postdata();

            $relatedCampuses = get_field('related_campus');
           
              if($relatedCampuses){
                   
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">'. get_the_title() . ' is available at these campuses : </h2>';
              
                   echo '<ul class="min-list link-list">';
                   foreach($relatedCampuses as $campus){
                       ?> <li> <a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus) ?> </a></li>
                       
                       <?php  


                   }
              echo '</ul>';
                }

             ?>
</div>



  
  
  <?php 
  get_footer();
}
?>