@extends('layouts.app')

@section('title', 'Homepage - Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
/* BASE TOKENS */
:root {
  --primary: var(--color-primary);
  --primary-dark: var(--color-primary-dark);
  --primary-light: var(--color-primary-light);
  --gray-900: var(--color-gray-900);
  --gray-600: var(--color-gray-600);
  --gray-400: var(--color-gray-400);
  --gray-200: var(--color-border);
  --gray-100: var(--color-muted);
  --gray-50: #F9FAFB;
  --white: var(--color-white);
  --footer-bg: var(--color-footer);
  --font-heading: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
  --font-body: 'Inter', system-ui, -apple-system, sans-serif;
  --font-arabic: 'Amiri', serif;
}

body { font-family: var(--font-body); }
h1, h2, h3, h4, h5, h6, .nav-link, .btn, .card-title { font-family: var(--font-heading); }
h1 { font-weight: 700; }
h2, h3, h4, h5, h6 { font-weight: 600; }
.arab, [dir='rtl'], .arabic-verse { font-family: 'Amiri', serif !important; direction: rtl; text-align: right; }

/* DESKTOP CSS */
@media (min-width: 768px) {
  

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    background-color: var(--white);
    color: var(--gray-900);
    font-family: var(--font-body);
    font-size: 16px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-heading);
    color: var(--gray-900);
    line-height: 1.2;
  }

  img {
    max-width: 100%;
    display: block;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .section {
    padding: 80px 0;
  }

  .section-sm {
    padding: 48px 0;
  }

  .section-bg-gray {
    background-color: var(--gray-100);
  }

  .section-bg-primary {
    background-color: var(--primary);
    color: var(--white);
  }

  .section-header {
    text-align: center;
    margin-bottom: 48px;
  }

  .section-header-left {
    text-align: left;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
  }

  .section-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--primary);
    margin-bottom: 12px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .section-bg-primary .section-label {
    color: var(--primary-light);
  }

  .section-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 16px;
  }

  .section-bg-primary .section-title {
    color: var(--white);
  }

  .section-subtitle {
    font-size: 16px;
    color: var(--gray-600);
    max-width: 600px;
    margin: 0 auto;
  }

  .section-header-left .section-subtitle {
    margin: 0;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    padding: 0 24px;
    border-radius: var(--radius-lg);
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    white-space: nowrap;
    gap: 8px;
  }

  .btn-sm {
    height: 40px;
    padding: 0 16px;
    font-size: 14px;
  }

  .btn-primary {
    background-color: var(--primary);
    color: var(--white);
    border: none;
  }

  .btn-white {
    background-color: var(--white);
    color: var(--primary);
    border: none;
  }

  .btn-outline-white {
    background-color: transparent;
    color: var(--white);
    border: 1px solid var(--white);
  }

  .btn-outline-primary {
    background-color: transparent;
    color: var(--primary);
    border: 1px solid var(--primary);
  }
  
  .btn-ghost {
    background-color: transparent;
    color: var(--primary);
    border: none;
    padding: 0 12px;
  }

  .btn-full {
    width: 100%;
  }

  .grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
  }

  .grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
  }
  
  .badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    background: var(--primary-light);
    color: var(--primary);
  }

/* HERO SPLIT LAYOUT */
  .hero {
    display: flex;
    min-height: 520px;
    overflow: hidden;
    position: relative;
  }

  .hero-left {
    flex: 0 0 50%;
    background-color: var(--primary);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 64px 56px 48px 56px;
    overflow: hidden;
  }

  /* Geometric pattern overlay on left */
  .hero-left::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      repeating-linear-gradient(
        45deg,
        rgba(255,255,255,0.03) 0px,
        rgba(255,255,255,0.03) 1px,
        transparent 1px,
        transparent 30px
      ),
      repeating-linear-gradient(
        -45deg,
        rgba(255,255,255,0.03) 0px,
        rgba(255,255,255,0.03) 1px,
        transparent 1px,
        transparent 30px
      );
    pointer-events: none;
  }

  .hero-content {
    position: relative;
    z-index: 1;
    color: var(--white);
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .hero-title {
    font-size: 44px;
    color: var(--white);
    margin-bottom: 20px;
    line-height: 1.2;
    font-weight: 700;
    letter-spacing: -0.01em;
  }

  .hero-desc {
    font-size: 16px;
    color: rgba(255,255,255,0.85);
    margin-bottom: 36px;
    line-height: 1.7;
    max-width: 420px;
  }

  .hero-actions {
    display: flex;
    gap: 16px;
    align-items: center;
  }

  .hero-quote {
    position: relative;
    z-index: 1;
    margin-top: 40px;
    padding-top: 32px;
    border-top: 1px solid rgba(255,255,255,0.15);
  }

  .hero-quote-text {
    font-size: 15px;
    font-style: italic;
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
    margin-bottom: 8px;
  }

  .hero-quote-source {
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.6);
  }

  /* RIGHT — Slideshow */
  .hero-right {
    flex: 0 0 50%;
    position: relative;
    overflow: hidden;
    background: #111;
  }

  .hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1s ease-in-out;
  }

  .hero-slide.active {
    opacity: 1;
  }

  .hero-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .hero-slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.15), transparent);
  }

  .hero-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
  }

  .hero-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    padding: 0;
  }

  .hero-dot.active {
    background: var(--white);
    width: 24px;
    border-radius: 4px;
  }
.stats-section {
    margin-top: -60px;
    position: relative;
    z-index: 10;
    margin-bottom: 64px;
  }

  .stats-bar {
    background-color: var(--white);
    border-radius: var(--radius-2xl);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    padding: 40px;
    border: 1px solid var(--gray-200);
  }

  .stat-card {
    text-align: center;
    padding: 0 16px;
    border-right: 1px solid var(--gray-200);
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .stat-card:last-child {
    border-right: none;
  }
  
  .stat-icon {
    margin-bottom: 12px;
    color: var(--primary);
  }

  .stat-number {
    font-family: var(--font-heading);
    font-size: 40px;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 4px;
    line-height: 1;
  }

  .stat-label {
    font-size: 14px;
    color: var(--gray-600);
    font-weight: 500;
  }

  .stats-note {
    text-align: center;
    font-size: 13px;
    color: var(--gray-400);
    margin-top: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
.program-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-2xl);
    padding: 32px;
    position: relative;
    overflow: hidden;
  }
  
  .program-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gray-200);
  }

  .program-icon {
    width: 56px;
    height: 56px;
    background-color: var(--primary-light);
    color: var(--primary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
  }

  .program-title {
    font-size: 20px;
    margin-bottom: 12px;
  }

  .program-desc {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 24px;
  }
  
  .program-features {
    list-style: none;
    margin-bottom: 24px;
  }
  
  .program-features li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: var(--gray-600);
    margin-bottom: 8px;
  }
  
  .program-features li iconify-icon {
    color: var(--primary);
    margin-top: 2px;
  }
  
  .program-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
    font-family: var(--font-heading);
  }
