<?php
/*
 * This file is part of the FileConverter package.
 *
 * (c) Greg Payne
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FileConverter\Engine;

class Invalid extends EngineBase {
  public function convertFile($source, $destination) {
    return $this;
  }

  protected function getHelpInstallation($os, $os_version) {
    return array(
      'title' => "Invalid engine configuration provided.",
    );
  }

  public function isAvailable() {
    return FALSE;
  }

}