<?php
$this->pageTitle=Yii::app()->name . ' - Crear Usuario';
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Usuarios','url'=>array('index')),
	array('label'=>'Administrar Usuarios','url'=>array('admin')),
);
?>

<h1>Crear Usuario</h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
)); ?>