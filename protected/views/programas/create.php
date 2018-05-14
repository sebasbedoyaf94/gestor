<?php
$this->pageTitle=Yii::app()->name . ' - Crear Programa';
$this->breadcrumbs=array(
	'Programas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Programas','url'=>array('index')),
	array('label'=>'Administrar Programas','url'=>array('admin')),
);
?>

<h1>Crear Programa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>