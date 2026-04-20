@extends('layouts.app')

@section('title', __('app.pustaka.title'))

@push('head')
<style>
/* ============================================
   PUSTAKA DIGITAL â€” INDEX (Katalog E-Book)
   Semua warna via CSS token, NO hardcode hex
   ============================================ */

/* Reset & base */
*, *::before, *::after { box-sizing: border-box; }

.pustaka-page {
    font-family: var(--font-body);
    background-color: var(--color-muted);
    color: var(--color-gray-900);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}


/* ---- HERO SECTION ---- */
.hero-pustaka {
    padding: 80px 0 96px 0;
    background-color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}
.hero-pustaka::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.07;
    background-image: radial-gradient(var(--color-white) 1px, transparent 1px);
    background-size: 20px 20px;
}
.hero-pustaka::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.10);
}
.hero-pustaka-inner {
    position: relative;
    z-index: 10;
    text-align: center;
    max-width: 800px;
    padding: 0 24px;
    margin-top: 16px;
}
.hero-pustaka-inner h1 {
    font-family: var(--font-heading);
    font-size: 36px;
    font-weight: 700;
    color: var(--color-white);
    margin-bottom: 12px;
}
.hero-pustaka-inner p {
    color: rgba(255,255,255,0.90);
    font-size: 16px;
    margin-bottom: 16px;
    max-width: 560px;
    margin-inline: auto;
}
.breadcrumb-hero {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: rgba(255,255,255,0.75);
    font-size: 13px;
    font-weight: 500;
}
.breadcrumb-hero span:last-child {
    color: var(--color-white);
    font-weight: 600;
}

/* ---- SEARCH & FILTER BAR ---- */
.search-filter-wrap {
    position: relative;
    z-index: 20;
    max-width: 1200px;
    margin: -32px auto 40px;
    padding: 0 24px;
}
.search-filter-card {
    background: var(--color-white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--color-border);
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
@media (min-width: 768px) {
    .search-filter-card {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}
.search-box {
    display: flex;
    align-items: center;
    background: var(--color-muted);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 10px 16px;
    gap: 10px;
    width: 100%;
}
@media (min-width: 768px) { .search-box { width: 350px; flex-shrink: 0; } }
.search-box iconify-icon { color: var(--color-gray-400); flex-shrink: 0; }
.search-box input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    color: var(--color-gray-900);
    width: 100%;
    font-family: var(--font-body);
}
.search-box input::placeholder { color: var(--color-gray-400); }

.filter-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.filter-tab {
    background: var(--color-muted);
    color: var(--color-gray-600);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-full);
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    font-family: var(--font-heading);
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.15s ease;
}
.filter-tab:hover {
    background: var(--color-primary-light);
    color: var(--color-primary);
    border-color: var(--color-primary);
}
.filter-tab.active-tab {
    background: var(--color-primary);
    color: var(--color-white);
    border-color: var(--color-primary);
    font-weight: 700;
}

/* ---- SECTION FEATURED ---- */
.section-featured {
    background: transparent;
    padding-bottom: 40px;
    padding-top: 16px;
}
.section-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}
.section-title-bordered {
    font-family: var(--font-heading);
    font-size: 28px;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 32px;
    border-bottom: 1px solid var(--color-border);
    padding-bottom: 16px;
}

.featured-card {
    background: var(--color-white);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--color-border);
    box-shadow: 0 8px 30px rgba(0,0,0,0.04);
    padding: 48px;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 48px;
    align-items: center;
}
.featured-cover-wrap {
    position: relative;
    width: 220px;
    flex-shrink: 0;
}
.featured-cover-wrap img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 0 6px 6px 0;
    box-shadow: 12px 16px 30px rgba(0,0,0,0.18);
    border-left: 3px solid var(--color-border);
}
.featured-cover-spine {
    position: absolute;
    inset-block: 0;
    left: 0;
    width: 3px;
    background: linear-gradient(to right, rgba(0,0,0,0.15), transparent);
}

.category-badge {
    display: inline-block;
    background: var(--color-warning-surface);
    color: var(--color-warning);
    padding: 4px 12px;
    border-radius: var(--radius-sm);
    font-size: 11px;
    font-weight: 700;
    font-family: var(--font-heading);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 16px;
}

