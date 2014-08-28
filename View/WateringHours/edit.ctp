<div class="wateringHours form">
<?php echo $this->Form->create('WateringHour'); ?>
	<fieldset>
		<legend><?php echo __('Edit Watering Hour'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('start');
		echo $this->Form->input('status');
		echo $this->Form->input('duration');
		echo $this->Form->input('device_id');
		echo $this->Form->input('repeat');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('WateringHour.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('WateringHour.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Watering Hours'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Devices'), array('controller' => 'devices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Device'), array('controller' => 'devices', 'action' => 'add')); ?> </li>
	</ul>
</div>
