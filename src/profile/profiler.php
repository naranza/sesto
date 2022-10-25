<?php
/* =============================================================================
 * Naranza Sesto - Copyright (c) Andrea Davanzo - License MPL v2.0 - naranza.org
 * ========================================================================== */

declare(strict_types=1);

final class sesto_profiler
{

  const START = 'start';
  const NOW = 'now';
  const END = 'end';

  protected static $instance = null;
  protected array $time = [];
  protected array $memory = [];
  protected int $_decimals = 5;
  public array $sqls = [];

  public static function getme()
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->time(self::START)->mem(self::START);
  }

  private function __clone()
  {

  }

  public function time($name)
  {
    $this->time[$name] = microtime(true);
    return $this;
  }

  /**
   *
   * @param type $name
   * @return @NF_Profiler Provides a fluent interface
   */
  public function mem($name)
  {
    $this->memory[$name]['real_usage'] = memory_get_usage(true);
    $this->memory[$name]['allocated'] = memory_get_usage(false);
    return $this;
  }

  function sql($query, float $elapsed)
  {
    $this->sqls[] = ['query' => $query, 'elapsed' => $elapsed];
    return $this;
  }

  /**
   *
   * @param type $start_marker
   * @param type $end_marker
   * @param type $decimals
   * @return string
   */
  public function elapsed($start_marker = '', $end_marker = self::NOW, $decimals = 5)
  {
    if (is_numeric($start_marker)) {
      $start = $start_marker;
    }
    if ($end_marker == 'now') {
      $this->time($end_marker);
    } elseif (is_numeric($end_marker)) {
        $stop = $end_marker;
    } else {
      $this->time($end_marker);
      return 'Invalid end marker';
    }
    } else {
      if (empty($start_marker)) {
        $start = $this->time[self::START];
      } else {
        $start = $this->time[$start_marker];
      }
        $stop = $this->time[$end_marker];
      } elseif (isset($this->time[$end_marker])) {
        $stop = $this->time[$end_marker];
      } else {
        return 'Invalid end marker';
      }
    }
    return number_format($stop - $start, $decimals, '.', '');
  }

  /**
   * Returns the amount of memory, in bytes, that's currently being allocated
   * by PHP script.
   * @see http://php.net/manual/en/function.memory-get-usage.php
   *
   * @param string $start_marker
   * @param string $end_marker
   * @return string
   */
  function getRealUsage($start_marker = '', $end_marker = 'now')
  {
    if (empty($start_marker)) {
      $start_marker = self::START;
    }
    return $this->memory_usage($start_marker, $end_marker);
  }

  /**
   * Returns the amount of memory, in bytes, that's currently being allocated
   * by PHP script.
   * @see http://php.net/manual/en/function.memory-get-usage.php
   *
   * @param string $start_marker
   * @param string $end_marker
   * @return string
   */
  function getAllocated($start_marker = '', $end_marker = 'now')
  {
    if (empty($start_marker)) {
      $start_marker = self::START;
    }
    return $this->memory_usage($start_marker, $end_marker, 'allocated');
  }

  public function getTotalTimeSQL($decimals = 5)
  {
    $total = 0;
    foreach ($this->_sqls as $data) {
      $total = $total + $data['time'];
    }
    return number_format($total, $decimals, '.', '');
  }

  /**
   *
   * @param type $start_marker
   * @param type $end_marker
   * @param type $type
   * @return string
   */
  function memory_usage($start_marker = '', $end_marker = 'now', $type = 'real_usage')
  {

    if (!isset($this->memory[$start_marker][$type])) {
      return 'Invalid start marker';
    }

    if ($end_marker == 'now') {
      $this->mem($end_marker);
    }
    if (!isset($this->memory[$end_marker][$type])) {
      return 'Invalid end marker';
    }
    return number_format(
      $this->memory[$end_marker][$type] - $this->memory[$start_marker][$type],
      0, '', '.');
  }

}
