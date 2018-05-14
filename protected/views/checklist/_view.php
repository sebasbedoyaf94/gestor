<?php
/* @var $this ChecklistController */
/* @var $data Checklist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->check_id), array('view', 'id'=>$data->check_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_proy_id')); ?>:</b>
	<?php echo CHtml::encode($data->check_proy_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_url_pruebas')); ?>:</b>
	<?php echo CHtml::encode($data->check_url_pruebas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_ruta_doc_funcional')); ?>:</b>
	<?php echo CHtml::encode($data->check_ruta_doc_funcional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_ruta_doc_tecnica')); ?>:</b>
	<?php echo CHtml::encode($data->check_ruta_doc_tecnica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->check_observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_usuario_pruebas')); ?>:</b>
	<?php echo CHtml::encode($data->check_usuario_pruebas); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('check_contrasena_pruebas')); ?>:</b>
	<?php echo CHtml::encode($data->check_contrasena_pruebas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->check_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->check_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->check_modificadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('check_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->check_fechamodificado); ?>
	<br />

	*/ ?>

</div>