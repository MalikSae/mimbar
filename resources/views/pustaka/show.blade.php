@extends('layouts.app')

@section('title', $ebook->title . ' — Pustaka Digital Mimbar Al-Tauhid')

@push('head')
<style>
/* ============================================
   PUSTAKA DIGITAL — SHOW (Detail E-Book)
   ============================================ */
*, *::before, *::after { box-sizing: border-box; }

/* ── Prose styling (untuk Sinopsis TipTap) ─────────────────── */
.prose-content { font-size: 16px; color: var(--color-gray-800); line-height: 1.8; }
.prose-content p  { margin-bottom: 20px; }
.prose-content h2 { font-family: var(--font-heading); font-size: 24px; font-weight: 700; color: var(--color-primary); margin-top: 40px; margin-bottom: 16px; }
.prose-content h3 { font-family: var(--font-heading); font-size: 20px; font-weight: 700; color: var(--color-gray-900); margin-top: 32px; margin-bottom: 12px; }
.prose-content h4 { font-family: var(--font-heading); font-size: 18px; font-weight: 700; color: var(--color-gray-900); margin-top: 24px; margin-bottom: 10px; }
.prose-content ul { list-style-type: disc; padding-left: 24px; margin-bottom: 20px; }
.prose-content ol { list-style-type: decimal; padding-left: 24px; margin-bottom: 20px; }
.prose-content li { margin-bottom: 8px; display: list-item; }
.prose-content blockquote {
    border-left: 4px solid var(--color-primary); background-color: var(--color-primary-light);
    padding: 16px 20px; margin: 24px 0; border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic; color: var(--color-gray-700);
}
.prose-content a { color: var(--color-primary); text-decoration: underline; }
.prose-content img { max-width: 100%; border-radius: var(--radius-md); margin: 24px auto; display: block; }
.prose-content strong { font-weight: 700; }
.prose-content em { font-style: italic; }
.prose-content s { text-decoration: line-through; }
.prose-content hr { border: none; border-top: 2px solid var(--color-border); margin: 32px 0; }
/* ────────────────────────────────────────────────────────── */

.pustaka-page {
    font-family: var(--font-body);
    background-color: var(--color-page-bg, var(--color-white));
    color: var(--color-gray-900);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ---- NAVBAR ---- */

/* ---- SECTION CONTAINER ---- */
.section-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* ---- SECTION 1: BOOK PROFILE ---- */
.section-book-profile {
    background: var(--color-white);
    padding: 64px 0;
    flex: 1;
}
.book-profile-grid {
    display: grid;
    grid-template-columns: 30% 70%;
    gap: 48px;
    align-items: start;
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 80px;
}
@media (max-width: 900px) {
    .book-profile-grid {
        grid-template-columns: 1fr;
        padding: 0 24px;
        gap: 32px;
    }
}

/* Book 3D Cover */
.book-cover-3d {
    position: relative;
    width: 100%;
    max-width: 280px;
    margin: 0 auto;
}
.book-cover-inner {
    position: relative;
    box-shadow: 15px 20px 35px rgba(0,0,0,0.22);
    border-radius: 0 8px 8px 0;
    overflow: hidden;
    border-left: 4px solid var(--color-border);
}
.book-cover-inner img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    aspect-ratio: 3/4;
}
.book-spine-1 {
    position: absolute;
    inset-block: 0; left: 0;
    width: 5px;
    background: linear-gradient(to right, rgba(0,0,0,0.25), transparent);
}
.book-spine-2 {
    position: absolute;
    inset-block: 0; left: 5px;
    width: 2px;
    background: rgba(255,255,255,0.4);
}
.book-gloss {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, transparent 50%, rgba(0,0,0,0.06) 100%);
    pointer-events: none;
}

/* Book Info */
.book-info { display: flex; flex-direction: column; }
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--color-gray-400);
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
}
.breadcrumb a { color: inherit; text-decoration: none; }
.breadcrumb a:hover { color: var(--color-primary); }
.breadcrumb span:last-child { color: var(--color-gray-900); }

.category-badge-detail {
    display: inline-block;
    background: var(--color-warning-surface);
    color: var(--color-warning);
    padding: 4px 12px;
    border-radius: var(--radius-sm);
    font-size: 11px;
    font-weight: 700;
    font-family: var(--font-heading);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 16px;
    align-self: flex-start;
}
.book-title {
    font-family: var(--font-heading);
    font-size: 36px;
    font-weight: 700;
    color: var(--color-gray-900);
    line-height: 1.3;
    margin-bottom: 16px;
}
.book-author {
    color: var(--color-primary);
    font-size: 17px;
    font-weight: 500;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.book-meta-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
    background: var(--color-muted);
    border: 1px solid var(--color-border);
    padding: 14px 20px;
    border-radius: var(--radius-xl);
    margin-bottom: 32px;
    width: fit-content;
}
.book-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    color: var(--color-gray-600);
}
.book-meta-item iconify-icon { color: var(--color-gray-400); }
.book-meta-dot {
    width: 4px; height: 4px;
    border-radius: 50%;
    background: var(--color-border);
}
.book-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
@media (min-width: 640px) { .book-actions { flex-direction: row; } }

.btn-primary-lg {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: var(--color-primary);
    color: var(--color-white);
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 15px;
    padding: 14px 28px;
    border-radius: var(--radius-lg);
    border: none;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    text-decoration: none;
    transition: background 0.15s;
    white-space: nowrap;
}
.btn-primary-lg:hover { background: var(--color-primary-dark); }

.btn-outline-lg {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 15px;
    padding: 13px 28px;
    border-radius: var(--radius-lg);
    cursor: pointer;
    text-decoration: none;
    transition: all 0.15s;
    white-space: nowrap;
}
.btn-outline-lg:hover { background: var(--color-primary-light); }

