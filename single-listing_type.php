<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $CORE_REALESTATE, $post, $userdata, $wpdb;
 
wp_register_script( 'homestyles', get_template_directory_uri()."/".THEME_FOLDER.'/template/js/jquery.zclip.js');	 
wp_enqueue_script( 'homestyles' );

// STAR RATING
$starrating = get_post_meta($post->ID, 'starrating', true);
if(!is_numeric($starrating)){ $starrating = 0; }

$starreviews = get_post_meta($post->ID, 'starrating_votes', true);
if(!is_numeric($starreviews)){ $starreviews = 0; }


// GET VALUE
$date = get_post_meta($post->ID,'expiry_date',true);
if($date == ""){
	$date = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id =('".$post->ID."') AND meta_key=('expiry_date') LIMIT 1" );
}

$couponcode = get_post_meta($post->ID,'code',true);


// GET DATE PARTS
$vv = $CORE->date_timediff($date);

function _hook_extra_css($css){ global $CORE;
ob_start();
?>
<style>
.couponbutton {
	border: 1px solid #ddd; background:#fff;
}
.couponbutton .button {
    display: inline-block;
    width: auto;
    padding: 1.2em .75em;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    vertical-align: middle;
	float:right;
}
@media (max-width: 576px) { 
	.couponbutton .button {
	width:100%;
	}
}
.button-primary, .button-show-code {
    display: inline-block;
    width: 100%;
    min-width: 2em;
    padding: 1em .75em;
    transition: background-color .5s ease,border-color .5s ease,color .5s ease,fill .5s ease; 
    color: #fff; 
    font-size: 15px;   
    text-align: center;
    text-decoration: none;
    cursor: pointer; 
    border: 1px solid #fff; 
}
.copybtn {
	vertical-align: middle;
    overflow-y: auto;
    width: auto;
    max-width: 72%;
    font-size: 26px;
    white-space: nowrap;
    display: inline-block;
    width: 100%;
    min-width: 2em;
    padding: 15px 20px;
    transition: background-color .5s ease,border-color .5s ease,color .5s ease,fill .5s ease;
    background: #fff;
    color: #222;
    font-size: 19px; 
    text-align: center;
    text-decoration: none;
    cursor: pointer; 
}

.wlt_rating_box {
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 65px;
}
.wlt_rating_box .rt1 {
    background-color: #cd1111;
}
.wlt_rating_box .rt2 {
    background-color: #01b18a;
}
.wlt_rating_box .rt3 {
    background-color: #e89e00;
}
.wlt_rating_box .rt4 {
    background-color: #007bff;
}

.wlt_rating_box .rating {
    display: block;
    width: 100%;
    margin-top: -2px;
    padding: 10px 10px 11px;
    font-weight: 700;
    font-size: 10px;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    position: absolute;
    top: 0;
    background-image: -webkit-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: -moz-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: -o-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: linear,143deg,rgba(255,255,255,.2) 50%,transparent 50%;
}
.wlt_rating_box .rating .b1 {
    font-size: 18px;
    font-weight: 700;
    text-align: center;
    display: block;
    line-height: 21px;
}
.wlt_rating_box .b3 {
    margin: 0;
    padding: 0;
    position: absolute;
    top: 60px;
    left: 0;
    color: #444;
    font-size: 11px;
    width: 100%;
    text-align: center;
}

 
.wlt_rating_box .thumbs {
 padding:10px;
}
.wlt_rating_box .thumbs span {
    display: block;
    float: left;
    background: #000;
    border: 1px solid #000;
    position: relative;
    cursor: pointer;
    text-align: center;
    font-size: 16px;
    color: #fff;
    padding: 5px 15px;
    background-image: -webkit-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: -moz-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: -o-linear-gradient(-53deg,rgba(255,255,255,.2) 50%,transparent 50%);
    background-image: linear,143deg,rgba(255,255,255,.2) 50%,transparent 50%;
}

.wlt_rating_box .right { float:right; }

.sharebox { border-top:1px solid #ddd; padding:10px 0px; border-bottom: 1px solid #ddd; }
.sharebox .col-md-4 { border-right:1px solid #ddd; line-height: 40px;    text-align: center;}
.sharebox .col-md-4:last-child { border-right:0px; }

.couponinfo { color:#222; }
.couponinfo-wrap1 { width:49%; padding:20px; float:right; font-size:12px; }
.couponinfo-wrap2 { border-right:1px solid #ddd; width:49%; padding:20px; float:right; font-size:12px; }
.couponinfo i {     font-size: 40px;    float: left;    padding-right: 10px;    color: #bbbbbb; }

@media (min-width: 992px) {
   .bbr { border-right: 1px solid #ddd; }
   .bbl { border-left:1px solid #ddd; }
   }

</style>
<?php

$newcss = ob_get_clean();
$newcss = str_replace("<style>","", str_replace("</style>","",$newcss)); 
$newcss = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $newcss)); 
return $css.$newcss;
}
add_action('hook_v9_extra_css','_hook_extra_css');

// RANDOM NUMBERS
$email_nr1 = rand("0", "9");$email_nr2 = rand("0", "9");

get_header($CORE->pageswitch());
 
if (have_posts()) : while (have_posts()) : the_post();

if($post->post_author == $userdata->ID){   get_template_part('author', 'toolbox' );   } ?>

<?php get_template_part( 'page', 'top' ); ?>    
<section>
   <div class="container">
      <div class="card mb-2">
         <div class="card-body">
            <div class="row">
               <div class="col-md-4">
                  <div class="text-center mx-auto">
				  <?php echo do_shortcode('[COUPONIMAGE screenshot=1]'); ?>
				  <?php echo do_shortcode('[STORE text=""]'); ?>
				  </div>
               </div>
               <div class="col-md-8 bbl">
                  <div class="bg-light px-5 pt-4 pb-5">
                     <div class="row">
                        <div class="col-xl-6 bbr">
                           <?php if($couponcode == ""){ ?>
                           <div class="mb-4 small text-center"><?php echo __("No Coupon Needed!","premiumpress") ?></div>
                           <div class="text-center">
                              <a href="<?php echo get_post_meta($post->ID,'link',true); ?>" class="btn btn-primary btn-lg mt-2 text-uppercase" target="_blank" rel="nofollow"><?php echo __("Continue to Store","premiumpress") ?></a>
                           </div>
                           <?php }else{ ?>   
                           <div class="mb-4 small text-center"><?php echo __("Copy and paste this code at;","premiumpress") ?><br /> <?php echo do_shortcode('[STORE linkout=1 limit=1]'); ?></div>
                           <div class="couponbutton clearfix mb-3">
                              <div class="copybtn" id="copybtn"><?php echo $couponcode; ?></div>
                              <button class="button button-primary btn-primary js-copy" data-clipboard-target="#copybtn"><?php echo __("Copy","premiumpress") ?></button>
                           </div>
                           
                           
<script>
 						  
var clipboard = new ClipboardJS('.js-copy');


clipboard.on('success', function(e) {


	jQuery.ajax({
                              					type: "POST",
                              					url: '<?php echo home_url(); ?>/',		
                              					data: {
                              						action: "update_usage",						
                              						pid: '<?php echo $post->ID; ?>',						
                              					},
                              					success: function(response) {
                              						
                              						jQuery('#ajax_payment_form').html(response);
                              						 
                              						
                              					},
                              					error: function(e) {
                              						 
                              					}
                              				});
                              		
                              		
                              			window.open(  '<?php echo get_post_meta($post->ID,'link',true); ?>',  '_blank' );
});

 


                           								 
                               
                              									 
                              
                           </script>
                           <?php } ?>
                        </div>
                        <div class="col-xl-6 text-center">
                           <div class="mb-5 small"><?php echo __("Did it work? Let us know!","premiumpress") ?></div>
                           <?php echo do_shortcode('[RATINGBOX]'); ?>
                        </div>
                     </div>
                  </div>
                  <div class="couponinfo mt-3">
                     <div class="couponinfo-wrap1"> 
                        <i class="fa fa-clock-o"></i>         
                        <?php if($vv['expired'] == 1){	?>
                        <?php echo __("This coupon has expired.","premiumpress") ?>
                        <?php }else{ ?>
                        <?php echo __("This coupon expires in","premiumpress") ?> <?php echo $vv['string']; ?>        
                        <?php } ?>
                     </div>
                     <div class="couponinfo-wrap2"> 
                        <i class="fa fa-cog"></i>         
                        <?php echo __("This coupon has been viewed","premiumpress") ?>
                        <?php echo sprintf( _n( 'once', '%s times', do_shortcode('[HITS]'), "premiumpress" ), do_shortcode('[HITS]') ); ?>
                        <?php echo __("times and has been used ","premiumpress") ?>
                        <?php echo sprintf( _n( 'once', '%s times', do_shortcode('[USED]'), "premiumpress" ), do_shortcode('[USED]') ); ?>.
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php if(get_post_meta($post->ID,'cashback',true) > 0 || defined('WLT_DEMOMODE') ){ 
         $amount = hook_price(get_post_meta($post->ID,'cashback',true));
         
         if(defined('WLT_DEMOMODE')){ $amount = 15; }
         
         ?>
      <div class="sharebox bg-light py-4">
         <div class="row">
            <div class="col-md-4">
               <strong class="text-uppercase"><?php echo __("Earn Cash-back today!","premiumpress") ?></strong>
            </div>
            <div class="col-md-5 text-center">
               <p class="mt-2 mb-0"><?php echo sprintf( _n( '', 'You can earn %s with this offer.', $amount, 'premiumpress' ), $amount ); ?></p>
            </div>
            <div class="col-md-3">
               <div class="mr-4"><a href="<?php echo _ppt(array('links','cashback')); ?>" class="btn btn-primary btn-block"><?php echo __("Learn More","premiumpress") ?></a></div>
            </div>
         </div>
      </div>
      <?php } ?>
      <!-- card -->
      <div class="card-body">
         <div class="row sharebox">
            <div class="col-md-4">
               <?php echo do_shortcode('[FAVS icon=1]'); ?>
            </div>
            <div class="col-md-4">
               <?php echo __("Coupon ID","premiumpress") ?> #<?php echo $post->ID; ?>
            </div>
            <div class="col-md-4">
               <a href="javascript:void(0);" class="btn btn-block addthis_button_compact"><i class="fa fa-heart-o"></i> <?php echo __("Share","premiumpress") ?></a>
            </div>
         </div>
      </div>
      <!-- end card -->
   </div>
</section>
<section class="bg-light">
   <div class="container">
      <div class="listing-grid-wrapper">
         <div class="row">                      
            <?php
               if(get_post_meta($post->ID,'map-area',true) != ""){
               	$args = array('posts_per_page' => 6, 
               			 'orderby' => 'title', 'order' => 'des', 'paged'  => 1, 'post_type' => 'listing_type',
               			'meta_query' => array (
               					array (
               					  'key' => 'map-area',
               					  'value' => ''.get_post_meta($post->ID,'map-area',true).'',
               					)
               				  ) 
               			 );
               }else{
               	$args = array('posts_per_page' => 6, 
               			 'orderby' => 'title', 'order' => 'des', 'paged'  => 1, 'post_type' => 'listing_type',
               			   
               			 );
               }	  
               // PERFORM LOOP	
               $query2 = new WP_Query( $args );
               if ( $query2->have_posts() ) {
               	// The 2nd Loop
               	while ( $query2->have_posts() ) {
               		$query2->the_post();
               		
               		$post =  $query2->post;
               		
               ?>
            <?php get_template_part( hook_theme_folder(array('content','listing')), str_replace("_type","","listing_type") ); ?> 
            <?php
               }
               
               // Restore original Post Data
               wp_reset_postdata();
               }
               
               ?>
         </div>
      </div>
   </div>
</section>
<script>var addthis_config = {"data_track_addressbar":false};</script>
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=premiumpress"></script>

<?php endwhile; endif;

get_footer($CORE->pageswitch());
?>