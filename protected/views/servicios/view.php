<?php
$this->pageTitle=Yii::app()->name . ' - Ver Servicios';
$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->serv_nombre." (".$model->servProg->prog_nombre." ".$model->servProg->progCli->cli_nombre.")",
);

$this->menu=array(
	array('label'=>'Listar Servicios','url'=>array('index')),
	array('label'=>'Crear Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Servicios']['Crear'])),
	array('label'=>'Modificar Servicio','url'=>array('update','id'=>$model->serv_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Servicios']['Modificar'])),
	array('label'=>'Administrar Servicios','url'=>array('admin')),
);
?>

<h1>Servicio <?php echo $model->serv_nombre." (".$model->servProg->prog_nombre." ".$model->servProg->progCli->cli_nombre.")"; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Servicio</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'serv_prog_id',
			        'value'=>$model->servProg->prog_nombre." (".$model->servProg->progCli->cli_nombre.")",
			    ),
				'serv_nombre',
				'serv_descripcion',
				array(
			        'name'=>'LUNES',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioLunes.'</b> hasta las <b>'.$model->serv_horaFinLunes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'MARTES',			        
			        'value'=>'Desde las <b>'.$model->serv_horaInicioMartes.'</b> hasta las <b>'.$model->serv_horaFinMartes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'MIERCOLES',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioMiercoles.'</b> hasta las <b>'.$model->serv_horaFinMiercoles.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'JUEVES',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioJueves.'</b> hasta las <b>'.$model->serv_horaFinJueves.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'VIERNES',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioViernes.'</b> hasta las <b>'.$model->serv_horaFinViernes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'SABADO',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioSabado.'</b> hasta las <b>'.$model->serv_horaFinSabado.'</b>',
			        'type'=>'raw',
			    ),
				array(
			        'name'=>'DOMINGO',
			        'value'=>'Desde las <b>'.$model->serv_horaInicioDomingo.'</b> hasta las <b>'.$model->serv_horaFinDomingo.'</b>',
			        'type'=>'raw',
			    ),
				'serv_habilitado',
				'serv_fechacreado',
				array(
			        'name'=>'serv_creadopor',
			        'value'=>$model->servCreadopor->usua_usuariored,
			    ),
				'serv_fechamodificado',
				array(
			        'name'=>'serv_modificadopor',
			        'value'=>$model->servModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
