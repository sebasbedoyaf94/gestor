<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectoses'=>array('index'),
	$model->usuaproy_id=>array('view','id'=>$model->usuaproy_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsuariosProyectos', 'url'=>array('index')),
	array('label'=>'Create UsuariosProyectos', 'url'=>array('create')),
	array('label'=>'View UsuariosProyectos', 'url'=>array('view', 'id'=>$model->usuaproy_id)),
	array('label'=>'Manage UsuariosProyectos', 'url'=>array('admin')),
);
?>

<h1>Update UsuariosProyectos <?php echo $model->usuaproy_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>