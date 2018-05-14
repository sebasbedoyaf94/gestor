<div class="view">


	<b><?php echo CHtml::encode($data->getAttributeLabel('turserv_tur_id')); ?>:</b>
	<?php echo CHtml::encode($data->turservTur->tur_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turserv_serv_id')); ?>:</b>
	<?php echo CHtml::encode($data->turservServ->serv_nombre . " (" . $data->turservServ->servProg->prog_nombre . " - " . $data->turservServ->servProg->progCli->cli_nombre . ")"); ?>
	<br />


</div>