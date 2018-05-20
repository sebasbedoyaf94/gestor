<?php
/* @var $this CargaController */
/* @var $model Carga */

$this->breadcrumbs=array(
	'Cargas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Cargas', 'url'=>array('index')),
	array('label'=>'Administrar Cargas', 'url'=>array('admin')),
);
?>

<h1>Crear Carga</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'model_proyectos'=>$model_proyectos)); ?>