.featured-title {
    font-family: var(--font-heading);
    font-size: 32px;
    font-weight: 700;
    color: var(--color-gray-900);
    line-height: 1.3;
    margin-bottom: 12px;
}
.featured-author {
    color: var(--color-gray-600);
    font-size: 15px;
    font-weight: 500;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.featured-author iconify-icon { color: var(--color-primary); }
.featured-desc {
    font-size: 16px;
    color: var(--color-gray-600);
    line-height: 1.75;
    margin-bottom: 32px;
    max-width: 600px;
}

.btn-primary-lg {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--color-primary);
    color: var(--color-white);
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 16px;
    padding: 14px 32px;
    border-radius: var(--radius-lg);
    border: none;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    transition: background 0.15s ease;
}
.btn-primary-lg:hover { background: var(--color-primary-dark); }

/* ---- KATALOG GRID ---- */
.section-catalog {
    background: transparent;
    padding-bottom: 80px;
}
.catalog-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
}
.catalog-header h2 {
    font-family: var(--font-heading);
    font-size: 28px;
    font-weight: 700;
    color: var(--color-gray-900);
}
.catalog-count {
    font-size: 13px;
    color: var(--color-gray-600);
    font-weight: 500;
}

.ebook-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}
@media (max-width: 1024px) { .ebook-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px)  { .ebook-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .ebook-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; } }

.ebook-card {
    background: var(--color-white);
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    padding: 20px;
    box-shadow: var(--shadow-card);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: box-shadow 0.2s ease;
}
.ebook-card:hover { box-shadow: var(--shadow-md); }

.ebook-cover-wrap {
    width: 85%;
    margin: 0 auto 16px;
    position: relative;
    overflow: hidden;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    border-left: 2px solid var(--color-border);
    box-shadow: 6px 8px 16px rgba(0,0,0,0.12);
}
.ebook-cover-wrap img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
    aspect-ratio: 3/4;
}
.ebook-category-badge {
    font-size: 10px;
    font-weight: 700;
    font-family: var(--font-heading);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--color-warning);
    text-align: center;
    margin-bottom: 8px;
}
.ebook-title {
    font-family: var(--font-heading);
    font-size: 15px;
    font-weight: 700;
    color: var(--color-gray-900);
    line-height: 1.4;
    text-align: center;
    margin-bottom: 0;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.ebook-title a {
    text-decoration: none;
    color: inherit;
    transition: color 0.15s ease;
}
.ebook-title a:hover { color: var(--color-primary); }

.btn-outline-primary {
    display: inline-flex;
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
    transition: all 0.15s ease;
}
.btn-outline-primary:hover {
    background: var(--color-primary-light);
}

/* Pagination */
.pagination-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 48px;
}
.pagination-wrap .page-link,
.pagination-wrap a,
.pagination-wrap span.page-link {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-md);
    border: 1px solid var(--color-border);
    background: var(--color-white);
    color: var(--color-gray-600);
    font-size: 14px;
    font-weight: 500;
    font-family: var(--font-heading);
    text-decoration: none;
    transition: all 0.15s ease;
}
.pagination-wrap a:hover {
    background: var(--color-primary-light);
    border-color: var(--color-primary);
    color: var(--color-primary);
}
.pagination-wrap .active > .page-link,
.pagination-wrap span.active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: var(--color-white);
    font-weight: 700;
}
.pagination-wrap .disabled span,
.pagination-wrap .disabled a {
    color: var(--color-gray-400);
    pointer-events: none;
    opacity: 0.5;
}

/* ---- SUPPORT CTA ---- */
.section-cta {
    background: transparent;
    padding: 64px 0;
}
.cta-inner {
    background: var(--color-primary);
    border-radius: var(--radius-2xl);
    padding: 40px;
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
    .cta-inner { flex-direction: row; }
}
.cta-inner::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.08;
    background-image: radial-gradient(var(--color-white) 1px, transparent 1px);
    background-size: 18px 18px;
}
.cta-text-group {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 16px;
    max-width: 600px;
}
@media (min-width: 768px) {
    .cta-text-group { flex-direction: row; align-items: flex-start; text-align: left; }
}
.cta-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-full);
    background: rgba(255,255,255,0.1);
    color: var(--color-accent, #D4AF37);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.cta-text-group p {
    font-size: 16px;
    font-weight: 500;
    color: var(--color-white);
    line-height: 1.6;
    margin-bottom: 0;
}
.cta-btn-gold {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--color-accent, #D4AF37);
    color: var(--color-gray-900);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 15px;
    padding: 14px 28px;
    border-radius: var(--radius-lg);
    border: none;
    cursor: pointer;
    white-space: nowrap;
    box-shadow: var(--shadow-md);
    flex-shrink: 0;
    text-decoration: none;
    transition: all 0.15s;
}
.cta-btn-gold:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(212,175,55,0.3); }

