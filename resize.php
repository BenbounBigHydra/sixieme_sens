<?php
function makeSquarePadded($src, $dst) {
    if (!file_exists($src)) {
        echo "File not found: $src\n";
        return;
    }
    $img = imagecreatefrompng($src);
    if (!$img) {
        echo "Could not read png: $src\n";
        return;
    }
    $w = imagesx($img);
    $h = imagesy($img);
    $size = max($w, $h);
    
    $square = imagecreatetruecolor($size, $size);
    imagealphablending($square, false);
    $transparent = imagecolorallocatealpha($square, 0, 0, 0, 127);
    imagefill($square, 0, 0, $transparent);
    imagesavealpha($square, true);
    
    $dst_x = ($size - $w) / 2;
    $dst_y = ($size - $h) / 2;
    
    imagecopy($square, $img, $dst_x, $dst_y, 0, 0, $w, $h);
    imagepng($square, $dst);
    imagedestroy($img);
    imagedestroy($square);
    echo "Padded $src to $dst\n";
}

makeSquarePadded('public/images/hug_icon_Mobile.png', 'public/images/hug_icon_square.png');
makeSquarePadded('public/images/dono_smiling.png', 'public/images/dono_smiling_square.png');
