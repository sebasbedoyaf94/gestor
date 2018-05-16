<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	$model->proy_id=>array('view','id'=>$model->proy_id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Proyectos', 'url'=>array('create')),
	array('label'=>'Ver Proyectos', 'url'=>array('view', 'id'=>$model->proy_id)),
	array('label'=>'Administrar Proyectos', 'url'=>array('admin')),
);
?>

<h1>Actualizar proyecto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>