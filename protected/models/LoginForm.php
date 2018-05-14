<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Recordarme',
			'username'=>'Usuario',
			'password'=>'Contraseña',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);

			if(!$this->_identity->authenticate())
			{
				//luego de validar que el usuario existe y esta habilitado, entonces se valida con directorio activo
				$username = $this->username;
				$password = $this->password;

				/* para hacer uso del controlador AutenticacionLdap
				*  se debe agregar la siguiente linea en el main.php en el import
				*  'application.controllers.*',
				*/
				/*$autenticacionLDAP=AutenticacionLdapController::autenticacionDirectorioActivo($username,$password);

				
				if (!$autenticacionLDAP['res']) {
					$this->addError('password',$autenticacionLDAP['error']);
				}*/
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{

				
			/*si el usuario se autentico exitosamente,
			entonces se debe traer los permisos que tiene.
			ademas de guardar toda la informacion del usuario.
			*/

			//validar que el usuario existe y capturar los datos necesarios
						
			$model= Usuarios::model()->findByAttributes(
			    array('usua_usuariored'=>$this->username),
			    'usua_habilitado=:usua_habilitado',
			    array(':usua_habilitado'=>'Si')
			);


			//Informacion del usuario que se usara en la aplicacion para identificarlo o registrar sus actividades en la base de datos
			Yii::app()->session['login_nombre'] = $model->usua_nombre.' '.$model->usua_apellidos;
			Yii::app()->session['login_usuariored'] = $model->usua_usuariored;
			Yii::app()->session['login_usuarioid'] = $model->usua_id;
			Yii::app()->session['login_rolid'] = $model->usua_rol_id;
			Yii::app()->session['login_nombreRol'] = $model->usuaRol->rol_nombre;

			$permisos = '';
			//capturar los diferentes permisos que tiene el rol del usuario autenticado
			foreach ($model->usuaRol->rolesModulosAcciones as $key => $value) {
				$permisos[$value->rolmodacModac->modacModu->modu_nombre][$value->rolmodacModac->modac_nombre] = true;
			}

			//guardamos los permisos
			Yii::app()->session['permisosRol'] = $permisos;

			//seleccionar los servicios a los cuales el usuario tiene permiso
			//se debe garantizar que si el servicio se encuentra deshabilitado no pueda ser listado
			
			$serviciosDelUsuario = array();
			foreach ($model->usuariosServicioses as $key => $servicioDelUsuario) 
			{
				if ($servicioDelUsuario->usuaservServ->serv_habilitado == 'Si') 
				{

					$info['nombreServicio'] = $servicioDelUsuario->usuaservServ->serv_nombre;
					$info['idServicio'] = $servicioDelUsuario->usuaservServ->serv_id;

					$info['nombrePrograma'] = $servicioDelUsuario->usuaservServ->servProg->prog_nombre;
					$info['idPrograma'] = $servicioDelUsuario->usuaservServ->servProg->prog_id;

					$info['nombreCliente'] = $servicioDelUsuario->usuaservServ->servProg->progCli->cli_nombre;
					$info['idCliente'] = $servicioDelUsuario->usuaservServ->servProg->progCli->cli_id;



					$serviciosDelUsuario[] = $info;
				}
			}

			//ordenamos por servicio, luego debemos clasificarlo por cliente
			$serv_order = $this->array_sort($serviciosDelUsuario, 'nombreServicio', SORT_ASC);

			$serviciosDelUsuario = array();
			foreach ($serv_order as $key => $serv) 
			{
				$serviciosDelUsuario[$serv['nombreCliente']][] = $serv;
			}

			//guardamos los servicios
			Yii::app()->session['serviciosDelUsuario'] = $serviciosDelUsuario;


			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}


	function array_sort($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}
}