/* ---- FOOTER ---- */
.site-footer {
    background-color: var(--color-footer);
    color: var(--color-white);
    padding-top: 64px;
    padding-bottom: 24px;
    position: relative;
    overflow: hidden;
}
.site-footer::before {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0.05;
    pointer-events: none;
    background-image: repeating-linear-gradient(45deg, var(--color-white) 0, var(--color-white) 1px, transparent 1px, transparent 24px),
                      repeating-linear-gradient(-45deg, var(--color-white) 0, var(--color-white) 1px, transparent 1px, transparent 24px);
}
.footer-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    margin-bottom: 48px;
    position: relative;
    z-index: 1;
}
@media (max-width: 768px) { .footer-grid { grid-template-columns: repeat(2, 1fr); } }
.footer-logo { height: 56px; width: auto; margin-bottom: 16px; }
.footer-desc {
    color: rgba(255,255,255,0.75);
    font-size: 13px;
    line-height: 1.7;
    margin-bottom: 24px;
}
.footer-social { display: flex; gap: 10px; }
.footer-social-icon {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-full);
    border: 1px solid rgba(255,255,255,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-white);
    text-decoration: none;
}
.footer-col h4 {
    font-family: var(--font-heading);
    font-size: 13px;
    font-weight: 700;
    color: var(--color-white);
    margin-bottom: 16px;
}
.footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.footer-col ul li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    color: rgba(255,255,255,0.75);
    font-size: 13px;
}
.footer-col ul li a {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
}
.footer-col ul li a:hover { color: var(--color-white); }
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.10);
    padding-top: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: rgba(255,255,255,0.55);
    font-size: 12px;
    position: relative;
    z-index: 1;
}

/* ---- MODAL DOWNLOAD ---- */
.modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(22, 22, 42, 0.55);
    backdrop-filter: blur(4px);
    z-index: 200;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.modal-box {
    background: var(--color-white);
    width: 100%;
    max-width: 500px;
    border-radius: var(--radius-2xl);
    box-shadow: 0 24px 80px rgba(0,0,0,0.18);
    display: flex;
    flex-direction: column;
    max-height: 90vh;
    overflow-y: auto;
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

/* ---- INFAQ INSTRUCTIONS OVERLAY ---- */
.infaq-overlay {
    position: fixed;
    inset: 0;
    background: var(--color-muted);
    z-index: 150;
    overflow-y: auto;
    padding: 48px 24px 80px;
}
.infaq-overlay-inner {
    max-width: 700px;
    margin: 0 auto;
}
.infaq-status-icon {
    width: 80px;
    height: 80px;
    background: var(--color-success);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-white);
    margin: 0 auto 24px;
    border: 4px solid var(--color-white);
    box-shadow: var(--shadow-md);
}
.infaq-heading {
    font-family: var(--font-heading);
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 16px;
    line-height: 1.3;
    text-align: center;
}
.infaq-subtext {
    font-size: 17px;
    color: var(--color-gray-600);
    max-width: 620px;
    margin: 0 auto 32px;
    line-height: 1.65;
    text-align: center;
}
.payment-card {
    background: var(--color-white);
    border-radius: var(--radius-2xl);
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    border: 1px solid var(--color-border);
    padding: 40px;
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
}
.payment-card-topbar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--color-primary);
}
.payment-total-label {
    font-size: 15px;
    font-weight: 500;
    color: var(--color-gray-600);
    margin-bottom: 8px;
    text-align: center;
}
.payment-total-amount {
    font-family: var(--font-heading);
    font-size: 48px;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 16px;
    text-align: center;
}
.unique-code-badge {
    display: inline-flex;
    align-items: flex-start;
    gap: 8px;
    background: var(--color-warning-surface);
    color: var(--color-warning);
    border: 1px solid rgba(227,98,9,0.25);
    padding: 10px 16px;
    border-radius: var(--radius-lg);
    font-size: 13px;
    font-weight: 500;
    text-align: left;
    margin-bottom: 32px;
}
.payment-divider {
    border: none;
    border-top: 1px solid var(--color-border);
    margin-bottom: 24px;
}
.bank-label { font-size: 13px; color: var(--color-gray-600); font-weight: 500; margin-bottom: 12px; }
.bank-box {
    background: var(--color-muted);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.bank-header {
    display: flex;
    align-items: center;
    gap: 12px;
}
.bank-logo-box {
    width: 48px;
    height: 48px;
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 12px;
    color: var(--color-primary);
    flex-shrink: 0;
    box-shadow: var(--shadow-card);
}
.bank-name-wrap h4 {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 15px;
    color: var(--color-gray-900);
    margin-bottom: 2px;
}
.bank-name-wrap p { font-size: 13px; color: var(--color-gray-400); }

.account-number-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 14px 16px;
    gap: 12px;
    flex-wrap: wrap;
}
.account-number-text {
    font-family: monospace;
    font-size: 22px;
    font-weight: 700;
    color: var(--color-gray-900);
    letter-spacing: 0.06em;
}
.btn-copy {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--color-primary);
    border: 1px solid var(--color-primary);
    background: transparent;
    padding: 8px 20px;
    border-radius: var(--radius-md);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.15s;
}
.btn-copy:hover { background: var(--color-primary-light); }

