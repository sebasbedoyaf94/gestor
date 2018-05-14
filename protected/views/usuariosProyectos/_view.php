<?php
/* @var $this UsuariosProyectosController */
/* @var $data UsuariosProyectos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuaproy_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usuaproy_id), array('view', 'id'=>$data->usuaproy_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuaproy_usua_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuaproy_usua_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuaproy_proy_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuaproy_proy_id); ?>
	<br />


</div>