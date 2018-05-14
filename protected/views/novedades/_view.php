<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nov_nombre),array('view','id'=>$data->nov_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_abreviatura')); ?>:</b>
	<?php echo CHtml::encode($data->nov_abreviatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->nov_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_paga')); ?>:</b>
	<?php echo CHtml::encode($data->nov_paga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->nov_habilitado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->nov_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->nov_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->nov_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nov_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->nov_modificadopor); ?>
	<br />

	*/ ?>

</div>