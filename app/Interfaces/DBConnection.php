<?php

namespace App\Interfaces;

abstract class DBConnection
{
  public abstract function connect($config);
}
