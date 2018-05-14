<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('aseserv_ase_id')); ?>:</b>
	<?php echo CHtml::encode($data->aseservAse->ase_nombre . " " . $data->aseservAse->ase_apellidos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aseserv_serv_id')); ?>:</b>
	<?php echo CHtml::encode($data->aseservServ->serv_nombre . " (". $data->aseservServ->servProg->prog_nombre . " - ". $data->aseservServ->servProg->progCli->cli_nombre . ")"); ?>
	<br />


</div>