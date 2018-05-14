<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tur_nombre')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tur_nombre),array('view','id'=>$data->tur_id)); ?>
	<br />

	<b>Lunes: </b>
	<?php echo CHtml::encode($data->tur_horaInicioLunes." a ".$data->tur_horaFinLunes); ?>
	<br />

	<b>Martes: </b>
	<?php echo CHtml::encode($data->tur_horaInicioMartes." a ".$data->tur_horaFinMartes); ?>
	<br />

	<b>Miercoles: </b>
	<?php echo CHtml::encode($data->tur_horaInicioMiercoles." a ".$data->tur_horaFinMiercoles); ?>
	<br />

	<b>Jueves: </b>
	<?php echo CHtml::encode($data->tur_horaInicioJueves." a ".$data->tur_horaFinJueves); ?>
	<br />

	<b>Viernes: </b>
	<?php echo CHtml::encode($data->tur_horaInicioViernes." a ".$data->tur_horaFinViernes); ?>
	<br />

	<b>Sabado: </b>
	<?php echo CHtml::encode($data->tur_horaInicioSabado." a ".$data->tur_horaFinSabado); ?>
	<br />

	<b>Domingo: </b>
	<?php echo CHtml::encode($data->tur_horaInicioDomingo." a ".$data->tur_horaFinDomingo); ?>
	<br />

	

</div>