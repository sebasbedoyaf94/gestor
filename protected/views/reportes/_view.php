<?php
/* @var $this ReportesController */
/* @var $data Reportes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rep_id), array('view', 'id'=>$data->rep_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->rep_fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_fechaFin')); ?>:</b>
	<?php echo CHtml::encode($data->rep_fechaFin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_fase')); ?>:</b>
	<?php echo CHtml::encode($data->rep_fase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_proy_id')); ?>:</b>
	<?php echo CHtml::encode($data->rep_proy_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rep_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->rep_tipo); ?>
	<br />


</div>