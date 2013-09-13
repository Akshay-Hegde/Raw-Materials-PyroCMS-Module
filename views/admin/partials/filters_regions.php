<fieldset id="filters">

	<legend><?php echo lang('global:filters') ?></legend>
	
	<?php echo form_open('') ?>
	<?php echo form_hidden('f_module', $module_details['slug']) ?>
		<ul>
			<li>
				Status
				<?php echo form_dropdown('f_status', array(0 => lang('global:select-all'), 1 => 'Active', 2 => 'Hiring', 3 => 'Coming', 4 => 'Inactive' ), array(0)) ?>
			</li>
			<li>
				Parent
				<?php echo form_dropdown('f_parent', $f_parent_opts, array(0)) ?>
			</li>
			<li><?php echo anchor(current_url(), lang('buttons:cancel'), 'class="cancel"') ?></li>
		</ul>
	<?php echo form_close() ?>
</fieldset>