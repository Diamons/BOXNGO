<?php
        // phpredis_set.php
        $redis=new Redis() or die("Can'f load redis module.");
        $redis->connect('127.0.0.1');
        $redis->set('set_testkey', 1);
var_dump($redis); ?>
