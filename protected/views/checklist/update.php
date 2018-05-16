<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	$model->check_id=>array('view','id'=>$model->check_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Checklist', 'url'=>array('index')),
	array('label'=>'Create Checklist', 'url'=>array('create')),
	array('label'=>'View Checklist', 'url'=>array('view', 'id'=>$model->check_id)),
	array('label'=>'Manage Checklist', 'url'=>array('admin')),
);
?>

<h1>Update Checklist <?php echo $model->check_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>