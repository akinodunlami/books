<?php

ini_set('date.timezone', 'Europe/London');
define('REQUEST_MICROTIME', microtime(true));

defined('APPLICATION_ENV')  || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'live');
defined('DEBUG_MODE')       || define('DEBUG_MODE', getenv('DEBUG_MODE')           ? getenv('DEBUG_MODE')      : false);
defined('DS')               || define('DS', DIRECTORY_SEPARATOR);