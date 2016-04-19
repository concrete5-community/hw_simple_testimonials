<?php       defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="hw-simple-testimonial-wrapper">
	<h1> <?php      echo t('Testimonials') ?> </h1>

    <div class="hw-simple-testimonial">
	<?php           foreach ($testimonialslist as $tl) : ?>

        <div class="ccm-block-testimonial-text">
		
		    <div class="hw-simple-testimonial-testimonial">
                <?php      echo t($tl->testimonial)?>
            </div>
			<div class="hw-simple-testimonial-author">
                <?php      echo t($tl->author)?> <span class="hw-simple-testimonial-company"><?php    if(strlen($tl->company)>0){ ?> : <?php    echo t($tl->company)?></span> <?php    } ?>
            </div>
			 <div class="hw-simple-testimonial-extra">
                <?php     echo t($tl->extra) ?>
            </div>
        </div>
		<hr>
	<?php      endforeach; ?>
    </div>
	<?php        if ($paginator): ?>
		<?php        echo $pagination; ?>
	<?php        endif; ?>

</div>