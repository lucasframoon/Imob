<?php

namespace App\Entity;

class Upload
{

    private $name;
    private $extension; //sem o ponto
    private $type; //tipo mime
    private $tmpName; //nome temporário do arquivo
    private $error; //codigo de erro do upload
    private $size; //tamanho do arquivo


    /**
     * @param array $_FILES[field]
     */
    public function __construct($file)
    {
        $this->type = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];

        $info = pathinfo($file['name']);
        $this->name = $info['filename'];
        $this->extension = $info['extension'];
    }

    /**Retorna o nome do arquivo com sua extensão
     * @return string
     */
    // public function getBaseName()
    // {
    //     $extension = strlen($this->extension) ? '.' . $this->extension : '';
    //     return $this->name . $extension;
    // }

    /**
     * Obtem o nome possivel para o arquivo
     * @return string
     */
    // private function getPossibleBaseName($dir, $overwrite)
    // {
    //    if($overwrite) {
    //        return $this->getBaseName();
    //    }

    //      $baseName = $this->getBaseName();

    //      if(!file_exists($dir .'/'. $baseName)) {
    //          return $baseName;
    //      }


    // }

    /** Gera um nome randomico
     * @return string
     */
    public function generateRandomName()
    {
        $extension = strlen($this->extension) ? '.' . $this->extension : '';

        return md5(uniqid(rand(), true)) . $extension;
    }

    /**
     * Metodo responsável por mover o arquivo de upload
     * @param string $path
     * @param boolean $overwrite
     * @return array [boolean, msg]
     */
    public function upload($dir, $overwrite = false)
    {
        $response = [];

        switch ($this->error) {
            case 0:
                $path = $dir . '/' . $this->generateRandomName();
                $response = move_uploaded_file($this->tmpName, $path) ? ['STATUS' => true, 'MSG' => 'OK', 'PATH' => $path] : ['STATUS' => false, 'MSG' => 'FAIL_MOVE_UPLOADED_FILE'];
                break;
            case 1:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_INITIALIZATION'];
                break;
            case 2:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_FORM_SIZE'];
                break;
            case 3:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_PARTIAL'];
                break;
            case 4:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_NO_FILE'];
                break;
            case 5:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_NO_TMP_DIR'];
                break;
            case 6:
                $response = [false, 'UPLOAD_ERR_CANT_WRITE'];
                break;
            case 7:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_EXTENSION'];
                break;
            default:
                $response = ['STATUS' => false, 'MSG' => 'UPLOAD_ERR_UNKNOWN'];
                break;
        }
        // debugPhp($response);
        return $response;
    }

    public static function deleteFile($fullPath)
    {
        if (file_exists($fullPath)) {
            unlink($fullPath);
        } else {
            return false;
        }
    }
}
