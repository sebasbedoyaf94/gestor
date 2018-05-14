<?php
/* @var $this CargaController */
/* @var $model Carga */

$this->breadcrumbs=array(
	'Cargas'=>array('index'),
	$model->carga_id,
);

$this->menu=array(
	array('label'=>'List Carga', 'url'=>array('index')),
	array('label'=>'Create Carga', 'url'=>array('create')),
	array('label'=>'Update Carga', 'url'=>array('update', 'id'=>$model->carga_id)),
	array('label'=>'Delete Carga', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->carga_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Carga', 'url'=>array('admin')),
);
?>

<h1>View Carga #<?php echo $model->carga_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'carga_id',
		'carga_nombre_archivo',
		'carga_ruta_archivo',
		'carga_proy_id',
		'carga_fase',
		'carga_descripcion',
		'carga_creadopor',
		'carga_fechacreado',
		'carga_modificadopor',
		'carga_fechamodificado',
	),
)); ?>
