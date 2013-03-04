<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wordpress');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'z?1`4y6n^G^,mE_*qLf( 7_W$8R99l/YbAQ7$[}?tF#F_;NI@iWe|<PBbA$c+{oi'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '9FiNjX9BMy*U.b[W8 ,XMKMo5&fUUx>S#[t0k8<>fh8tf]GD?<`FwWg&SzKmSlqh'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'FZn`83)>jwIjeXbAu``18+`sO5J90(SE?bY!iuk4O}8t%t_jkyR6,jDM=#u$`$I='); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'V*Z@1m PaVRvsg:r)~%2my45SIo5`Axn9bg{k#cwi6uITS4dg?bx!$,R=LFeY~#%'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'r?;+e0a*M0>oH?X3VBj~SG&-8hSTOVPwdYiNNU%ms}M|qaf]lmDb![Po[=jXaHX='); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'ZPNX#di6Y|yY>F&9S@;y`zUx/ez`qA}8X0>krXNEVJm~50mV~{lI(5(#86H5)UG.'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '2=1$W(=3M0Uo-L_?P]qH~Q0.C+6-mGv2ir~[1wxXCt@li/m0g-tg#Jbp&OikAo9;'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', ':mF /ddFUq~xl:bL-?5/QCeP.QU@!-^cvvK.Eqs{;5@Fe?kc5ZgyBX]>]-{mq-eK'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

