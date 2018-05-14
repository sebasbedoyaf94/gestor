<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_tur_id')); ?>:</b>
	<?php echo CHtml::encode($data->turaseTur->tur_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_aseserv_id')); ?>:</b>
	<?php echo CHtml::encode($data->turaseAse->ase_nombre . " " . $data->turaseAse->ase_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->turase_fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_fechaFin')); ?>:</b>
	<?php echo CHtml::encode($data->turase_fechaFin); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->turase_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->turase_creadopor); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->turase_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turase_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->turase_modificadopor); ?>
	<br />

	*/ ?>

</div>