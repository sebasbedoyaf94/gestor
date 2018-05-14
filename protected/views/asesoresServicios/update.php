<?php
$this->pageTitle=Yii::app()->name . ' - Modificar Asesores Servicios';
$this->breadcrumbs=array(
	'Asesores Servicios'=>array('index'),
	$model->aseserv_id=>array('view','id'=>$model->aseserv_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Listar Asesores Servicios','url'=>array('index')),
	array('label'=>'Crear Asesor Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['AsesoresServicios']['Crear']),),
	array('label'=>'Ver Asesores Servicios','url'=>array('view','id'=>$model->aseserv_id)),
	array('label'=>'Administrar Asesores Servicios','url'=>array('admin')),
);
?>

	<h1>Modificar servicio de <?php echo $model->aseservAse->ase_nombre . " " . $model->aseservAse->ase_apellidos; ?></h1>

<?php echo $this->renderPartial('_form2',array('model'=>$model)); ?>