/* ---- SHARE SECTION ---- */
.share-section {
    margin-top: 32px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px dashed var(--color-border);
}
.share-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--color-gray-500);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.share-buttons {
    display: flex;
    gap: 8px;
}
.share-btn {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-white);
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    cursor: pointer;
}
.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.share-wa { background: #25D366; }
.share-fb { background: #1877F2; }
.share-tw { background: #000000; }
.share-copy { background: var(--color-gray-600); }

/* ---- SECTION 2: TABS + CONTENT ---- */
.section-sinopsis {
    background: var(--color-misi-bg, var(--color-muted));
    padding: 64px 0;
}
.sinopsis-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Tab navigation */
.tab-nav {
    display: flex;
    flex-wrap: nowrap;
    gap: 6px;
    border-bottom: 1px solid var(--color-border);
    padding-bottom: 12px;
    margin-bottom: 40px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.tab-nav::-webkit-scrollbar { display: none; }
.tab-btn {
    white-space: nowrap;
    flex-shrink: 0;
    padding: 10px 24px;
    border-radius: var(--radius-full);
    font-size: 14px;
    font-weight: 600;
    font-family: var(--font-heading);
    cursor: pointer;
    border: none;
    background: transparent;
    color: var(--color-gray-600);
    transition: all 0.15s;
}
.tab-btn.active-tab {
    background: var(--color-primary);
    color: var(--color-white);
    box-shadow: var(--shadow-card);
}
.tab-btn:hover:not(.active-tab) {
    background: var(--color-border);
    color: var(--color-gray-900);
}

/* Tab content */
.tab-content { display:none; }
.tab-content.active-tab-content { display:block; }

.sinopsis-text {
    font-size: 17px;
    color: var(--color-gray-900);
    line-height: 1.85;
}
.sinopsis-text p { margin-bottom: 24px; }

.quote-block {
    background: var(--color-misi-bg);
    border-left: 4px solid var(--color-accent, #D4AF37);
    padding: 20px 24px;
    margin: 32px 0;
    border-radius: 0 var(--radius-xl) var(--radius-xl) 0;
}
.quote-block p {
    font-size: 18px;
    color: var(--color-gray-900);
    font-style: italic;
    line-height: 1.7;
    font-family: var(--font-arabic);
    margin: 0;
}

/* Table of contents */
.toc-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.toc-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: var(--radius-lg);
    background: var(--color-white);
    border: 1px solid var(--color-border);
    font-size: 15px;
    color: var(--color-gray-900);
    font-weight: 500;
}
.toc-item-num {
    width: 28px;
    height: 28px;
    border-radius: var(--radius-full);
    background: var(--color-primary-light);
    color: var(--color-primary);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* Author tab */
.author-profile {
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: 32px;
}
.author-name-display {
    font-family: var(--font-heading);
    font-size: 22px;
    font-weight: 700;
    color: var(--color-gray-900);
    margin-bottom: 8px;
}
.author-bio-text {
    font-size: 16px;
    color: var(--color-gray-600);
    line-height: 1.75;
}

/* ---- CTA DALAM SINOPSIS ---- */
.cta-dakwah-banner {
    background: var(--color-primary);
    border-radius: var(--radius-2xl);
    padding: 40px;
    margin-top: 64px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    position: relative;
    overflow: hidden;
}
@media (min-width: 768px) {
    .cta-dakwah-banner { flex-direction: row; }
}
.cta-dakwah-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.08;
    background-image: radial-gradient(var(--color-white) 1px, transparent 1px);
    background-size: 18px 18px;
}
.cta-dakwah-text { position: relative; z-index: 1; flex: 1; }
.cta-dakwah-text h3 {
    font-family: var(--font-heading);
    font-size: 22px;
    font-weight: 700;
    color: var(--color-accent, #D4AF37);
    margin-bottom: 10px;
}
.cta-dakwah-text p {
    color: rgba(255,255,255,0.88);
    font-size: 14px;
    line-height: 1.65;
}
.btn-cta-gold {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--color-accent, #D4AF37);
    color: var(--color-gray-900);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 14px;
    padding: 14px 28px;
    border-radius: var(--radius-lg);
    border: none;
    cursor: pointer;
    white-space: nowrap;
    box-shadow: var(--shadow-md);
    flex-shrink: 0;
    text-decoration: none;
}
.btn-cta-gold:hover { opacity: 0.9; }

/* ---- RELATED BOOKS ---- */
.section-related {
    background: var(--color-white);
    border-top: 1px solid var(--color-border);
    padding: 80px 0;
}
.related-title {
    font-family: var(--font-heading);
    font-size: 28px;
    font-weight: 700;
    color: var(--color-gray-900);
    margin-bottom: 48px;
    text-align: center;
}
.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
}
@media (max-width: 1024px) { .related-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px)  { .related-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .related-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; } }

.related-card {
    background: var(--color-white);
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: box-shadow 0.2s ease;
}
.related-card:hover { box-shadow: var(--shadow-md); }

.related-cover-wrap {
    width: 80%;
    margin: 0 auto 24px;
    position: relative;
    overflow: hidden;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    border-left: 2px solid var(--color-border);
    box-shadow: 8px 8px 16px rgba(0,0,0,0.12);
}
.related-cover-wrap img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    aspect-ratio: 3/4;
}
.related-title-text {
    font-family: var(--font-heading);
    font-size: 16px;
    font-weight: 700;
    color: var(--color-gray-900);
    line-height: 1.4;
    text-align: center;
    flex: 1;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.btn-outline-sm {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    width: 100%;
    padding: 10px;
    margin-top: 16px;
    border: 1px solid var(--color-primary);
    background: transparent;
    color: var(--color-primary);
    font-family: var(--font-heading);
    font-size: 13px;
    font-weight: 600;
    border-radius: var(--radius-lg);
    cursor: pointer;
    transition: all 0.15s;
}
.btn-outline-sm:hover { background: var(--color-primary-light); }

/* ---- FOOTER ---- */

/* ---- MODAL DOWNLOAD (sama persis seperti index) ---- */
.modal-backdrop {
    position: fixed; inset: 0;
    background: rgba(22,22,42,0.55);
    backdrop-filter: blur(4px);
    z-index: 200;
    display: flex; align-items: center; justify-content: center;
    padding: 16px;
}
.modal-box {
    background: var(--color-white);
    width: 100%; max-width: 500px;
    border-radius: var(--radius-2xl);
    box-shadow: 0 24px 80px rgba(0,0,0,0.18);
    display: flex; flex-direction: column;
    max-height: 90vh; overflow-y: auto;
}
.modal-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--color-border);
    display: flex; justify-content: space-between; align-items: center;
    background: var(--color-white);
    position: sticky; top: 0; z-index: 10;
    border-radius: var(--radius-2xl) var(--radius-2xl) 0 0;
}
.modal-header-left { display: flex; align-items: center; gap: 12px; }
.modal-header-icon {
    width: 36px; height: 36px; border-radius: var(--radius-full);
    background: var(--color-primary-light); color: var(--color-primary);
    display: flex; align-items: center; justify-content: center;
}
.modal-header h2 { font-family: var(--font-heading); font-size: 18px; font-weight: 700; color: var(--color-gray-900); }
.modal-close {
    width: 28px; height: 28px; background: var(--color-muted); border: none;
    border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center;
    color: var(--color-gray-400); cursor: pointer; transition: all 0.15s;
}
.modal-close:hover { background: var(--color-border); color: var(--color-gray-900); }
.modal-body { padding: 16px 20px 8px; }
.input-group { margin-bottom: 12px; }
.input-label { display: block; font-size: 13px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 4px; }
.input-field {
    width: 100%; border: 1px solid var(--color-border); border-radius: var(--radius-xl);
    padding: 10px 14px; font-size: 14px; color: var(--color-gray-900);
    font-family: var(--font-body); outline: none; transition: border-color 0.15s;
    background: var(--color-white);
}
.input-field:focus { border-color: var(--color-primary); box-shadow: 0 0 0 2px var(--color-primary-light); }
.input-wa-wrap {
    display: flex; border: 1px solid var(--color-border); border-radius: var(--radius-xl);
    overflow: hidden; transition: border-color 0.15s;
}
.input-wa-wrap:focus-within { border-color: var(--color-primary); box-shadow: 0 0 0 2px var(--color-primary-light); }
.input-wa-prefix { background: var(--color-muted); border-right: 1px solid var(--color-border); padding: 10px 14px; font-size: 13px; font-weight: 700; color: var(--color-gray-600); flex-shrink: 0; }
.input-wa-field { flex: 1; border: none; outline: none; padding: 10px 14px; font-size: 14px; color: var(--color-gray-900); font-family: var(--font-body); background: var(--color-white); }
.input-hint { display: flex; align-items: flex-start; gap: 6px; font-size: 11px; color: var(--color-gray-400); margin-top: 6px; }
.donate-checkbox-wrap {
    margin: 0 20px 12px;
    padding: 12px 16px;
    background: var(--color-page-bg);
    border-radius: var(--radius-xl);
    display: flex; align-items: flex-start; gap: 10px;
    border: 1px solid rgba(212,175,55,0.4);
    cursor: pointer; transition: background 0.15s;
}
.donate-checkbox-wrap:hover { background: #FAF3D0; }
.checkbox-indicator {
    width: 18px; height: 18px; border-radius: 4px;
    border: 2px solid var(--color-border); background: var(--color-white);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 2px; transition: all 0.15s;
}
.checkbox-indicator.checked { background: var(--color-primary); border-color: var(--color-primary); color: var(--color-white); }
.donate-label h4 { font-family: var(--font-heading); font-size: 13px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 2px; }
.donate-label p { font-size: 12px; color: var(--color-gray-600); line-height: 1.4; }
.nominal-section { padding: 16px 20px 0; border-top: 1px dashed rgba(212,175,55,0.5); margin: 0 20px; }
.nominal-section-label { font-size: 13px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 10px; }
.nominal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.nominal-btn {
    padding: 10px 8px; border-radius: var(--radius-xl); border: 1px solid var(--color-border);
    background: var(--color-white); color: var(--color-gray-900);
    font-family: var(--font-heading); font-weight: 700; font-size: 13px;
    cursor: pointer; text-align: center; box-shadow: var(--shadow-card); transition: all 0.15s;
}
.nominal-btn:hover { border-color: var(--color-primary); color: var(--color-primary); }
.nominal-btn.active-nominal { border-color: var(--color-primary); border-width: 2px; background: var(--color-primary-light); color: var(--color-primary); }
.nominal-btn.nominal-other { font-weight: 500; color: var(--color-gray-600); }
.custom-amount-field { margin-top: 10px; }
.custom-amount-field .input-field { text-align: center; font-weight: 700; padding: 10px 14px; }
.modal-footer {
    padding: 12px 20px 16px; background: var(--color-white);
    position: sticky; bottom: 0;
    border-radius: 0 0 var(--radius-2xl) var(--radius-2xl);
    margin-top: 4px;
}
.btn-modal-submit {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 12px 16px;
    background: var(--color-primary); color: var(--color-white);
    font-family: var(--font-heading); font-size: 15px; font-weight: 700;
    border: none; border-radius: var(--radius-lg); cursor: pointer;
    box-shadow: var(--shadow-md); transition: background 0.15s;
}
.btn-modal-submit:hover { background: var(--color-primary-dark); }
.btn-modal-submit:disabled { opacity: 0.55; cursor: not-allowed; }

/* ---- INFAQ OVERLAY ---- */
.infaq-overlay {
    position: fixed; inset: 0;
    background: var(--color-muted);
    z-index: 150; overflow-y: auto;
    padding: 48px 24px 80px;
}
.infaq-overlay-inner { max-width: 700px; margin: 0 auto; }
.infaq-status-icon {
    width: 80px; height: 80px;
    background: var(--color-success); border-radius: var(--radius-full);
    display: flex; align-items: center; justify-content: center;
    color: var(--color-white); margin: 0 auto 24px;
    border: 4px solid var(--color-white); box-shadow: var(--shadow-md);
}
.infaq-heading {
    font-family: var(--font-heading); font-size: 32px; font-weight: 700;
    color: var(--color-primary); margin-bottom: 16px; line-height: 1.3; text-align: center;
}
.infaq-subtext {
    font-size: 17px; color: var(--color-gray-600); max-width: 620px;
    margin: 0 auto 32px; line-height: 1.65; text-align: center;
}
.payment-card {
    background: var(--color-white); border-radius: var(--radius-2xl);
    box-shadow: 0 15px 40px rgba(0,0,0,0.08); border: 1px solid var(--color-border);
    padding: 40px; position: relative; overflow: hidden; margin-bottom: 24px;
}
.payment-card-topbar { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--color-primary); }
.payment-total-label { font-size: 15px; font-weight: 500; color: var(--color-gray-600); margin-bottom: 8px; text-align: center; }
.payment-total-amount { font-family: var(--font-heading); font-size: 48px; font-weight: 700; color: var(--color-primary); margin-bottom: 16px; text-align: center; }
.unique-code-badge {
    display: inline-flex; align-items: flex-start; gap: 8px;
    background: var(--color-warning-surface); color: var(--color-warning);
    border: 1px solid rgba(227,98,9,0.25); padding: 10px 16px;
    border-radius: var(--radius-lg); font-size: 13px; font-weight: 500; text-align: left; margin-bottom: 32px;
}
.payment-divider { border: none; border-top: 1px solid var(--color-border); margin-bottom: 24px; }
.bank-label { font-size: 13px; color: var(--color-gray-600); font-weight: 500; margin-bottom: 12px; }
.bank-box {
    background: var(--color-muted); border: 1px solid var(--color-border);
    border-radius: var(--radius-xl); padding: 20px; display: flex; flex-direction: column; gap: 16px;
}
.bank-header { display: flex; align-items: center; gap: 12px; }
.bank-logo-box {
    width: 48px; height: 48px; background: var(--color-white); border: 1px solid var(--color-border);
    border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center;
    font-family: var(--font-heading); font-weight: 700; font-size: 12px; color: var(--color-primary);
    flex-shrink: 0; box-shadow: var(--shadow-card);
}
.bank-name-wrap h4 { font-family: var(--font-heading); font-weight: 700; font-size: 15px; color: var(--color-gray-900); margin-bottom: 2px; }
.bank-name-wrap p { font-size: 13px; color: var(--color-gray-400); }
.account-number-row {
    display: flex; align-items: center; justify-content: space-between;
    background: var(--color-white); border: 1px solid var(--color-border);
    border-radius: var(--radius-lg); padding: 14px 16px; gap: 12px; flex-wrap: wrap;
}
.account-number-text { font-family: monospace; font-size: 22px; font-weight: 700; color: var(--color-gray-900); letter-spacing: 0.06em; }
.btn-copy {
    display: flex; align-items: center; gap: 8px; color: var(--color-primary);
    border: 1px solid var(--color-primary); background: transparent;
    padding: 8px 20px; border-radius: var(--radius-md); font-family: var(--font-heading);
    font-weight: 700; font-size: 13px; cursor: pointer; white-space: nowrap; transition: all 0.15s;
}
.btn-copy:hover { background: var(--color-primary-light); }
.account-name-row {
    display: flex; align-items: center; gap: 8px;
    background: var(--color-white); border: 1px solid var(--color-border);
    border-radius: var(--radius-lg); padding: 12px 16px; font-size: 13px; color: var(--color-gray-600);
}
.account-name-row strong { color: var(--color-gray-900); }
.countdown-wrap {
    background: var(--color-danger-surface); color: var(--color-danger);
    border: 1px solid rgba(192,57,43,0.15); border-radius: var(--radius-xl);
    padding: 14px 20px; display: flex; align-items: center; justify-content: center;
    gap: 12px; font-size: 15px; font-weight: 500; margin-top: 8px;
}
.countdown-value { font-family: monospace; font-size: 20px; font-weight: 700; }
.ebook-status-card {
    background: var(--color-page-bg); border: 1px solid rgba(212,175,55,0.25);
    border-radius: var(--radius-xl); padding: 32px; text-align: center;
    box-shadow: var(--shadow-card); margin-bottom: 32px;
}
.ebook-status-icon {
    width: 64px; height: 64px; background: var(--color-white);
    border: 1px solid var(--color-border); border-radius: var(--radius-full);
    display: flex; align-items: center; justify-content: center; color: var(--color-warning);
    margin: 0 auto 16px; box-shadow: var(--shadow-card);
}
.ebook-status-card h3 { font-family: var(--font-heading); font-size: 19px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; }
.ebook-status-card p { color: var(--color-gray-600); font-size: 14px; line-height: 1.7; margin-bottom: 12px; }
.ebook-status-note { background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 12px 16px; font-size: 13px; color: var(--color-gray-400); margin-bottom: 20px; }
.btn-wa {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 16px; background: var(--color-success); color: var(--color-white);
    font-family: var(--font-heading); font-weight: 700; font-size: 15px;
    border: none; border-radius: var(--radius-lg); cursor: pointer; box-shadow: var(--shadow-md);
    text-decoration: none; transition: opacity 0.15s;
}
.btn-wa:hover { opacity: 0.9; }
.hadits-quote-card {
    background: var(--color-white); border: 1px solid var(--color-border);
    border-radius: var(--radius-2xl); padding: 40px; text-align: center;
    position: relative; margin-bottom: 24px;
}
.quote-icon-float {
    position: absolute; top: -18px; left: 50%; transform: translateX(-50%);
    width: 40px; height: 40px; background: var(--color-accent, #D4AF37);
    border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center;
    color: var(--color-white); border: 4px solid var(--color-muted);
}
.hadits-text { font-family: var(--font-arabic); font-size: 18px; font-style: italic; color: var(--color-gray-900); line-height: 1.8; margin-bottom: 12px; margin-top: 8px; }
.hadits-source { font-size: 13px; font-weight: 700; color: var(--color-accent, #D4AF37); text-transform: uppercase; letter-spacing: 0.06em; font-family: var(--font-heading); }
.toast-success {
    position: fixed; bottom: 32px; right: 32px; z-index: 300;
    background: var(--color-success); color: var(--color-white);
    padding: 16px 22px; border-radius: var(--radius-xl);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    display: flex; align-items: center; gap: 10px;
    font-size: 14px; font-weight: 600; font-family: var(--font-heading);
    animation: slideUp 0.3s ease;
}
@keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

/* ---- RESPONSIVE MEDIA QUERIES ---- */
@media (max-width: 480px) {
    .modal-body { padding: 20px 16px 8px; }
    .donate-checkbox-wrap { margin: 0 16px 16px; padding: 12px; }
    .nominal-section { margin: 0 16px; padding: 16px 16px 0; }
    .modal-header, .modal-footer { padding: 16px; }

    .related-card { padding: 16px; }
    .related-card .related-cover-wrap { width: 100%; max-width: 140px; }

    .book-title { font-size: 26px; }
}
</style>
@endpush

@php
    // Parse table_of_contents yang disimpan sebagai JSON
    $toc = [];
    if ($ebook->table_of_contents) {
        $decoded = json_decode($ebook->table_of_contents, true);
        if (is_array($decoded)) {
            $toc = $decoded;
        } else {
            $toc = array_filter(array_map('trim', explode("\n", $ebook->table_of_contents)));
        }
    }

    $publishedYear = $ebook->year ?? now()->year;
@endphp

@section('content')
<div class="pustaka-page"
     x-data="{
        showModal: false,
        showSuccess: false,
        showInfaqInstructions: false,
        showFreeDownloadSuccess: false,
        showToast: false,
        toastMessage: '',
        ebookSlug: '',
        ebookTitle: '',
        name: '',
        whatsapp: '',
        wantDonate: false,
        donationAmount: 50000,
        customAmount: '',
        loading: false,
        downloadUrl: '',
        infaqData: {},
        _countdownTimer: null,
        countdownDisplay: '23 : 59 : 59',
        activeTab: 'sinopsis',

        openModal(slug, title) {
            this.ebookSlug = slug;
            this.ebookTitle = title;
            this.showModal = true;
            this.showSuccess = false;
            this.showInfaqInstructions = false;
            this.name = '';
            this.whatsapp = '';
            this.wantDonate = false;
            this.donationAmount = 50000;
            this.customAmount = '';
        },

        async submitDownload() {
            this.loading = true;
            try {
                const amount = this.wantDonate
                    ? (this.donationAmount === 'custom' ? parseInt((this.customAmount || '').toString().replace(/\./g, '')) || 0 : this.donationAmount)
                    : 0;

                const res = await fetch('/pustaka/' + this.ebookSlug + '/download', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        name: this.name,
                        whatsapp: this.whatsapp,
                        want_donate: this.wantDonate,
                        donation_amount: amount,
                    })
                });

                const data = await res.json();
                this.loading = false;

                if (data.status === 'success') {
                    this.showModal = false;
                    this.infaqData = data || {};
                    this.showFreeDownloadSuccess = true;
                } else if (data.status === 'infaq') {
                    this.showModal = false;
                    this.infaqData = data;
                    this.showInfaqInstructions = true;
                    this._startCountdown(data.expired_at);
                } else {
                    alert(data.message || 'Terjadi kesalahan.');
                }
            } catch (e) {
                this.loading = false;
                console.error(e);
            }
        },

        _startCountdown(expiredAt) {
            if (this._countdownTimer) clearInterval(this._countdownTimer);
            const expired = new Date(expiredAt).getTime();
            const update = () => {
                const diff = expired - Date.now();
                if (diff <= 0) { this.countdownDisplay = '00 : 00 : 00'; clearInterval(this._countdownTimer); return; }
                const h = Math.floor(diff / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                const pad = n => String(n).padStart(2, '0');
                this.countdownDisplay = pad(h) + ' : ' + pad(m) + ' : ' + pad(s);
            };
            update();
            this._countdownTimer = setInterval(update, 1000);
        },

        formatRupiah(n) {
            if (!n && n !== 0) return '0';
            return Number(n).toLocaleString('id-ID');
        },

        buildWaMessage() {
            const d = this.infaqData;
            const msg = 'Assalamualaikum, saya sudah transfer infaq untuk e-book ' + (d.ebook_title || '') + '. Nama: ' + (this.name || '') + ', No. Transfer: Rp ' + this.formatRupiah(d.total_transfer);
            const wa = (d.wa_admin || '').replace(/[^0-9]/g, '');
            return 'https://wa.me/' + wa + '?text=' + encodeURIComponent(msg);
        },

        buildFreeWaMessage() {
            const msg = 'Assalamu\'alaikum Admin, saya ingin mengonfirmasi pengiriman link download e-book gratis %22' + (this.ebookTitle || '') + '%22 atas nama ' + (this.name || '') + '. Terima kasih.';
            const waRaw = (this.infaqData && this.infaqData.wa_admin) ? this.infaqData.wa_admin : '6282311119499';
            const wa = String(waRaw).replace(/[^0-9]/g, '');
            return 'https://wa.me/' + wa + '?text=' + msg;
        },

        copyLink() {
            let text = window.location.href;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).catch(() => {});
            } else {
                let textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                document.body.appendChild(textArea);
                textArea.select();
                try { document.execCommand('copy'); } catch (err) {}
                document.body.removeChild(textArea);
            }
            this.toastMessage = 'Tautan berhasil disalin!';
            this.showToast = true;
            setTimeout(() => { this.showToast = false; }, 3000);
        }
     }"
