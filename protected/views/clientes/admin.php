<?php
/* @var $this ClientesController */
/* @var $model Clientes */
$this->pageTitle=Yii::app()->name . ' - Administrar Clientes';
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Crear Clientes', 'url'=>array('create')),
);

?>

<h1>Administrar Clientes</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'clientes-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'cli_nombre',
			'value' => '$data->cli_nombre',
			// 'filter'=> CHtml::listData(Roles::model()->findAll(), 'rol_nombre', 'rol_nombre'),
		),
		array(
			'name' => 'cli_habilitado',
			'value' => '$data->cli_habilitado',
			'filter'=> CHtml::listData(Roles::model()->findAll(), 'cli_habilitado', 'cli_habilitado'),
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
			'template' => '{view} {update}',
			'buttons' => array(
	            'view' => array(
	                'options' => array(
	                	'title' => Yii::t('app', 'Ver'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal(); 
                  //           }'
                  //       ),
	                ),
	            ),
	            'update' => array(
	            	'visible' => '$data->cli_id != Yii::app()->session["login_rolid"] and !empty(Yii::app()->session["permisosRol"]["Clientes"]["Modificar"])',
	                'options' => array(
	                	'title' => Yii::t('app', 'Modificar'),
	                	// 'ajax'=>array(
                  //           'type'=>'POST',
                  //           'url'=>"js:$(this).attr('href')",
                  //           'success'=>'function(data) { 
                  //           	$("#viewModal .modal-body").html(data); 
                  //           	$("#viewModal").modal();
                  //           }'
                  //       ),
	                ),
	            ),            
	        ),
		),
),
)); ?>

