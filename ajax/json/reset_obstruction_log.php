<?php
require('../../config.inc.php');

unlink($_CONFIG['results']['obstruction_log']);

echo json_encode(true);