>


{{-- ======================== SECTION 1: BOOK PROFILE ======================== --}}
<section class="section-book-profile">
    <div class="book-profile-grid">
        {{-- Kiri: Cover 3D --}}
        <div class="book-cover-3d">
            <div class="book-cover-inner">
                <img src="{{ $ebook->cover_image ? asset('storage/' . $ebook->cover_image) : 'https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book' }}"
                     alt="{{ $ebook->title }}"
                     onerror="this.src='https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book'">
                <div class="book-spine-1"></div>
                <div class="book-spine-2"></div>
                <div class="book-gloss"></div>
            </div>
        </div>

        {{-- Kanan: Informasi --}}
        <div class="book-info">
            {{-- Breadcrumb --}}
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Beranda</a>
                <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
                <a href="{{ route('ebooks.index') }}">Pustaka Digital</a>
                <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
                <span>{{ $ebook->category ?? 'Koleksi' }}</span>
            </div>

            {{-- Badge Kategori --}}
            @if($ebook->category)
            <span class="category-badge-detail">{{ $ebook->category }}</span>
            @endif

            {{-- Judul --}}
            <h1 class="book-title">{{ $ebook->title }}</h1>

            {{-- Penulis --}}
            <p class="book-author">
                <iconify-icon icon="lucide:pen-tool" width="17"></iconify-icon>
                Oleh: {{ $ebook->author ?? 'Tim Penulis Mimbar Al-Tauhid' }}
            </p>

            {{-- Meta Info --}}
            <div class="book-meta-row">
                @if($ebook->page_count)
                <div class="book-meta-item">
                    <iconify-icon icon="lucide:file-text" width="15"></iconify-icon>
                    {{ number_format($ebook->page_count) }} Halaman
                </div>
                <div class="book-meta-dot"></div>
                @endif
                @if($ebook->file_size)
                <div class="book-meta-item">
                    <iconify-icon icon="lucide:download" width="15"></iconify-icon>
                    PDF - {{ $ebook->file_size }}
                </div>
                <div class="book-meta-dot"></div>
                @endif
                <div class="book-meta-item">
                    <iconify-icon icon="lucide:calendar" width="15"></iconify-icon>
                    {{ \Carbon\Carbon::createFromDate($publishedYear, 1, 1)->translatedFormat('Y') }}
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="book-actions">
                <button class="btn-primary-lg"
                        @click="openModal('{{ $ebook->slug }}', '{{ addslashes($ebook->title) }}')">
                    <iconify-icon icon="lucide:download-cloud" width="19"></iconify-icon>
                    Unduh PDF Gratis
                </button>
                @if($ebook->preview_url)
                <a href="{{ $ebook->preview_url }}" target="_blank" rel="noopener noreferrer" class="btn-outline-lg">
                    <iconify-icon icon="lucide:eye" width="19"></iconify-icon>
                    Preview / Baca Online
                </a>
                @endif
            </div>

            {{-- Share --}}
            <div class="share-section">
                <span class="share-label">Bagikan:</span>
                <div class="share-buttons">
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode('Unduh e-book Islami gratis: ' . $ebook->title . ' di ' . Request::url()) }}" target="_blank" class="share-btn share-wa" title="Bagikan ke WhatsApp">
                        <iconify-icon icon="simple-icons:whatsapp" width="18"></iconify-icon>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="share-btn share-fb" title="Bagikan ke Facebook">
                        <iconify-icon icon="simple-icons:facebook" width="18"></iconify-icon>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ rawurlencode('Unduh e-book Islami gratis: ' . $ebook->title) }}&url={{ urlencode(Request::url()) }}" target="_blank" class="share-btn share-tw" title="Bagikan ke X (Twitter)">
                        <iconify-icon icon="simple-icons:x" width="16"></iconify-icon>
                    </a>
                    <button type="button" class="share-btn share-copy" title="Salin Tautan"
                            @click="copyLink()">
                        <iconify-icon icon="lucide:link" width="18"></iconify-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================== SECTION 2: TABS ======================== --}}
