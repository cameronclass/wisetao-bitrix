<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/bitrix/templates/main-wisetao/assets/images/";
$logFile = $_SERVER['DOCUMENT_ROOT'] . "/bitrix/templates/main-wisetao/assets/images/compress_log.txt";

file_put_contents($logFile, "=== Начало сжатия ===\n", FILE_APPEND);

function getImages($dir, &$images = [])
{
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === "." || $file === "..")
            continue;
        $path = $dir . "/" . $file;
        if (is_dir($path)) {
            getImages($path, $images);
        } elseif (preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
            $images[] = $path;
        }
    }
    return $images;
}

function compressImage($source, $quality = 60)
{
    global $logFile;

    if (!file_exists($source)) {
        file_put_contents($logFile, "Файл не найден: $source\n", FILE_APPEND);
        return false;
    }

    $info = getimagesize($source);
    file_put_contents($logFile, "Обрабатываем: $source ({$info['mime']})\n", FILE_APPEND);

    if ($info['mime'] == 'image/jpeg') {
        // Оптимизация JPEG с jpegoptim
        $command = "jpegoptim --strip-all --max=$quality --all-progressive " . escapeshellarg($source);
        exec($command);
        file_put_contents($logFile, "JPEG сжат (jpegoptim): $source\n", FILE_APPEND);
        return true;
    } elseif ($info['mime'] == 'image/png') {
        // Оптимизация PNG с pngquant
        $compressedFile = $source . "-compressed.png";
        $command = "pngquant --quality=50-60 --speed 1 --output " . escapeshellarg($compressedFile) . " -- " . escapeshellarg($source);
        exec($command);

        if (file_exists($compressedFile)) {
            rename($compressedFile, $source);
            file_put_contents($logFile, "PNG сжат (pngquant): $source\n", FILE_APPEND);
            return true;
        }
    } else {
        file_put_contents($logFile, "НЕПОДДЕРЖИВАЕМЫЙ ФОРМАТ: $source\n", FILE_APPEND);
    }
    return false;
}


$images = getImages($uploadDir);

if (!$images) {
    file_put_contents($logFile, "Файлы не найдены!\n", FILE_APPEND);
} else {
    foreach ($images as $image) {
        compressImage($image);
    }
}

file_put_contents($logFile, "✅ Сжатие завершено!\n", FILE_APPEND);

echo "Готово! Проверь `/bitrix/templates/assets/images/compress_log.txt`";
?>