<?php
/* @var $this ChecklistController */
/* @var $model Checklist */

$this->breadcrumbs=array(
	'Checklists'=>array('index'),
	$model->check_id,
);

$this->menu=array(
	array('label'=>'Listar Checklist', 'url'=>array('index')),
	array('label'=>'Crear Checklist', 'url'=>array('create')),
	array('label'=>'Actualizar Checklist', 'url'=>array('update', 'id'=>$model->check_id)),
	array('label'=>'Administrar Checklist', 'url'=>array('admin')),
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
