<?php
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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'Eurasia' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NDtP<{D+c0$E9@FWcbHdZ>]Py?T+H<4g%nB^uB&f+uZ67KMq6,CpO|fz-F-wylX ' );
define( 'SECURE_AUTH_KEY',  'MB*2{a`o0v.E9&pXUI$BQS%_G}J`>iG]Tj+cqe7 (RDj$LygvUKHo>B,u`~@-[W?' );
define( 'LOGGED_IN_KEY',    'H|klI.j%l0Jg/d!!],:x{-dO_$iCMk5}7 4s>3,+5^X}&>[7Wukk1(8h9/YU];v&' );
define( 'NONCE_KEY',        'g9uw B}o2HQe7H-ewL):}S!1IH#7AK=G1K~JtQ{YmHqa,_2]A.n0_ehAUa[{X<pL' );
define( 'AUTH_SALT',        'am,sm;kWiwqHm5M:7CwHs8rZ3M[<mIe%f5idG6v1CykY&~HQ)X+]N2as=K0S%ZE(' );
define( 'SECURE_AUTH_SALT', 'l,DY.?WoAiWc)?U+BMh2%eb+uH~KmWj)C. ]p-+<9ml=lTPxM<@i,K249s sP2?A' );
define( 'LOGGED_IN_SALT',   'B~4}M;`3gr%OaUoS-Z]~gA@8QSbmER%|Aq]3>C[]KH)A%[`F`i?=o&V_Mf<M0HFx' );
define( 'NONCE_SALT',       ']#^q3;F@c;B]UT})U[(fR)>S>`C/9:av)hx5jMb:/86dgK23tb%2kjepS5p{/[}w' );

/**#@-*/

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
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
