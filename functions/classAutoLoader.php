<?php
function classAutoLoader($classname) {
    include_once "./classes/" . $classname . ".php";
}