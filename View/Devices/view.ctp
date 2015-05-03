<div class="devices view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Device'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Device'), array('action' => 'edit', $device['Device']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Device'), array('action' => 'delete', $device['Device']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Devices'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Device'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Watering Hours'), array('controller' => 'watering_hours', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($device['Device']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bcm Number'); ?></th>
		<td>
			<?php echo h($device['Device']['bcm_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($device['Device']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Description'); ?></th>
		<td>
			<?php echo h($device['Device']['description']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Visibility'); ?></th>
		<td>
			<?php echo h($device['Device']['visibility']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Device State'); ?></th>
		<td>
			<?php echo h($device['Device']['device_state']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Watering Hours'); ?></h3>
	<?php if (!empty($device['WateringHour'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th><?php echo __('Device Id'); ?></th>
		<th><?php echo __('Repeat'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($device['WateringHour'] as $wateringHour): ?>
		<tr>
			<td><?php echo $wateringHour['id']; ?></td>
			<td><?php echo $wateringHour['start']; ?></td>
			<td><?php echo $wateringHour['state']; ?></td>
			<td><?php echo $wateringHour['duration']; ?></td>
			<td><?php echo $wateringHour['device_id']; ?></td>
			<td><?php echo $wateringHour['repeat']; ?></td>
			<td><?php echo $wateringHour['time']; ?></td>
			<td><?php echo $wateringHour['parent_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'watering_hours', 'action' => 'view', $wateringHour['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'watering_hours', 'action' => 'edit', $wateringHour['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'watering_hours', 'action' => 'delete', $wateringHour['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $wateringHour['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
