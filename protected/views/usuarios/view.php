<?php
$this->pageTitle=Yii::app()->name . ' - Ver Usuarios';
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usua_nombre.' '.$model->usua_apellidos,
);

$this->menu=array(
	array('label'=>'Listar Usuarios','url'=>array('index'),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])),
	array('label'=>'Crear Usuario','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])),
	array('label'=>'Modificar Usuario','url'=>array('update','id'=>$model->usua_id),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Modificar'])),
	array('label'=>'Administrar Usuarios','url'=>array('admin'),'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear'])),
);
?>

<h1>Usuario <b><?php echo $model->usua_nombre.' '.$model->usua_apellidos; ?></b></h1>

<div class="col-xs-12 well">
	<div class="col-xs-12">
		<h3 class='subtitulo'>Información del Usuario</h3>
	</div>

	<div class="col-xs-12">
		<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
				// 'usua_id',
				'usua_nombre',
				'usua_apellidos',
				'usua_usuariored',
				array(
			        'name'=>'usua_rol_id',
			        'value'=>$model->usuaRol->rol_nombre,
			    ),
				'usua_habilitado',
				'usua_fechacreado',
				array(
			        'name'=>'usua_creadopor',
			        'value'=>$model->usuaCreadopor->usua_usuariored,
			    ),
				'usua_fechamodificado',
				array(
			        'name'=>'usua_modificadopor',
			        'value'=>$model->usuaModificadopor->usua_usuariored,
			    ),
			),
		)); ?>
	</div>
</div>
