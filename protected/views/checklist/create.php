<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Checklist', 'url'=>array('index')),
	array('label'=>'Manage Checklist', 'url'=>array('admin')),
);
?>

<h1>Create Checklist</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>