<?php
$this->pageTitle=Yii::app()->name . ' - Crear Contrato';
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Contratos','url'=>array('index')),
	array('label'=>'Administrar Contratos','url'=>array('admin')),
);
?>

<h1>Crear Contrato</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>