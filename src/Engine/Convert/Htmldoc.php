<?php
/*
 * This file is part of the FileConverter package.
 *
 * (c) Greg Payne
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FileConverter\Engine\Convert;

use FileConverter\Engine\EngineBase;
use FileConverter\Util\Shell;
class Htmldoc extends EngineBase {
  protected $cmd_options = array(
    array(
      'name' => 'webpage',
      'mode' => Shell::SHELL_ARG_BOOL_DBL,
      'default' => TRUE,
    ),
    array(
      // Ex: 'pdf'
      'name' => 'format',
      'mode' => Shell::SHELL_ARG_BOOL_DBL,
      'default' => NULL,
    ),
    array(
      'name' => 'top',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '1.0in',
    ),
    array(
      'name' => 'bottom',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '1.0in',
    ),
    array(
      'name' => 'left',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '1.0in',
    ),
    array(
      'name' => 'right',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '1.0in',
    ),
    array(
      'name' => 'fontsize',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '10pt',
    ),
    array(
      'name' => 'footer',
      'mode' => Shell::SHELL_ARG_BASIC_DBL_NOEQUAL,
      'default' => '.',
    ),
  );
  protected $cmd_source_safe = TRUE;

  public function getConvertFileShell($source, &$destination) {
    return array(
      "cat",
      $source,
      Shell::arg('|', Shell::SHELL_SAFE),
      $this->cmd,
      Shell::argOptions($this->cmd_options, $this->configuration, 1),
      Shell::arg('f', Shell::SHELL_ARG_BASIC_SGL, $destination),
      Shell::arg('-', Shell::SHELL_SAFE),
    );
  }

  protected function getHelpInstallation($os, $os_version) {
    $help = array(
      'title' => 'HtmlDoc',
    );
    switch ($os) {
      case 'Ubuntu':
        $help['os'] = 'confirmed on Ubuntu 12.04';
        $help['apt-get'] = 'htmldoc';
        return $help;
    }

    return parent::getHelpInstallation($os, $os_version);
  }

  public function getVersionInfo() {
    $info = array(
        'htmldoc' => $this->shell($this->cmd . " --version")
    );
    return $info;
  }

  public function isAvailable() {
    $this->cmd = $this->shellWhich('htmldoc');
    return isset($this->cmd);
  }
}