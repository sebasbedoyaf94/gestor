<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectoses'=>array('index'),
	$model->usuaproy_id,
);

$this->menu=array(
	array('label'=>'List UsuariosProyectos', 'url'=>array('index')),
	array('label'=>'Create UsuariosProyectos', 'url'=>array('create')),
	array('label'=>'Update UsuariosProyectos', 'url'=>array('update', 'id'=>$model->usuaproy_id)),
	array('label'=>'Delete UsuariosProyectos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->usuaproy_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsuariosProyectos', 'url'=>array('admin')),
);
?>

<h1>View UsuariosProyectos #<?php echo $model->usuaproy_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usuaproy_id',
		'usuaproy_usua_id',
		'usuaproy_proy_id',
	),
)); ?>
