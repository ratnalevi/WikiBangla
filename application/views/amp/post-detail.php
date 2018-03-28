<?php
$ci =& get_instance();
$ci->load->model('front_model');
?>

<div class="material-box content">
    <h4 class="news-post-title"><?php echo $post->post_title; ?></h4>

    <amp-social-share class="under-material-icon" type="twitter" width="43" height="43"></amp-social-share>
    <amp-social-share class="under-material-icon" type="facebook" width="43" height="43" data-param-app_id="254325784911610"></amp-social-share>
    <amp-social-share class="under-material-icon" type="gplus" width="43" height="43"></amp-social-share>
    <div class="clear"></div>

    <div class="decoration"></div>

    <amp-carousel class="slider full-bottom" width="600" height="400" layout="responsive" type="slides" controls autoplay loop delay="3000">
        <?php foreach($slider as $i => $slide){ ?>
            <div>
                <amp-img class="responsive-img" src="<?php echo base_url(UPLOAD_POST.'/'.$slide->image); ?>" alt="<?php echo $slide->part_title; ?>" layout="fill"></amp-img>
                <div class="caption">
                    <h3><?php echo $slide->part_title; ?></h3>
                </div>

            </div>
        <?php } ?>
    </amp-carousel>

    <p>
        <?php echo $post->description; ?>
    </p>
</div>

<?php foreach ($parts as $i => $part) { ?>
    <div class="content material-box">
        <h4 class="uppercase ultrabold quarter-bottom"><span class="">Part <?php echo $i+1; ?> : </span><span><?php echo $part->part_title; ?></span></h4>
        <?php
            $sections = $ci->front_model->post_part_sections($part->id)->result();
            foreach($sections as $j => $section){
        ?>
                <amp-img class="responsive-img" src="<?php echo base_url(UPLOAD_POST . '/' . $section->image); ?>" alt="<?php echo $part->part_title; ?>" width="600" height="375" layout="responsive"></amp-img>
                <p>
                    <?php echo $section->section_description; ?>
                </p>
        <?php } ?>
    </div>
<?php } ?>

<div class="decoration"></div>

<div class="material-box">
    <div class="news-category">
        <p class="bg-blue-dark">Related WikiBangla Posts</p>
        <div class="bg-blue-dark full-bottom"></div>
    </div>
    <div class="news-thumbs">
        <?php foreach($related as $rel){ ?>
        <a href="<?php echo base_url('p/'.$rel->slug); ?>" class="news-item">
            <amp-img class="responsive-img" src="<?php echo base_url(UPLOAD_FEATURED.'/300X230_'.$rel->featured_image); ?>" width="95" height="95" alt="<?php echo $rel->post_title; ?>" layout="responsive"></amp-img>
            <h5><?php echo $rel->post_title; ?></h5>
        </a>
        <?php } ?>
    </div>
</div>
