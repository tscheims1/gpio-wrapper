<div class="wateringHours index">
	<h2><?php echo __('Watering Hours'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('start'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th><?php echo $this->Paginator->sort('device_id'); ?></th>
			<th><?php echo $this->Paginator->sort('repeat'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($wateringHours as $wateringHour): ?>
	<tr>
		<td><?php echo h($wateringHour['WateringHour']['id']); ?>&nbsp;</td>
		<td><?php echo h($wateringHour['WateringHour']['start']); ?>&nbsp;</td>
		<td><?php echo h($wateringHour['WateringHour']['state']); ?>&nbsp;</td>
		<td><?php echo h($wateringHour['WateringHour']['duration']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($wateringHour['Device']['name'], array('controller' => 'devices', 'action' => 'view', $wateringHour['Device']['id'])); ?>
		</td>
		<td><?php echo h($wateringHour['WateringHour']['repeat']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view','controller' => 'watering_hours', $wateringHour['WateringHour']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit','controller' => 'watering_hours', $wateringHour['WateringHour']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $wateringHour['WateringHour']['id']), array(), __('Are you sure you want to delete # %s?', $wateringHour['WateringHour']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Watering Hour'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Devices'), array('controller' => 'devices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('controller' => 'devices', 'action' => 'add')); ?> </li>
	</ul>
</div>
