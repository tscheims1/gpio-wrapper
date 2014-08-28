<div class="devices view">
<h2><?php echo __('Device'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($device['Device']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bcm Number'); ?></dt>
		<dd>
			<?php echo h($device['Device']['bcm_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($device['Device']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($device['Device']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Device'), array('action' => 'edit', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Device'), array('action' => 'delete', $device['Device']['id']), array(), __('Are you sure you want to delete # %s?', $device['Device']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Watering Hours'), array('controller' => 'watering_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Watering Hours'); ?></h3>
	<?php if (!empty($device['WateringHour'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Duration'); ?></th>
		<th><?php echo __('Device Id'); ?></th>
		<th><?php echo __('Repeat'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($device['WateringHour'] as $wateringHour): ?>
		<tr>
			<td><?php echo $wateringHour['id']; ?></td>
			<td><?php echo $wateringHour['start']; ?></td>
			<td><?php echo $wateringHour['status']; ?></td>
			<td><?php echo $wateringHour['duration']; ?></td>
			<td><?php echo $wateringHour['device_id']; ?></td>
			<td><?php echo $wateringHour['repeat']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'watering_hours', 'action' => 'view', $wateringHour['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'watering_hours', 'action' => 'edit', $wateringHour['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'watering_hours', 'action' => 'delete', $wateringHour['id']), array(), __('Are you sure you want to delete # %s?', $wateringHour['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