.account-name-row {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 12px 16px;
    font-size: 13px;
    color: var(--color-gray-600);
}
.account-name-row strong { color: var(--color-gray-900); }

.countdown-wrap {
    background: var(--color-danger-surface);
    color: var(--color-danger);
    border: 1px solid rgba(192,57,43,0.15);
    border-radius: var(--radius-xl);
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    font-size: 15px;
    font-weight: 500;
    margin-top: 8px;
}
.countdown-value {
    font-family: monospace;
    font-size: 20px;
    font-weight: 700;
}

/* Ebook status card */
.ebook-status-card {
    background: var(--color-page-bg);
    border: 1px solid rgba(212,175,55,0.25);
    border-radius: var(--radius-xl);
    padding: 32px;
    text-align: center;
    box-shadow: var(--shadow-card);
    margin-bottom: 32px;
}
.ebook-status-icon {
    width: 64px;
    height: 64px;
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-warning);
    margin: 0 auto 16px;
    box-shadow: var(--shadow-card);
}
.ebook-status-card h3 {
    font-family: var(--font-heading);
    font-size: 19px;
    font-weight: 700;
    color: var(--color-gray-900);
    margin-bottom: 12px;
}
.ebook-status-card p {
    color: var(--color-gray-600);
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 12px;
}
.ebook-status-note {
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 12px 16px;
    font-size: 13px;
    color: var(--color-gray-400);
    margin-bottom: 20px;
}
.btn-wa {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 16px;
    background: var(--color-success);
    color: var(--color-white);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 15px;
    border: none;
    border-radius: var(--radius-lg);
    cursor: pointer;
    box-shadow: var(--shadow-md);
    text-decoration: none;
    transition: opacity 0.15s;
}
.btn-wa:hover { opacity: 0.9; }

/* Quote block */
.hadits-quote-card {
    background: var(--color-white);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-2xl);
    padding: 40px;
    text-align: center;
    position: relative;
    margin-bottom: 24px;
}
.quote-icon-float {
    position: absolute;
    top: -18px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    background: var(--color-warning);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-white);
    border: 4px solid var(--color-muted);
}
.hadits-text {
    font-family: var(--font-arabic);
    font-size: 18px;
    font-style: italic;
    color: var(--color-gray-900);
    line-height: 1.8;
    margin-bottom: 12px;
    margin-top: 8px;
}
.hadits-source {
    font-size: 13px;
    font-weight: 700;
    color: var(--color-warning);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-family: var(--font-heading);
}

/* Toast */
.toast-success {
    position: fixed;
    bottom: 32px;
    right: 32px;
    z-index: 300;
    background: var(--color-success);
    color: var(--color-white);
    padding: 16px 22px;
    border-radius: var(--radius-xl);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    font-family: var(--font-heading);
    animation: slideUp 0.3s ease;
}
@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}

/* ---- RESPONSIVE MEDIA QUERIES ---- */
@media (max-width: 768px) {
    .hero-pustaka {
        padding: 56px 0 64px 0;
    }
    .hero-pustaka-inner h1 { font-size: 28px; }
    .hero-pustaka-inner p { font-size: 15px; }

    .featured-card {
        grid-template-columns: 1fr;
        padding: 32px 24px;
        gap: 32px;
    }
    .featured-cover-wrap {
        margin: 0 auto;
        width: 180px;
    }
    .catalog-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    .footer-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 480px) {
    .modal-body { padding: 20px 16px 8px; }
    .donate-checkbox-wrap { margin: 0 16px 16px; padding: 12px; }
    .nominal-section { margin: 0 16px; padding: 16px 16px 0; }
    .modal-header, .modal-footer { padding: 16px; }

    .ebook-card { padding: 16px; }
    .ebook-card .ebook-cover-wrap { width: 100%; max-width: 140px; }
    
    .footer-grid {
        grid-template-columns: 1fr !important;
        gap: 32px;
    }
}
</style>
@endpush

