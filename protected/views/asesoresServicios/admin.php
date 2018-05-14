<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Asesores Servicios';
$this->breadcrumbs=array(
	'Asesores Servicios'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Asesores Servicios','url'=>array('index')),
	array('label'=>'Crear Asesor Servicio','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['AsesoresServicios']['Crear']),),
);
?>

<h1>Administrar Asesores Servicios</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'asesores-servicios-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		/*array(
			'name' => 'aseserv_ase_id',
			'value' => '$data->aseservAse->ase_nombre . " " . $data->aseservAse->ase_apellidos',
			//'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_id', 'ase_nombre'),
		),*/
		array( 'name'=>'full_name', 
			'value'=>'$data->aseservAse->ase_nombre . " " . $data->aseservAse->ase_apellidos'),
		/*array(
			'name' => 'full_name',
			'value' => '$data->getFull_Name()',
			//'filter'=> CHtml::listData(Asesores::model()->findAll(), 'ase_id', 'ase_nombre'),
		),*/
		array(
			'name' => 'full_servicio',
			'value' => '$data->aseservServ->serv_nombre',
			//'filter' => CHtml::textField('aseservServ_serv_nombre', Yii::app()->request->getParam('aseservServ_serv_nombre')),
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(AsesoresServicios::model()->findAll(), 'aseserv_serv_id', 'aseserv_serv_id'),
		),
		array(
			'name' => 'full_programa',
			'value' => '$data->aseservServ->servProg->prog_nombre',
			//'filter' => CHtml::textField('aseservServ_serv_nombre', Yii::app()->request->getParam('aseservServ_serv_nombre')),
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(AsesoresServicios::model()->findAll(), 'aseserv_serv_id', 'aseserv_serv_id'),
		),
		array(
			'name' => 'full_cliente',
			'value' => '$data->aseservServ->servProg->progCli->cli_nombre',
			//'filter' => CHtml::textField('aseservServ_serv_nombre', Yii::app()->request->getParam('aseservServ_serv_nombre')),
			//'type'=>'raw',
			// 'filter'=> CHtml::listData(AsesoresServicios::model()->findAll(), 'aseserv_serv_id', 'aseserv_serv_id'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['AsesoresServicios']['Modificar'])",
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
