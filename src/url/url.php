<?php

// Naranza Sesto - https://naranza.org
// SPDX-License-Identifier: MPL-2.0
// Copyright (c) Andrea Davanzo and contributors

declare(strict_types=1);

class sesto_url
{
  public string $id = '';
  public string $scheme = '';
  public string $host = '';
  public int $port = 0;
  public string $fullhost = '';
  public string $base = '';
  public string $path = '';
  public string $relative = '';
  public string $dirname = '';
  public string $filename = '';
  public string $basename = '';
  public string $extension = '';
}
