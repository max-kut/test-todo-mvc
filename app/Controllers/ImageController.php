<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.06.18
 * Time: 9:57
 */

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class ImageController
 *
 * @package App\Controllers
 */
class ImageController
{
    const IMAGES_DIR = 'assets/img/';
    
    /**
     * Обработчик загруженного изображения
     */
    public function loadImage()
    {
        $this->checkUploadDirectory(PUBLIC_PATH . self::IMAGES_DIR);
        
        $this->configureImageDriver();
        
        $imgPath = $this->saveImage($_FILES[0]);
        
        // Сохраним в сессию
        $_SESSION['task_image'] = $imgPath;
        
        echo $imgPath;
    }
    
    /**
     * Проверка существования директории для изображений
     *
     * @param $uploadDir
     */
    private function checkUploadDirectory($uploadDir)
    {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777);
        }
    }
    
    /**
     * Настройка драйвера изображений
     */
    private function configureImageDriver()
    {
        Image::configure([
            'driver' => in_array('imagick', get_loaded_extensions()) ? 'imagick' : 'gd',
        ]);
    }
    
    /**
     * @param array $file
     *
     * @return string image url path
     */
    private function saveImage($file)
    {
        /** @var string $ext - расширение */
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        /** @var string $newName - рандомное имя */
        $newName = time() . '_' . substr(md5($file['name'] . time()), 0, 6) . '.' . $ext;
        
        $img = Image::make($file['tmp_name']);
        $img->fit(320, 240);
        $img->save(PUBLIC_PATH . self::IMAGES_DIR . $newName);
        
        return '/' . self::IMAGES_DIR . $newName;
    }
    
    /**
     * Удаление изображения
     */
    public function removeImage()
    {
        unset($_SESSION['task_image']);
        $imagePath = PUBLIC_PATH . substr($_POST['src'], 1);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}