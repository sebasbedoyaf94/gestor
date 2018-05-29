<?php
/* @var $this UsuariosProyectosController */
/* @var $data UsuariosProyectos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuaproy_usua_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuaproyUsua->usua_nombre ." ". $data->usuaproyUsua->usua_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuaproy_proy_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuaproyProy->proy_nombre . " (" . $data->usuaproyProy->proyCli->cli_nombre . ")"); ?>
	<br />


</div>