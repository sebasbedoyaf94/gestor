<?php
/* @var $this UsuariosProyectosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarios Proyectoses',
);

$this->menu=array(
	array('label'=>'Create UsuariosProyectos', 'url'=>array('create')),
	array('label'=>'Manage UsuariosProyectos', 'url'=>array('admin')),
);
?>

<h1>Usuarios Proyectoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