@section('content')
<div class="pustaka-page"
     x-data="{
        showModal: false,
        showSuccess: false,
        showInfaqInstructions: false,
        showFreeDownloadSuccess: false,
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
                const now = Date.now();
                const diff = expired - now;
                if (diff <= 0) {
                    this.countdownDisplay = '00 : 00 : 00';
                    clearInterval(this._countdownTimer);
                    return;
                }
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
        }
     }"
>


{{-- ======================== HERO ======================== --}}
<section class="hero-pustaka">
    <div class="hero-pustaka-inner" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
        <h1>{{ __('app.pustaka.hero_title') }}</h1>
        <p>{{ __('app.pustaka.hero_desc') }}</p>
        <div class="breadcrumb-hero">
            <span>{{ __('app.pustaka.breadcrumb_home') }}</span>
            <iconify-icon icon="{{ app()->getLocale() === 'ar' ? 'lucide:chevron-left' : 'lucide:chevron-right' }}" width="14"></iconify-icon>
            <span>{{ __('app.pustaka.breadcrumb_current') }}</span>
        </div>
    </div>
</section>

{{-- ======================== SEARCH & FILTER ======================== --}}
<section class="search-filter-wrap">
    <div class="search-filter-card">
        {{-- Search --}}
        <form method="GET" action="{{ route('ebooks.index') }}" style="display:flex;align-items:center;gap:16px;flex:1;flex-wrap:wrap;">
            <div class="search-box" style="flex:1;min-width:240px;">
                <iconify-icon icon="lucide:search" width="18"></iconify-icon>
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="{{ __('app.pustaka.search_placeholder') }}">
            </div>
            @if(request('kategori') && request('kategori') !== 'semua')
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <button type="submit" style="display:none;"></button>
        </form>

        {{-- Filter Tabs --}}
        <div class="filter-tabs" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <a href="{{ route('ebooks.index', array_merge(request()->except('kategori', 'page'), ['kategori' => 'semua'])) }}"
               class="filter-tab {{ request('kategori', 'semua') === 'semua' ? 'active-tab' : '' }}">
                {{ __('app.pustaka.filter_all') }}
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('ebooks.index', array_merge(request()->except('kategori', 'page'), ['kategori' => $cat])) }}"
               class="filter-tab {{ request('kategori') === $cat ? 'active-tab' : '' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================== FEATURED / REKOMENDASI ======================== --}}
@if($featured)
<section class="section-featured">
    <div class="section-container" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
        <h2 class="section-title-bordered">{{ __('app.pustaka.featured_title') }}</h2>

        <div class="featured-card">
            {{-- Cover --}}
            <div class="featured-cover-wrap">
                <div class="featured-cover-spine"></div>
                <img src="{{ $featured->cover_image ? asset('storage/' . $featured->cover_image) : 'https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book' }}"
                     alt="{{ $featured->title }}"
                     onerror="this.src='https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book'">
            </div>

            {{-- Info --}}
            <div @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                @if($featured->category)
                <span class="category-badge">{{ $featured->category }}</span>
                @endif
                <h3 class="featured-title"><bdi>{{ $featured->title }}</bdi></h3>
                <p class="featured-author">
                    <iconify-icon icon="lucide:pen-tool" width="16"></iconify-icon>
                    {{ __('app.pustaka.featured_author_prefix') }} {{ $featured->author ?? __('app.pustaka.featured_author_default') }}
                </p>
                @if($featured->description)
                <p class="featured-desc"><bdi>{{ Str::limit($featured->description, 220) }}</bdi></p>
                @endif
                <button class="btn-primary-lg"
                        @click="openModal('{{ $featured->slug }}', '{{ addslashes($featured->title) }}')">
                    <iconify-icon icon="lucide:download" width="18"></iconify-icon>
                    {{ __('app.pustaka.btn_download') }}{{ $featured->file_size ? ' (' . $featured->file_size . ')' : '' }}
                </button>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ======================== KATALOG GRID ======================== --}}
