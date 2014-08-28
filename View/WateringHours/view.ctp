<div class="wateringHours view">
<h2><?php echo __('Watering Hour'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Device'); ?></dt>
		<dd>
			<?php echo $this->Html->link($wateringHour['Device']['name'], array('controller' => 'devices', 'action' => 'view', $wateringHour['Device']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Repeat'); ?></dt>
		<dd>
			<?php echo h($wateringHour['WateringHour']['repeat']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Watering Hour'), array('action' => 'edit', $wateringHour['WateringHour']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Watering Hour'), array('action' => 'delete', $wateringHour['WateringHour']['id']), array(), __('Are you sure you want to delete # %s?', $wateringHour['WateringHour']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Watering Hours'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Watering Hour'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Devices'), array('controller' => 'devices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('controller' => 'devices', 'action' => 'add')); ?> </li>
	</ul>
</div>
