<?php

use Coalition\ConfigRepository;

$config = new ConfigRepository();


$config->set('paths', ['base' => 'path', 'app' => 'path'])
        ->set('options', ['foo' => 'bar']);

 print_r($config->config_array);