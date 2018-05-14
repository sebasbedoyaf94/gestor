<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Novedades Asesores';
$this->breadcrumbs=array(
	'Novedades Asesores'=>array('index'),
	$model->novase_id=>array('view','id'=>$model->novase_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Novedades Asesores','url'=>array('index')),
	array('label'=>'Crear Novedad Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']['Crear']),),
	array('label'=>'Ver Novedades Asesores','url'=>array('view','id'=>$model->novase_id)),
	array('label'=>'Administrar Novedades Asesores','url'=>array('admin')),
);
?>

	<h1>Modificar novedad del asesor</h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>