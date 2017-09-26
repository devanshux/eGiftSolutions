<?php
mkdir("test",0777);
mkdir("../test2",0777);
echo chmod("test",0777);
echo chmod("../test2",0777);
?>