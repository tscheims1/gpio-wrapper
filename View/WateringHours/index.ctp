<div class="wateringHours index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Watering Hours'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Watering Hour'), array('controller' => 'watering_hours','action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Devices'), array('controller' => 'devices', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Device'), array('controller' => 'devices', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php ;//echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('start'); ?></th>
						<th><?php echo $this->Paginator->sort('state'); ?></th>
						<th><?php echo $this->Paginator->sort('duration'); ?></th>
						<th><?php echo $this->Paginator->sort('device_id'); ?></th>
						<th><?php echo $this->Paginator->sort('repeat'); ?></th>
						<th><?php echo $this->Paginator->sort('time'); ?></th>
						<th><?php ;//echo $this->Paginator->sort('parent_id'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($wateringHours as $wateringHour): ?>
					<tr>
						<td><?php ;//echo h($wateringHour['WateringHour']['id']); ?>&nbsp;</td>
						<td><?php echo h($wateringHour['WateringHour']['start']); ?>&nbsp;</td>
						<td><?php echo h($wateringHour['WateringHour']['state']); ?>&nbsp;</td>
						<td><?php echo h($wateringHour['WateringHour']['duration']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($wateringHour['Device']['name'], array('controller' => 'devices', 'action' => 'view', $wateringHour['Device']['id'])); ?>
		</td>
						<td><?php echo h($wateringHour['WateringHour']['repeat']); ?>&nbsp;</td>
						<td><?php echo h($wateringHour['WateringHour']['time']); ?>&nbsp;</td>
						<td><?php ;//echo h($wateringHour['WateringHour']['parent_id']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('controller' => 'watering_hours','action' => 'view', $wateringHour['WateringHour']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('controller' => 'watering_hours','action' => 'edit', $wateringHour['WateringHour']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'watering_hours','action' => 'delete', $wateringHour['WateringHour']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $wateringHour['WateringHour']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				
			</table>
			<div>
				<strong>Manuell</strong>
				<table>
				<tr>
					<td>Pin Nummer</td>
					<td>Name</td>
					<td>Status</td>
					<td></td>
				</tr>
				<?php foreach($devices as $device):?>
				<tr>
					<td><?= $device['Device']['bcm_number'];?></td>
					<td><?= $device['Device']['name'];?></td>
					<td><?= $device['Device']['device_state'];?></td>
					<td><?=$this->Html->link(__('enable',true),array('controller'=>'devices','action' =>'enable','id'=>$device['Device']['id']));?></td>
					<td><?=$this->Html->link(__('disable',true),array('controller'=>'devices','action' => 'disable','id'=>$device['Device']['id']));?></td>

				</tr>	
				<?php endforeach;?>	
				</table>
			</div>
			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->
	

</div><!-- end containing of content -->