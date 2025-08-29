<?php

require_once('dbfunctions.php');

if ( ! requestIsInternal()) {
    echo "<html><body><h1>401: Unauthorized</h1></body></html>";
    http_response_code(401);
    exit(401);
}
