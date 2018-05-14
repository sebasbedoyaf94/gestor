<?php
$this->pageTitle=Yii::app()->name . ' - Ver Turnos Servicios';
$this->breadcrumbs=array(
	'Turnos Servicios'=>array('index'),
	$model->turservServ->serv_nombre,
);

$this->menu=array(
array('label'=>'Listar Turnos Servicios','url'=>array('index')),
array('label'=>'Crear Turno Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosServicios']['Crear']),),
array('label'=>'Modificar Turnos Servicios','url'=>array('update','id'=>$model->turserv_id),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosServicios']['Modificar'])),
array('label'=>'Administrar Turnos Servicios','url'=>array('admin')),
);
?>

<h1>Información</h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Turno</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'Nombre',
			        'value'=>$model->turservTur->tur_nombre,
			    ),
			    array(
			    	'name'=>'Lunes',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioLunes.'</b> hasta las <b>'.$model->turservTur->tur_horaFinLunes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Martes',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioMartes.'</b> hasta las <b>'.$model->turservTur->tur_horaFinMartes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Miercoles',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioMiercoles.'</b> hasta las <b>'.$model->turservTur->tur_horaFinMiercoles.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Jueves',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioJueves.'</b> hasta las <b>'.$model->turservTur->tur_horaFinJueves.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Viernes',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioViernes.'</b> hasta las <b>'.$model->turservTur->tur_horaFinViernes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Sabado',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioSabado.'</b> hasta las <b>'.$model->turservTur->tur_horaFinSabado.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Domingo',
			    	'value'=>'Desde las <b>'.$model->turservTur->tur_horaInicioDomingo.'</b> hasta las <b>'.$model->turservTur->tur_horaFinDomingo.'</b>',
			    	'type'=>'raw',
			    ),
			),
		)); ?>
	</div>
	
	<div class="col-xs-12">
		<h3 class='subtitulo'>Servicio</h3>
	</div>
	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'Nombre',
			        'value'=>$model->turservServ->serv_nombre . " (" . $model->turservServ->servProg->prog_nombre . " - " . $model->turservServ->servProg->progCli->cli_nombre . ")",
			    ),
			    array(
			    	'name'=>'Lunes',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioLunes.'</b> hasta las <b>'.$model->turservServ->serv_horaFinLunes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Martes',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioMartes.'</b> hasta las <b>'.$model->turservServ->serv_horaFinMartes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Miercoles',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioMiercoles.'</b> hasta las <b>'.$model->turservServ->serv_horaFinMiercoles.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Jueves',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioJueves.'</b> hasta las <b>'.$model->turservServ->serv_horaFinJueves.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Viernes',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioViernes.'</b> hasta las <b>'.$model->turservServ->serv_horaFinViernes.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Sabado',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioSabado.'</b> hasta las <b>'.$model->turservServ->serv_horaFinSabado.'</b>',
			    	'type'=>'raw',
			    ),
			    array(
			    	'name'=>'Domingo',
			    	'value'=>'Desde las <b>'.$model->turservServ->serv_horaInicioDomingo.'</b> hasta las <b>'.$model->turservServ->serv_horaFinDomingo.'</b>',
			    	'type'=>'raw',
			    ),
			),
		)); ?>
	</div>
</div>
