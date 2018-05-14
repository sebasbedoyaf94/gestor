<?php
/* @var $this ProyectosController */
/* @var $data Proyectos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->proy_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_cli_id')); ?>:</b>
	<?php echo CHtml::encode($data->proyCli->cli_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->proy_fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_fechaFin')); ?>:</b>
	<?php echo CHtml::encode($data->proy_fechaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->proyCreadopor->usua_usuariored); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->proy_fechacreado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->proy_modificadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proy_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->proy_fechamodificado); ?>
	<br />

	*/ ?>

</div>