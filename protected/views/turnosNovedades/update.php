<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Turnos Novedades';
$this->breadcrumbs=array(
	'Turnos Novedades'=>array('index'),
	$model->turnov_id=>array('view','id'=>$model->turnov_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Novedades','url'=>array('index')),
	array('label'=>'Crear Turno Novedad','url'=>array('create'), 'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosNovedades']['Crear']),),
	array('label'=>'Ver Turnos Novedades','url'=>array('view','id'=>$model->turnov_id)),
	array('label'=>'Administrar Turnos Novedades','url'=>array('admin')),
);
?>

	<h1>Modificar novedad del <?php echo $model->turnovTur->tur_nombre; ?></h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>