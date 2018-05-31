<?php
/* @var $this ReportesController */
/* @var $model Reportes */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	$model->rep_id=>array('view','id'=>$model->rep_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reportes', 'url'=>array('index')),
	array('label'=>'Create Reportes', 'url'=>array('create')),
	array('label'=>'View Reportes', 'url'=>array('view', 'id'=>$model->rep_id)),
	array('label'=>'Manage Reportes', 'url'=>array('admin')),
);
?>

<h1>Update Reportes <?php echo $model->rep_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>