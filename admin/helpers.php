<?php
function convertAndSaveToWebp($sourceTmpName, $destinationPath, $quality = 85) {
    // Ensure destination has .webp extension
    $path_info = pathinfo($destinationPath);
    $finalDestination = $path_info['dirname'] . '/' . $path_info['filename'] . '.webp';
    
    // Create directory if it doesn't exist
    if (!file_exists($path_info['dirname'])) {
        mkdir($path_info['dirname'], 0777, true);
    }

    $info = @getimagesize($sourceTmpName);
    if (!$info) {
        // Not an image, just move it
        return move_uploaded_file($sourceTmpName, $destinationPath) ? $destinationPath : false;
    }
    
    $mime = $info['mime'];
    $image = false;

    switch ($mime) {
        case 'image/jpeg':
            $image = @imagecreatefromjpeg($sourceTmpName);
            break;
        case 'image/png':
            $image = @imagecreatefrompng($sourceTmpName);
            if ($image) {
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
            }
            break;
        case 'image/webp':
            // Already webp, just move it
            return move_uploaded_file($sourceTmpName, $finalDestination) ? $finalDestination : false;
        default:
            // Unsupported for webp conversion, just move it
            return move_uploaded_file($sourceTmpName, $destinationPath) ? $destinationPath : false;
    }

    if (!$image) {
        // Fallback
        return move_uploaded_file($sourceTmpName, $destinationPath) ? $destinationPath : false;
    }

    // Save as WebP
    $success = imagewebp($image, $finalDestination, $quality);
    imagedestroy($image);

    if ($success) {
        return $finalDestination;
    }
    
    // Fallback if conversion failed
    return move_uploaded_file($sourceTmpName, $destinationPath) ? $destinationPath : false;
}
?>