<section class="section-sinopsis">
    <div class="sinopsis-container">

        {{-- Tab Header --}}
        <div class="tab-nav">
            <button class="tab-btn" :class="activeTab === 'sinopsis' ? 'active-tab' : ''"
                    @click="activeTab = 'sinopsis'">Sinopsis</button>
            <button class="tab-btn" :class="activeTab === 'daftarisi' ? 'active-tab' : ''"
                    @click="activeTab = 'daftarisi'">Daftar Isi</button>
            <button class="tab-btn" :class="activeTab === 'penulis' ? 'active-tab' : ''"
                    @click="activeTab = 'penulis'">Profil Penulis</button>
        </div>

        {{-- Tab: Sinopsis --}}
        <div x-show="activeTab === 'sinopsis'" x-cloak
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="sinopsis-text prose-content">
                @if($ebook->synopsis)
                    <div>
                        {!! $ebook->synopsis !!}
                    </div>
                @elseif($ebook->description)
                    <p>{{ $ebook->description }}</p>
                @else
                    <p>Sinopsis belum tersedia untuk e-book ini.</p>
                @endif

                @if($ebook->quote)
                <div class="quote-block">
                    <p>{{ $ebook->quote }}</p>
                </div>
                @endif
            </div>

            {{-- CTA Banner --}}
            <div class="cta-dakwah-banner">
                <div class="cta-dakwah-text">
                    <h3>Dukung Program Distribusi Buku Islam</h3>
                    <p>Ikut ambil bagian dalam mencetak dan mendistribusikan lebih banyak literatur dakwah gratis ke masjid, pesantren, perpustakaan, dan masyarakat pelosok di seluruh Indonesia.</p>
                </div>
                <button class="btn-cta-gold"
                        @click="openModal('{{ $ebook->slug }}', '{{ addslashes($ebook->title) }}'); wantDonate = true;">
                    Infaq Dakwah &amp; Literasi
                </button>
            </div>
        </div>

        {{-- Tab: Daftar Isi --}}
        <div x-show="activeTab === 'daftarisi'" x-cloak
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            @if(count($toc) > 0)
            <ul class="toc-list">
                @foreach($toc as $index => $chapter)
                <li class="toc-item">
                    <span class="toc-item-num">{{ $index + 1 }}</span>
                    <span>{{ is_array($chapter) ? ($chapter['title'] ?? json_encode($chapter)) : $chapter }}</span>
                </li>
                @endforeach
            </ul>
            @else
            <div style="text-align:center;padding:48px 24px;color:var(--color-gray-400);">
                <iconify-icon icon="lucide:list" width="40" style="margin-bottom:12px;opacity:0.4;"></iconify-icon>
                <p>Daftar isi belum tersedia.</p>
            </div>
            @endif
        </div>

        {{-- Tab: Profil Penulis --}}
        <div x-show="activeTab === 'penulis'" x-cloak
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="author-profile">
                <h3 class="author-name-display">{{ $ebook->author ?? 'Tim Penulis Mimbar Al-Tauhid' }}</h3>
                <p class="author-bio-text">
                    {{ $ebook->author ?? 'Tim Penulis' }} adalah bagian dari tim riset dan penulisan Yayasan Mimbar Al-Tauhid yang berdedikasi dalam memproduksi literatur Islami berkualitas berdasarkan Al-Qur'an dan As-Sunnah sesuai pemahaman Salafussholih.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ======================== SECTION 3: KOLEKSI SERUPA ======================== --}}
