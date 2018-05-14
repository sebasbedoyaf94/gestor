<?php
$this->pageTitle=Yii::app()->name . ' - Crear Turnos Novedades';
$this->breadcrumbs=array(
	'Turnos Novedades'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Turnos Novedades','url'=>array('index')),
	array('label'=>'Administrar Turnos Novedades','url'=>array('admin')),
);
?>

<h1>Crear Turno Novedad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>