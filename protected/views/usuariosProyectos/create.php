<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Usuarios Proyectos', 'url'=>array('index')),
	array('label'=>'Administrar Usuarios Proyectos', 'url'=>array('admin')),
);
?>

<h1>Crear Usuarios Proyectos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>