<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Turnos Servicios';
$this->breadcrumbs=array(
	'Turnos Servicios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Turnos Servicios','url'=>array('index')),
	array('label'=>'Crear Turno Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['TurnosServicios']['Crear']),),
);


?>

<h1>Administrar Turnos Servicios</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'turnos-servicios-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'full_turno',
			'value' => '$data->turservTur->tur_nombre',
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(TurnosServicios::model()->findAll(), 'turserv_tur_id', 'turserv_tur_id'),
		),
		array(
			'name' => 'full_servicio',
			'value' => '$data->turservServ->serv_nombre',
			// 'filter'=> CHtml::listData(TurnosServicios::model()->findAll(), 'turserv_serv_id', 'turserv_serv_id'),
		),
		array(
			'name' => 'full_programa',
			'value' => '$data->turservServ->servProg->prog_nombre',
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(TurnosServicios::model()->findAll(), 'turserv_tur_id', 'turserv_tur_id'),
		),
		array(
			'name' => 'full_cliente',
			'value' => '$data->turservServ->servProg->progCli->cli_nombre',
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(TurnosServicios::model()->findAll(), 'turserv_tur_id', 'turserv_tur_id'),
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
	            	'visible' => '!empty(Yii::app()->session["permisosRol"]["TurnosServicios"]["Modificar"])',
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
