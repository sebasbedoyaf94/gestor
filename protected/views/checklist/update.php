<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	$model->check_id=>array('view','id'=>$model->check_id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Checklist', 'url'=>array('index')),
	array('label'=>'Crear Checklist', 'url'=>array('create')),
	array('label'=>'Ver Checklists', 'url'=>array('view', 'id'=>$model->check_id)),
	array('label'=>'Administrar Checklist', 'url'=>array('admin')),
);
?>

<h1>Actualizar Checklist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>