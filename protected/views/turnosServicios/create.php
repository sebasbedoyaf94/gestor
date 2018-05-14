<?php
$this->pageTitle=Yii::app()->name . ' - Crear Turno Servicio';
$this->breadcrumbs=array(
	'Turnos Servicios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Turnos Servicios','url'=>array('index')),
	array('label'=>'Administrar Turnos Servicios','url'=>array('admin')),
);
?>

<h1>Crear Turno Servicio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>