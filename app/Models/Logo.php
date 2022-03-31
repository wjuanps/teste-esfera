<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\HasUuid;

class Logo extends Model {

  use HasFactory, HasUuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'filename',
    'filesize',
    'file_id',
    'mime_type',
    'extension'
  ];

  public function saveLogo(Company $company, $resquestFile) {
    $error = null;
    $logo = null;
    DB::transaction(function () use ($resquestFile, &$error, &$logo, $company) {
      try {
        $file = new LocalFile($resquestFile);

        $logo = $this->create([
          'filename'  => $file->getFileName(),
          'filesize'  => $file->getFileSize(),
          'file_id'   => $file->getFileId(),
          'mime_type' => $file->getFileMimeType(),
          'extension' => $file->getFileExtension()
        ]);

        if ($logo) {
          $patch = $file->saveFile('companies/' . $company->id);

          $logo->patch = $patch;

          $logo->save();
        }
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $logo;
  }

  public function updateLogo(Company $company, $resquestFile) {
    $error = null;
    $logo = null;
    DB::transaction(function () use ($resquestFile, &$error, &$logo, $company) {
      try {
        $file = new LocalFile($resquestFile);

        LocalFile::removeFile(public_path('storage/' . $company->logo->patch));

        $logo = Logo::find($company->logo->id)
          ->update([
            'filename'  => $file->getFileName(),
            'filesize'  => $file->getFileSize(),
            'file_id'   => $file->getFileId(),
            'mime_type' => $file->getFileMimeType(),
            'extension' => $file->getFileExtension()
          ]
        );

        if ($logo) {
          $patch = $file->saveFile('companies/' . $company->id);
          $company->logo->patch = $patch;
          $company->logo->save();
        }
      } catch (\Throwable $th) {
        $error = $th;
      }
    });

    if ($error) {
      return $error;
    }

    return $logo;
  }

  public function company() {
    return $this->belongsTo(Company::class);
  }
}
