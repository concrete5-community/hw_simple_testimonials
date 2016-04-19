<?php       defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<style>
i.item-select-list-sort:hover{cursor:move}
.ui-sortable-helper {display: table;}

</style>
       <?php       $confirmMsg = t('Are you sure?'); ?>
        <script type="text/javascript">
        deleteTestimonial = function() {
          if(confirm('<?php       echo $confirmMsg?>')){ 
                
           }   
     }
       </script>

	<div class="ccm-dashboard-header-buttons">
		<a href="<?php       echo View::url('/dashboard/hw_simple_testimonials/addtestimonials')?>" class="btn btn-primary"><?php       echo t("Add Testimonial")?></a>
    </div>

<table class="table table-striped sorted_table">
<thead>
		<tr>
			<th><?php       echo t('Author')?></th>
			<th><?php       echo t('Company')?></th>
			<th><?php       echo t('Testimonial')?></th>
			<th><?php       echo t('Optional Content')?></th>
			<th><?php       echo t('')?></td>
			<th><?php       echo t('')?></td>
			<th><?php       echo t('')?></td>
		</tr>
		</thead>
				<tbody>
	<?php           foreach ($testimonialslist as $tl) : ?>
			<?php      
				$testimonial = $tl->testimonial;
				if(strlen($testimonial) > 100) { $testimonial = substr($testimonial, 0, 100) . "...";}
			?>

		<tr id ="akID_<?php      echo($tl->sID)?>">
			<td><?php        echo $tl->author; ?></td>
			<td><?php        echo $tl->company; ?></td>
			<td><?php        echo $testimonial ?></td>
			<td><?php        echo $tl->extra; ?></td>
			<td>
				<a href="<?php          echo $view->action('addtestimonials', 'edit', $tl->sID)?>" class="fa fa-pencil-square-o fa-lg"></a>
				<a href="<?php          echo $view->action('delete_check', $tl->sID)?>" onclick="deleteTestimonial()" class="fa fa-trash fa-lg"></a>
			</td>
			<td><i class="fa fa-arrows-v item-select-list-sort"></i></td>
			<td style="visibility: hidden"><?php      echo $tl->sortorder; ?></td>
		</tr>
		
   <?php           endforeach; ?>
   </tbody>
</table>
		<?php        if ($paginator): ?>
			<?php        echo $pagination; ?>
		<?php        endif; ?>
		
	<script type="text/javascript">

$(document).ready(function(){
		$('tbody').sortable({
			handle: 'i.item-select-list-sort',
			 cursor: 'move',
            opacity: 0.5,
			stop: function( event, ui ){
         var ualist = $(this).sortable('serialize');
                $.post('<?php      echo URL::to('/hwsimpletestimonials/sortorder')?>', ualist, function(r) {});

    }
})
});

</script>





