<?php
define('WP_CACHE', true /* Modified by NitroPack */ ); // Added by WP Rocket


/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'dx289284_frame' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'dx289284_frame' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'Ju3L9TcSm48n' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'dx289284.mysql.tools' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

define('AUTH_KEY',         'Nl|5|jT&^M|hV6+_B,1^D@4wQXioG.2ID[#wURH9,l;U[Ga^-#xtNC5}!/OuP.R`');
define('SECURE_AUTH_KEY',  ':&tsoO/!Z`IVCK!}6+GA8nKlfYx^g<Jghqvx6,E&hMk%!~x6.|VnC|Jq^ (wNM7M');
define('LOGGED_IN_KEY',    '?F=ZCh>/J-%YIsd- piS-SRsQx}8)u!wO>]Y,r},eIQ?r:D7tCH[6 as{bD1i< ~');
define('NONCE_KEY',        '/pctMtgm11*Jx9H(D~h73ZVk%7SZ!!(*=.B+l_#S,?g<fR}*:7m7K;X,tKs*&sR?');
define('AUTH_SALT',        'qm-6hV,r 94DZ,|8u/2_b-8m7[l7|`+~LN3-V>{::<Nop6uf*]<~v]!-m>qOP~U+');
define('SECURE_AUTH_SALT', '|qgcks0uk+{964+KU2yg_PKsn4LAx]L>Q-|-P0O[MPEaCMPu^?1 N+sXQ_ym_u}m');
define('LOGGED_IN_SALT',   'lmP]PEsCkDJ}iG .JQPP;J`Vp8E-+8!fJ-GsVwG,^U`l_B}y_srK[ ro`j^MJ*-t');
define('NONCE_SALT',       '`f?4Z4 Ks`51V7xM.XBc%UMRuhzO%/8p4`%LE>eh4.ff9LMFy8Vhwj6Dn[wx]d(#');


/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

/*Increase PHP Memory to 1G*/
define('WP_MEMORY_LIMIT', '1G');
