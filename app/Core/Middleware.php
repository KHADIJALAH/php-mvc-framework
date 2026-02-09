<?php

namespace app\Core;

abstract class Middleware
{
    abstract public function execute(): void;
}
