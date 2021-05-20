<?php

namespace Container;

interface Configuration {

  public function getName(): string;

  public function getParameters(): Parameters;
}