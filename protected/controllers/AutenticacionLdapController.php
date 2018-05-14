<?php
/* para hacer uso del controlador AutenticacionLdap en cualquier otro lugar
*  se debe agregar la siguiente linea en el main.php en el import
* 'application.controllers.*',
*/


/* Para desplegar el error obtenido por LDAP en el formulario.
* se debe hacer el llamado a la funcion tambien en el model,
* ya que en el userIdentity no se puede capturar el mensaje.
*
*/
class AutenticacionLdapController extends Controller
{
	public static function autenticacionDirectorioActivo($username,$password)
	{
		$res = array(
			'res' => true,
			'error' => '',
		);

		$LDAP_SERVER1 = Yii::app()->params['LDAP_SERVER1'];
		$LDAP_accsufix = Yii::app()->params['LDAP_accsufix'];

		$usernameFull = $username.$LDAP_accsufix;
		/* CONEXION A LDAP */
        //$ldapconn = ldap_connect($LDAP_SERVER1);

        /* BUSQUEDA DE USUARIO */
        //$ldapbind = @ldap_bind($ldapconn, $usernameFull, $password);

        //si la busqueda del usuario es falsa, entonces obtenemos el error y la respuesta es false
        /*if (!$ldapbind) {

        	$res['res'] = false;
            $ErrNUM = ldap_errno($ldapconn);
            
            switch ($ErrNUM) 
            {
                case 81:
                    $res['error'] = "No se puede conectar al servidor LDAP";
                    break;
                case 49:
                    $res['error'] = "Usuario o contraseña no valida.";
                    break;

                default:
                    $res['error'] = "[Error en LDAP] ".ldap_error($ldapconn);
                    break;
            }
        }*/

        return $res;
	}
}