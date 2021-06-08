<?php 
  if(! is_user_logged_in()) {
      wp_redirect(esc_url(site_url('/')));
      exit;
      
  }
  
  
  get_header();
   pageBanner();
   ?>
   

  <div class="container container--narrow page-section">
     Custom code will Go here 
    </div>

  
<?php 
  get_footer();
  ?>