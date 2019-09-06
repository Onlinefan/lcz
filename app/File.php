<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

/**
 * Class File model for table files
 * @package App
 */
class File extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public function createFile(UploadedFile $file, $path, $name)
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->isDirectory($path)) {
            $fileSystem->makeDirectory($path, 0755, true, true);
        }

        $file->move($path, $name . '.' . $file->getClientOriginalExtension());
        $this->path = $path;
        $this->file_name = $name . '.' . $file->getClientOriginalExtension();
        $this->save();
        return $this;
    }

    public static function createName($projectName)
    {
        return 'D' . uniqid() . '_' . substr($projectName, 0, 5) . '_' .date('Y');
    }
}
