<div class="devices form">
<?php echo $this->Form->create('Device'); ?>
	<fieldset>
		<legend><?php echo __('Add Device'); ?></legend>
	<?php
		echo $this->Form->input('bcm_number');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('visibility');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Devices'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Watering Hours'), array('controller' => 'watering_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