.tabs-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
  }
  
  .tabs {
    display: flex;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 999px;
    padding: 4px;
  }
  
  .tab {
    padding: 8px 24px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-600);
    cursor: pointer;
  }
  
  .tab.active {
    background: var(--primary);
    color: var(--white);
  }

  .donasi-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  .donasi-img-wrapper {
    position: relative;
  }

  .donasi-img {
    height: 220px;
    width: 100%;
    object-fit: cover;
  }
  
  .donasi-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(4px);
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
  }

  .donasi-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .donasi-title {
    font-size: 18px;
    margin-bottom: 8px;
    line-height: 1.4;
  }

  .donasi-desc {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 24px;
    flex: 1;
  }

  .progress-container {
    margin-bottom: 24px;
  }
  
  .progress-stats {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: var(--gray-600);
    margin-bottom: 8px;
  }
  
  .progress-stats span:first-child {
    color: var(--primary);
    font-weight: 700;
  }

  .progress-bar-bg {
    height: 8px;
    background-color: var(--gray-200);
    border-radius: 999px;
    margin-bottom: 8px;
    overflow: hidden;
  }

  .progress-bar-fill {
    height: 100%;
    background-color: var(--primary);
    border-radius: 999px;
  }

  .progress-info {
    font-size: 13px;
    color: var(--gray-600);
  }

  .progress-info strong {
    color: var(--gray-900);
    font-weight: 600;
  }
.video-section {
    background: var(--gray-900);
    color: var(--white);
    position: relative;
  }
  
  .video-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  
  .video-wrapper {
    width: 100%;
    max-width: 900px;
    height: 500px;
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    margin-top: 48px;
    border: 8px solid rgba(255,255,255,0.1);
  }
  
  .video-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .video-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .play-btn {
    width: 80px;
    height: 80px;
    background: var(--primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 0 0 16px rgba(139, 26, 74, 0.3);
  }
.news-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
  }

  .news-img {
    height: 220px;
    width: 100%;
    object-fit: cover;
  }

  .news-body {
    padding: 24px;
  }

  .news-category {
    display: inline-block;
    padding: 4px 12px;
    border: 1px solid var(--gray-200);
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    color: var(--primary);
    background: var(--primary-light);
    margin-bottom: 16px;
  }

  .news-title {
    font-size: 18px;
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .news-excerpt {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 24px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .news-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid var(--gray-100);
    padding-top: 16px;
  }
  
  .author {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  
  .author-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--gray-200);
  }
  
  .author-name {
    font-size: 12px;
    font-weight: 500;
    color: var(--gray-900);
  }
  
  .news-date {
    font-size: 12px;
    color: var(--gray-400);
  }
.testimonial-card {
    background: var(--white);
    padding: 32px;
    border-radius: var(--radius-2xl);
    border: 1px solid var(--gray-200);
    position: relative;
  }
  
  .quote-icon {
    position: absolute;
    top: 32px;
    right: 32px;
    color: var(--primary-light);
  }
  
  .testimonial-text {
    font-size: 15px;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 32px;
    font-style: italic;
  }
  
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 16px;
  }
  
  .author-img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
  }
  
  .author-info h4 {
    font-size: 15px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 2px;
  }
  
  .author-info p {
    font-size: 12px;
    color: var(--gray-400);
  }
.why-us {
    background-color: var(--primary);
    color: var(--white);
    padding: 100px 0;
  }

  .verse-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-right: 48px;
  }

  .arabic-verse {
    font-family: var(--font-arabic);
    font-size: 40px;
    line-height: 1.8;
    direction: rtl;
    text-align: right;
    margin-bottom: 24px;
    color: var(--white);
  }

  .verse-translation {
    font-size: 16px;
    font-style: italic;
    color: var(--primary-light);
    border-left: 2px solid var(--primary-light);
    padding-left: 16px;
  }

  .trust-points {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .trust-point {
    display: flex;
    align-items: flex-start;
    gap: 16px;
  }

  .trust-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: var(--white);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .trust-text h4 {
    color: var(--white);
    font-size: 18px;
    margin-bottom: 4px;
  }

  .trust-text p {
    color: var(--primary-light);
    font-size: 14px;
  }
.cta-banner {
    background: var(--gray-50);
    padding: 64px 0;
    border-top: 1px solid var(--gray-200);
  }
  
  .cta-box {
    background: var(--white);
    border-radius: 24px;
    padding: 48px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid var(--gray-200);
  }
  
  .cta-text h2 {
    font-size: 28px;
    margin-bottom: 12px;
  }
  
  .cta-text p {
    font-size: 15px;
    color: var(--gray-600);
  }
  
  .cta-form {
    display: flex;
    gap: 12px;
    width: 100%;
    max-width: 400px;
  }
  
  .cta-input {
    flex: 1;
    height: 48px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 0 16px;
    font-family: var(--font-body);
    font-size: 15px;
  }
.footer {
    background-color: var(--footer-bg);
    color: var(--white);
    padding: 80px 0 0;
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 48px;
    margin-bottom: 64px;
  }

  .footer-logo {
    margin-bottom: 24px;
  }

  .footer-logo img {
    height: 48px;
    width: auto;
  }

  .footer-tagline {
    font-size: 15px;
    color: var(--white);
    margin-bottom: 24px;
    max-width: 320px;
    line-height: 1.6;
  }

  .footer-address {
    font-size: 14px;
    color: #D1B8C5;
    line-height: 1.6;
    max-width: 320px;
  }

  .footer-title {
    font-family: var(--font-heading);
    font-size: 16px;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .footer-links {
    list-style: none;
  }

  .footer-links li {
    margin-bottom: 16px;
  }

  .footer-links a {
    font-size: 14px;
    color: #D1B8C5;
  }

  .footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
    font-size: 14px;
    color: #D1B8C5;
  }
  
  .trust-badges {
    display: flex;
    gap: 16px;
    margin-top: 32px;
    align-items: center;
  }
  
  .trust-badge-item {
    background: rgba(255,255,255,0.1);
    padding: 8px 12px;
    border-radius: var(--radius-lg);
    font-size: 11px;
    color: #D1B8C5;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 24px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    color: #D1B8C5;
  }
  
  .footer-bottom-links {
    display: flex;
    gap: 24px;
  }
}

/* MOBILE CSS */
@media (max-width: 767px) {
  

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    background-color: var(--white);
    color: var(--gray-900);
    font-family: var(--font-body);
    font-size: 15px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-heading);
    color: var(--gray-900);
    line-height: 1.3;
  }

  img {
    max-width: 100%;
    display: block;
  }

  a {
    text-decoration: none;
    color: inherit;
  }

  .container {
    width: 100%;
    padding: 0 16px;
  }

  .section {
    padding: 48px 0;
  }

  .section-bg-gray {
    background-color: var(--gray-100);
  }

  .section-bg-primary {
    background-color: var(--primary);
    color: var(--white);
  }

  .section-header {
    text-align: left;
    margin-bottom: 32px;
  }

  .section-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--primary);
    margin-bottom: 12px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .section-bg-primary .section-label {
    color: var(--primary-light);
  }

  .section-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .section-bg-primary .section-title {
    color: var(--white);
  }

  .section-subtitle {
    font-size: 15px;
    color: var(--gray-600);
  }

  .section-header .section-subtitle {
    margin: 0;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 48px;
    padding: 0 24px;
    border-radius: var(--radius-lg);
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    white-space: nowrap;
    gap: 8px;
  }

  .btn-sm {
    height: 40px;
    padding: 0 16px;
    font-size: 14px;
  }

  .btn-primary {
    background-color: var(--primary);
    color: var(--white);
    border: none;
  }

  .btn-white {
    background-color: var(--white);
    color: var(--primary);
    border: none;
  }

  .btn-outline-white {
    background-color: transparent;
    color: var(--white);
    border: 1px solid var(--white);
  }

  .btn-outline-primary {
    background-color: transparent;
    color: var(--primary);
    border: 1px solid var(--primary);
  }

  .btn-full {
    width: 100%;
  }

  .stack-mobile {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    background: var(--primary-light);
    color: var(--primary);
  }
