<?php
/*
Template Name: [WEBMIX - STORES LIST A-Z]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE, $CORE_CART; wp_get_current_user(); 

$GLOBALS['flag-contact'] = true;
  
if(!_ppt_checkfile("tpl-aboutus.php")){

 
wp_register_style( 'homestyles', get_template_directory_uri()."/".THEME_FOLDER.'/template/style-home.css' );	 
wp_enqueue_style( 'homestyles' );
 
get_header($CORE->pageswitch()); ?>


<main id="main"> 

<section>


<div class="container">

    <div class="row">
	<div class="col-md-12">	


        <div class="row">    
            <div class="col-sm-12">						
                <div class="section-title text-primary">							
                <h2><?php echo __("Coupon Stores","premiumpress"); ?></h2>						
                <p><?php echo __("Here is a list of all the stores we have coupons for on our website.","premiumpress") ?></p>
                </div>							
            </div>                    
        </div>

    <div class="row">
    
		<?php
		
		$categories = get_terms('store', 'orderby=count&hide_empty=0');
        
        $cat=1;
        foreach ($categories as $category) { 
        
                // HIDE PARENT
                if($category->parent != 0){ continue; }
              
                 
                if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
                $caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
                }else{
                $caticon = "fa fa-check";
                }
                
                // LINK 
                $link = get_term_link($category);
                
        ?>
        
        <div class="col-6 col-md-3">
            <div class="storeslist">
                <a href="<?php echo $link; ?>">
                    <div class="image">
                        <?php echo do_shortcode('[SCREENSHOT url="'._ppt('category_website_'.$category->term_id).'" alt="'.$category->name.'"]'); ?>
                    </div>
                    <h6><?php echo $category->name; ?></h6>
                    <span><?php echo $category->count; ?> <?php echo __("coupons","premiumpress"); ?></span>
                </a>
            </div>
        </div>
        
        <?php } ?>
           
  
        
    
    </div><!-- end row -->

</div><!-- end container -->

 </div></div>

</section>
 
</main>	

<?php get_footer($CORE->pageswitch()); } ?>