<?php
$files = [
    'resources/views/admin/news/index.blade.php',
    'resources/views/admin/news/form.blade.php'
];
foreach($files as $f) {
    if (file_exists($f)) {
        $c = file_get_contents($f);
        $c = str_replace('admin.articles.', 'admin.news.', $c);
        $c = str_replace('Artikel', 'Berita', $c);
        $c = str_replace('artikel', 'berita', $c);
        file_put_contents($f, $c);
        echo "Processed $f\n";
    }
}