@if($related->count() > 0)
<section class="section-related">
    <div class="section-container">
        <h2 class="related-title">Koleksi Serupa Lainnya</h2>
        <div class="related-grid">
            @foreach($related as $rel)
            <div class="related-card">
                <div class="related-cover-wrap">
                    <img src="{{ $rel->cover_image ? asset('storage/' . $rel->cover_image) : 'https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book' }}"
                         alt="{{ $rel->title }}"
                         onerror="this.src='https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book'">
                </div>
                <h4 class="related-title-text">{{ $rel->title }}</h4>
                <button class="btn-outline-sm"
                        @click="openModal('{{ $rel->slug }}', '{{ addslashes($rel->title) }}')">
                    <iconify-icon icon="lucide:download" width="14"></iconify-icon>
                    Unduh
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ======================== MODAL DOWNLOAD ======================== --}}
<div x-show="showModal" x-cloak class="modal-backdrop" @click.self="showModal = false"
     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="modal-box" @click.stop
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

        <div class="modal-header">
            <div class="modal-header-left">
                <div class="modal-header-icon">
                    <iconify-icon icon="lucide:file-text" width="20"></iconify-icon>
                </div>
                <h2>Unduh Literatur Digital</h2>
            </div>
            <button class="modal-close" @click="showModal = false">
                <iconify-icon icon="lucide:x" width="18"></iconify-icon>
            </button>
        </div>

        <div class="modal-body">
            <div class="input-group">
                <label class="input-label">Nama Lengkap</label>
                <input type="text" class="input-field" x-model="name" placeholder="Hamba Allah">
            </div>
            <div class="input-group">
                <label class="input-label">Nomor WhatsApp</label>
                <div class="input-wa-wrap">
                    <span class="input-wa-prefix">+62</span>
                    <input type="tel" class="input-wa-field" x-model="whatsapp" placeholder="81234567890">
                </div>
                <p class="input-hint">
                    <iconify-icon icon="lucide:info" width="13" style="flex-shrink:0;margin-top:1px;"></iconify-icon>
                    <span>Link download akan dikirimkan otomatis ke WhatsApp Anda.</span>
                </p>
            </div>
        </div>

        <div class="donate-checkbox-wrap" @click="wantDonate = !wantDonate">
            <div class="checkbox-indicator" :class="{ 'checked': wantDonate }">
                <iconify-icon x-show="wantDonate" icon="lucide:check" width="13"></iconify-icon>
            </div>
            <div class="donate-label">
                <h4>Saya ingin mendukung program tebar buku Islam (Dukung Dakwah)</h4>
                <p>Bantu kami mencetak dan mendistribusikan buku dakwah gratis ke pelosok negeri.</p>
            </div>
        </div>

        <div x-show="wantDonate" x-cloak class="nominal-section"
             x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <p class="nominal-section-label">Pilih Nominal Infaq Terbaik</p>
            <div class="nominal-grid">
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 25000 }" @click="donationAmount = 25000">Rp 25.000</button>
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 50000 }" @click="donationAmount = 50000">Rp 50.000</button>
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 100000 }" @click="donationAmount = 100000">Rp 100.000</button>
                <button class="nominal-btn nominal-other" :class="{ 'active-nominal': donationAmount === 'custom' }" @click="donationAmount = 'custom'">Nominal Lain</button>
            </div>
            <div x-show="donationAmount === 'custom'" class="custom-amount-field" x-cloak>
                <input type="text" class="input-field" x-model="customAmount" 
                       @input="customAmount = customAmount.toString().replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                       placeholder="Masukkan nominal (Rp)">
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn-modal-submit" @click="submitDownload()" :disabled="loading || !name || !whatsapp">
                <span x-show="loading">
                    <iconify-icon icon="lucide:loader-2" width="18" style="animation:spin 1s linear infinite;"></iconify-icon>
                    Memproses...
                </span>
                <span x-show="!loading" x-text="wantDonate ? 'Lanjutkan Berinfaq &amp; Unduh PDF →' : 'Unduh PDF Gratis →'"></span>
            </button>
        </div>
    </div>
