<?php

use app\Controllers\TaskAsideController;

$task = new TaskAsideController;
?>
<div class="aside w-96 h-full p-2 pt-14 overflow-hidden bg-slate-500 duration-200">
    <div class="x-aside w-max"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg></div>
    <div class="content flex flex-col">
        <?php var_dump($task->getDatasUrl()) ?>
    </div>
</div>