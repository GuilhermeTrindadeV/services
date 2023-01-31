<?php

// Definindo Timezone
date_default_timezone_set('America/Recife');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('ignore_repeated_source', true);
ini_set('log_errors', true);
error_reporting( E_ALL );

set_error_handler(array('Src\Exceptions\ErrorHandler', 'control'), E_ALL);
register_shutdown_function(array('Src\Exceptions\ErrorHandler', 'shutdown'));