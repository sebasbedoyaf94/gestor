<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsuariosProyectos', 'url'=>array('index')),
	array('label'=>'Manage UsuariosProyectos', 'url'=>array('admin')),
);
?>

<h1>Create UsuariosProyectos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>