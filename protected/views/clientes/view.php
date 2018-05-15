<?php
/* @var $this ClientesController */
/* @var $model Clientes */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->cli_id,
);

$this->menu=array(
	array('label'=>'List Clientes', 'url'=>array('index')),
	array('label'=>'Create Clientes', 'url'=>array('create')),
	array('label'=>'Update Clientes', 'url'=>array('update', 'id'=>$model->cli_id)),
	array('label'=>'Delete Clientes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cli_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Clientes', 'url'=>array('admin')),
);
?>

<h1>View Clientes #<?php echo $model->cli_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cli_id',
		'cli_nombre',
		'cli_habilitado',
	),
)); ?>