<section class="section-catalog">
    <div class="section-container">
        <div class="catalog-header" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <h2>{{ __('app.pustaka.catalog_title') }}</h2>
            @if($ebooks->total() > 0)
            <div class="catalog-count">
                {{ __('app.pustaka.catalog_showing') }} {{ $ebooks->firstItem() }}–{{ $ebooks->lastItem() }} {{ __('app.pustaka.catalog_of') }} {{ $ebooks->total() }} {{ __('app.pustaka.catalog_books') }}
            </div>
            @endif
        </div>

        @if($ebooks->count() > 0)
        <div class="ebook-grid" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            @foreach($ebooks as $ebook)
            <div class="ebook-card">
                <div class="ebook-cover-wrap">
                    <img src="{{ $ebook->cover_image ? asset('storage/' . $ebook->cover_image) : 'https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book' }}"
                         alt="{{ $ebook->title }}"
                         onerror="this.src='https://placehold.co/200x280/e5e7eb/9ca3af?text=E-Book'">
                </div>
                @if($ebook->category)
                <div class="ebook-category-badge">{{ $ebook->category }}</div>
                @endif
                <h4 class="ebook-title">
                    <a href="{{ route('ebooks.show', $ebook->slug) }}"><bdi>{{ $ebook->title }}</bdi></a>
                </h4>
                <a href="{{ route('ebooks.show', $ebook->slug) }}" class="btn-outline-primary" style="text-decoration: none; display: inline-flex; justify-content: center; align-items: center;">
                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                    {{ __('app.pustaka.btn_detail') }}
                </a>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            {{ $ebooks->appends(request()->query())->links() }}
        </div>

        @else
        <div style="text-align:center;padding:80px 24px;color:var(--color-gray-400);">
            <iconify-icon icon="lucide:book-open" width="48" style="margin-bottom:16px;opacity:0.4;"></iconify-icon>
            <p style="font-size:16px;font-weight:500;">{{ __('app.pustaka.empty') }}</p>
        </div>
        @endif
    </div>
</section>

{{-- ======================== CTA BAWAH ======================== --}}
<section class="section-cta">
    <div class="section-container">
        <div class="cta-inner" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="cta-text-group">
                <div class="cta-icon-wrap">
                    <iconify-icon icon="lucide:book-heart" width="24"></iconify-icon>
                </div>
                <p>{{ __('app.pustaka.cta_text') }}</p>
            </div>
            <a href="{{ route('donations.index') }}" class="cta-btn-gold">
                {{ __('app.pustaka.cta_btn') }}
                <iconify-icon icon="{{ app()->getLocale() === 'ar' ? 'lucide:arrow-left' : 'lucide:arrow-right' }}" width="16"></iconify-icon>
            </a>
        </div>
    </div>
</section>


{{-- ======================== MODAL DOWNLOAD ======================== --}}
<div x-show="showModal" x-cloak class="modal-backdrop" @click.self="showModal = false"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="modal-box" @click.stop
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

        {{-- Header --}}
        <div class="modal-header" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="modal-header-left">
                <div class="modal-header-icon">
                    <iconify-icon icon="lucide:file-text" width="20"></iconify-icon>
                </div>
                <h2>{{ __('app.pustaka.modal_title') }}</h2>
            </div>
            <button class="modal-close" @click="showModal = false">
                <iconify-icon icon="lucide:x" width="18"></iconify-icon>
            </button>
        </div>

        {{-- Body --}}
        <div class="modal-body" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="input-group">
                <label class="input-label">{{ __('app.pustaka.modal_name') }}</label>
                <input type="text" class="input-field" x-model="name" placeholder="Hamba Allah">
            </div>
            <div class="input-group">
                <label class="input-label">{{ __('app.pustaka.modal_wa') }}</label>
                <div class="input-wa-wrap" @if(app()->getLocale() === 'ar') dir="ltr" @endif>
                    <span class="input-wa-prefix" @if(app()->getLocale() === 'ar') style="border-right:none;border-left:1px solid var(--color-border);" @endif>+62</span>
                    <input type="tel" class="input-wa-field" x-model="whatsapp" placeholder="81234567890" @if(app()->getLocale() === 'ar') style="text-align:right;" @endif>
                </div>
                <p class="input-hint">
                    <iconify-icon icon="lucide:info" width="13" style="flex-shrink:0;margin-top:1px;"></iconify-icon>
                    <span>{{ __('app.pustaka.modal_wa_hint') }}</span>
                </p>
            </div>
        </div>

        {{-- Checkbox Infaq --}}
        <div class="donate-checkbox-wrap" @click="wantDonate = !wantDonate" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="checkbox-indicator" :class="{ 'checked': wantDonate }">
                <iconify-icon x-show="wantDonate" icon="lucide:check" width="13"></iconify-icon>
            </div>
            <div class="donate-label">
                <h4>{{ __('app.pustaka.modal_donate_title') }}</h4>
                <p>{{ __('app.pustaka.modal_donate_desc') }}</p>
            </div>
        </div>

        {{-- Pilihan Nominal (muncul jika centang) --}}
        <div x-show="wantDonate" x-cloak class="nominal-section"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <p class="nominal-section-label">{{ __('app.pustaka.modal_nominal_label') }}</p>
            <div class="nominal-grid">
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 25000 }"
                        @click="donationAmount = 25000">Rp 25.000</button>
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 50000 }"
                        @click="donationAmount = 50000">Rp 50.000</button>
                <button class="nominal-btn" :class="{ 'active-nominal': donationAmount === 100000 }"
                        @click="donationAmount = 100000">Rp 100.000</button>
                <button class="nominal-btn nominal-other" :class="{ 'active-nominal': donationAmount === 'custom' }"
                        @click="donationAmount = 'custom'">{{ __('app.pustaka.modal_nominal_other') }}</button>
            </div>
            <div x-show="donationAmount === 'custom'" class="custom-amount-field" x-cloak>
                <input type="text" class="input-field" x-model="customAmount" 
                       @input="customAmount = customAmount.toString().replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                       placeholder="{{ __('app.pustaka.modal_nominal_placeholder') }}">
            </div>
        </div>

        {{-- Footer --}}
        <div class="modal-footer" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <button class="btn-modal-submit"
                    @click="submitDownload()"
                    :disabled="loading || !name || !whatsapp">
                <span x-show="loading">
                    <iconify-icon icon="lucide:loader-2" width="18" style="animation:spin 1s linear infinite;"></iconify-icon>
                    {{ __('app.pustaka.modal_processing') }}
                </span>
                <span x-show="!loading" x-text="wantDonate ? '{{ __('app.pustaka.modal_btn_donate') }}' : '{{ __('app.pustaka.modal_btn_free') }}'"></span>
            </button>
        </div>
    </div>
