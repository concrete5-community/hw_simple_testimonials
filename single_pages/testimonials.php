<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="hw-simple-testimonial-wrapper">
    <h1> <?php echo t('Testimonials') ?> </h1>
    <div class="hw-simple-testimonial">
        <?php foreach ($entries as $e)  : ?>

            <div class="ccm-block-testimonial-text">

                <div class="hw-simple-testimonial-testimonial">
                    <?php echo t($e->getTestimonial()) ?>
                </div>
                <div class="hw-simple-testimonial-author">
                    <?php echo t($e->getAuthor()) ?> <span
                            class="hw-simple-testimonial-company"><?php if (strlen($e->getCompany()) > 0){ ?>
                        : <?php echo t($e->getCompany()) ?></span> <?php } ?>
                </div>
                <div class="hw-simple-testimonial-extra">
                    <?php echo t($e->getExtra()) ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>

</div>