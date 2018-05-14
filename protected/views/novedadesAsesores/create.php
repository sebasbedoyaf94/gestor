<?php
$this->pageTitle=Yii::app()->name . ' - Crear Novedades Asesores';
$this->breadcrumbs=array(
	'Novedades Asesores'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Novedades Asesores','url'=>array('index')),
	array('label'=>'Administrar Novedades Asesores','url'=>array('admin')),
);
?>

<h1>Crear Novedad Asesor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>