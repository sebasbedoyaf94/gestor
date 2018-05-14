<?php
/* @var $this CargaController */
/* @var $data Carga */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->carga_id), array('view', 'id'=>$data->carga_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_nombre_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->carga_nombre_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_ruta_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->carga_ruta_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_proy_id')); ?>:</b>
	<?php echo CHtml::encode($data->carga_proy_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_fase')); ?>:</b>
	<?php echo CHtml::encode($data->carga_fase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->carga_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->carga_creadopor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->carga_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->carga_modificadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->carga_fechamodificado); ?>
	<br />

	*/ ?>

</div>