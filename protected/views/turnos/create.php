<?php
$this->pageTitle=Yii::app()->name . ' - Crear Turno';
$this->breadcrumbs=array(
	'Turnos'=>array('index'),
	'Cargar',
);

$this->menu=array(
	array('label'=>'Listar Turnos','url'=>array('index')),
	array('label'=>'Administrar Turnos','url'=>array('admin')),
);
?>

<h1>Carga Masiva Turnos</h1>

<?php echo $this->renderPartial('_form3', array('model'=>$model,'modelTurnosNovedades'=>$modelTurnosNovedades)); ?>