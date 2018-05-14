<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_total_horas_semana')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cont_total_horas_semana),array('view','id'=>$data->cont_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_min_horas_dia')); ?>:</b>
	<?php echo CHtml::encode($data->cont_min_horas_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_max_horas_dia')); ?>:</b>
	<?php echo CHtml::encode($data->cont_max_horas_dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->cont_habilitado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->cont_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->cont_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->cont_modificadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cont_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->cont_fechamodificado); ?>
	<br />

	*/ ?>

</div>