</div>

{{-- ======================== INFAQ INSTRUCTIONS ======================== --}}
<div x-show="showInfaqInstructions" x-cloak class="infaq-overlay"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
    <div class="infaq-overlay-inner">

        {{-- Status header --}}
        <div style="text-align:center;margin-bottom:32px;">
            <div class="infaq-status-icon">
                <iconify-icon icon="lucide:check" width="40"></iconify-icon>
            </div>
            <h1 class="infaq-heading">{{ __('app.pustaka.infaq_heading') }}</h1>
            <p class="infaq-subtext">{{ __('app.pustaka.infaq_subtext') }}</p>
        <        {{-- Payment Card --}}
        <div class="payment-card">
            <div class="payment-card-topbar"></div>
            <p class="payment-total-label">{{ __('app.pustaka.infaq_total_label') }}</p>
            <h2 class="payment-total-amount">Rp <span x-text="formatRupiah(infaqData.total_transfer)"></span></h2>

            <div style="display:flex;justify-content:center;margin-bottom:32px;">
                <div class="unique-code-badge" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                    <iconify-icon icon="lucide:info" width="15" style="flex-shrink:0;margin-top:2px;"></iconify-icon>
                    <span><strong x-text="infaqData.unique_code"></strong> {!! str_replace('*', '', __('app.pustaka.infaq_unique_code')) !!}</span>
                </div>
            </div>

            <hr class="payment-divider">

            <p class="bank-label" @if(app()->getLocale() === 'ar') dir="rtl" @endif>{{ __('app.pustaka.infaq_bank_label') }}</p>
            <div class="bank-box" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="bank-header">
                    <div class="bank-logo-box" x-text="infaqData.bank_code || 'BSI'" @if(app()->getLocale() === 'ar') dir="ltr" @endif></div>
                    <div class="bank-name-wrap">
                        <h4 x-text="infaqData.bank_name"></h4>
                        <p>{{ __('app.pustaka.infaq_bank_code') }} <span x-text="infaqData.bank_code"></span></p>
                    </div>
                </div>

                <div class="account-number-row" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                    <span class="account-number-text" x-text="infaqData.account_number" @if(app()->getLocale() === 'ar') dir="ltr" @endif></span>
                    <button class="btn-copy" @click="navigator.clipboard.writeText(infaqData.account_number)">
                        <iconify-icon icon="lucide:copy" width="15"></iconify-icon>
                        {{ __('app.pustaka.infaq_copy') }}
                    </button>
                </div>

                <div class="account-name-row" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                    <iconify-icon icon="lucide:user" width="15" style="color:var(--color-gray-400);flex-shrink:0;"></iconify-icon>
                    <span>{{ __('app.pustaka.infaq_account_name') }} <strong x-text="infaqData.account_name"></strong></span>
                </div>
            </div>

            <div class="countdown-wrap" style="margin-top:20px;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <iconify-icon icon="lucide:clock" width="20"></iconify-icon>
                <span class="countdown-countdown">{{ __('app.pustaka.infaq_countdown') }} <strong class="countdown-value" x-text="countdownDisplay" @if(app()->getLocale() === 'ar') dir="ltr" @endif></strong></span>
            </div>
        </div>

        {{-- Ebook Status Card --}}
        <div class="ebook-status-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="ebook-status-icon">
                <iconify-icon icon="lucide:download-cloud" width="28"></iconify-icon>
            </div>
            <h3>{{ __('app.pustaka.infaq_ebook_question') }}</h3>
            <p>
                <bdi>"<strong x-text="infaqData.ebook_title"></strong>"</bdi> {{ __('app.pustaka.infaq_ebook_answer') }}
            </p>
            <p class="ebook-status-note">{{ __('app.pustaka.infaq_ebook_note') }}</p>
            <a class="btn-wa" :href="buildWaMessage()" target="_blank" rel="noopener noreferrer">
                <iconify-icon icon="lucide:message-circle" width="20"></iconify-icon>
                {{ __('app.pustaka.infaq_wa_confirm') }}
            </a>
        </div>

        {{-- Hadits Quote --}}
        <div class="hadits-quote-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="quote-icon-float">
                <iconify-icon icon="lucide:quote" width="16"></iconify-icon>
            </div>
            <p class="hadits-text">{{ __('app.pustaka.infaq_hadits') }}</p>
            <p class="hadits-source">{{ __('app.pustaka.infaq_hadits_source') }}</p>
        </div>

        <p style="text-align:center;color:var(--color-gray-600);font-size:16px;font-weight:500;">
            {{ __('app.pustaka.infaq_closing') }}
        </p>

        <div style="text-align:center;margin-top:32px;">
            <a href="{{ route('ebooks.index') }}" class="btn-outline-primary" style="width:auto;display:inline-flex;padding:12px 32px;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                {!! __('app.pustaka.infaq_back') !!}
            </a>
        </div>     </div>
    </div>
