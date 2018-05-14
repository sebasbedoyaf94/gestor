<?php
$this->pageTitle=Yii::app()->name . ' - Crear Turnos Asesores';
$this->breadcrumbs=array(
	'Turnos Asesores'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Turnos Asesores','url'=>array('index')),
	array('label'=>'Administrar Turnos Asesores','url'=>array('admin')),
);
?>

<h1>Asignación de turnos</h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'modelAsesores'=>$modelAsesores,
	'modelServicios'=>$modelServicios,
	'modelTurnoServicio'=>$modelTurnoServicio,
	'modelAsesorServicio'=>$modelAsesorServicio,
)); ?>