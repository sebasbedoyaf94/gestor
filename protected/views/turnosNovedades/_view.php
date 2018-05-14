<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('turnov_tur_id')); ?>:</b>
	<?php echo CHtml::encode($data->turnovTur->tur_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turnov_nov_id')); ?>:</b>
	<?php echo CHtml::encode($data->turnovNov->nov_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turnov_dia')); ?>:</b>
	<?php echo CHtml::encode($data->turnov_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turnov_horaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->turnov_horaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turnov_horaFin')); ?>:</b>
	<?php echo CHtml::encode($data->turnov_horaFin); ?>
	<br />


</div>