</div>

{{-- ======================== INFAQ INSTRUCTIONS ======================== --}}
<div x-show="showInfaqInstructions" x-cloak class="infaq-overlay"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
    <div class="infaq-overlay-inner">

        <div style="text-align:center;margin-bottom:32px;">
            <div class="infaq-status-icon">
                <iconify-icon icon="lucide:check" width="40"></iconify-icon>
            </div>
            <h1 class="infaq-heading">Jazakumullah Khairan atas Dukungan Anda</h1>
            <p class="infaq-subtext">Niat baik Anda untuk mendukung program cetak dan tebar buku Islam telah kami catat. Silakan selesaikan infaq Anda.</p>
        </div>

        <div class="payment-card">
            <div class="payment-card-topbar"></div>
            <p class="payment-total-label">Total yang Harus Ditransfer</p>
            <h2 class="payment-total-amount">Rp <span x-text="formatRupiah(infaqData.total_transfer)"></span></h2>
            <div style="display:flex;justify-content:center;margin-bottom:32px;">
                <div class="unique-code-badge">
                    <iconify-icon icon="lucide:info" width="15" style="flex-shrink:0;margin-top:2px;"></iconify-icon>
                    <span>*Terdapat kode unik (<strong x-text="infaqData.unique_code"></strong>) untuk mempercepat verifikasi otomatis.</span>
                </div>
            </div>

            <hr class="payment-divider">

            <p class="bank-label">Transfer ke Rekening Tujuan:</p>
            
            <template x-if="infaqData.bank_accounts && infaqData.bank_accounts.length > 0">
                <div style="display:flex; flex-direction:column; gap:16px;">
                    <template x-for="bank in infaqData.bank_accounts" :key="bank.account_number">
                        <div class="bank-box">
                            <div class="bank-header">
                                <div class="bank-logo-box" x-text="bank.bank_code || bank.bank_name.substring(0,3).toUpperCase()"></div>
                                <div class="bank-name-wrap">
                                    <h4 x-text="bank.bank_name"></h4>
                                    <template x-if="bank.bank_code">
                                        <p>Kode Bank: <span x-text="bank.bank_code"></span></p>
                                    </template>
                                </div>
                            </div>

                            <div class="account-number-row" x-data="{ copied: false }">
                                <span class="account-number-text" x-text="bank.account_number"></span>
                                <button class="btn-copy" @click="
                                    let text = bank.account_number;
                                    if (navigator.clipboard && window.isSecureContext) {
                                        navigator.clipboard.writeText(text);
                                    } else {
                                        let textArea = document.createElement('textarea');
                                        textArea.value = text;
                                        textArea.style.position = 'fixed';
                                        document.body.appendChild(textArea);
                                        textArea.select();
                                        try { document.execCommand('copy'); } catch (err) {}
                                        document.body.removeChild(textArea);
                                    }
                                    copied = true; setTimeout(() => copied = false, 3000);
                                ">
                                    <iconify-icon x-show="!copied" icon="lucide:copy" width="15"></iconify-icon>
                                    <iconify-icon x-show="copied" style="display: none;" icon="lucide:check" width="15"></iconify-icon>
                                    <span x-text="copied ? 'Tersalin!' : 'Salin No. Rekening'"></span>
                                </button>
                            </div>

                            <div class="account-name-row">
                                <iconify-icon icon="lucide:user" width="15" style="color:var(--color-gray-400);flex-shrink:0;"></iconify-icon>
                                <span>Atas Nama: <strong x-text="bank.account_name"></strong></span>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
            <template x-if="!infaqData.bank_accounts || infaqData.bank_accounts.length === 0">
                <div class="bank-box text-center" style="align-items: center; justify-content: center; background:var(--color-muted);">
                    <p class="text-gray-600">Hubungi admin untuk informasi rekening.</p>
                </div>
            </template>

            <div class="countdown-wrap" style="margin-top:20px;">
                <iconify-icon icon="lucide:clock" width="20"></iconify-icon>
                <span>Selesaikan pembayaran dalam: <strong class="countdown-value" x-text="countdownDisplay"></strong></span>
            </div>
        </div>

        <div class="ebook-status-card">
            <div class="ebook-status-icon">
                <iconify-icon icon="lucide:download-cloud" width="28"></iconify-icon>
            </div>
            <h3>Bagaimana dengan E-Book Saya?</h3>
            <p>
                Link unduhan PDF "<strong x-text="infaqData.ebook_title"></strong>" akan dikirimkan otomatis ke WhatsApp Anda setelah infaq diverifikasi.
            </p>
            <p class="ebook-status-note">Jika dalam 1 jam link belum masuk atau Anda ingin konfirmasi manual, silakan hubungi admin kami.</p>
            <a class="btn-wa" :href="buildWaMessage()" target="_blank" rel="noopener noreferrer">
                <iconify-icon icon="lucide:message-circle" width="20"></iconify-icon>
                Konfirmasi via WhatsApp
            </a>
        </div>

        <div class="hadits-quote-card">
            <div class="quote-icon-float">
                <iconify-icon icon="lucide:quote" width="16"></iconify-icon>
            </div>
            <p class="hadits-text">"Apabila manusia itu meninggal dunia maka terputuslah segala amalnya kecuali tiga: yaitu sedekah jariyah, ilmu yang bermanfaat, dan anak sholeh yang mendoakan kepadanya."</p>
            <p class="hadits-source">(HR. Muslim)</p>
        </div>

        <p style="text-align:center;color:var(--color-gray-600);font-size:16px;font-weight:500;margin-bottom:32px;">
            Semoga dukungan Anda menjadi pendorong tersebarnya ilmu yang bermanfaat bagi umat.
        </p>

        <div style="text-align:center;">
            <a href="{{ route('ebooks.index') }}" class="btn-outline-sm" style="width:auto;display:inline-flex;padding:12px 32px;">
                ← Kembali ke Katalog
            </a>
        </div>
    </div>
