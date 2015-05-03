<div class="wateringHours form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Watering Hour'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Watering Hours'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Devices'), array('controller' => 'devices', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Device'), array('controller' => 'devices', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('WateringHour', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('start', array('class' => 'form-control', 'placeholder' => 'Start'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('state', array('class' => 'form-control', 'placeholder' => 'State', 'type' => 'select', 'options' => $wateringHourStates));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('duration', array('class' => 'form-control', 'placeholder' => 'Duration'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('device_id', array('class' => 'form-control', 'placeholder' => 'Device Id','type'=> 'select','options'=>$selectableDevices));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('repeat', array('class' => 'form-control', 'placeholder' => 'Repeat','type' => 'select','options' => $repeat));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('time', array('class' => 'form-control', 'placeholder' => 'Time'));?>
				</div>
				<!--<div class="form-group">
					<?php echo $this->Form->input('parent_id', array('class' => 'form-control', 'placeholder' => 'Parent Id'));?>
				</div>-->
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
