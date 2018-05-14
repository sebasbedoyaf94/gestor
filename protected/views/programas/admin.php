<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Programas';
$this->breadcrumbs=array(
	'Programas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Programas','url'=>array('index')),
	array('label'=>'Crear Programa',
		'url'=>array('create'),
		'visible'=>!empty(Yii::app()->session['permisosRol']['Programas']['Crear']),
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

<h1>Administrar Programas</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'programas-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'prog_cli_id',
			'value' => '$data->progCli->cli_nombre',
			'filter' => CHtml::textField('progCli_cli_nombre', Yii::app()->request->getParam('progCli_cli_nombre')),
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_cli_id', 'prog_cli_id'),
		),
		array(
			'name' => 'prog_nombre',
			'value' => '$data->prog_nombre',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_nombre', 'prog_nombre'),
		),
		array(
			'name' => 'prog_descripcion',
			'value' => '$data->prog_descripcion',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_descripcion', 'prog_descripcion'),
		),
		array(
			'name' => 'prog_habilitado',
			'value' => '$data->prog_habilitado',
			'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_habilitado', 'prog_habilitado'),
		),
		/*
		array(
			'name' => 'prog_fechacreado',
			'value' => '$data->prog_fechacreado',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_fechacreado', 'prog_fechacreado'),
		),
		array(
			'name' => 'prog_creadopor',
			'value' => '$data->prog_creadopor',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_creadopor', 'prog_creadopor'),
		),
		array(
			'name' => 'prog_fechamodificado',
			'value' => '$data->prog_fechamodificado',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_fechamodificado', 'prog_fechamodificado'),
		),
		array(
			'name' => 'prog_modificadopor',
			'value' => '$data->prog_modificadopor',
			// 'filter'=> CHtml::listData(Programas::model()->findAll(), 'prog_modificadopor', 'prog_modificadopor'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['Programas']['Modificar'])",
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
