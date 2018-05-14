<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prog_nombre),array('view','id'=>$data->prog_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_cli_id')); ?>:</b>
	<?php echo CHtml::encode($data->progCli->cli_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->prog_habilitado); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->prog_descripcion); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->prog_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->prog_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->prog_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prog_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->prog_modificadopor); ?>
	<br />

	*/ ?>

</div>