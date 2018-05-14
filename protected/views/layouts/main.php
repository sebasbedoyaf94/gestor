<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"> -->
	<title><?php echo CHtml::encode(Yii::app()->name); ?></title>
</head>

<script>
$(document).ready(function(){

  $('.dropdown a').hover(function() {
    $(this).find('.text-danger').css('color','#fff','!important');
  }, function() {
    $('.glyphicon').css('color','#0B0B61');
  }); 

  /*$('#yw5 a').hover(function() {
    $(this).find('.text-danger').css('color','#fff','!important');
  }, function() {
    $('.glyphicon').css('color','#0B0B61');
  });*/
});
</script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

<body class="container">

	<div class="row">
		<div class="col-xs-12">
			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</div><!-- header -->
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div id="mainmenu">
				<?php  
					$this->widget(
					    'booster.widgets.TbNavbar',
					    array(
					        'brand' => '',
				        	'brandOptions' => array('style' => 'display:none;'),
				        	'fixed' => true,
				        	'fluid' => true,
					        'items' => array(
					            array(
					                'class' => 'booster.widgets.TbMenu',
					            	'type' => 'navbar',
					            	'encodeLabel'=>false,
					                'items'=>array(
					                	//Menu HOME
										array('label'=>'<span class="glyphicon glyphicon-home text-danger"></span> Home', 'url'=>array('/site/index'), 'itemOptions'=>array('aria-hidden'=>'true'), 'visible'=>!Yii::app()->user->isGuest),
										//Menu Iniciar Sesion
										array('label'=>'<span class="glyphicon glyphicon-log-in text-danger"></span> Iniciar Sesion', 'url'=>array('/site/login'), 'itemOptions'=>array('class'=>'pull-right'), 'visible'=>Yii::app()->user->isGuest),
										
										//DropDown Maestros
										array(
					                        'label' => '<span class="glyphicon glyphicon-cog text-danger"></span> Maestros',
					                        'items' => array(
					                            
												//Menu Roles
							                    array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Roles ',
					                            	'url'=>array('/roles/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['Usuarios']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

							                    //Menu Usuarios
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Usuarios',
							                        'url'=>array('/usuarios/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Roles']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),

							                    //Menu Clientes
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Clientes',
							                        'url'=>array('/clientes/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Clientes']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),

							                    //Menu Programas
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Programas',
							                        'url'=>array('/programas/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Programas']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),

							                    //Menu Servicios
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Servicios',
							                        'url'=>array('/servicios/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Servicios']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),

							                    //Menu Contratos
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Contratos',
							                        'url'=>array('/contratos/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Contratos']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),
												
												//Menu Novedades
							                    array(
							                        'label' => '<span class="glyphicon glyphicon-list text-danger"></span> Novedades',
							                        'url'=>array('/novedades/admin'),
							                        'visible' => (!empty(Yii::app()->session['permisosRol']['Novedades']) and !Yii::app()->user->isGuest) ? true : false,
							                    ),

							                    //Menu Turnos
							                    array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Turnos ',
					                            	'url'=>array('/turnos/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['Turnos']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),
												
												//Menu Asesores
							                    array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Asesores ',
					                            	'url'=>array('/asesores/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['Asesores']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Turnos Servicios
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Turnos Servicios ',
					                            	'url'=>array('/turnosServicios/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['TurnosServicios']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Carga Masiva
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Carga Masiva ',
					                            	'url'=>array('/cargaMasiva/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['CargaMasiva']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Turnos Novedades
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Turnos Novedades ',
					                            	'url'=>array('/turnosNovedades/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['TurnosNovedades']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Turnos Asesores
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Turnos Asesores ',
					                            	'url'=>array('/turnosAsesores/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['TurnosAsesores']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Asesores Servicios
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Asesores Servicios ',
					                            	'url'=>array('/asesoresServicios/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['AsesoresServicios']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                            //Menu Novedades Asesores
					                            array(
					                            	'label'=>'<span class="glyphicon glyphicon-list text-danger"></span> Novedades Asesores ',
					                            	'url'=>array('/novedadesAsesores/admin'), 
					                        		'visible' => (!empty(Yii::app()->session['permisosRol']['NovedadesAsesores']) and !Yii::app()->user->isGuest) ? true : false,
					                            ),

					                        )
					                    ),
																					
					                    //Menu Admin Logueado
										array(
					                        'label' => '<span class="glyphicon glyphicon-user text-danger"></span> '.Yii::app()->session['login_nombre'].' ('.Yii::app()->session['login_nombreRol'].')',
					                        'url' => '#',
					                        'items' => array(
					                            array('label'=>'<span class="glyphicon glyphicon-log-out text-danger"></span> Cerrar Sesion ', 'url'=>array('/site/logout'), ),
					                        ),
					                        'itemOptions'=>array('class'=>'pull-right'), 
					                        'visible'=>!Yii::app()->user->isGuest,
					                    ),

									)
					            )
					        )
					    )
					);
				?>
			</div>
			<!-- mainmenu -->
		</div>
		<div class="col-xs-12">
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
			<?php endif?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php
			    foreach(Yii::app()->user->getFlashes() as $key => $message) {
			        echo '<div class="flash-'.$key.'">'.$message."</div>\n";
			    }
			?>
			<?php
				
			?>

			<?php echo $content; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="clear"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<!--<div id="footer">
				Copyright &copy; <?php //echo date('Y'); ?> by Konecta.<br/>
				Todos los derechos reservados.<br/>
			</div><!-- footer -->
		</div>
	</div>

</body>
</html>


<style type="text/css">
#Lineas_nombre,
#Novedades_nombre,
#Roles_nombre
{
	text-transform: uppercase;
}
</style>