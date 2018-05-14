<?php
$this->pageTitle=Yii::app()->name . ' - Ver Novedades Turnos';
$this->breadcrumbs=array(
	'Novedades Turnos'=>array('index'),
	$model->novtur_id,
);

$this->menu=array(
array('label'=>'Listar NovedadesTurnos','url'=>array('index')),
array('label'=>'Crear NovedadesTurnos','url'=>array('create')),
array('label'=>'Modificar NovedadesTurnos','url'=>array('update','id'=>$model->novtur_id)),
array('label'=>'Eliminar NovedadesTurnos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->novtur_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Administrar NovedadesTurnos','url'=>array('admin')),
);
?>

<h1>Ver NovedadesTurnos <?php echo $model->novtur_id; ?></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del NovedadesTurnos</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
							'novtur_id',
				'novtur_tur_id',
				'novtur_nov_id',
				'novtur_fecha',
				'novtur_horaInicio',
				'novtur_horaFin',
				'novtur_observaciones',
				'novtur_fechacreado',
				'novtur_creadopor',
				'novtur_fechamodificado',
				'novtur_modificadopor',
			),
		)); ?>
	</div>
</div>
