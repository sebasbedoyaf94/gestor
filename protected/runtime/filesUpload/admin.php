<h1 class="page-header">Administrar servicios</h1>
<?php $this->pageTitle=Yii::app()->name . ' - Servicios'; ?>
<?php
$this->menu=array(
	array(
		'label'=>'Crear servicio',
		'url'=>array('create'),
		'visible'=>Yii::app()->session['menu']['MenuGeneral']['Servicios']['crear'],
		'linkOptions' => array(
		 	'ajax'=>array(
                'type'=>'POST',
                'url'=>"js:$(this).attr('href')",
                'success'=>'function(data) { 
                	$("#viewModal .modal-body").html(data); 
                	$("#viewModal").modal(); 
                	$("#viewModal .modal-header h2").html("Crear servicio");
                }'
            )	
		 )
	),
);
?>

<?php $this->widget(
	'booster.widgets.TbGridView',
	array(
	'id'=>'servicios-grid',
	'dataProvider'=>$model->search(),
	'summaryText' => 'Mostrando del {start} al {end} de {count} registros',
	'emptyText' => 'Sin resultados',
	'filter'=>$model,
	'columns'=>array(
			//'idServicio',
			'nombre',
			//'codigoCUPS',
			// 'codigoCIE',
			array(
			    'name' => 'codigoCIE',
			    'headerHtmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'htmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'filterHtmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'value'=>'$data->codigoCIE0->codigoCIE',
				//'filter' => CHtml::listData(Cie10::model()->findAll(), 'codigoCIE', 'codigoCIE'),
			),
			array(
			    'name' => 'codigoCUPS',
			    'headerHtmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'htmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'filterHtmlOptions' => array('class' => 'hidden-xs hidden-sm'),
			    'value'=>'$data->codigoCUPS0->codigoCUPS',
				//'filter' => CHtml::listData(Cie10::model()->findAll(), 'codigoCIE', 'codigoCIE'),
			),
			array(
				    'name' => 'habilitado',
				    'value'=>'$data->habilitado == 1 ? \'Si\':\'No\'',
					'filter'=>array('1'=>'Si','0'=>'No'),
			),
			array(
					'htmlOptions' => array('nowrap'=>'nowrap'),
					'class'=>'booster.widgets.TbButtonColumn',
					'template' => '{view} {update}',
					'buttons' => array(
			            'view' => array(
			                'options' => array(
			                	'title' => Yii::t('app', 'Ver'),
			                	'ajax'=>array(
	                                'type'=>'POST',
	                                'url'=>"js:$(this).attr('href')",
	                                'success'=>'function(data) { 
	                                	$("#viewModal .modal-body").html(data); 
	                                	$("#viewModal").modal(); 
	                                	$("#viewModal .modal-header h2").html("Ver servicio");
	                                }'
	                            ),
			                ),
			            ),
			            'update' => array(
			                'options' => array(
			                	'title' => Yii::t('app', 'Modificar'),
			                	'ajax'=>array(
	                                'type'=>'POST',
	                                'url'=>"js:$(this).attr('href')",
	                                'success'=>'function(data) { 
	                                	$("#viewModal .modal-body").html(data); 
	                                	$("#viewModal").modal();
	                                	$("#viewModal .modal-header h2").html("Modificar servicio");
	                                }'
	                            ),
			                ),
			                'visible'=>Yii::app()->session['menu']['MenuGeneral']['Servicios']['modificar'],
			            ),
			            // 'delete' => array(
			            //     'options' => array('title' => Yii::t('app', 'Eliminar')),
			            // ),
			        ),
			        	//'deleteConfirmation'=>'¿Seguro que quiere eliminar el registro seleccionado?', 
				),
		),
	)
); ?>

<?php $this->renderPartial('//site/viewmodal'); ?>