<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 *
 * @author Juan Soares <wjuan.ps@gmail.com
 */
class LocalFile extends Model {

  public function __construct($file) {
    $explode         = explode('.', $file->getClientOriginalName());
    $this->fileName  = reset($explode);
    $this->fileSize  = (($file->getSize() / 1024) / 1024);
    $this->fileSize  = floatval(number_format($this->fileSize, 2));
    $this->extension = end($explode);
    $this->fileId    = hash('sha256', (time() * ceil(rand(1, 1024))));
    $this->mimeType  = $file->getMimeType();
    $this->file      = $file;
  }

  public function getFileName() {
    return $this->fileName;
  }

  public function getFileExtension() {
    return strtolower($this->extension);
  }

  public function getFileSize() {
    return $this->fileSize;
  }

  public function getFileId() {
    return $this->fileId;
  }

  public function getFileMimeType() {
    return $this->mimeType;
  }

  public function saveFile($path) {
    return $this->file->store($path, 'public');
  }

  public static function removeFile($path) {
    if (file_exists($path)) {
      unlink($path);
    }
  }

  public static function removeDirectory($path) {
    File::deleteDirectory($path);
  }
}