</div>

{{-- ======================== FREE DOWNLOAD SUCCESS ======================== --}}
<div x-show="showFreeDownloadSuccess" x-cloak class="infaq-overlay"
     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
    <div class="infaq-overlay-inner">
        <div style="text-align:center;margin-bottom:32px;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <div class="infaq-status-icon">
                <iconify-icon icon="lucide:check" width="40"></iconify-icon>
            </div>
            <h1 class="infaq-heading">{{ __('app.pustaka.free_heading') }}</h1>
            <p class="infaq-subtext">{{ __('app.pustaka.free_subtext_prefix') }} "<strong><span x-text="ebookTitle" @if(app()->getLocale() === 'ar') dir="ltr" @endif></span></strong>" {{ __('app.pustaka.free_subtext_suffix') }}</p>
            
            <div style="margin-top: 32px;">
                <button @click="showFreeDownloadSuccess = false" class="btn-modal-submit" style="display:inline-flex; width:auto; padding:14px 40px; font-size:16px;">
                    {{ __('app.pustaka.free_close') }}
                </button>
            </div>
        </div>

        <div style="text-align:center; border-top: 1px dashed var(--color-border); padding-top: 24px; margin-top: 24px;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <p style="font-size:14px; color:var(--color-gray-500); margin-bottom:12px;">
                {{ __('app.pustaka.free_not_received') }}
            </p>
            <a :href="buildFreeWaMessage()" target="_blank" rel="noopener noreferrer" style="display:inline-flex; align-items:center; gap:6px; color:var(--color-success); font-weight:600; font-size:14px; text-decoration:none;">
                <iconify-icon icon="simple-icons:whatsapp" width="16"></iconify-icon>
                {{ __('app.pustaka.free_contact_admin') }}
            </a>
        </div>
    </div>
</div>

{{-- ======================== TOAST SUKSES ======================== --}}
<div x-show="showSuccess" x-cloak class="toast-success"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     @if(app()->getLocale() === 'ar') dir="rtl" @endif>
    <iconify-icon icon="lucide:check-circle" width="20"></iconify-icon>
    {{ __('app.pustaka.toast_success') }}
</div>

</div><!-- end pustaka-page -->
@endsection

@push('scripts')
<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
@endpush
