<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Turnos Asesores';
$this->breadcrumbs=array(
	'Turnos Asesores'=>array('index'),
	$model->turase_id=>array('view','id'=>$model->turase_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Asesores','url'=>array('index')),
	array('label'=>'Crear Turno Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosAsesores']['Crear']),),
	array('label'=>'Ver Turnos Asesores','url'=>array('view','id'=>$model->turase_id)),
	array('label'=>'Administrar Turnos Asesores','url'=>array('admin')),
);
?>

	<h1>Modificar el turno del asesor</h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>