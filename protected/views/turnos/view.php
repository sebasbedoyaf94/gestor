<?php
$this->pageTitle=Yii::app()->name . ' - Ver Turnos';
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	$model->tur_nombre,
);

$this->menu=array(
array('label'=>'Listar Turnos','url'=>array('index')),
array('label'=>'Modificar Turno','url'=>array('update','id'=>$model->tur_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Turnos']['Modificar'])),
array('label'=>'Administrar Turnos','url'=>array('admin')),
);
?>

<h1>Turno <?php echo $model->tur_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Turno</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				'tur_nombre',
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
			        'value'=>$model->turModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>

</div>
