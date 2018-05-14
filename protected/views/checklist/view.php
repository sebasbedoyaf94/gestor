<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	$model->check_id,
);

$this->menu=array(
	array('label'=>'List Checklist', 'url'=>array('index')),
	array('label'=>'Create Checklist', 'url'=>array('create')),
	array('label'=>'Update Checklist', 'url'=>array('update', 'id'=>$model->check_id)),
	array('label'=>'Delete Checklist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->check_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Checklist', 'url'=>array('admin')),
);
?>

<h1>View Checklist #<?php echo $model->check_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'check_id',
		'check_proy_id',
		'check_url_pruebas',
		'check_ruta_doc_funcional',
		'check_ruta_doc_tecnica',
		'check_observaciones',
		'check_usuario_pruebas',
		'check_contrasena_pruebas',
		'check_creadopor',
		'check_fechacreado',
		'check_modificadopor',
		'check_fechamodificado',
	),
)); ?>
