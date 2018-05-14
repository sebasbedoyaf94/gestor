<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Roles';
$this->breadcrumbs=array(
	'Roles'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Roles','url'=>array('index')),
	array('label'=>'Crear Rol',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Roles']['Crear']),
	),
);

?>

<h1>Administrar Roles</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'roles-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'rol_nombre',
			'value' => '$data->rol_nombre',
			// 'filter'=> CHtml::listData(Roles::model()->findAll(), 'rol_nombre', 'rol_nombre'),
		),
		array(
			'name' => 'rol_habilitado',
			'value' => '$data->rol_habilitado',
			'filter'=> CHtml::listData(Roles::model()->findAll(), 'rol_habilitado', 'rol_habilitado'),
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
	            	'visible' => '$data->rol_id != Yii::app()->session["login_rolid"] and !empty(Yii::app()->session["permisosRol"]["Roles"]["Modificar"])',
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
