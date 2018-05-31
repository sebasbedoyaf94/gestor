<?php
/* @var $this ReportesController */
/* @var $model Reportes */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	$model->rep_id,
);

$this->menu=array(
	array('label'=>'List Reportes', 'url'=>array('index')),
	array('label'=>'Create Reportes', 'url'=>array('create')),
	array('label'=>'Update Reportes', 'url'=>array('update', 'id'=>$model->rep_id)),
	array('label'=>'Delete Reportes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rep_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reportes', 'url'=>array('admin')),
);
?>

<h1>View Reportes #<?php echo $model->rep_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rep_id',
		'rep_fechaInicio',
		'rep_fechaFin',
		'rep_fase',
		'rep_proy_id',
		'rep_tipo',
	),
)); ?>
