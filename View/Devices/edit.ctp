<div class="devices form">
<?php echo $this->Form->create('Device'); ?>
	<fieldset>
		<legend><?php echo __('Edit Device'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Device.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Device.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Devices'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Watering Hours'), array('controller' => 'watering_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Watering Hour'), array('controller' => 'watering_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
