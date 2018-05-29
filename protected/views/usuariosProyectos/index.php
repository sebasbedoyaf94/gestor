<?php
/* @var $this UsuariosProyectosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarios Proyectos',
);

$this->menu=array(
	array('label'=>'Crear Usuarios Proyectos', 'url'=>array('create')),
	array('label'=>'Administrar Usuarios Proyectos', 'url'=>array('admin')),
);
?>

<h1>Usuarios Proyectos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
