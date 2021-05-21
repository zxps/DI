<?php

namespace DI;

interface Configuration {

  public function getName(): string;

  public function getParameters(): Parameters;
}
