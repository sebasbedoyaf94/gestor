<?php
$this->pageTitle=Yii::app()->name . ' - Ver Turnos Novedades';
$this->breadcrumbs=array(
	'Turnos Novedades'=>array('index'),
	$model->turnovTur->tur_nombre,
);

$this->menu=array(
array('label'=>'Listar Turnos Novedades','url'=>array('index')),
array('label'=>'Crear Turno Novedad','url'=>array('create'), 'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosNovedades']['Crear']),),
array('label'=>'Modificar Turnos Novedades','url'=>array('update','id'=>$model->turnov_id)),
array('label'=>'Administrar Turnos Novedades','url'=>array('admin')),
);
?>

<h1>Ver novedad del <?php echo $model->turnovTur->tur_nombre; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información de la novedad</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				array(
			        'name'=>'turnov_tur_id',
			        'value'=>$model->turnovTur->tur_nombre,
			    ),
				array(
					'name'=>'turnov_nov_id',
					'value'=>$model->turnovNov->nov_nombre,
				),
				'turnov_dia',
				'turnov_horaInicio',
				'turnov_horaFin',
				'tunov_fecha',
			),
		)); ?>
	</div>
</div>
