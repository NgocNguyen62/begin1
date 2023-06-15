<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $fileName;
    public $imageFiles;

    public function rules()
    {
        return [
            ['fileName', 'string'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function save()
    {
      
        if ($this->validate()) { 
          
            foreach ($this->imageFiles as $file) {
                $files = new Files();
                $files->fileName = $this->fileName;
                $path = 'uploads/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $files->path = $path;
                $files->save();
            }
           
            return true;
        } else {
            return false;
        }
    }
    public function saveMF()
    {
      
        if ($this->validate()) { 
            $files = new Files();
            $files->fileName = $this->fileName;
            // $paths = '';
            // foreach ($this->imageFiles as $key => $file) {
            //     if($key != 0){
            //         $paths .= ',';
            //     }
            //     $path = 'uploads/' . $file->baseName . '.' . $file->extension;
            //     $paths .= $path;
            //     $file->saveAs($path);
            // }
            $paths = [];
            foreach ($this->imageFiles as $file) {
                $path = 'uploads/' . $file->baseName . time() . '.' . $file->extension;
                $paths[] = $path;
                $file->saveAs($path);
            }
            $paths = implode(",",$paths);
            $files->path = $path;
            $files->save();
            return true;
        } else {
            return false;
        }
    }
}
