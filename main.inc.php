<?php
/*
Plugin Name: Download Limits
Version: auto
Description: Limited number of downloads per day
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=
Author: plg
Author URI: https://piwigo.com
*/

if (!defined('PHPWG_ROOT_PATH'))
{
  die('Hacking attempt!');
}

// +-----------------------------------------------------------------------+
// | Define plugin constants                                               |
// +-----------------------------------------------------------------------+

defined('DLIMITS_ID') or define('DLIMITS_ID', basename(dirname(__FILE__)));
define('DLIMITS_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');

// init the plugin
add_event_handler('init', 'dlimits_init');
/**
 * plugin initialization
 *   - check for upgrades
 *   - unserialize configuration
 *   - load language
 */
function dlimits_init()
{
  global $conf, $user;

  $conf['download_limits'] = conf_get_param('download_limits', 5);

  load_language('plugin.lang', dirname(__FILE__).'/');
  load_language('lang', PHPWG_ROOT_PATH.PWG_LOCAL_DIR, array('no_fallback'=>true, 'local'=>true) );
}

add_event_handler('loc_end_picture', 'dlimits_picture');
function dlimits_picture()
{
  global $conf, $template, $user, $picture;

  // count the number of downloads for current user within the last 24 hours
  $query = '
SELECT
    COUNT(*) AS download_count
  FROM '.HISTORY_TABLE.'
  WHERE user_id = '.$user['id'].'
    AND image_type in (\'high\', \'other\')
    AND date = CURRENT_DATE()
;';
  list($download_count) = pwg_db_fetch_row(pwg_query($query));

  if ($download_count >= $conf['download_limits'])
  {
    $template->set_filename('dlimits', realpath(DLIMITS_PATH.'picture.tpl'));
    $template->assign_var_from_handle('PLUGIN_PICTURE_AFTER', 'dlimits');
  }
}

?>