.navbar {
    background-color: var(--white);
    border-bottom: 1px solid var(--gray-200);
    position: sticky;
    top: 0;
    z-index: 100;
  }

  .navbar-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
  }

  .nav-logo img {
    height: 36px;
    width: auto;
  }

  .mobile-menu-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-900);
    cursor: pointer;
  }
.hero {
    background-color: var(--primary);
    position: relative;
    overflow: hidden;
    padding: 40px 0 64px;
  }

  .hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.05;
    background-image: radial-gradient(#fff 1px, transparent 1px);
    background-size: 20px 20px;
  }

  .hero-container {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    gap: 32px;
  }

  .hero-content {
    color: var(--white);
  }
  
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 20px;
  }

  .hero-title {
    font-size: 32px;
    color: var(--white);
    margin-bottom: 16px;
    letter-spacing: -0.02em;
  }

  .hero-desc {
    font-size: 15px;
    color: var(--primary-light);
    margin-bottom: 24px;
    line-height: 1.6;
  }

  .hero-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .hero-image-wrapper {
    position: relative;
    margin-bottom: 24px;
  }

  .hero-image {
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
    border: 3px solid rgba(255, 255, 255, 0.1);
  }

  .hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .hero-floating-card {
    position: absolute;
    bottom: -24px;
    left: 16px;
    right: 16px;
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 12px 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 2;
  }
  
  .hero-float-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  
  .hero-float-text h4 {
    font-size: 14px;
    color: var(--gray-900);
    margin-bottom: 2px;
  }
  
  .hero-float-text p {
    font-size: 12px;
    color: var(--gray-600);
  }
.stats-section {
    margin-top: 32px;
    position: relative;
    z-index: 10;
    margin-bottom: 24px;
  }

  .stats-bar {
    background-color: var(--white);
    border-radius: var(--radius-2xl);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
    padding: 24px;
    border: 1px solid var(--gray-200);
  }

  .stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px 16px;
  }

  .stat-card {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .stat-icon {
    margin-bottom: 8px;
    color: var(--primary);
  }

  .stat-number {
    font-family: var(--font-heading);
    font-size: 28px;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 2px;
    line-height: 1;
  }

  .stat-label {
    font-size: 12px;
    color: var(--gray-600);
    font-weight: 500;
  }

  .stats-note {
    text-align: center;
    font-size: 12px;
    color: var(--gray-400);
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
.program-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    padding: 20px;
    position: relative;
    overflow: hidden;
  }
  
  .program-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gray-200);
  }

  .program-icon {
    width: 48px;
    height: 48px;
    background-color: var(--primary-light);
    color: var(--primary);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
  }

  .program-title {
    font-size: 18px;
    margin-bottom: 8px;
  }

  .program-desc {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.5;
    margin-bottom: 16px;
  }
  
  .program-features {
    list-style: none;
    margin-bottom: 16px;
  }
  
  .program-features li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: var(--gray-600);
    margin-bottom: 6px;
  }
  
  .program-features li iconify-icon {
    color: var(--primary);
    margin-top: 2px;
  }
  
  .program-link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
    font-family: var(--font-heading);
  }
.tabs-wrapper {
    margin-bottom: 24px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin-left: -16px;
    margin-right: -16px;
    padding: 0 16px 8px 16px;
    scrollbar-width: none;
  }
  
  .tabs-wrapper::-webkit-scrollbar {
    display: none;
  }
  
  .tabs {
    display: inline-flex;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 999px;
    padding: 4px;
  }
  
  .tab {
    padding: 8px 20px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-600);
    cursor: pointer;
    white-space: nowrap;
  }
  
  .tab.active {
    background: var(--primary);
    color: var(--white);
  }

  .donasi-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  .donasi-img-wrapper {
    position: relative;
  }

  .donasi-img {
    height: 200px;
    width: 100%;
    object-fit: cover;
  }
  
  .donasi-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(4px);
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    color: var(--primary);
  }

  .donasi-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .donasi-title {
    font-size: 16px;
    margin-bottom: 8px;
    line-height: 1.4;
  }

  .donasi-desc {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 20px;
    flex: 1;
  }

  .progress-container {
    margin-bottom: 20px;
  }
  
  .progress-stats {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: var(--gray-600);
    margin-bottom: 6px;
  }
  
  .progress-stats span:first-child {
    color: var(--primary);
    font-weight: 700;
  }

  .progress-bar-bg {
    height: 6px;
    background-color: var(--gray-200);
    border-radius: 999px;
    margin-bottom: 6px;
    overflow: hidden;
  }

  .progress-bar-fill {
    height: 100%;
    background-color: var(--primary);
    border-radius: 999px;
  }

  .progress-info {
    font-size: 12px;
    color: var(--gray-600);
  }

  .progress-info strong {
    color: var(--gray-900);
    font-weight: 600;
  }
.video-section {
    background: var(--gray-900);
    color: var(--white);
    position: relative;
  }
  
  .video-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  
  .video-wrapper {
    width: 100%;
    height: 200px;
    border-radius: var(--radius-2xl);
    overflow: hidden;
    position: relative;
    margin-top: 24px;
    border: 4px solid rgba(255,255,255,0.1);
  }
  
  .video-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .video-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .play-btn {
    width: 60px;
    height: 60px;
    background: var(--primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 0 0 12px rgba(139, 26, 74, 0.3);
  }
.news-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
  }

  .news-img {
    height: 180px;
    width: 100%;
    object-fit: cover;
  }

  .news-body {
    padding: 16px;
  }

  .news-category {
    display: inline-block;
    padding: 4px 12px;
    border: 1px solid var(--gray-200);
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    color: var(--primary);
    background: var(--primary-light);
    margin-bottom: 12px;
  }

  .news-title {
    font-size: 16px;
    margin-bottom: 8px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .news-excerpt {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .news-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid var(--gray-100);
    padding-top: 12px;
  }
  
  .author {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  
  .author-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--gray-200);
  }
  
  .author-name {
    font-size: 12px;
    font-weight: 500;
    color: var(--gray-900);
  }
  
  .news-date {
    font-size: 12px;
    color: var(--gray-400);
  }
