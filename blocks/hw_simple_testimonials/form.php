<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="pageQty" class="control-label"><?php echo t('Qty per page') ?></label>
        <?= $form->number('pageQty', $pageQty, array('min' => '1', 'step' => '1', 'placeholder' => t('Enter the amount of Testimonials'))); ?>
    </div>
</div>