<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Usuarios';
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Usuarios','url'=>array('index')),
	array('label'=>'Crear Usuario',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Usuarios']['Crear']),
	),
);

?>

<h1>Administrar Usuarios</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'usuarios-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'usua_nombre',
			'value' => '$data->usua_nombre',
		),
		array(
			'name' => 'usua_apellidos',
			'value' => '$data->usua_apellidos',
		),
		array(
			'name' => 'usua_cedula',
			'value' => '$data->usua_cedula',
		),
		array(
			'name' => 'usua_usuariored',
			'value' => '$data->usua_usuariored',
		),
		array(
			'name' => 'usua_rol_id',
			'value' => '$data->usuaRol->rol_nombre',
			'filter'=> CHtml::listData(Roles::model()->findAll(), 'rol_id', 'rol_nombre'),
		),
		array(
			'name' => 'usua_habilitado',
			'value' => '$data->usua_habilitado',
			'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_habilitado', 'usua_habilitado'),
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {update}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                ),
	            ),
	            'update' => array(
	            	'visible' => '!empty(Yii::app()->session["permisosRol"]["Usuarios"]["Modificar"])',
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                ),
	            ),            
	        ),
		),
),
)); ?>
