<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->serv_nombre),array('view','id'=>$data->serv_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_prog_id')); ?>:</b>
	<?php echo CHtml::encode($data->servProg->prog_nombre." (".$data->servProg->progCli->cli_nombre.")"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->serv_descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_habilitado')); ?>:</b>
	<?php echo CHtml::encode($data->serv_habilitado); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioLunes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioLunes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinLunes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinLunes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioMartes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioMartes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinMartes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinMartes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioMiercoles')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioMiercoles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinMiercoles')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinMiercoles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioJueves')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioJueves); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinJueves')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinJueves); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioViernes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioViernes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinViernes')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinViernes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioSabado')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioSabado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinSabado')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinSabado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaInicioDomingo')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaInicioDomingo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_horaFinDomingo')); ?>:</b>
	<?php echo CHtml::encode($data->serv_horaFinDomingo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_fechacreado')); ?>:</b>
	<?php echo CHtml::encode($data->serv_fechacreado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_creadopor')); ?>:</b>
	<?php echo CHtml::encode($data->serv_creadopor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_fechamodificado')); ?>:</b>
	<?php echo CHtml::encode($data->serv_fechamodificado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serv_modificadopor')); ?>:</b>
	<?php echo CHtml::encode($data->serv_modificadopor); ?>
	<br />

	*/ ?>

</div>