</div>

{{-- ======================== FREE DOWNLOAD SUCCESS ======================== --}}
<div x-show="showFreeDownloadSuccess" x-cloak class="infaq-overlay"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
    <div class="infaq-overlay-inner">
        <div style="text-align:center;margin-bottom:32px;">
            <div class="infaq-status-icon">
                <iconify-icon icon="lucide:check" width="40"></iconify-icon>
            </div>
            <h1 class="infaq-heading">Alhamdulillah, Sukses!</h1>
            <p class="infaq-subtext">Link download e-book "<strong><span x-text="ebookTitle"></span></strong>" akan dikirimkan otomatis melalui pesan WhatsApp ke nomor Anda sesaat lagi.</p>
            
            <div style="margin-top: 32px;">
                <button @click="showFreeDownloadSuccess = false" class="btn-modal-submit" style="display:inline-flex; width:auto; padding:14px 40px; font-size:16px;">
                    Selesai, Tutup Panel
                </button>
            </div>
        </div>

        <div style="text-align:center; border-top: 1px dashed var(--color-border); padding-top: 24px; margin-top: 24px;">
            <p style="font-size:14px; color:var(--color-gray-500); margin-bottom:12px;">
                Belum menerima pesan WA setelah beberapa saat?
            </p>
            <a :href="buildFreeWaMessage()" target="_blank" rel="noopener noreferrer" style="display:inline-flex; align-items:center; gap:6px; color:var(--color-success); font-weight:600; font-size:14px; text-decoration:none;">
                <iconify-icon icon="simple-icons:whatsapp" width="16"></iconify-icon>
                Hubungi Admin Mimbar
            </a>
        </div>
    </div>
</div>

{{-- ======================== TOAST SUKSES ======================== --}}
<div x-show="showSuccess" x-cloak class="toast-success"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <iconify-icon icon="lucide:check-circle" width="20"></iconify-icon>
    Jazakumullah khairan! File sedang diunduh.
</div>

{{-- Toast Share Link --}}
<div x-show="showToast" x-cloak class="toast-success"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <iconify-icon icon="lucide:check-circle" width="20"></iconify-icon>
    <span x-text="toastMessage"></span>
</div>

</div>{{-- end pustaka-page --}}
@endsection
