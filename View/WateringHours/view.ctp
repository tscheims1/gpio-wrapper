<div class="wateringHours view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Watering Hour'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Watering Hour'), array('action' => 'edit', $wateringHour['WateringHour']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Watering Hour'), array('action' => 'delete', $wateringHour['WateringHour']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $wateringHour['WateringHour']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Watering Hours'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Watering Hour'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Devices'), array('controller' => 'devices', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Device'), array('controller' => 'devices', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Start'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['start']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('State'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['state']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Duration'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['duration']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Device'); ?></th>
		<td>
			<?php echo $this->Html->link($wateringHour['Device']['name'], array('controller' => 'devices', 'action' => 'view', $wateringHour['Device']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Repeat'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['repeat']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Time'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['time']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Parent Id'); ?></th>
		<td>
			<?php echo h($wateringHour['WateringHour']['parent_id']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

