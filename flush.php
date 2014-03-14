<?php
    str_pad(" ", 300);
    for($i = 0; $i < 2; $i++) {
        print "this ing";
        flush();
        ob_flush();
        echo $i;
        sleep(5);
    }