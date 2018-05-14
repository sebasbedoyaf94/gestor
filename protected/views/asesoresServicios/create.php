<?php
$this->pageTitle=Yii::app()->name . ' - Crear Asesores Servicios';
$this->breadcrumbs=array(
	'Asesores Servicios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Asesores Servicios','url'=>array('index')),
	array('label'=>'Administrar Asesores Servicios','url'=>array('admin')),
);
?>

<h1>Crear Asesor Servicio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>