.testimonial-card {
    background: var(--white);
    padding: 24px;
    border-radius: var(--radius-xl);
    border: 1px solid var(--gray-200);
    position: relative;
  }
  
  .quote-icon {
    position: absolute;
    top: 24px;
    right: 24px;
    color: var(--primary-light);
  }
  
  .testimonial-text {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 24px;
    font-style: italic;
  }
  
  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  
  .author-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
  }
  
  .author-info h4 {
    font-size: 14px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 2px;
  }
  
  .author-info p {
    font-size: 11px;
    color: var(--gray-400);
  }
.why-us {
    background-color: var(--primary);
    color: var(--white);
    padding: 64px 0;
  }

  .verse-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 40px;
  }

  .arabic-verse {
    font-family: var(--font-arabic);
    font-size: 32px;
    line-height: 1.8;
    direction: rtl;
    text-align: right;
    margin-bottom: 16px;
    color: var(--white);
  }

  .verse-translation {
    font-size: 14px;
    font-style: italic;
    color: var(--primary-light);
    border-left: 2px solid var(--primary-light);
    padding-left: 12px;
  }

  .trust-points {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .trust-point {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .trust-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: var(--white);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .trust-text h4 {
    color: var(--white);
    font-size: 16px;
    margin-bottom: 4px;
  }

  .trust-text p {
    color: var(--primary-light);
    font-size: 14px;
  }
.cta-banner {
    background: var(--gray-50);
    padding: 48px 0;
    border-top: 1px solid var(--gray-200);
  }
  
  .cta-box {
    background: var(--white);
    border-radius: var(--radius-2xl);
    padding: 32px 24px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 8px 24px rgba(0,0,0,0.03);
    border: 1px solid var(--gray-200);
  }
  
  .cta-text {
    margin-bottom: 20px;
  }
  
  .cta-text h2 {
    font-size: 22px;
    margin-bottom: 8px;
  }
  
  .cta-text p {
    font-size: 14px;
    color: var(--gray-600);
  }
  
  .cta-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
  }
  
  .cta-input {
    width: 100%;
    height: 48px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 0 16px;
    font-family: var(--font-body);
    font-size: 15px;
  }
.footer {
    background-color: var(--footer-bg);
    color: var(--white);
    padding: 48px 0 0;
  }

  .footer-grid {
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin-bottom: 40px;
  }

  .footer-logo {
    margin-bottom: 16px;
  }

  .footer-logo img {
    height: 40px;
    width: auto;
  }

  .footer-tagline {
    font-size: 14px;
    color: var(--white);
    margin-bottom: 16px;
    line-height: 1.6;
  }

  .footer-address {
    font-size: 13px;
    color: #D1B8C5;
    line-height: 1.6;
  }

  .footer-title {
    font-family: var(--font-heading);
    font-size: 15px;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .footer-links {
    list-style: none;
  }

  .footer-links li {
    margin-bottom: 12px;
  }

  .footer-links a {
    font-size: 14px;
    color: #D1B8C5;
  }

  .footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
    font-size: 14px;
    color: #D1B8C5;
  }
  
  .trust-badges {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    align-items: center;
  }
  
  .trust-badge-item {
    background: rgba(255,255,255,0.1);
    padding: 6px 12px;
    border-radius: var(--radius-lg);
    font-size: 11px;
    color: #D1B8C5;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 24px 0;
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
    text-align: center;
    font-size: 12px;
    color: #D1B8C5;
  }
  
  .footer-bottom-links {
    display: flex;
    gap: 16px;
  }
}
</style>
@endpush

