<?php          defined('C5_EXECUTE') or die("Access Denied."); ?>
<style>
.hwTestimonial .redactor-editor {
	min-height: 150px;
}
.hwExtra .redactor-editor {
	min-height: 50px;
}
</style>
<?php        
	$fp = FilePermissions::getGlobal();
	$tp = new TaskPermission();
  
	$ih = Loader::helper('concrete/ui'); 
	$action = $view->action('add_testimonials');
	$PageTitle = t('New Testimonials');
	$button = t('Add');
	
	if ($controller->getTask() == 'edit') {
		$action = $view->action('edit_testimonials', $testimonial);
		$PageTitle = t('Edit Testimonials');
		$button = t('Update');
	}
?>

    <form method="post" class="form-horizontal" action="<?php       echo $action?>">
		<fieldset>
    		<legend><?php       echo($PageTitle); ?></legend>
			
			<div class="row">
				<div class="form-group">
					<label for="hwAuthor" class="control-label col-sm-3"><?php       echo t('Author')?></label>
					<div class="col-md-5">
						<?php       echo $form->text('hwAuthor', $hwAuthor)?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="hwCompany" class="control-label col-sm-3"><?php       echo t('Company')?></label>
						<div class="col-md-5">
						<?php       echo $form->text('hwCompany', $hwCompany)?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="hwTestimonial" class="control-label col-sm-3"><?php       echo t('Testimonial')?></label>
					<div class="col-md-5 hwTestimonial">
						<?php       echo $form->textarea('hwTestimonial', $hwTestimonial, array('rows' => 10))?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label for="hwExtra" class="control-label col-sm-3"><?php       echo t('Optional Content')?></label>
					<div class="col-md-5 hwExtra">
						<?php       echo $form->textarea('hwExtra', $hwExtra)?>
						<script type="text/javascript">
                            $(function(){
                                $('#hwExtra').redactor({
                                    minHeight: '200',
                                    'concrete5': {
                                        filemanager: <?php     echo $fp->canAccessFileManager()?>,
                                        sitemap: <?php     echo $tp->canAccessSitemap()?>,
                                        lightbox: true
                                    }
                                });
                            });
                        </script>
					</div>
				</div>
			</div>
			
    	</fieldset>

	<?php       echo $token->output('submit');?>

	<div class="ccm-dashboard-form-actions-wrapper">
	<div class="ccm-dashboard-form-actions">
		<a href="<?php       echo View::url('/dashboard/hw_simple_testimonials')?>" class="btn btn-default pull-left"><?php       echo t('Cancel')?></a>
		<?php       echo Loader::helper("form")->submit($button, $button, array('class' => 'btn btn-primary pull-right'))?>
	</div>
	</div>
    </form>