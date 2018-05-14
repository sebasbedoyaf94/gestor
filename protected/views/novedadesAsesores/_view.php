<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_ase_id')); ?>:</b>
	<?php echo CHtml::encode($data->novaseAse->ase_nombre . " " . $data->novaseAse->ase_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_nov_id')); ?>:</b>
	<?php echo CHtml::encode($data->novaseNov->nov_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->novase_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_horaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->novase_horaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_horaFin')); ?>:</b>
	<?php echo CHtml::encode($data->novase_horaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->novase_observaciones); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->novase_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->novase_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->novase_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novase_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->novase_modificadopor); ?>
	<br />

	*/ ?>

</div>