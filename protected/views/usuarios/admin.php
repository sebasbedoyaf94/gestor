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
		// 'linkOptions' => array(
		//  	'ajax'=>array(
  //               'type'=>'POST',
  //               'url'=>"js:$(this).attr('href')",
  //               'success'=>'function(data) { 
  //               	$("#viewModal .modal-body").html(data); 
  //               	$("#viewModal").modal(); 
  //               }'
  //           )	
		//  )
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
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_nombre', 'usua_nombre'),
		),
		array(
			'name' => 'usua_apellidos',
			'value' => '$data->usua_apellidos',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_apellidos', 'usua_apellidos'),
		),
		array(
			'name' => 'usua_usuariored',
			'value' => '$data->usua_usuariored',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_usuariored', 'usua_usuariored'),
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
		/*
		array(
			'name' => 'usua_fechacreado',
			'value' => '$data->usua_fechacreado',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_fechacreado', 'usua_fechacreado'),
		),
		array(
			'name' => 'usua_creadopor',
			'value' => '$data->usua_creadopor',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_creadopor', 'usua_creadopor'),
		),
		array(
			'name' => 'usua_fechamodificado',
			'value' => '$data->usua_fechamodificado',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_fechamodificado', 'usua_fechamodificado'),
		),
		array(
			'name' => 'usua_modificadopor',
			'value' => '$data->usua_modificadopor',
			// 'filter'=> CHtml::listData(Usuarios::model()->findAll(), 'usua_modificadopor', 'usua_modificadopor'),
		),
		*/
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
	            	'visible' => '$data->usua_id != Yii::app()->session["login_usuarioid"] and !empty(Yii::app()->session["permisosRol"]["Usuarios"]["Modificar"]) and ($data->usua_id != Yii::app()->session["login_usuarioid"])',
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
