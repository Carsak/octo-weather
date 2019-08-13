<?php

namespace App\File;

use App\Parser;

abstract class File
{
    abstract public function save(Parser $parser);

    abstract public function getDataAsString(Parser $parser);
}