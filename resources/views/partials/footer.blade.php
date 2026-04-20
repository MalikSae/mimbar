<style>
    .footer-grid {
        display: grid;
        grid-template-columns: 1fr 1.6fr 1.1fr 1fr 1fr;
        gap: 32px;
        padding-bottom: 48px;
    }

    @media (max-width: 1023px) {
        .footer-grid {
            grid-template-columns: 1fr !important;
            gap: 32px !important;
            text-align: left;
        }
        .footer-col {
            display: flex;
            flex-direction: column;
            align-items: flex-start !important;
        }
        .footer-col h4 {
            margin-bottom: 12px !important; /* 2. Jarak judul dan konten diperkecil */
        }
        .footer-col ul {
            gap: 8px !important; /* 3. Jarak antar menu diperkecil */
        }
        .footer-logo {
            margin-left: 0;
            margin-right: 0;
        }
        .footer-sosmed {
            justify-content: flex-start !important;
        }
        .footer-contact-list {
            align-items: flex-start !important;
        }
        .footer-map-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }
    }
</style>

<footer style="background-color: var(--color-primary, #8b1a4a); color: white; position: relative; overflow: hidden;">
    <!-- Geometric Pattern Overlay -->
    <div style="position: absolute; inset: 0; opacity: 0.07; background-image: repeating-linear-gradient(45deg, #fff 0px, #fff 1px, transparent 1px, transparent 30px), repeating-linear-gradient(-45deg, #fff 0px, #fff 1px, transparent 1px, transparent 30px); pointer-events: none;"></div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 64px 24px 0; position: relative; z-index: 1;">
        <div class="footer-grid">

            <!-- Col 1: Logo & Sosmed -->
            <div class="footer-col">
                <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-DARK-MODE.png') }}"
                     alt="Yayasan Mimbar Al-Tauhid"
                     class="footer-logo"
                     style="height: 64px; width: auto; margin-bottom: 24px; display: block;">
                <!-- Social Icons -->
                <div class="footer-sosmed" style="display: flex; gap: 12px; margin-bottom: 24px;">
                    <a href="https://wa.me/6282311119499" target="_blank" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <iconify-icon icon="mdi:whatsapp" style="font-size: 18px;"></iconify-icon>
                    </a>
                    <a href="https://www.facebook.com/mimbartauhid" target="_blank" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <iconify-icon icon="mdi:facebook" style="font-size: 18px;"></iconify-icon>
                    </a>
                    <a href="https://www.youtube.com/@mimbartauhid" target="_blank" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <iconify-icon icon="mdi:youtube" style="font-size: 18px;"></iconify-icon>
                    </a>
                    <a href="https://www.instagram.com/mimbartauhid" target="_blank" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <iconify-icon icon="mdi:instagram" style="font-size: 18px;"></iconify-icon>
                    </a>
                    <a href="https://t.me/mimbartauhid" target="_blank" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.12)'">
                        <iconify-icon icon="mdi:telegram" style="font-size: 18px;"></iconify-icon>
                    </a>
                </div>
                <div style="font-size: 13px; color: rgba(255,255,255,0.7); display: flex; flex-wrap: wrap; gap: 20px;">
                    @php
                        $total = is_callable($totalVisitors) ? $totalVisitors() : $totalVisitors;
                        $today = is_callable($todayVisitors) ? $todayVisitors() : $todayVisitors;
                    @endphp
                    <div>
                        <span style="font-weight: 600; color: rgba(255,255,255,0.9);">{{ __('app.footer.visitor') }}: </span>
                        <span>{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: rgba(255,255,255,0.9);">{{ __('app.footer.today') }}: </span>
                        <span>{{ number_format($today, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Col 2: Google Maps -->
            <div class="footer-col">
                <h4 style="font-family: var(--font-heading, inherit); font-size: 16px; font-weight: 700; margin-bottom: 16px; color: white;">{{ __('app.footer.lokasi') }}</h4>
                <div class="footer-map-container" style="border-radius: 10px; overflow: hidden; border: 2px solid rgba(255,255,255,0.15);">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0464083742136!2d106.7996108!3d-6.8850447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68316c5a90247d%3A0x3aa1977e79690a69!2sYayasan%20Mimbar%20Al-Tauhid!5e0!3m2!1sen!2sid!4v1776374056622!5m2!1sen!2sid"
                        width="100%"
                        height="160"
                        style="border:0; display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Col 3: Informasi Kontak -->
            <div class="footer-col">
                <h4 style="font-family: var(--font-heading, inherit); font-size: 16px; font-weight: 700; margin-bottom: 20px; color: white;">{{ __('app.footer.kontak') }}</h4>
                <ul class="footer-contact-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                    <li style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: rgba(255,255,255,0.8);">
                        <iconify-icon icon="lucide:phone" style="font-size: 15px; flex-shrink: 0;"></iconify-icon>
                        <span dir="ltr">+62 266-6545-616</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: rgba(255,255,255,0.8);">
                        <iconify-icon icon="lucide:phone" style="font-size: 15px; flex-shrink: 0;"></iconify-icon>
                        <span dir="ltr">+62 823-1111-9499</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: rgba(255,255,255,0.8);">
                        <iconify-icon icon="lucide:mail" style="font-size: 15px; flex-shrink: 0;"></iconify-icon>
                        <span dir="ltr">info@mimbar.or.id</span>
                    </li>

                </ul>
            </div>

            <!-- Col 4: Media & Pendidikan -->
            <div class="footer-col">
                <h4 style="font-family: var(--font-heading, inherit); font-size: 16px; font-weight: 700; margin-bottom: 20px; color: white;">{{ __('app.footer.media') }}</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                    <li><a href="https://www.youtube.com/@mimbartvid" target="_blank" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Mimbar TV</a></li>
                    <li><a href="https://www.instagram.com/markaz_ibnutaimiyah" target="_blank" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Markaz Ibnu Taimiyah</a></li>
                    <li><a href="#" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Markaz Muadz Bin Jabal</a></li>
                    <li><a href="https://www.instagram.com/mahad_alqurannuroh" target="_blank" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Ma'had Al-Quran Nuroh</a></li>
                </ul>
            </div>

            <!-- Col 5: Program -->
            <div class="footer-col">
                <h4 style="font-family: var(--font-heading, inherit); font-size: 16px; font-weight: 700; margin-bottom: 20px; color: white;">{{ __('app.footer.program') }}</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                    <li><a href="{{ route('program.dakwah') }}" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Dakwah</a></li>
                    <li><a href="{{ route('program.sosial') }}" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Sosial</a></li>
                    <li><a href="{{ route('program.pendidikan') }}" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Pendidikan</a></li>
                    <li><a href="{{ route('program.pembangunan') }}" style="font-size: 14px; color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.8)'">Pembangunan</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div style="border-top: 1px solid rgba(255,255,255,0.15); padding: 20px 0; text-align: center;">
            <p style="font-size: 13px; color: rgba(255,255,255,0.55); margin: 0;">
                &copy; {{ date('Y') }} &middot; Yayasan Mimbar Al-Tauhid. {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}
            </p>
        </div>
    </div>
</footer>
