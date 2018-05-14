<?php
$this->pageTitle=Yii::app()->name . ' - Ver Carga Masiva';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	$model->tur_nombre,
);

$this->menu=array(
array('label'=>'Listar CargaMasiva','url'=>array('index')),
array('label'=>'Crear CargaMasiva','url'=>array('create')),
array('label'=>'Modificar CargaMasiva','url'=>array('update','id'=>$model->tur_id)),
array('label'=>'Eliminar CargaMasiva','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->tur_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar CargaMasiva','url'=>array('admin')),
);
?>

<h1>Ver <?php echo $model->tur_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Turno</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				/*array(
			        'name'=>'serv_prog_id',
			        'value'=>$model->servProg->prog_nombre." (".$model->servProg->progCli->cli_nombre.")",
			    ),
				'serv_nombre',
				'serv_descripcion',*/
				array(
			        'name'=>'LUNES',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioLunes.'</b> hasta las <b>'.$model->tur_horaFinLunes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'MARTES',			        
			        'value'=>'Desde las <b>'.$model->tur_horaInicioMartes.'</b> hasta las <b>'.$model->tur_horaFinMartes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'MIERCOLES',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioMiercoles.'</b> hasta las <b>'.$model->tur_horaFinMiercoles.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'JUEVES',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioJueves.'</b> hasta las <b>'.$model->tur_horaFinJueves.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'VIERNES',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioViernes.'</b> hasta las <b>'.$model->tur_horaFinViernes.'</b>',
			        'type'=>'raw',
			    ),
				array(
					'name'=>'SABADO',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioSabado.'</b> hasta las <b>'.$model->tur_horaFinSabado.'</b>',
			        'type'=>'raw',
			    ),
				array(
			        'name'=>'DOMINGO',
			        'value'=>'Desde las <b>'.$model->tur_horaInicioDomingo.'</b> hasta las <b>'.$model->tur_horaFinDomingo.'</b>',
			        'type'=>'raw',
			    ),
				'tur_habilitado',
				'tur_fechacreado',
				array(
			        'name'=>'tur_creadopor',
			        'value'=>$model->turCreadopor->usua_usuariored,
			    ),
				'tur_fechamodificado',
				array(
			        'name'=>'tur_modificadopor',
			        'value'=>$model->turCreadopor->usua_usuariored,
			    ),
			    array(
			    	'name'=>'SERVICIOS',
			    	'value'=>$model_servicios->serv_nombre,
			    ),
			    array(
			    	'name'=>'NOVEDADES',
			    	//'value'=>$model->turnosNovedades->turnovNov->nov_nombre,
			    ),
			),
		)); ?>
	</div>
</div>
