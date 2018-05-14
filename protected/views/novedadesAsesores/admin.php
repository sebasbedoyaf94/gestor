<?php
$this->pageTitle=Yii::app()->name . ' - Administrar Novedades Asesores';
$this->breadcrumbs=array(
	'Novedades Asesores'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Novedades Asesores','url'=>array('index')),
	array('label'=>'Crear Novedad Asesor','url'=>array('create'),'visible'=>!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']['Crear']),),
);

?>

<h1>Administrar Novedades Asesores</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'novedades-asesores-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'htmlOptions' => array('style' => 'white-space: nowrap'),
'columns'=>array(
		array(
			'name' => 'full_name',
			'value' => '$data->novaseAse->ase_nombre . " " . $data->novaseAse->ase_apellidos',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_ase_id', 'novase_ase_id'),
		),
		array(
			'name' => 'novase_nov_id',
			'value' => '$data->novaseNov->nov_nombre',
			'filter'=> CHtml::listData(Novedades::model()->findAll(), 'nov_id', 'nov_nombre'),
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_nov_id', 'novase_nov_id'),
		),
		array(
			'name' => 'novase_fecha',
			'value' => '$data->novase_fecha',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_fecha', 'novase_fecha'),
		),
		array(
			'name' => 'novase_horaInicio',
			'value' => '$data->novase_horaInicio',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_horaInicio', 'novase_horaInicio'),
		),
		array(
			'name' => 'novase_horaFin',
			'value' => '$data->novase_horaFin',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_horaFin', 'novase_horaFin'),
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
	            	'visible'=>"!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']['Modificar'])",
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
		/*
		array(
			'name' => 'novase_observaciones',
			'value' => '$data->novase_observaciones',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_observaciones', 'novase_observaciones'),
		),
		array(
			'name' => 'novase_fechacreado',
			'value' => '$data->novase_fechacreado',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_fechacreado', 'novase_fechacreado'),
		),
		array(
			'name' => 'novase_creadopor',
			'value' => '$data->novase_creadopor',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_creadopor', 'novase_creadopor'),
		),
		array(
			'name' => 'novase_fechamodificado',
			'value' => '$data->novase_fechamodificado',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_fechamodificado', 'novase_fechamodificado'),
		),
		array(
			'name' => 'novase_modificadopor',
			'value' => '$data->novase_modificadopor',
			// 'filter'=> CHtml::listData(NovedadesAsesores::model()->findAll(), 'novase_modificadopor', 'novase_modificadopor'),
		),
		*/

),
)); ?>
