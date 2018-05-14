<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Novedades';
$this->breadcrumbs=array(
	'Novedades'=>array('index'),
	$model->nov_nombre=>array('view','id'=>$model->nov_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Novedades','url'=>array('index')),
	array('label'=>'Crear Novedad','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Novedades']['Crear'])),
	array('label'=>'Ver Novedad','url'=>array('view','id'=>$model->nov_id)),
	array('label'=>'Administrar Novedades','url'=>array('admin')),
);
?>

	<h1>Modificar Novedad <?php echo $model->nov_nombre; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>