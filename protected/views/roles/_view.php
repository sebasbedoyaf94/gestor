<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rol_nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rol_nombre),array('view','id'=>$data->rol_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rol_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->rol_habilitado); ?>
	<br />

</div>