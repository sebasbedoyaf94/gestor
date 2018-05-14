<?php
/* @var $this ProyectosController */
/* @var $model Proyectos */

$this->breadcrumbs=array(
	'Proyectoses'=>array('index'),
	$model->proy_id,
);

$this->menu=array(
	array('label'=>'List Proyectos', 'url'=>array('index')),
	array('label'=>'Create Proyectos', 'url'=>array('create')),
	array('label'=>'Update Proyectos', 'url'=>array('update', 'id'=>$model->proy_id)),
	array('label'=>'Delete Proyectos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->proy_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Proyectos', 'url'=>array('admin')),
);
?>

<h1>View Proyectos #<?php echo $model->proy_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'proy_id',
		'proy_nombre',
		'proy_cli_id',
		'proy_fechaInicio',
		'proy_fechaFin',
		'proy_creadopor',
		'proy_fechacreado',
		'proy_modificadopor',
		'proy_fechamodificado',
	),
)); ?>
