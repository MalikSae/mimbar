<?php
$file = 'lang/ar/app.php';
$content = file_get_contents($file);
$text = "
    // --- DONASI INSTRUKSI ---
    'donasi_instruksi.page_title' => 'تعليمات الدفع',
    'donasi_instruksi.hampir_selesai' => 'على وشك الانتهاء، جزاكم الله خيرا',
    'donasi_instruksi.niat_baik' => 'نيتكم الطيبة لبرنامج',
    'donasi_instruksi.telah_dicatat' => 'قد تم تسجيلها. يرجى إكمال الدفع وفقا للتعليمات أدناه.',
    'donasi_instruksi.total_transfer' => 'إجمالي المبلغ المطلوب تحويله',
    'donasi_instruksi.kode_unik_1' => '*يشمل الرمز الفريد',
    'donasi_instruksi.kode_unik_2' => 'للتحقق التلقائي.',
    'donasi_instruksi.transfer_ke' => 'تحويل إلى حساب:',
    'donasi_instruksi.kode_bank' => 'رمز البنك:',
    'donasi_instruksi.salin' => 'نسخ',
    'donasi_instruksi.tersalin' => 'تم النسخ',
    'donasi_instruksi.atas_nama' => 'باسم:',
    'donasi_instruksi.hubungi_admin' => 'اتصل بالمسؤول للحصول على معلومات الحساب.',
    'donasi_instruksi.selesaikan_dalam' => 'أكمل الدفع خلال:',
    'donasi_instruksi.waktu_habis' => 'انتهى وقت الدفع',
    'donasi_instruksi.sudah_transfer' => 'هل قمت بالتحويل؟',
    'donasi_instruksi.deteksi_otomatis' => 'عادةً ما يكتشف نظامنا تلقائيًا في غضون 5 دقائق. إذا لم تتغير الحالة في غضون ساعة واحدة، يرجى التأكيد يدويًا.',
    'donasi_instruksi.konfirmasi_wa' => 'التأكيد عبر واتساب',
    'donasi_instruksi.ayat_quran' => '\"قُلْ هَٰذِهِ سَبِيلِي أَدْعُو إِلَى اللَّهِ ۚ عَلَىٰ بَصِيرَةٍ أَنَا وَمَنِ اتَّبَعَنِي...\"',
    'donasi_instruksi.ayat_surah' => '(سورة يوسف: ١٠٨)',
    'donasi_instruksi.doa_penutup' => 'نسأل الله أن يجعل هذه الصدقة في ميزان حسناتكم في الآخرة. آمين.',
    'donasi_instruksi.wa_text' => 'السلام عليكم، لقد قمت بتحويل التبرع لبرنامج :program. الاسم: :nama، إجمالي التحويل: روبية :total، الرمز الفريد: :kode',
];
";
$content = preg_replace('/];\s*$/', $text, $content);
file_put_contents($file, $content);
echo "Done AR translation append.\n";
