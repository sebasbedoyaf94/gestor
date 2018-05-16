<?php
/* @var $this ClientesController */
/* @var $model Clientes */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->cli_id=>array('view','id'=>$model->cli_id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Crear Clientes', 'url'=>array('create')),
	array('label'=>'Ver Clientes', 'url'=>array('view', 'id'=>$model->cli_id)),
	array('label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<h1>Actualizar Cliente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>