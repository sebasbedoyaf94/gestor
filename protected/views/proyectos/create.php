<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Proyectos', 'url'=>array('index')),
	array('label'=>'Manage Proyectos', 'url'=>array('admin')),
);
?>

<h1>Create Proyectos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>