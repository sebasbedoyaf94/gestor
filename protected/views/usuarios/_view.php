<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('usua_nombre').' y '.$data->getAttributeLabel('usua_apellidos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->usua_nombre.' '.$data->usua_apellidos),array('view','id'=>$data->usua_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_cedula')); ?>:</b>
	<?php echo CHtml::encode($data->usua_cedula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_celular')); ?>:</b>
	<?php echo CHtml::encode($data->usua_celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_correo')); ?>:</b>
	<?php echo CHtml::encode($data->usua_correo); ?>
	<br />
 
	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_usuariored')); ?>:</b>
	<?php echo CHtml::encode($data->usua_usuariored); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_rol_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuaRol->rol_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->usua_habilitado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->usua_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->usua_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->usua_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usua_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->usua_modificadopor); ?>
	<br />

	*/ ?>

</div>