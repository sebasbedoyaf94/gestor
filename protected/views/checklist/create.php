<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Checklist', 'url'=>array('index')),
	array('label'=>'Administrar Checklist', 'url'=>array('admin')),
);
?>

<h1>Crear Checklist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>