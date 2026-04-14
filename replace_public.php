<?php
$files = [
    'resources/views/berita/index.blade.php',
    'resources/views/berita/show.blade.php'
];
foreach($files as $f) {
    if (file_exists($f)) {
        $c = file_get_contents($f);
        $c = str_replace('artikel.', 'berita.', $c);
        $c = str_replace('Artikel', 'Berita', $c);
        $c = str_replace('artikel', 'berita', $c);
        file_put_contents($f, $c);
        echo "Processed $f\n";
    }
}
