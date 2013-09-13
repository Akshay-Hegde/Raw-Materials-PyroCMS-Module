<section class="title">
	<h4><?php echo lang('raw_materials:title.regions.index'); ?></h4>
</section>

<section class="item">
	<div class="content">
	
		<?php template_partial('filters') ?>
		
			<div id="filter-stage">
				<?php template_partial('admin/partials/table_regions') ?>
			</div>
	
		<?php echo form_close() ?>
	</div>
</section>
