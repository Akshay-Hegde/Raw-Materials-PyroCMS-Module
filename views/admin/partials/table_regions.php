<?php if (!empty($regions)): ?>
	<table border="0" class="table-list" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Name</th>
				<th>Parent</th>
				<th>Country</th>
				<th>Status</th>
				<th width="200"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="8">
					<div class="inner"><?php $this->load->view('admin/partials/pagination') ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($regions as $r): ?>
				<tr>
					<td>
						<?php echo $r->name ?>
					</td>
					<td>
						<?php echo $r->parent ?>
					</td>
					<td>
						<?php echo $r->country ?>
					</td>
					<td>
						<?php echo $r->status ?>
					</td>
					<td class="actions">
						<?php echo anchor('admin/raw_materials/regions/form/' . $r->id, lang('global:edit'), array('class'=>'button edit')) ?>
						<?php echo anchor('admin/raw_materials/regions/form/' . $r->id, lang('global:delete'), array('class'=>'confirm button delete')) ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php endif ?>