<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->novtur_id),array('view','id'=>$data->novtur_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_tur_id')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_tur_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_nov_id')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_nov_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_fecha')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_horaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_horaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_horaFin')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_horaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_observaciones); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novtur_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->novtur_modificadopor); ?>
	<br />

	*/ ?>

</div>