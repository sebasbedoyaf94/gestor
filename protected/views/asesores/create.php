<?php
$this->pageTitle=Yii::app()->name . ' - Crear Asesor';
$this->breadcrumbs=array(
	'Asesores'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Asesores','url'=>array('index')),
	array('label'=>'Administrar Asesores','url'=>array('admin')),
);
?>

<h1>Crear Asesor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>