<?php
/* @var $this UsuariosProyectosController */
/* @var $model UsuariosProyectos */

$this->breadcrumbs=array(
	'Usuarios Proyectos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Usuarios Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Usuarios Proyectos', 'url'=>array('create')),
);

?>

<h1>Administrar Usuarios Proyectos</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'usuarios-proyectos-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'usuaproy_usua_id',
			'value' => '$data->usuaproyUsua->usua_nombre',
			'filter' => CHtml::textField('usuaProy_usua_nombre', Yii::app()->request->getParam('usuaProy_usua_nombre')),
		),
		array(
			'name' => 'usuaproy_proy_id',
			'value' => '$data->usuaproyProy->proy_nombre',
			'filter' => CHtml::textField('usuaProy_proy_nombre', Yii::app()->request->getParam('usuaProy_proy_nombre')),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['UsuariosProyectos']['Modificar'])",
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                ),
	            ),            
	        ),
		),
),
)); ?>
