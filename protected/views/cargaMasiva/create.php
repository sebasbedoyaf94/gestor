<?php
$this->pageTitle=Yii::app()->name . ' - Crear Carga Masiva';
$this->breadcrumbs=array(
	'Carga Masiva'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar CargaMasiva','url'=>array('index')),
	array('label'=>'Administrar CargaMasiva','url'=>array('admin')),
);
?>

<h1>Crear CargaMasiva</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>