@section('content')
<!-- Desktop View -->
<div class="hidden md:block w-full" id="desktop-view" x-data="{ donasiTab: 'Semua' }">
  <!-- CONTENT START -->
  <main>

  <!-- HERO SECTION -->
  <header class="hero" id="hero-section">
    <!-- LEFT: Content -->
    <div class="hero-left">
      <div class="hero-content">
        <h1 class="hero-title">Menginspirasi Kebaikan, Membangun Generasi Islami</h1>
        <p class="hero-desc">Bersama <strong>Yayasan Mimbar Al-Tauhid</strong>, kita wujudkan masyarakat Islami yang kuat dan berdaya melalui program dakwah, pendidikan, dan sosial.</p>
        <div class="hero-actions">
          <a href="{{ route('program.index') }}" class="btn btn-white">
            <iconify-icon icon="lucide:arrow-right" style="font-size: 18px;"></iconify-icon>
            Lihat Program Kami
          </a>
        </div>
      </div>
      <div class="hero-quote">
        <p class="hero-quote-text">&ldquo;Naungan orang beriman di hari Kiamat adalah sedekahnya&rdquo;</p>
        <span class="hero-quote-source">- HR Ahmad</span>
      </div>
    </div>

    <!-- RIGHT: Slideshow -->
    <div class="hero-right" id="hero-slideshow">
      <div class="hero-slide active">
        <img src="https://placehold.co/900x600/8B6F47/ffffff?text=Masjid+Al-Tauhid" alt="Masjid Al-Tauhid">
        <div class="hero-slide-overlay"></div>
      </div>
      <div class="hero-slide">
        <img src="https://placehold.co/900x600/5C4A3A/ffffff?text=Program+Dakwah" alt="Program Dakwah">
        <div class="hero-slide-overlay"></div>
      </div>
      <div class="hero-slide">
        <img src="https://placehold.co/900x600/4A6741/ffffff?text=Beasiswa+Santri" alt="Beasiswa Santri">
        <div class="hero-slide-overlay"></div>
      </div>
      <div class="hero-slide">
        <img src="https://placehold.co/900x600/2E4A5C/ffffff?text=Distribusi+Al-Quran" alt="Distribusi Al-Quran">
        <div class="hero-slide-overlay"></div>
      </div>
      <!-- Dot indicators -->
      <div class="hero-dots">
        <button class="hero-dot active" data-slide="0"></button>
        <button class="hero-dot" data-slide="1"></button>
        <button class="hero-dot" data-slide="2"></button>
        <button class="hero-dot" data-slide="3"></button>
      </div>
    </div>
  </header>

  <script>
  (function() {
    var slides = document.querySelectorAll('#hero-slideshow .hero-slide');
    var dots = document.querySelectorAll('#hero-slideshow .hero-dot');
    var current = 0;
    var interval;

    function goTo(idx) {
      slides[current].classList.remove('active');
      dots[current].classList.remove('active');
      current = idx;
      slides[current].classList.add('active');
      dots[current].classList.add('active');
    }

    function next() {
      goTo((current + 1) % slides.length);
    }

    function startAuto() {
      interval = setInterval(next, 4000);
    }

    dots.forEach(function(dot, i) {
      dot.addEventListener('click', function() {
        clearInterval(interval);
        goTo(i);
        startAuto();
      });
    });

    startAuto();
  })();
  </script>

  <!-- IMPACT STATS -->
  <section class="stats-section">
    <div class="container">
      <div class="stats-bar">
        <div class="grid-4">
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:home" style="font-size: 32px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_masjid'] }}</div>
            <div class="stat-label">Masjid Telah Dibangun</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:book-open" style="font-size: 32px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_mushaf'] }}</div>
            <div class="stat-label">Mushaf Al-Qur'an Tersebar</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:mic" style="font-size: 32px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_kajian'] }}</div>
            <div class="stat-label">Kajian &amp; Seminar Terlaksana</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:heart-handshake" style="font-size: 32px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_mualaf'] }}</div>
            <div class="stat-label">Mualaf Telah Dibina</div>
          </div>
        </div>
        <div class="stats-note">
          <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
            <iconify-icon icon="lucide:info" style="font-size: 16px;"></iconify-icon>
          </div>
          Pencapaian bersama sejak 2017 â€” karena setiap donatur adalah bagian dari angka ini.
        </div>
      </div>
    </div>
  </section>

  <!-- PROGRAM UNGGULAN -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
            <iconify-icon icon="lucide:layout-grid" style="font-size: 16px;"></iconify-icon>
          </div>
          PROGRAM KAMI
        </div>
        <h2 class="section-title">Empat Pilar Gerakan Dakwah Yayasan</h2>
        <p class="section-subtitle">Setiap program dirancang secara strategis agar syiar Islam menjangkau mereka yang belum terjangkau secara optimal.</p>
      </div>

      <div class="grid-4">
        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:mic" style="font-size: 28px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Departemen Dakwah</h3>
          <p class="program-desc">Menyebarkan pemahaman Islam yang lurus melalui kajian rutin dan terjun langsung ke masyarakat minoritas.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Kajian Pekanan &amp; Akbar
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Distribusi Al-Qur'an
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Pembinaan Mualaf
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:building" style="font-size: 28px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Wakaf &amp; Infrastruktur</h3>
          <p class="program-desc">Membangun masjid dan sarana ibadah di wilayah yang membutuhkan agar syiar Islam semakin merata.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Pembangunan Masjid
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Sumur Air Bersih
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Renovasi Madrasah
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:radio" style="font-size: 28px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Humas &amp; Media</h3>
          <p class="program-desc">Menjawab tantangan zaman dengan penyebaran syiar Islam melalui dunia digital dan siaran radio.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Radio Cahaya FM 105.3
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Produksi Konten Digital
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Penerbitan Ebook Gratis
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:graduation-cap" style="font-size: 28px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Pendidikan &amp; Sosial</h3>
          <p class="program-desc">Fokus pada pembinaan generasi muda, kaderisasi da'i, serta bantuan kemanusiaan tanggap darurat.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Beasiswa Santri
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Kaderisasi Da'i
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Santunan Yatim &amp; Dhuafa
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VIDEO SECTION -->
  <section class="video-section section">
    <div class="container video-container">
      <div class="section-label" style="color: var(--primary-light);">
        <iconify-icon icon="lucide:video" style="font-size: 16px;"></iconify-icon>
        PROFIL YAYASAN
      </div>
      <h2 class="section-title" style="color: var(--white);">Saksikan Jejak Langkah Dakwah Kami</h2>
      <p class="section-subtitle" style="color: var(--gray-400);">
        Lebih dekat dengan berbagai program yang telah kami jalankan berkat dukungan donatur sekalian di berbagai pelosok daerah.
      </p>
      
      <div class="video-wrapper">
        <iframe class="w-full h-full absolute top-0 left-0" src="https://www.youtube.com/embed/oHnVnvUtYu8?si=WLmgGaY2ZMiWHTUb" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
    </div>
  </section>

  <!-- AMAL JARIYAH -->
  <section class="section section-bg-gray">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <iconify-icon icon="lucide:heart-handshake" style="font-size: 16px;"></iconify-icon>
          TITIPKAN AMAL JARIYAHMU
        </div>
        <h2 class="section-title">Pilih Program Dakwah yang Ingin Anda Dukung</h2>
        <p class="section-subtitle">Setiap rupiah yang Anda salurkan adalah bagian dari amal jariyah yang terus mengalir pahalanya.</p>
      </div>
      
      <div class="tabs-wrapper">
        <div class="tabs">
          <div class="tab" :class="{'active': donasiTab === 'Semua'}" @click="donasiTab = 'Semua'">Semua Program</div>
          <div class="tab" :class="{'active': donasiTab === 'Wakaf'}" @click="donasiTab = 'Wakaf'">Wakaf Masjid</div>
          <div class="tab" :class="{'active': donasiTab === 'Al-Quran'}" @click="donasiTab = 'Al-Quran'">Al-Qur'an</div>
          <div class="tab" :class="{'active': donasiTab === 'Kafalah'}" @click="donasiTab = 'Kafalah'">Kafalah Da'i</div>
          <div class="tab" :class="{'active': donasiTab === 'Sosial'}" @click="donasiTab = 'Sosial'">Sosial &amp; Bencana</div>
        </div>
      </div>

      <div class="grid-3">
        @forelse($donationPrograms as $program)
        <div class="donasi-card" x-show="donasiTab === 'Semua'" x-transition.opacity>
          <div class="donasi-img-wrapper">
            <div class="donasi-badge">{{ $program->status === 'active' ? 'Aktif' : 'Selesai' }}</div>
            <img class="donasi-img" src="{{ $program->image ? asset('storage/' . $program->image) : 'https://placehold.co/1200x600?text=' . urlencode($program->name) }}" alt="{{ $program->name }}">
          </div>
          <div class="donasi-body">
            <h3 class="donasi-title">{{ $program->name }}</h3>
            <p class="donasi-desc">{{ $program->description }}</p>
            
            <div class="progress-container">
              <div class="progress-stats">
                <span>Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($program->target_amount, 0, ',', '.') }}</span>
              </div>
              <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $program->progress_percentage }}%;"></div>
              </div>
              <div class="progress-info">
                <strong>{{ $program->progress_percentage }}%</strong> terkumpul dari target
              </div>
            </div>

            <a href="{{ route('donations.show', $program->slug) }}" class="btn btn-primary btn-full">Salurkan Amal Jariyah</a>
          </div>
        </div>
        @empty
        <div class="donasi-card">
          <div class="donasi-body">
            <p style="color: var(--gray-600); text-align: center; padding: 40px 0;">Belum ada program donasi aktif.</p>
          </div>
        </div>
        @endforelse
      </div>
      
      <div style="text-align: center; margin-top: 48px;">
        <div class="btn btn-outline-primary" data-media-type="banani-button">Lihat Semua Program Donasi</div>
      </div>
    </div>
  </section>

  <!-- BERITA TERBARU -->
  <section class="section">
    <div class="container">
      <div class="section-header-left">
        <div>
          <div class="section-label">
            <iconify-icon icon="lucide:newspaper" style="font-size: 16px;"></iconify-icon>
            BERITA &amp; ARTIKEL
          </div>
          <h2 class="section-title">Kabar dari Lapangan Dakwah</h2>
          <p class="section-subtitle">Laporan nyata program yang berjalan â€” transparansi adalah bagian dari amanah.</p>
        </div>
        <div class="btn btn-outline-primary btn-sm" data-media-type="banani-button">
          Lihat Semua Artikel
        </div>
      </div>

      <div class="grid-3">
        @forelse($articles->take(3) as $article)
        <a href="{{ route('artikel.show', $article->slug) }}" class="news-card">
          <img class="news-img" src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://placehold.co/1200x600?text=' . urlencode(Str::limit($article->title, 30)) }}" alt="{{ $article->title }}">
          <div class="news-body">
            <div class="news-category">{{ $article->category->name ?? 'Artikel' }}</div>
            <h3 class="news-title">{{ $article->title }}</h3>
            <p class="news-excerpt">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
            <div class="news-meta">
              <div class="author">
                <div class="author-avatar"></div>
                <span class="author-name">Tim Mimbar</span>
              </div>
              <span class="news-date">{{ $article->published_at->translatedFormat('d M Y') }}</span>
            </div>
          </div>
        </a>
        @empty
        <div class="news-card">
          <div class="news-body">
            <p style="color: var(--gray-600); text-align: center; padding: 40px 0;">Belum ada artikel.</p>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>
  
  <!-- TESTIMONIALS -->
  <section class="section section-bg-gray">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <iconify-icon icon="lucide:message-square-quote" style="font-size: 16px;"></iconify-icon>
          APA KATA MEREKA
        </div>
        <h2 class="section-title">Kepercayaan Umat adalah Amanah Kami</h2>
        <p class="section-subtitle">Dukungan dari tokoh masyarakat dan ulama menjadi semangat kami untuk terus meluaskan manfaat.</p>
      </div>
      
      <div class="grid-3">
        <div class="testimonial-card">
          <div class="quote-icon">
            <iconify-icon icon="lucide:quote" style="font-size: 40px; opacity: 0.3;"></iconify-icon>
          </div>
          <p class="testimonial-text">
            "Kehadiran Yayasan Mimbar Al-Tauhid sangat dirasakan manfaatnya oleh warga desa kami, terutama program pembangunan masjid dan pembagian air bersih di musim kemarau."
          </p>
          <div class="testimonial-author">
            <img class="author-img" src="https://placehold.co/1200x600" alt="Tokoh Masyarakat">
            <div class="author-info">
              <h4>Bapak H. Sulaeman</h4>
              <p>Tokoh Masyarakat Sukabumi</p>
            </div>
          </div>
        </div>
        
        <div class="testimonial-card">
          <div class="quote-icon">
            <iconify-icon icon="lucide:quote" style="font-size: 40px; opacity: 0.3;"></iconify-icon>
          </div>
          <p class="testimonial-text">
            "Saya mengenal pengurus yayasan ini, mereka anak-anak muda yang giat berdakwah. Laporannya transparan dan program-programnya sangat menyentuh akar rumput."
          </p>
          <div class="testimonial-author">
            <img class="author-img" src="https://placehold.co/1200x600" alt="Ustadz">
            <div class="author-info">
              <h4>Ustadz Abdurrahman</h4>
              <p>Pembina Pondok Pesantren</p>
            </div>
          </div>
        </div>
        
        <div class="testimonial-card">
          <div class="quote-icon">
            <iconify-icon icon="lucide:quote" style="font-size: 40px; opacity: 0.3;"></iconify-icon>
          </div>
          <p class="testimonial-text">
            "Alhamdulillah, berkat bantuan mushaf dan Iqro dari donatur melalui yayasan, anak-anak di TPQ kami sekarang lebih semangat belajar mengaji."
          </p>
          <div class="testimonial-author">
            <img class="author-img" src="https://placehold.co/1200x600" alt="Guru Ngaji">
            <div class="author-info">
              <h4>Ibu Fatimah</h4>
              <p>Pengajar TPQ Pelosok</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- KENAPA MIMBAR AL-TAUHID -->
  <section class="why-us">
    <div class="container">
      <div class="grid-2">
        <div class="verse-container">
          <div class="arabic-verse">
            Ù‚ÙÙ„Ù’ Ù‡ÙŽÙ°Ø°ÙÙ‡ÙÛ¦ Ø³ÙŽØ¨ÙÙŠÙ„ÙÙ‰Ù“ Ø£ÙŽØ¯Ù’Ø¹ÙÙˆÙ“Ø§ÛŸ Ø¥ÙÙ„ÙŽÙ‰ Ù±Ù„Ù„ÙŽÙ‘Ù‡Ù Ø¹ÙŽÙ„ÙŽÙ‰Ù° Ø¨ÙŽØµÙÙŠØ±ÙŽØ©Ù
          </div>
          <div class="verse-translation">
            "Katakanlah: Inilah jalanku, aku mengajak kepada Allah dengan bashirah." â€” Q.S. Yusuf: 108
          </div>
          <div style="margin-top: 40px;">
            <div class="btn btn-outline-white" data-media-type="banani-button">
              Pelajari Tentang Kami
            </div>
          </div>
        </div>

        <div class="trust-points">
          <div class="trust-point">
            <div class="trust-icon">
              <iconify-icon icon="lucide:check" style="font-size: 16px;"></iconify-icon>
            </div>
            <div class="trust-text">
              <h4>Amanah &amp; Transparan</h4>
              <p>Laporan keuangan dipublikasikan secara rutin dan terbuka untuk semua mitra dakwah. Diaudit oleh lembaga independen secara berkala.</p>
            </div>
          </div>

          <div class="trust-point">
            <div class="trust-icon">
              <iconify-icon icon="lucide:check" style="font-size: 16px;"></iconify-icon>
            </div>
            <div class="trust-text">
              <h4>Profesional &amp; Berpengalaman</h4>
              <p>Dikelola SDM yang kompeten, berpengalaman puluhan tahun, dan memiliki dedikasi penuh tanggung jawab terhadap umat.</p>
            </div>
          </div>

          <div class="trust-point">
            <div class="trust-icon">
              <iconify-icon icon="lucide:check" style="font-size: 16px;"></iconify-icon>
            </div>
            <div class="trust-text">
              <h4>Berdampak Nyata Sejak 2017</h4>
              <p>Telah aktif bergerak memberikan manfaat, menebar hidayah dan menjangkau wilayah pelosok Indonesia yang membutuhkan sentuhan dakwah.</p>
            </div>
          </div>

          <div class="trust-point">
            <div class="trust-icon">
              <iconify-icon icon="lucide:check" style="font-size: 16px;"></iconify-icon>
            </div>
            <div class="trust-text">
              <h4>Gerakan Bersama (Kolaboratif)</h4>
              <p>Anda bukan sekadar donatur biasa, Anda adalah mitra penting dalam pergerakan roda dakwah Islam ini.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="cta-banner">
    <div class="container">
      <div class="cta-box">
        <div class="cta-text">
          <h2>Dapatkan Kabar Terbaru dari Kami</h2>
          <p>Berlangganan laporan bulanan, info penyaluran, dan update artikel Islami dari Yayasan.</p>
        </div>
        <div class="cta-form">
          <input type="email" class="cta-input" placeholder="Masukkan alamat email Anda">
          <div class="btn btn-primary" data-media-type="banani-button">
            Berlangganan
          </div>
        </div>
      </div>
    </div>
  </section>

  </main>
