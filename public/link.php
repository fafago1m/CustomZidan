<?php
$target = __DIR__ . '/storage/app/public';  // Folder asli penyimpanan file
$link = __DIR__ . '/public/storage';        // Lokasi link simbolik yang diakses publik

if (file_exists($link)) {
    echo "Symlink sudah ada.\n";
} else {
    if (symlink($target, $link)) {
        echo "Symlink berhasil dibuat.\n";
    } else {
        echo "Gagal membuat symlink.\n";
    }
}
?>