</div>

<!-- Mobile View -->
<div class="block md:hidden w-full" id="mobile-view" x-data="{ mobileMenuOpen: false, donasiTab: 'Semua' }">
  <main>

  <!-- HERO SECTION -->
  <header class="hero">
    <div class="hero-pattern"></div>
    <div class="container hero-container">
      <div class="hero-content">
        <div class="hero-badge">
          <div style="width: 14px; height: 14px; display: flex; align-items: center; justify-content: center;">
            <iconify-icon icon="lucide:sparkles" style="font-size: 14px; color: #F5E8EE"></iconify-icon>
          </div>
          Program Ramadhan 1446 H Dibuka
        </div>
        <h1 class="hero-title">Bersama Menyebarkan Syiar Islam ke Seluruh Pelosok Negeri</h1>
        <p class="hero-desc">Yayasan Mimbar Al-Tauhid menghadirkan program dakwah yang inovatif dan amanah. Jadilah bagian dari gerakan kebaikan ini.</p>
        <div class="hero-actions">
          <div class="btn btn-white btn-full" data-media-type="banani-button">Mulai Berdonasi</div>
          <div class="btn btn-outline-white btn-full" data-media-type="banani-button">
            <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:play-circle" style="font-size: 18px;"></iconify-icon>
            </div>
            Tonton Video
          </div>
        </div>
      </div>
      <div class="hero-image-wrapper">
        <div class="hero-image">
          <img data-aspect-ratio="4:3" data-query="mosque studying islamic activity photography warm light indonesia" alt="Islamic study activity" src="https://placehold.co/800x400">
        </div>
        <div class="hero-floating-card">
          <div class="hero-float-icon">
            <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:users" style="font-size: 20px;"></iconify-icon>
            </div>
          </div>
          <div class="hero-float-text">
            <h4>+15.000 Donatur</h4>
            <p>Telah bergabung bersama kami</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- IMPACT STATS -->
  <section class="stats-section">
    <div class="container">
      <div class="stats-bar">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:home" style="font-size: 24px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_masjid'] }}</div>
            <div class="stat-label">Masjid Dibangun</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:book-open" style="font-size: 24px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_mushaf'] }}</div>
            <div class="stat-label">Mushaf Tersebar</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:mic" style="font-size: 24px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_kajian'] }}</div>
            <div class="stat-label">Kajian Terlaksana</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:heart-handshake" style="font-size: 24px;"></iconify-icon>
              </div>
            </div>
            <div class="stat-number">{{ $stats['stat_mualaf'] }}</div>
            <div class="stat-label">Mualaf Dibina</div>
          </div>
        </div>
        <div class="stats-note">
          <div style="width: 14px; height: 14px; display: flex; align-items: center; justify-content: center;">
            <iconify-icon icon="lucide:info" style="font-size: 14px;"></iconify-icon>
          </div>
          Pencapaian bersama sejak 2017
        </div>
      </div>
    </div>
  </section>

  <!-- PROGRAM UNGGULAN -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <div style="width: 14px; height: 14px; display: flex; align-items: center; justify-content: center;">
            <iconify-icon icon="lucide:layout-grid" style="font-size: 14px;"></iconify-icon>
          </div>
          PROGRAM KAMI
        </div>
        <h2 class="section-title">Empat Pilar Gerakan Dakwah</h2>
        <p class="section-subtitle">Setiap program dirancang strategis agar syiar Islam menjangkau yang belum terjangkau.</p>
      </div>

      <div class="stack-mobile">
        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:mic" style="font-size: 24px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Departemen Dakwah</h3>
          <p class="program-desc">Menyebarkan pemahaman Islam melalui kajian rutin dan terjun langsung ke minoritas.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Kajian Pekanan &amp; Akbar
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Distribusi Al-Qur'an
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Pembinaan Mualaf
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 14px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:building" style="font-size: 24px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Wakaf &amp; Infrastruktur</h3>
          <p class="program-desc">Membangun masjid dan sarana ibadah di wilayah yang membutuhkan agar syiar merata.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Pembangunan Masjid
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Sumur Air Bersih
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Renovasi Madrasah
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 14px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:radio" style="font-size: 24px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Humas &amp; Media</h3>
          <p class="program-desc">Menjawab tantangan zaman dengan syiar Islam melalui digital dan siaran radio.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Radio Cahaya FM 105.3
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Produksi Konten Digital
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Penerbitan Ebook Gratis
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 14px;"></iconify-icon>
          </div>
        </div>

        <div class="program-card" data-media-type="banani-button">
          <div class="program-icon">
            <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="lucide:graduation-cap" style="font-size: 24px;"></iconify-icon>
            </div>
          </div>
          <h3 class="program-title">Pendidikan &amp; Sosial</h3>
          <p class="program-desc">Fokus pada pembinaan generasi muda, kaderisasi da'i, serta bantuan kemanusiaan.</p>
          <ul class="program-features">
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Beasiswa Santri
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Kaderisasi Da'i
            </li>
            <li>
              <iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon>
              Santunan Yatim &amp; Dhuafa
            </li>
          </ul>
          <div class="program-link">
            Lihat Detail 
            <iconify-icon icon="lucide:arrow-right" style="font-size: 14px;"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VIDEO SECTION -->
  <section class="video-section section">
    <div class="container video-container">
      <div class="section-label" style="color: var(--primary-light);">
        <iconify-icon icon="lucide:video" style="font-size: 14px;"></iconify-icon>
        PROFIL YAYASAN
      </div>
      <h2 class="section-title" style="color: var(--white);">Jejak Langkah Dakwah</h2>
      <p class="section-subtitle" style="color: var(--gray-400);">
        Lebih dekat dengan berbagai program yang telah kami jalankan berkat dukungan donatur.
      </p>
      
      <div class="video-wrapper">
        <iframe class="w-full h-full absolute top-0 left-0" src="https://www.youtube.com/embed/oHnVnvUtYu8?si=WLmgGaY2ZMiWHTUb" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
    </div>
  </section>

  <!-- AMAL JARIYAH -->
  <section class="section section-bg-gray">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <iconify-icon icon="lucide:heart-handshake" style="font-size: 14px;"></iconify-icon>
          AMAL JARIYAHMU
        </div>
        <h2 class="section-title">Pilih Program Dakwah</h2>
        <p class="section-subtitle">Setiap rupiah yang disalurkan adalah bagian dari amal jariyah yang terus mengalir.</p>
      </div>
      
      <div class="tabs-wrapper">
        <div class="tabs">
          <div class="tab" :class="{'active': donasiTab === 'Semua'}" @click="donasiTab = 'Semua'">Semua</div>
          <div class="tab" :class="{'active': donasiTab === 'Wakaf'}" @click="donasiTab = 'Wakaf'">Wakaf Masjid</div>
          <div class="tab" :class="{'active': donasiTab === 'Al-Quran'}" @click="donasiTab = 'Al-Quran'">Al-Qur'an</div>
          <div class="tab" :class="{'active': donasiTab === 'Kafalah'}" @click="donasiTab = 'Kafalah'">Kafalah Da'i</div>
          <div class="tab" :class="{'active': donasiTab === 'Sosial'}" @click="donasiTab = 'Sosial'">Sosial</div>
        </div>
      </div>

      <div class="stack-mobile">
        @forelse($donationPrograms as $program)
        <div class="donasi-card" x-show="donasiTab === 'Semua'" x-transition.opacity>
          <div class="donasi-img-wrapper">
            <div class="donasi-badge">{{ $program->status === 'active' ? 'Aktif' : 'Selesai' }}</div>
            <img class="donasi-img" src="{{ $program->image ? asset('storage/' . $program->image) : 'https://placehold.co/800x400?text=' . urlencode($program->name) }}" alt="{{ $program->name }}">
          </div>
          <div class="donasi-body">
            <h3 class="donasi-title">{{ $program->name }}</h3>
            <p class="donasi-desc">{{ $program->description }}</p>
            
            <div class="progress-container">
              <div class="progress-stats">
                <span>Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($program->target_amount, 0, ',', '.') }}</span>
              </div>
              <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $program->progress_percentage }}%;"></div>
              </div>
              <div class="progress-info">
                <strong>{{ $program->progress_percentage }}%</strong> terkumpul dari target
              </div>
            </div>

            <a href="{{ route('donations.show', $program->slug) }}" class="btn btn-primary btn-full">Salurkan Amal Jariyah</a>
          </div>
        </div>
        @empty
        <div class="donasi-card">
          <div class="donasi-body">
            <p style="color: var(--gray-600); text-align: center; padding: 40px 0;">Belum ada program donasi aktif.</p>
          </div>
        </div>
        @endforelse
      </div>
      
      <div style="margin-top: 32px;">
        <div class="btn btn-outline-primary btn-full" data-media-type="banani-button">Lihat Semua Program</div>
      </div>
    </div>
  </section>

  <!-- BERITA TERBARU -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <iconify-icon icon="lucide:newspaper" style="font-size: 14px;"></iconify-icon>
          BERITA &amp; ARTIKEL
        </div>
        <h2 class="section-title">Kabar Lapangan</h2>
        <p class="section-subtitle">Laporan nyata program yang berjalan dari berbagai pelosok daerah.</p>
      </div>

      <div class="stack-mobile">
        @forelse($articles->take(3) as $article)
        <a href="{{ route('artikel.show', $article->slug) }}" class="news-card">
          <img class="news-img" src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://placehold.co/800x400?text=' . urlencode(Str::limit($article->title, 30)) }}" alt="{{ $article->title }}">
          <div class="news-body">
            <div class="news-category">{{ $article->category->name ?? 'Artikel' }}</div>
            <h3 class="news-title">{{ $article->title }}</h3>
            <p class="news-excerpt">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 100) }}</p>
            <div class="news-meta">
              <div class="author">
                <div class="author-avatar"></div>
                <span class="author-name">Tim Mimbar</span>
              </div>
              <span class="news-date">{{ $article->published_at->translatedFormat('d M Y') }}</span>
            </div>
          </div>
        </a>
        @empty
        <div class="news-card">
          <div class="news-body">
            <p style="color: var(--gray-600); text-align: center; padding: 40px 0;">Belum ada artikel.</p>
          </div>
        </div>
        @endforelse
      </div>
      
      <div style="margin-top: 32px;">
        <div class="btn btn-outline-primary btn-full" data-media-type="banani-button">
          Lihat Semua Artikel
        </div>
      </div>
    </div>
  </section>
  
  <!-- TESTIMONIALS -->
  <section class="section section-bg-gray">
    <div class="container">
      <div class="section-header">
        <div class="section-label">
          <iconify-icon icon="lucide:message-square-quote" style="font-size: 14px;"></iconify-icon>
          KATA MEREKA
        </div>
        <h2 class="section-title">Amanah Umat</h2>
        <p class="section-subtitle">Dukungan tokoh dan ulama menjadi semangat kami meluaskan manfaat.</p>
      </div>
      
      <div class="stack-mobile">
        <div class="testimonial-card">
          <div class="quote-icon">
            <iconify-icon icon="lucide:quote" style="font-size: 32px; opacity: 0.3;"></iconify-icon>
          </div>
          <p class="testimonial-text">
            "Kehadiran yayasan dirasakan manfaatnya oleh warga, terutama program masjid dan pembagian air bersih."
          </p>
          <div class="testimonial-author">
            <img class="author-img" src="https://placehold.co/800x400" alt="Tokoh Masyarakat">
            <div class="author-info">
              <h4>Bapak H. Sulaeman</h4>
              <p>Tokoh Masyarakat</p>
            </div>
          </div>
        </div>
        
        <div class="testimonial-card">
          <div class="quote-icon">
            <iconify-icon icon="lucide:quote" style="font-size: 32px; opacity: 0.3;"></iconify-icon>
          </div>
          <p class="testimonial-text">
            "Saya mengenal pengurus yayasan, anak-anak muda giat. Laporannya transparan dan menyentuh akar rumput."
          </p>
          <div class="testimonial-author">
            <img class="author-img" src="https://placehold.co/800x400" alt="Ustadz">
            <div class="author-info">
              <h4>Ust. Abdurrahman</h4>
              <p>Pembina Pesantren</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- KENAPA MIMBAR AL-TAUHID -->
  <section class="why-us">
    <div class="container">
      <div class="verse-container">
        <div class="arabic-verse">
          Ù‚ÙÙ„Ù’ Ù‡ÙŽÙ°Ø°ÙÙ‡ÙÛ¦ Ø³ÙŽØ¨ÙÙŠÙ„ÙÙ‰Ù“ Ø£ÙŽØ¯Ù’Ø¹ÙÙˆÙ“Ø§ÛŸ Ø¥ÙÙ„ÙŽÙ‰ Ù±Ù„Ù„ÙŽÙ‘Ù‡Ù Ø¹ÙŽÙ„ÙŽÙ‰Ù° Ø¨ÙŽØµÙÙŠØ±ÙŽØ©Ù
        </div>
        <div class="verse-translation">
          "Katakanlah: Inilah jalanku, aku mengajak kepada Allah dengan bashirah (ilmu)." â€” Q.S. Yusuf: 108
        </div>
        <div style="margin-top: 32px;">
          <div class="btn btn-outline-white btn-full" data-media-type="banani-button">
            Tentang Kami
          </div>
        </div>
      </div>

      <div class="trust-points">
        <div class="trust-point">
          <div class="trust-icon">
            <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
          </div>
          <div class="trust-text">
            <h4>Amanah &amp; Transparan</h4>
            <p>Laporan keuangan dipublikasikan rutin dan diaudit independen.</p>
          </div>
        </div>

        <div class="trust-point">
          <div class="trust-icon">
            <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
          </div>
          <div class="trust-text">
            <h4>Profesional &amp; Berpengalaman</h4>
            <p>Dikelola SDM kompeten dengan dedikasi tanggung jawab penuh.</p>
          </div>
        </div>

        <div class="trust-point">
          <div class="trust-icon">
            <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
          </div>
          <div class="trust-text">
            <h4>Berdampak Sejak 2017</h4>
            <p>Aktif memberikan manfaat dan menjangkau pelosok Indonesia.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="cta-banner">
    <div class="container">
      <div class="cta-box">
        <div class="cta-text">
          <h2>Dapatkan Kabar Terbaru</h2>
          <p>Berlangganan info penyaluran, dan update artikel Islami dari Yayasan.</p>
        </div>
        <div class="cta-form">
          <input type="email" class="cta-input" placeholder="Alamat email Anda">
          <div class="btn btn-primary" data-media-type="banani-button">
            Berlangganan
          </div>
        </div>
      </div>
    </div>
  </section>

  </main>
</div>
@endsection
