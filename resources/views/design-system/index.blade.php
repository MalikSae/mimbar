<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mimbar Al-Tauhid - Design System</title>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: 'var(--primary)',
                            dark: 'var(--primary-dark)',
                            light: 'var(--primary-light)',
                        },
                        success: {
                            DEFAULT: 'var(--success)',
                            surface: 'var(--success-surface)',
                        },
                        warning: {
                            DEFAULT: 'var(--warning)',
                            surface: 'var(--warning-surface)',
                        },
                        destructive: {
                            DEFAULT: 'var(--destructive)',
                            surface: 'var(--destructive-surface)',
                        },
                        info: {
                            DEFAULT: 'var(--info)',
                            surface: 'var(--info-surface)',
                        },
                        gray: {
                            400: 'var(--gray-400)',
                            600: 'var(--gray-600)',
                            900: 'var(--gray-900)',
                        },
                        border: 'var(--border)',
                        muted: 'var(--muted)',
                    },
                    borderRadius: {
                        'sm': 'var(--radius-sm)',
                        'md': 'var(--radius-md)',
                        'lg': 'var(--radius-lg)',
                        'xl': 'var(--radius-xl)',
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
    :root {
        /* Brand Colors */
        --primary: #8B1A4A;
        --primary-dark: #6B1238;
        --primary-light: #F5E8EE;

        /* Neutrals */
        --gray-900: #1A1A1A;
        --gray-600: #555555;
        --gray-400: #9CA3AF;
        --border: #E5E7EB;
        --muted: #F5F5F5;
        --background: #FFFFFF;
        --foreground: #1A1A1A;

        /* Semantic Colors */
        --success: #22863A;
        --success-surface: #EAF3DE;
        --warning: #E36209;
        --warning-surface: #FAEEDA;
        --destructive: #C0392B;
        --destructive-surface: #FCEBEB;
        --info: #185FA5;
        --info-surface: #E6F1FB;

        /* Radii Tokens */
        --radius-sm: 4px;
        --radius-md: 6px;
        --radius-lg: 8px;
        --radius-xl: 12px;
    }
        [x-cloak] { display: none !important; }
        .ds-tab { cursor: pointer; }
* { 
    box-sizing: border-box; 
    margin: 0; 
    padding: 0; 
  }
  body {
    background-color: var(--background);
    color: var(--foreground);
    font-family: var(--font-family-body, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif);
    -webkit-font-smoothing: antialiased;
  }
.ds-wrapper {
    min-height: 100vh;
    padding: 48px 64px;
    background-color: #FFFFFF;
    max-width: 1440px;
    margin: 0 auto;
  }
  
  .ds-header {
    margin-bottom: 32px;
  }
  
  .ds-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
  }
  
  .ds-subtitle {
    font-size: 16px;
    color: var(--gray-600);
  }

  .ds-tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
    overflow-x: auto;
    gap: 32px;
  }

  .ds-tab {
    padding: 16px 0;
    font-size: 15px;
    color: var(--gray-600);
    white-space: nowrap;
    position: relative;
    font-weight: 500;
  }

  .ds-tab.active {
    color: var(--primary);
    font-weight: 600;
  }

  .ds-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: var(--primary);
    border-radius: 3px 3px 0 0;
  }
.ds-section {
    margin-bottom: 64px;
  }
  
  .ds-section-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
  }

  .ds-color-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 32px;
  }

  .ds-swatch {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: #FFFFFF;
    display: flex;
    flex-direction: column;
  }

  .ds-swatch-color {
    height: 120px;
    width: 100%;
    border-bottom: 1px solid var(--border);
  }
  
  /* Light colors might need a subtle inner border if they don't have a border-bottom already, but they all have one here */
  .ds-swatch-color.light-border {
    border-bottom: 1px solid var(--border);
  }

  .ds-swatch-info {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .ds-swatch-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .ds-swatch-token {
    font-weight: 600;
    font-size: 16px;
    color: var(--gray-900);
  }

  .ds-swatch-hex {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    font-size: 13px;
    color: var(--gray-600);
    background: var(--muted);
    padding: 4px 8px;
    border-radius: var(--radius-sm);
    font-weight: 500;
  }

  .ds-swatch-usage {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.5;
    margin-top: auto;
  }
* { 
    box-sizing: border-box; 
    margin: 0; 
    padding: 0; 
  }
  body {
    background-color: var(--background, #FFFFFF);
    color: var(--foreground, var(--gray-900));
    font-family: var(--font-family-body, 'Inter', system-ui, -apple-system, sans-serif);
    -webkit-font-smoothing: antialiased;
  }
  h1, h2, h3, h4, h5, h6 {
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
  }
.ds-wrapper {
    min-height: 100vh;
    padding: 48px 64px;
    background-color: #FFFFFF;
    max-width: 1440px;
    margin: 0 auto;
  }
  
  .ds-header {
    margin-bottom: 32px;
  }
  
  .ds-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
  }
  
  .ds-subtitle {
    font-size: 16px;
    color: var(--gray-600);
  }

  .ds-tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
    overflow-x: auto;
    gap: 32px;
  }

  .ds-tab {
    padding: 16px 0;
    font-size: 15px;
    color: var(--gray-600);
    white-space: nowrap;
    position: relative;
    font-weight: 500;
    cursor: pointer;
  }

  .ds-tab.active {
    color: var(--primary);
    font-weight: 600;
  }

  .ds-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: var(--primary);
    border-radius: 3px 3px 0 0;
  }

  .ds-section {
    margin-bottom: 80px;
  }
  
  .ds-section-header {
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
  }

  .comp-container {
    background-color: #FAFAFA;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 32px;
  }
.btn-primary {
    background-color: var(--primary);
    color: #FFFFFF;
    padding: 0 16px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  
  .btn-outline {
    background-color: #FFFFFF;
    color: var(--gray-600);
    border: 1px solid var(--border);
    padding: 0 16px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  
  .btn-full {
    width: 100%;
  }

  .action-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-md);
    color: var(--gray-600);
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    cursor: pointer;
  }
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    white-space: nowrap;
    border-radius: 9999px;
  }
  .badge-primary {
    background-color: var(--primary-light);
    color: var(--primary);
  }
/* Progress Bar */
  .progress-wrapper { margin-bottom: 24px; max-width: 480px; }
  .progress-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 12px; }
  .progress-label { font-size: 14px; color: var(--gray-600); margin-bottom: 4px; }
  .progress-amount { font-size: 24px; font-weight: 700; color: var(--gray-900); }
  .progress-percent { font-size: 14px; font-weight: 700; color: var(--primary); background: var(--primary-light); padding: 2px 8px; border-radius: var(--radius-sm); }
  .progress-track { height: 8px; background-color: var(--border); border-radius: 9999px; overflow: hidden; margin-bottom: 8px; }
  .progress-fill { height: 100%; background-color: var(--primary); border-radius: 9999px; }
  .progress-target { font-size: 12px; color: var(--gray-600); text-align: right; }

  /* Bank Transfer Box */
  .bank-card {
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FFFCFA; /* slightly warm */
    padding: 24px;
    max-width: 480px;
  }
  .bank-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
  .bank-logo-placeholder { width: 48px; height: 32px; background: #FFFFFF; border: 1px solid var(--border); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; color: var(--gray-900); font-weight: 700; font-size: 14px; }
  .bank-name { font-weight: 600; font-size: 16px; color: var(--gray-900); }
  
  .bank-detail-row { margin-bottom: 16px; }
  .bank-detail-label { font-size: 12px; color: var(--gray-600); margin-bottom: 4px; }
  .bank-account-num { font-size: 20px; font-weight: 700; color: var(--gray-900); display: flex; align-items: center; gap: 12px; }
  
  /* Nominal Chips */
  .nominal-grid { display: flex; flex-wrap: wrap; gap: 12px; max-width: 600px; }
  .nominal-chip {
    padding: 12px 20px;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    font-size: 15px;
    font-weight: 600;
    color: var(--gray-600);
    background: #FFFFFF;
    cursor: pointer;
    flex: 1;
    min-width: 140px;
    text-align: center;
  }
  .nominal-chip.selected {
    background: var(--primary);
    color: #FFFFFF;
    border-color: var(--primary);
  }

  /* Upload Proof Box */
  .upload-zone {
    border: 2px dashed var(--gray-400);
    border-radius: var(--radius-xl);
    background-color: #FFFFFF;
    padding: 32px;
    text-align: center;
    cursor: pointer;
    max-width: 480px;
  }
  .upload-filled {
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FFFFFF;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 16px;
    max-width: 480px;
  }
  .upload-thumb { width: 48px; height: 48px; border-radius: var(--radius-lg); object-fit: cover; }
  
  /* Success State */
  .success-state {
    text-align: center;
    max-width: 480px;
    padding: 40px 24px;
    background: #FFFFFF;
    border-radius: 16px;
    border: 1px solid var(--border);
  }
  .success-icon { width: 64px; height: 64px; border-radius: 50%; background: var(--success-surface); color: var(--success); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; }
  
  /* Qurban Card */
  .qurban-grid { display: flex; gap: 24px; flex-wrap: wrap; }
  .qurban-card {
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FFFFFF;
    overflow: hidden;
    width: 320px;
    position: relative;
  }
  .qurban-card.selected {
    border: 2px solid var(--primary);
    box-shadow: 0 10px 15px -3px rgba(139, 26, 74, 0.1);
  }
  .qurban-img { width: 100%; height: 200px; object-fit: cover; }
  .qurban-body { padding: 20px; }
  
  /* Step Indicator */
  .step-container {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 500px;
    position: relative;
  }
  .step-line-bg {
    position: absolute;
    top: 16px;
    left: 40px;
    right: 40px;
    height: 2px;
    background: var(--border);
    z-index: 0;
  }
  .step-line-fill {
    position: absolute;
    top: 16px;
    left: 40px;
    width: 50%;
    height: 2px;
    background: var(--primary);
    z-index: 0;
  }
  .step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    z-index: 1;
    background: #FAFAFA;
    padding: 0 12px;
    flex: 1;
  }
  .step-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
  }
  .step-completed .step-circle { background: var(--primary); color: #FFFFFF; }
  .step-active .step-circle { border: 2px solid var(--primary); color: var(--primary); background: #FFFFFF; }
  .step-pending .step-circle { background: #F3F4F6; color: var(--gray-400); }
  .step-label { font-size: 14px; font-weight: 600; text-align: center; }
  .step-completed .step-label { color: var(--primary); }
  .step-active .step-label { color: var(--primary); }
  .step-pending .step-label { color: var(--gray-400); }
* { 
    box-sizing: border-box; 
    margin: 0; 
    padding: 0; 
  }
  body {
    background-color: var(--background, #FFFFFF);
    color: var(--foreground, var(--gray-900));
    font-family: var(--font-family-body, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif);
    -webkit-font-smoothing: antialiased;
  }
.ds-wrapper {
    min-height: 100vh;
    padding: 48px 64px;
    background-color: #FFFFFF;
    max-width: 1440px;
    margin: 0 auto;
  }
  
  .ds-header {
    margin-bottom: 32px;
  }
  
  .ds-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
  }
  
  .ds-subtitle {
    font-size: 16px;
    color: var(--gray-600);
  }

  .ds-tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
    overflow-x: auto;
    gap: 32px;
  }

  .ds-tab {
    padding: 16px 0;
    font-size: 15px;
    color: var(--gray-600);
    white-space: nowrap;
    position: relative;
    font-weight: 500;
    cursor: pointer;
  }

  .ds-tab.active {
    color: var(--primary);
    font-weight: 600;
  }

  .ds-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: var(--primary);
    border-radius: 3px 3px 0 0;
  }

  .ds-section {
    margin-bottom: 80px;
  }
  
  .ds-section-header {
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
  }
/* Variants Grid */
  .btn-grid-variants {
    display: grid;
    grid-template-columns: 120px repeat(3, minmax(180px, 1fr));
    gap: 32px 24px;
    align-items: center;
    max-width: 900px;
  }
  .btn-grid-header {
    font-size: 13px;
    color: #6B7280;
    font-weight: 500;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
  }
  .btn-grid-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
  }

  /* Base Button Styles */
  .btn {
    font-family: 'Plus Jakarta Sans', var(--font-family-body, sans-serif);
    font-weight: 600;
    border-radius: var(--radius-lg);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
    white-space: nowrap;
    border: 1px solid transparent;
  }

  /* Sizes */
  .btn-lg { height: 48px; padding: 0 24px; font-size: 18px; }
  .btn-md { height: 40px; padding: 0 16px; font-size: 14px; }
  .btn-sm { height: 32px; padding: 0 12px; font-size: 12px; }

  /* Icon-Only Sizes */
  .btn-icon-lg { width: 48px; padding: 0; }
  .btn-icon-md { width: 40px; padding: 0; }
  .btn-icon-sm { width: 32px; padding: 0; }

  /* Shapes & Layouts */
  .btn-rounded-full { border-radius: 9999px; }
  .btn-full-width { width: 100%; }

  /* Icon Wrappers */
  .icon-wrap-14 { width: 14px; height: 14px; display: flex; align-items: center; justify-content: center; }
  .icon-wrap-16 { width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; }
  .icon-wrap-20 { width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; }
  
  .icon-14 { font-size: 14px; color: inherit; }
  .icon-16 { font-size: 16px; color: inherit; }
  .icon-20 { font-size: 20px; color: inherit; }

  /* Variants Styling (Static States) */
  .btn-primary { background-color: var(--primary); color: #FFFFFF; }
  .btn-primary.hover { background-color: var(--primary-dark); }
  .btn-primary.disabled { background-color: var(--border); color: var(--gray-400); cursor: not-allowed; border-color: transparent; }

  .btn-secondary { background-color: #FFFFFF; color: var(--primary); border-color: var(--primary); }
  .btn-secondary.hover { background-color: var(--primary-light); color: var(--primary-dark); border-color: var(--primary-dark); }
  .btn-secondary.disabled { background-color: #FFFFFF; border-color: var(--border); color: var(--gray-400); cursor: not-allowed; }

  .btn-ghost { background-color: transparent; color: var(--primary); }
  .btn-ghost.hover { background-color: var(--primary-light); color: var(--primary-dark); }
  .btn-ghost.disabled { color: var(--gray-400); cursor: not-allowed; background-color: transparent; }

  .btn-danger { background-color: var(--destructive); color: #FFFFFF; }
  .btn-danger.hover { background-color: #A93226; }
  .btn-danger.disabled { background-color: var(--border); color: var(--gray-400); cursor: not-allowed; }

  .btn-success { background-color: var(--success); color: #FFFFFF; }
  .btn-success.hover { background-color: #1E7031; }
  .btn-success.disabled { background-color: var(--border); color: var(--gray-400); cursor: not-allowed; }


.btn-icon-square-lg {
  width: 40px;
  height: 40px;
  aspect-ratio: 1 / 1;
  padding: 0;
  border-radius: 16px;
  flex-shrink: 0;
}

.btn-icon-square-row {
  display: flex;
  gap: 16px;
}
.btn-sizes-flex {
    display: flex;
    gap: 48px;
    align-items: flex-end;
  }
  .btn-size-item {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: flex-start;
  }
  .btn-size-label {
    font-size: 13px;
    color: #6B7280;
    font-weight: 500;
  }
  
  .btn-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
    margin-bottom: 48px;
  }
  .btn-feature-card {
    padding: 32px 24px;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FAFAFA;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 24px;
  }
  .btn-feature-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
  }
.btn-primary {
    background-color: var(--primary);
    color: #FFFFFF;
    padding: 0 16px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
  
  .btn-outline {
    background-color: #FFFFFF;
    color: var(--gray-600);
    border: 1px solid var(--border);
    padding: 0 16px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .btn-outline-danger {
    background-color: #FFFFFF;
    color: var(--destructive);
    border: 1px solid var(--destructive);
    padding: 0 16px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .action-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-md);
    color: var(--gray-600);
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    cursor: pointer;
  }
  
  .action-btn.text-success {
    color: var(--success);
  }
  
  .action-btn.text-danger {
    color: var(--destructive);
  }

  .action-btn.disabled {
    color: var(--gray-400);
    background-color: #F9FAFB;
    cursor: not-allowed;
  }
.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    white-space: nowrap;
  }
  .badge-pill {
    border-radius: 9999px;
  }
  .badge-warning {
    background-color: var(--warning-surface);
    color: var(--warning);
  }
  .badge-success {
    background-color: var(--success-surface);
    color: var(--success);
  }
  .badge-danger {
    background-color: var(--destructive-surface);
    color: var(--destructive);
  }
.table-wrapper {
    border: 1px solid var(--border); 
    border-radius: var(--radius-lg); 
    overflow: hidden; 
    margin-bottom: 24px; 
    background: #FFFFFF;
  }
  
  .data-table {
    width: 100%; 
    border-collapse: collapse;
    font-size: 14px;
  }
  
  .data-table th {
    padding: 14px 16px; 
    text-align: left; 
    font-weight: 600; 
    color: var(--gray-600); 
    font-size: 12px; 
    text-transform: uppercase; 
    letter-spacing: 0.05em;
    background-color: #F9FAFB; 
    border-bottom: 1px solid var(--border);
  }
  
  .data-table td {
    padding: 14px 16px; 
    border-bottom: 1px solid var(--border);
    color: var(--gray-600);
  }
  
  .data-table td.text-dark {
    color: var(--gray-900);
    font-weight: 500;
  }
  
  .data-table tbody tr:last-child td {
    border-bottom: none;
  }
  
  .data-table tbody tr:nth-child(even) {
    background-color: #FAFAFA;
  }
  
  .data-table tbody tr.row-hover {
    background-color: #F3F4F6;
  }
  
  .data-table tbody tr.row-selected {
    background-color: var(--primary-light);
  }
  
  .checkbox {
    width: 16px; 
    height: 16px;
    border: 1px solid var(--gray-400);
    border-radius: var(--radius-sm);
    display: inline-flex; 
    align-items: center; 
    justify-content: center;
    background-color: #FFFFFF;
    vertical-align: middle;
  }
  
  .checkbox.checked {
    background-color: var(--primary);
    border-color: var(--primary);
    color: #FFFFFF;
  }
  
  .sim-input {
    display: flex; 
    align-items: center;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 8px 12px;
    background: #FFFFFF;
    font-size: 14px;
    color: var(--gray-600);
    gap: 8px;
  }
.comp-container {
    background-color: #FAFAFA;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 32px;
  }

  .comp-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 16px;
  }

  /* Desktop Navbar */
  .desktop-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    background-color: #FFFFFF;
    border-radius: var(--radius-lg);
  }

  .desktop-nav.scrolled {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: none;
  }

  .desktop-nav.default {
    border: 1px solid var(--border);
  }

  .nav-brand {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .nav-links {
    display: flex;
    gap: 32px;
  }

  .nav-link {
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-600);
    text-decoration: none;
  }

  .nav-link.active {
    color: var(--primary);
    font-weight: 600;
  }

  .btn-nav-primary {
    background-color: var(--primary);
    color: #FFFFFF;
    padding: 0 20px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  /* Mobile Navbar */
  .mobile-nav-wrapper {
    max-width: 375px;
    background: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
  }

  .mobile-nav-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    border-bottom: 1px solid var(--border);
  }

  .mobile-nav-menu {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .mobile-nav-item {
    padding: 12px;
    border-radius: var(--radius-md);
    color: var(--gray-600);
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
  }

  .mobile-nav-item.active {
    background-color: var(--primary-light);
    color: var(--primary);
    font-weight: 600;
  }

  /* Footer */
  .footer-wrapper {
    background-color: #4A0E28;
    color: #FFFFFF;
    padding: 48px;
    border-radius: var(--radius-xl);
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 64px;
    margin-bottom: 48px;
  }

  .footer-col-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 24px;
    color: #FFFFFF;
  }

  .footer-text {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
    margin-bottom: 24px;
    max-width: 320px;
  }

  .footer-links {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .footer-link {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
  }

  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 24px;
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.6);
  }

  /* Admin Sidebar */
  .sidebar-container {
    display: flex;
    gap: 32px;
  }

  .sidebar {
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    height: 600px;
    display: flex;
    flex-direction: column;
  }

  .sidebar-expanded {
    width: 240px;
  }

  .sidebar-collapsed {
    width: 80px;
    align-items: center;
  }

  .sidebar-header {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .sidebar-collapsed .sidebar-header {
    padding: 24px 0;
    justify-content: center;
    width: 100%;
  }

  .sidebar-menu {
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
  }

  .sidebar-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: var(--radius-lg);
    color: var(--gray-600);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
  }

  .sidebar-collapsed .sidebar-item {
    justify-content: center;
    padding: 12px 0;
    width: 48px;
  }

  .sidebar-item.active {
    background-color: var(--primary);
    color: #FFFFFF;
  }

  .sidebar-footer {
    padding: 16px 12px;
    border-top: 1px solid var(--border);
  }

  .sidebar-collapsed .sidebar-footer {
    display: flex;
    justify-content: center;
    width: 100%;
  }

  /* Breadcrumb & Pagination */
  .breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #6B7280;
  }

  .breadcrumb-item {
    cursor: pointer;
  }

  .breadcrumb-item.active {
    color: var(--gray-900);
    font-weight: 500;
  }

  .breadcrumb-separator {
    color: var(--gray-400);
    display: flex;
    align-items: center;
  }

  .pagination {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .page-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    background: #FFFFFF;
    color: var(--gray-600);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
  }

  .page-btn.active {
    background-color: var(--primary);
    color: #FFFFFF;
    border-color: var(--primary);
  }

  .page-btn.disabled {
    color: var(--gray-400);
    background-color: #F9FAFB;
    cursor: not-allowed;
  }
.ds-spacing-list {
    display: flex;
    flex-direction: column;
    max-width: 800px;
  }
  .ds-spacing-row {
    display: flex;
    padding: 20px 0;
    border-bottom: 1px solid #F3F4F6;
    align-items: center;
    gap: 48px;
  }
  .ds-spacing-row:last-child {
    border-bottom: none;
  }
  .ds-spacing-specs {
    width: 160px;
    flex-shrink: 0;
  }
  .ds-spacing-name {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 4px;
  }
  .ds-spacing-px {
    font-size: 13px;
    color: #6B7280;
  }
  .ds-spacing-bar {
    height: 32px;
    background-color: var(--primary);
    border-radius: 2px;
  }
.ds-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
  }
  .ds-spec-card {
    padding: 32px;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FAFAFA;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .ds-radius-visual {
    width: 80px;
    height: 80px;
    background-color: var(--primary);
    margin-bottom: 24px;
  }
  .ds-shadow-visual {
    width: 100px;
    height: 100px;
    background-color: #FFFFFF;
    margin-bottom: 24px;
    border-radius: var(--radius-xl);
  }
  .ds-spec-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 6px;
  }
  .ds-spec-desc {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.5;
  }
.ds-grid-diagrams {
    display: flex;
    flex-direction: column;
    gap: 48px;
  }
  .ds-grid-wrapper {
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FFFFFF;
    overflow: hidden;
  }
  .ds-grid-header {
    background-color: #FAFAFA;
    padding: 16px 24px;
    border-bottom: 1px solid var(--border);
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-900);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .ds-grid-header-specs {
    font-size: 13px;
    color: #6B7280;
    font-weight: 400;
  }
  .ds-grid-body {
    padding: 48px 24px;
    background-color: #FFFFFF;
    display: flex;
    justify-content: center;
  }
  .ds-grid-visual-container {
    width: 100%;
    background-color: #F9FAFB;
    border: 1px dashed #D1D5DB;
    border-radius: var(--radius-lg);
  }
  .ds-grid-visual-container.desktop {
    max-width: 1200px;
    padding: 32px 24px;
  }
  .ds-grid-visual-container.tablet {
    max-width: 768px;
    padding: 32px 24px;
  }
  .ds-grid-visual-container.mobile {
    max-width: 375px;
    padding: 32px 16px;
  }
  .ds-grid-row {
    display: grid;
    height: 120px;
  }
  .ds-grid-col {
    background-color: var(--primary-light);
    border: 1px solid rgba(139, 26, 74, 0.15);
    border-radius: var(--radius-sm);
  }
.ds-wrapper {
    min-height: 100vh;
    padding: 48px 64px;
    background-color: #FFFFFF;
    max-width: 1440px;
    margin: 0 auto;
  }
  
  .ds-header {
    margin-bottom: 32px;
  }
  
  .ds-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  
  .ds-subtitle {
    font-size: 16px;
    color: var(--gray-600);
  }

  .ds-tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
    overflow-x: auto;
    gap: 32px;
  }

  .ds-tab {
    padding: 16px 0;
    font-size: 15px;
    color: var(--gray-600);
    white-space: nowrap;
    position: relative;
    font-weight: 500;
    cursor: pointer;
  }

  .ds-tab.active {
    color: var(--primary);
    font-weight: 600;
  }

  .ds-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: var(--primary);
    border-radius: 3px 3px 0 0;
  }

  .ds-section {
    margin-bottom: 80px;
  }
  
  .ds-section-header {
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
/* Grid Layout for States */
  .form-grid-variants {
    display: grid;
    grid-template-columns: 100px repeat(5, minmax(180px, 1fr));
    gap: 48px 24px;
    align-items: start;
  }
  .grid-col-header {
    font-size: 13px;
    color: #6B7280;
    font-weight: 500;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
    margin-bottom: 16px;
  }
  .grid-row-label {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
    padding-top: 32px;
  }

  /* Form Group Base */
  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    font-family: 'Inter', var(--font-family-body, sans-serif);
  }
  .form-label {
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-900);
  }
  .form-helper {
    font-size: 12px;
    color: #6B7280;
    display: flex;
    align-items: center;
    gap: 4px;
    min-height: 16px;
  }
  .form-helper.error {
    color: var(--destructive);
  }
  .form-helper.success {
    color: var(--success);
  }

  /* Mock Inputs Base */
  .mock-input {
    width: 100%;
    height: 40px;
    padding: 0 12px;
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: var(--gray-900);
    cursor: text;
  }
  .mock-textarea {
    width: 100%;
    min-height: 80px;
    padding: 10px 12px;
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    font-size: 14px;
    color: var(--gray-900);
    cursor: text;
    display: flex;
    align-items: flex-start;
  }

  /* Input Text Colors */
  .text-placeholder {
    color: var(--gray-400);
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .text-value {
    color: var(--gray-900);
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .text-prefix {
    color: var(--gray-600);
    font-weight: 500;
  }

  /* Input States */
  .is-focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
  }
  .is-error {
    border-color: var(--destructive);
    box-shadow: 0 0 0 3px var(--destructive-surface);
  }
  .is-disabled {
    background-color: var(--muted);
    border-color: var(--border);
    color: var(--gray-400);
    cursor: not-allowed;
  }
  .is-disabled .text-value, 
  .is-disabled .text-placeholder,
  .is-disabled .icon-16 {
    color: var(--gray-400);
  }

  /* Select specific */
  .mock-select {
    cursor: pointer;
    position: relative;
  }
  .mock-dropdown-menu {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    z-index: 10;
    overflow: hidden;
    padding: 4px 0;
  }
  .mock-dropdown-item {
    padding: 8px 12px;
    font-size: 14px;
    color: var(--gray-900);
    cursor: pointer;
  }
  .mock-dropdown-item.active {
    background-color: var(--primary-light);
    color: var(--primary);
    font-weight: 500;
  }

  /* Radio & Checkbox */
  .mock-radio, .mock-checkbox {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 14px;
    color: var(--gray-900);
  }
  .mock-radio-box {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    flex-shrink: 0;
  }
  .mock-checkbox-box {
    width: 18px;
    height: 18px;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    flex-shrink: 0;
  }

  /* Radio States */
  .mock-radio.is-focus .mock-radio-box { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
  .mock-radio.is-checked .mock-radio-box { border-color: var(--primary); }
  .mock-radio.is-checked .mock-radio-dot { width: 10px; height: 10px; border-radius: 50%; background-color: var(--primary); }
  .mock-radio.is-error .mock-radio-box { border-color: var(--destructive); }
  .mock-radio.is-disabled { color: var(--gray-400); cursor: not-allowed; }
  .mock-radio.is-disabled .mock-radio-box { background-color: var(--muted); border-color: var(--border); }

  /* Checkbox States */
  .mock-checkbox.is-focus .mock-checkbox-box { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
  .mock-checkbox.is-checked .mock-checkbox-box { background-color: var(--primary); border-color: var(--primary); color: #FFFFFF; }
  .mock-checkbox.is-error .mock-checkbox-box { border-color: var(--destructive); }
  .mock-checkbox.is-disabled { color: var(--gray-400); cursor: not-allowed; }
  .mock-checkbox.is-disabled .mock-checkbox-box { background-color: var(--muted); border-color: var(--border); }

  /* File Upload Zone */
  .file-upload-zone {
    border: 2px dashed var(--border);
    border-radius: var(--radius-lg);
    padding: 32px 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background-color: #FAFAFA;
    text-align: center;
    cursor: pointer;
  }
  .file-upload-zone .upload-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-900);
    margin-top: 8px;
  }
  .file-upload-zone .upload-subtitle {
    font-size: 12px;
    color: #6B7280;
  }

  /* Chips */
  .chip-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 8px;
  }
  .form-chip {
    padding: 6px 12px;
    border: 1px solid var(--border);
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 500;
    color: var(--gray-600);
    background-color: #FFFFFF;
    cursor: pointer;
  }
  .form-chip.active {
    border-color: var(--primary);
    background-color: var(--primary-light);
    color: var(--primary);
  }

  /* Section Layouts */
  .variations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 40px;
  }
  .variation-card {
    padding: 24px;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    background-color: #FAFAFA;
  }

  /* Form Divider */
  .form-divider {
    display: flex;
    align-items: center;
    margin: 40px 0 24px;
  }
  .form-divider::before, .form-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background-color: var(--border);
  }
  .form-divider span {
    padding: 0 16px;
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  /* Icons */
  .icon-wrap-16 {
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .icon-wrap-20 {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .icon-16 { font-size: 16px; color: #6B7280; }
  .icon-20 { font-size: 20px; color: var(--primary); }
.ds-section {
    margin-bottom: 64px;
  }
  
  .ds-section-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
  }

  .ds-font-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 32px;
    margin-bottom: 64px;
  }

  .ds-font-card {
    padding: 24px;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    background-color: #FAFAFA;
  }

  .ds-font-name {
    font-size: 20px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 8px;
  }

  .ds-font-desc {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.5;
  }

  .ds-type-list {
    display: flex;
    flex-direction: column;
  }

  .ds-type-row {
    display: flex;
    padding: 32px 0;
    border-bottom: 1px solid var(--border);
    align-items: center;
    gap: 48px;
  }

  .ds-type-row:last-child {
    border-bottom: none;
  }

  .ds-type-specs {
    width: 240px;
    flex-shrink: 0;
  }

  .ds-type-name {
    font-size: 16px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 8px;
  }

  .ds-type-details {
    font-size: 13px;
    color: var(--gray-600);
    line-height: 1.5;
  }

  .ds-type-sample {
    flex: 1;
    color: var(--gray-900);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .ds-type-sample-wrap {
    flex: 1;
    color: var(--gray-900);
    line-height: 1.5;
  }
.ds-wrapper {
    min-height: 100vh;
    padding: 48px 64px;
    background-color: #FFFFFF;
    max-width: 1440px;
    margin: 0 auto;
  }
  
  .ds-header {
    margin-bottom: 32px;
  }
  
  .ds-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 8px;
  }
  
  .ds-subtitle {
    font-size: 16px;
    color: var(--gray-600);
  }

  .ds-tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    margin-bottom: 48px;
    overflow-x: auto;
    gap: 32px;
  }

  .ds-tab {
    padding: 16px 0;
    font-size: 15px;
    color: var(--gray-600);
    white-space: nowrap;
    position: relative;
    font-weight: 500;
    cursor: pointer;
  }

  .ds-tab.active {
    color: var(--primary);
    font-weight: 600;
  }

  .ds-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background-color: var(--primary);
    border-radius: 3px 3px 0 0;
  }

  .ds-section {
    margin-bottom: 80px;
  }
  
  .ds-section-header {
    border-bottom: 1px solid var(--border);
    padding-bottom: 16px;
    margin-bottom: 32px;
  }

  .ds-section-title {
    font-size: 24px;
    font-weight: 600;
    color: var(--gray-900);
  }

  .comp-container {
    background-color: #FAFAFA;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 32px;
  }

  .comp-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .comp-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 32px;
  }
/* Badges Base */
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    white-space: nowrap;
  }

  .badge-pill {
    border-radius: 9999px;
  }

  .badge-rounded {
    border-radius: var(--radius-sm);
  }

  /* Semantic Colors */
  .badge-warning {
    background-color: var(--warning-surface);
    color: var(--warning);
  }

  .badge-success {
    background-color: var(--success-surface);
    color: var(--success);
  }

  .badge-danger {
    background-color: var(--destructive-surface);
    color: var(--destructive);
  }

  .badge-info {
    background-color: var(--info-surface);
    color: var(--info);
  }

  .badge-gray {
    background-color: var(--muted);
    color: var(--gray-600);
  }

  .badge-primary {
    background-color: var(--primary-light);
    color: var(--primary);
  }

  /* Outlined Chips */
  .chip-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 500;
    padding: 6px 16px;
    border-radius: 9999px;
    border: 1px solid var(--border);
    color: var(--gray-600);
    background-color: #FFFFFF;
    cursor: pointer;
  }

  .chip-outline.active {
    border-color: var(--primary);
    color: var(--primary);
    background-color: var(--primary-light);
  }

  .flex-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
  }
/* Toasts */
  .toast {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    border-radius: var(--radius-lg);
    background-color: #FFFFFF;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-left: 4px solid transparent;
    max-width: 400px;
  }

  .toast-success {
    border-left-color: var(--success);
  }
  
  .toast-error {
    border-left-color: var(--destructive);
  }

  .toast-info {
    border-left-color: var(--info);
  }

  .toast-content {
    flex: 1;
    font-size: 14px;
    color: var(--gray-900);
    line-height: 1.5;
    font-weight: 500;
  }

  .toast-close {
    color: var(--gray-400);
    cursor: pointer;
    display: flex;
  }

  /* Empty State */
  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 24px;
    text-align: center;
    background-color: #FFFFFF;
    border: 1px dashed #D1D5DB;
    border-radius: var(--radius-xl);
  }

  .empty-state-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--muted);
    color: var(--gray-400);
    border-radius: 50%;
    margin-bottom: 24px;
  }

  .empty-state-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 8px;
  }

  .empty-state-desc {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 24px;
    max-width: 300px;
  }

  .btn-primary {
    background-color: var(--primary);
    color: #FFFFFF;
    padding: 0 20px;
    height: 40px;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  /* Skeleton Loading */
  .skeleton-card {
    background-color: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    width: 100%;
    max-width: 320px;
  }

  .skeleton-img {
    height: 180px;
    background-color: #F3F4F6;
    width: 100%;
  }

  .skeleton-body {
    padding: 20px;
  }

  .skeleton-line {
    height: 16px;
    background-color: #F3F4F6;
    border-radius: var(--radius-sm);
    margin-bottom: 12px;
  }

  .skeleton-line.short {
    width: 60%;
  }

  .skeleton-line.tiny {
    width: 30%;
    margin-top: 24px;
    margin-bottom: 0;
  }

  /* Alert Banner */
  .alert-banner {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    background-color: var(--info-surface);
    border-radius: var(--radius-lg);
    color: var(--info);
  }

  .alert-banner-content {
    font-size: 14px;
    font-weight: 500;
    flex: 1;
  }
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap');

  * { 
    box-sizing: border-box; 
    margin: 0; 
    padding: 0; 
  }
  body {
    background-color: var(--background, #FFFFFF);
    color: var(--foreground, var(--gray-900));
    font-family: 'Inter', var(--font-family-body, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif);
    -webkit-font-smoothing: antialiased;
  }
/* Base Card Styles */
  .card {
    background: #FFFFFF;
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .card-img-wrapper {
    width: 100%;
    position: relative;
  }

  .card-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
  }

  .card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .card-badge {
    display: inline-flex;
    padding: 4px 10px;
    background-color: var(--primary-light);
    color: var(--primary);
    font-size: 12px;
    font-weight: 600;
    border-radius: var(--radius-sm);
    margin-bottom: 12px;
    width: fit-content;
  }

  .card-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 18px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 8px;
    line-height: 1.4;
  }

  .card-excerpt {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.5;
    margin-bottom: 16px;
  }

  .card-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--gray-400);
    margin-top: auto;
  }

  .meta-dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #D1D5DB;
  }

  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Section Grid Layouts */
  .grid-2-cols {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
    align-items: start;
  }

  .grid-3-cols {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    align-items: start;
  }

  /* Horizontal Artikel Card */
  .card-horizontal {
    flex-direction: row;
  }

  .card-img-horizontal {
    width: 240px;
    height: 100%;
    object-fit: cover;
  }

  /* Program Donasi Card */
  .progress-section {
    margin-top: auto;
    margin-bottom: 20px;
  }

  .progress-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-size: 13px;
  }

  .progress-text {
    color: var(--gray-600);
  }

  .progress-text strong {
    color: var(--gray-900);
    font-weight: 600;
  }

  .progress-percent {
    color: var(--primary);
    font-weight: 600;
  }

  .progress-bar-bg {
    height: 6px;
    background-color: var(--border);
    border-radius: 9999px;
    overflow: hidden;
    margin-bottom: 8px;
  }

  .progress-bar-fill {
    height: 100%;
    background-color: var(--primary);
    border-radius: 9999px;
  }

  .progress-target {
    font-size: 12px;
    color: var(--gray-600);
  }

  /* Buttons */
  .btn-primary {
    background-color: var(--primary);
    color: #FFFFFF;
    border: none;
    border-radius: var(--radius-lg);
    padding: 12px 16px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
  }

  .btn-secondary {
    background-color: #FFFFFF;
    color: var(--primary);
    border: 1px solid var(--primary);
    border-radius: var(--radius-lg);
    padding: 12px 16px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
  }

  .full-width {
    width: 100%;
  }

  /* Ebook Card */
  .ebook-cover {
    width: 140px;
    height: 186px;
    border-radius: var(--radius-lg);
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  }

  .ebook-info {
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .ebook-author {
    font-size: 14px;
    color: var(--gray-600);
    margin-bottom: 12px;
  }

  .ebook-stats {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #6B7280;
    margin-bottom: 16px;
  }

  /* Laporan Card */
  .card-laporan {
    flex-direction: row;
    align-items: center;
    padding: 24px;
    gap: 20px;
    cursor: pointer;
  }

  .laporan-icon {
    width: 56px;
    height: 56px;
    border-radius: var(--radius-xl);
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .laporan-info {
    flex: 1;
  }

  .laporan-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
  }

  .badge-keuangan {
    padding: 4px 8px;
    background-color: var(--info-surface);
    color: var(--info);
    font-size: 11px;
    font-weight: 600;
    border-radius: var(--radius-sm);
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .laporan-tahun {
    font-size: 13px;
    color: var(--gray-600);
    font-weight: 500;
  }

  .laporan-action {
    display: flex;
    align-items: center;
    gap: 6px;
    padding-left: 16px;
  }

  .link-maroon {
    color: var(--primary);
    font-size: 14px;
    font-weight: 600;
  }

  /* Departemen Card */
  .card-departemen {
    padding: 24px;
    cursor: pointer;
    height: 100%;
  }

  .departemen-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 16px;
  }

  .departemen-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-xl);
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .link-maroon-wrap {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: auto;
  }

  /* Stat Card */
  .card-stat {
    padding: 24px;
  }

  .stat-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
  }

  .stat-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-xl);
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .stat-label {
    font-size: 15px;
    font-weight: 500;
    color: var(--gray-600);
  }

  .stat-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 36px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 12px;
  }

  .stat-trend {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
  }

  .trend-up {
    color: var(--success);
  }

  .trend-down {
    color: var(--destructive);
  }

  .trend-text {
    color: var(--gray-400);
    font-weight: 400;
  }

/* Fix for buttons inner icons color overriding */
        .btn iconify-icon, .btn-primary iconify-icon, .btn-secondary iconify-icon, .btn-danger iconify-icon, .btn-ghost iconify-icon, .btn-outline iconify-icon, .action-btn iconify-icon {
            color: inherit !important;
        }

        /* Global Typography Overrides */
        body, .ds-wrapper { font-family: 'Inter', system-ui, -apple-system, sans-serif !important; }
        h1, h2, h3, h4, h5, h6, .ds-title, .ds-section-title, .card-title, .ds-spec-title, .btn, .ds-display, .ds-h1, .ds-h2, .ds-h3, .ds-h4, .ds-h5, .ds-h6 { font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important; }
        .amiri, .arab, [dir="rtl"], .text-arab { font-family: 'Amiri', serif !important; }
        
        /* Fix for Typography Sample Texts matching the left-side label */
        .ds-type-sample[style*="48px"],
        .ds-type-sample[style*="36px"],
        .ds-type-sample[style*="28px"],
        .ds-type-sample[style*="22px"],
        .ds-type-sample[style*="18px"] {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important;
        }
    </style>
</head>
<body>
    <div class="ds-wrapper" x-data="{ activeTab: 'color' }" x-cloak>
        <header class="ds-header">
            <h1 class="ds-title" style="font-family: 'Plus Jakarta Sans', sans-serif;">Mimbar Al-Tauhid UI Kit</h1>
            <p class="ds-subtitle">Design system guidelines and core components</p>
        </header>

        <nav class="ds-tabs">
            <div class="ds-tab" :class="{ 'active': activeTab === 'color' }" @click="activeTab = 'color'">Color</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'typography' }" @click="activeTab = 'typography'">Typography</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'spacing' }" @click="activeTab = 'spacing'">Spacing & Grid</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'responsive' }" @click="activeTab = 'responsive'">Responsive & Mobile</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'buttons' }" @click="activeTab = 'buttons'">Buttons</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'forms' }" @click="activeTab = 'forms'">Forms</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'cards' }" @click="activeTab = 'cards'">Cards</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'navigation' }" @click="activeTab = 'navigation'">Navigation</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'feedback' }" @click="activeTab = 'feedback'">Badges & Feedback</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'tables' }" @click="activeTab = 'tables'">Tables</div>
            <div class="ds-tab" :class="{ 'active': activeTab === 'donasi' }" @click="activeTab = 'donasi'">Donasi Components</div>
        </nav>

        <div x-show="activeTab === 'color'" x-transition>
            <main>
                <!-- Brand Colors Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Brand Colors</h2>
      </div>
      <div class="ds-color-grid">
        <!-- Primary / Maroon -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--primary);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Primary / Maroon</span>
              <span class="ds-swatch-hex">var(--primary)</span>
            </div>
            <p class="ds-swatch-usage">Main brand color — used for CTA buttons, headings, nav active state.</p>
          </div>
        </div>

        <!-- Primary Dark -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--primary-dark);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Primary Dark</span>
              <span class="ds-swatch-hex">var(--primary-dark)</span>
            </div>
            <p class="ds-swatch-usage">Used for hover states on primary actions and deep background accents.</p>
          </div>
        </div>

        <!-- Primary Light -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--primary-light);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Primary Light</span>
              <span class="ds-swatch-hex">var(--primary-light)</span>
            </div>
            <p class="ds-swatch-usage">Used for tinted backgrounds, highlight rows, and subtle brand presence.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Neutral Palette Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Neutral Palette</h2>
      </div>
      <div class="ds-color-grid">
        <!-- Gray 900 -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--gray-900);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Gray 900</span>
              <span class="ds-swatch-hex">var(--gray-900)</span>
            </div>
            <p class="ds-swatch-usage">Primary body text, high-contrast headings, and solid dark backgrounds.</p>
          </div>
        </div>

        <!-- Gray 600 -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--gray-600);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Gray 600</span>
              <span class="ds-swatch-hex">var(--gray-600)</span>
            </div>
            <p class="ds-swatch-usage">Secondary text, subtitles, meta information, and muted icons.</p>
          </div>
        </div>

        <!-- Gray 400 -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--gray-400);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Gray 400</span>
              <span class="ds-swatch-hex">var(--gray-400)</span>
            </div>
            <p class="ds-swatch-usage">Placeholder text, disabled states, and subtle UI icons.</p>
          </div>
        </div>

        <!-- Gray 200 -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--border);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Gray 200</span>
              <span class="ds-swatch-hex">var(--border)</span>
            </div>
            <p class="ds-swatch-usage">Borders, dividers, and inactive structural elements.</p>
          </div>
        </div>

        <!-- Gray 100 -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--muted);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Gray 100</span>
              <span class="ds-swatch-hex">var(--muted)</span>
            </div>
            <p class="ds-swatch-usage">Default page background, table header rows, and secondary panels.</p>
          </div>
        </div>

        <!-- White -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: #FFFFFF;"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">White</span>
              <span class="ds-swatch-hex">#FFFFFF</span>
            </div>
            <p class="ds-swatch-usage">Card backgrounds, primary surface areas, and text on dark backgrounds.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Semantic Colors Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Semantic Colors</h2>
      </div>
      <div class="ds-color-grid">
        <!-- Success Base -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--success);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Success Base</span>
              <span class="ds-swatch-hex">var(--success)</span>
            </div>
            <p class="ds-swatch-usage">Verified status, positive actions, success text and icons.</p>
          </div>
        </div>
        
        <!-- Success Surface -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--success-surface);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Success Surface</span>
              <span class="ds-swatch-hex">var(--success-surface)</span>
            </div>
            <p class="ds-swatch-usage">Background for success alerts, badges, and verified highlights.</p>
          </div>
        </div>

        <!-- Warning Base -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--warning);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Warning Base</span>
              <span class="ds-swatch-hex">var(--warning)</span>
            </div>
            <p class="ds-swatch-usage">Pending status, needs action, warning text and icons.</p>
          </div>
        </div>

        <!-- Warning Surface -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--warning-surface);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Warning Surface</span>
              <span class="ds-swatch-hex">var(--warning-surface)</span>
            </div>
            <p class="ds-swatch-usage">Background for warning alerts, pending badges, and caution notices.</p>
          </div>
        </div>

        <!-- Danger Base -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--destructive);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Danger Base</span>
              <span class="ds-swatch-hex">var(--destructive)</span>
            </div>
            <p class="ds-swatch-usage">Rejected status, errors, destructive actions, danger text.</p>
          </div>
        </div>

        <!-- Danger Surface -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--destructive-surface);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Danger Surface</span>
              <span class="ds-swatch-hex">var(--destructive-surface)</span>
            </div>
            <p class="ds-swatch-usage">Background for error alerts, rejected badges, and destructive states.</p>
          </div>
        </div>

        <!-- Info Base -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--info);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Info Base</span>
              <span class="ds-swatch-hex">var(--info)</span>
            </div>
            <p class="ds-swatch-usage">Informational notices, standard links, neutral system states.</p>
          </div>
        </div>

        <!-- Info Surface -->
        <div class="ds-swatch">
          <div class="ds-swatch-color" style="background-color: var(--info-surface);"></div>
          <div class="ds-swatch-info">
            <div class="ds-swatch-header">
              <span class="ds-swatch-token">Info Surface</span>
              <span class="ds-swatch-hex">var(--info-surface)</span>
            </div>
            <p class="ds-swatch-usage">Background for info alerts, neutral badges, and helpful tips.</p>
          </div>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'typography'" x-transition>
            <main>
                <!-- Font Families Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Font Families</h2>
      </div>
      <div class="ds-font-grid">
        <div class="ds-font-card">
          <div class="ds-font-name">Plus Jakarta Sans</div>
          <div class="ds-font-desc">Primary heading font. Used for all main titles, section headers, and impactful typography. Employs Bold and Semibold weights.</div>
        </div>
        <div class="ds-font-card">
          <div class="ds-font-name">Inter</div>
          <div class="ds-font-desc">Primary body font. Used for long-form reading, descriptions, UI labels, and meta information. Employs Medium and Regular weights.</div>
        </div>
        <div class="ds-font-card">
          <div class="ds-font-name">Amiri</div>
          <div class="ds-font-desc">Specialty Arabic font. Exclusively used for Quranic verses and Arabic content requiring RTL direction and authentic typographic presentation.</div>
        </div>
      </div>
    </section>

    <!-- Type Scale Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Type Scale</h2>
      </div>
      
      <div class="ds-type-list">
        <!-- Display / Hero -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Display / Hero</div>
            <div class="ds-type-details">Plus Jakarta Sans<br>48px • Bold • 1.2 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 48px; font-weight: 700; line-height: 1.2;">
            Empowering Ummah
          </div>
        </div>

        <!-- H1 -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">H1</div>
            <div class="ds-type-details">Plus Jakarta Sans<br>36px • Bold • 1.2 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 36px; font-weight: 700; line-height: 1.2;">
            Foundation for a Better Tomorrow
          </div>
        </div>

        <!-- H2 -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">H2</div>
            <div class="ds-type-details">Plus Jakarta Sans<br>28px • Semibold • 1.3 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 28px; font-weight: 600; line-height: 1.3;">
            Our Core Programs &amp; Initiatives
          </div>
        </div>

        <!-- H3 -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">H3</div>
            <div class="ds-type-details">Plus Jakarta Sans<br>22px • Semibold • 1.3 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 22px; font-weight: 600; line-height: 1.3;">
            Donate to Orphanage Construction
          </div>
        </div>

        <!-- H4 -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">H4</div>
            <div class="ds-type-details">Plus Jakarta Sans<br>18px • Semibold • 1.4 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 18px; font-weight: 600; line-height: 1.4;">
            Campaign Objective Details
          </div>
        </div>

        <!-- Body Large -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Body Large</div>
            <div class="ds-type-details">Inter<br>16px • Regular • 1.5 LH</div>
          </div>
          <div class="ds-type-sample-wrap" style="font-size: 16px; font-weight: 400; line-height: 1.5;">
            Mimbar Al-Tauhid is dedicated to providing humanitarian assistance, educational support, and community development programs to those in need.
          </div>
        </div>

        <!-- Body -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Body</div>
            <div class="ds-type-details">Inter<br>14px • Regular • 1.5 LH</div>
          </div>
          <div class="ds-type-sample-wrap" style="font-size: 14px; font-weight: 400; line-height: 1.5;">
            By contributing to this campaign, you are helping us build a sustainable future. Your donations go directly towards funding essential resources, education, and shelter.
          </div>
        </div>

        <!-- Small / Caption -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Small / Caption</div>
            <div class="ds-type-details">Inter<br>12px • Regular • 1.5 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 12px; font-weight: 400; line-height: 1.5; color: var(--gray-600);">
            Last updated on October 24, 2023 • 2 mins read
          </div>
        </div>

        <!-- Label / Overline -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Label / Overline</div>
            <div class="ds-type-details">Inter<br>11px • Medium • 1.5 LH</div>
          </div>
          <div class="ds-type-sample" style="font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; line-height: 1.5; color: var(--gray-600);">
            Section Label
          </div>
        </div>

        <!-- Arabic Text -->
        <div class="ds-type-row">
          <div class="ds-type-specs">
            <div class="ds-type-name">Arabic Text</div>
            <div class="ds-type-details">Amiri<br>28px • Regular • 1.8 LH</div>
          </div>
          <div class="ds-type-sample-wrap" dir="rtl" style="font-size: 28px; font-weight: 400; line-height: 1.8; text-align: right;">
            وَتَعَاوَنُوا عَلَى الْبِرِّ وَالتَّقْوَىٰ
          </div>
        </div>

      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'spacing'" x-transition>
            <main>
                <!-- Spacing Scale -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Spacing Scale (Base 4px)</h2>
      </div>
      <div class="ds-spacing-list">
        <!-- 4px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">4px</div>
            <div class="ds-spacing-px">0.25rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 4px;"></div>
        </div>
        <!-- 8px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">8px</div>
            <div class="ds-spacing-px">0.5rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 8px;"></div>
        </div>
        <!-- 12px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">12px</div>
            <div class="ds-spacing-px">0.75rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 12px;"></div>
        </div>
        <!-- 16px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">16px</div>
            <div class="ds-spacing-px">1rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 16px;"></div>
        </div>
        <!-- 20px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">20px</div>
            <div class="ds-spacing-px">1.25rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 20px;"></div>
        </div>
        <!-- 24px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">24px</div>
            <div class="ds-spacing-px">1.5rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 24px;"></div>
        </div>
        <!-- 32px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">32px</div>
            <div class="ds-spacing-px">2rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 32px;"></div>
        </div>
        <!-- 40px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">40px</div>
            <div class="ds-spacing-px">2.5rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 40px;"></div>
        </div>
        <!-- 48px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">48px</div>
            <div class="ds-spacing-px">3rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 48px;"></div>
        </div>
        <!-- 64px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">64px</div>
            <div class="ds-spacing-px">4rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 64px;"></div>
        </div>
        <!-- 80px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">80px</div>
            <div class="ds-spacing-px">5rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 80px;"></div>
        </div>
        <!-- 96px -->
        <div class="ds-spacing-row">
          <div class="ds-spacing-specs">
            <div class="ds-spacing-name">96px</div>
            <div class="ds-spacing-px">6rem</div>
          </div>
          <div class="ds-spacing-bar" style="width: 96px;"></div>
        </div>
      </div>
    </section>

    <!-- Border Radius -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Border Radius</h2>
      </div>
      <div class="ds-cards-grid">
        <!-- xs -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: var(--radius-sm);"></div>
          <div class="ds-spec-title">xs / 4px</div>
          <div class="ds-spec-desc">Tags, chips</div>
        </div>
        <!-- sm -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: var(--radius-lg);"></div>
          <div class="ds-spec-title">sm / 8px</div>
          <div class="ds-spec-desc">Buttons, inputs, small cards</div>
        </div>
        <!-- md -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: var(--radius-xl);"></div>
          <div class="ds-spec-title">md / 12px</div>
          <div class="ds-spec-desc">Cards, panels</div>
        </div>
        <!-- lg -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: 16px;"></div>
          <div class="ds-spec-title">lg / 16px</div>
          <div class="ds-spec-desc">Modals, feature cards</div>
        </div>
        <!-- xl -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: 24px;"></div>
          <div class="ds-spec-title">xl / 24px</div>
          <div class="ds-spec-desc">Hero sections, large containers</div>
        </div>
        <!-- full -->
        <div class="ds-spec-card">
          <div class="ds-radius-visual" style="border-radius: 9999px;"></div>
          <div class="ds-spec-title">full / 9999px</div>
          <div class="ds-spec-desc">Pills, badges, avatars</div>
        </div>
      </div>
    </section>

    <!-- Shadow Scale -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Shadow Scale</h2>
      </div>
      <div class="ds-cards-grid">
        <!-- sm -->
        <div class="ds-spec-card">
          <div class="ds-shadow-visual" style="box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);"></div>
          <div class="ds-spec-title">shadow-sm</div>
          <div class="ds-spec-desc">Subtle card lift</div>
        </div>
        <!-- md -->
        <div class="ds-spec-card">
          <div class="ds-shadow-visual" style="box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);"></div>
          <div class="ds-spec-title">shadow-md</div>
          <div class="ds-spec-desc">Dropdowns, floating elements</div>
        </div>
        <!-- lg -->
        <div class="ds-spec-card">
          <div class="ds-shadow-visual" style="box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);"></div>
          <div class="ds-spec-title">shadow-lg</div>
          <div class="ds-spec-desc">Modals, sticky navbar on scroll</div>
        </div>
      </div>
    </section>

    <!-- Grid System -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Grid System</h2>
      </div>
      <div class="ds-grid-diagrams">
        <!-- Desktop -->
        <div class="ds-grid-wrapper">
          <div class="ds-grid-header">
            <span>Desktop</span>
            <span class="ds-grid-header-specs">12 columns • max 1200px • 24px gutter</span>
          </div>
          <div class="ds-grid-body">
            <div class="ds-grid-visual-container desktop">
              <div class="ds-grid-row" style="grid-template-columns: repeat(12, 1fr); gap: 24px;">
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div>
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div>
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tablet -->
        <div class="ds-grid-wrapper">
          <div class="ds-grid-header">
            <span>Tablet</span>
            <span class="ds-grid-header-specs">8 columns • 20px gutter</span>
          </div>
          <div class="ds-grid-body">
            <div class="ds-grid-visual-container tablet">
              <div class="ds-grid-row" style="grid-template-columns: repeat(8, 1fr); gap: 20px;">
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div>
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div><div class="ds-grid-col"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile -->
        <div class="ds-grid-wrapper">
          <div class="ds-grid-header">
            <span>Mobile</span>
            <span class="ds-grid-header-specs">4 columns • 16px gutter • 16px side padding</span>
          </div>
          <div class="ds-grid-body">
            <div class="ds-grid-visual-container mobile">
              <div class="ds-grid-row" style="grid-template-columns: repeat(4, 1fr); gap: 16px;">
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div>
                <div class="ds-grid-col"></div><div class="ds-grid-col"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'responsive'" x-transition>
            <main>
                <!-- Responsive Principles Section -->
                <section class="ds-section">
                    <div class="ds-section-header">
                        <h2 class="ds-section-title">Responsive & Mobile Guidelines</h2>
                    </div>
                    
                    <div class="comp-container">
                        <h3 class="comp-title">Core Breakpoints</h3>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Device / Breakpoint</th>
                                        <th>Viewport Width</th>
                                        <th>Tailwind Prefix</th>
                                        <th>Primary Layout Target</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark">Mobile (Default)</td>
                                        <td>&lt; 768px</td>
                                        <td><em>None</em> (Base)</td>
                                        <td>iPhone / Android (375px base)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Tablet</td>
                                        <td>&ge; 768px</td>
                                        <td><code>md:</code></td>
                                        <td>iPad</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Desktop</td>
                                        <td>&ge; 1024px</td>
                                        <td><code>lg:</code></td>
                                        <td>Laptop / PC</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="comp-container">
                        <h3 class="comp-title">Typography Scaling (Mobile vs Desktop)</h3>
                        <p class="ds-swatch-usage" style="margin-bottom: 24px;">Gunakan ukuran font yang menyesuaikan layar. Di Tailwind, deklarasikan ukuran mobile terlebih dahulu, lalu ukuran desktop dengan prefix <code>md:</code>.</p>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Element</th>
                                        <th>Mobile Size (&lt; 768px)</th>
                                        <th>Desktop Size (&ge; 768px)</th>
                                        <th>Tailwind Utility Class</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark">Heading 1 (Page Title)</td>
                                        <td>24px</td>
                                        <td>32px</td>
                                        <td><code>text-2xl md:text-4xl</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Heading 2 (Section Title)</td>
                                        <td>20px</td>
                                        <td>24px</td>
                                        <td><code>text-xl md:text-2xl</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Heading 3 (Card Title)</td>
                                        <td>18px</td>
                                        <td>20px</td>
                                        <td><code>text-lg md:text-xl</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Body Text (Paragraph)</td>
                                        <td>14px</td>
                                        <td>16px</td>
                                        <td><code>text-sm md:text-base</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="comp-container">
                        <h3 class="comp-title">Spacing & Layout Constraints</h3>
                        <div class="table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Constraint Type</th>
                                        <th>Mobile Target</th>
                                        <th>Desktop Target</th>
                                        <th>Tailwind Utility Class</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark">Page/Container Padding (Horizontal)</td>
                                        <td>16px (Kiri-Kanan)</td>
                                        <td>32px - 64px</td>
                                        <td><code>px-4 md:px-8</code> / <code>md:px-16</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Section Gap (Vertical Spacing)</td>
                                        <td>32px</td>
                                        <td>64px - 80px</td>
                                        <td><code>py-8 md:py-16</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark">Grid Stacking</td>
                                        <td>1 Kolom (Full width)</td>
                                        <td>2-3 Kolom</td>
                                        <td><code>grid-cols-1 md:grid-cols-2 lg:grid-cols-3</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <div x-show="activeTab === 'buttons'" x-transition>
            <main>
                <!-- Button Variants -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Variants &amp; States</h2>
      </div>
      <div class="btn-grid-variants">
        <div class="btn-grid-header">Variant</div>
        <div class="btn-grid-header">Default</div>
        <div class="btn-grid-header">Hover</div>
        <div class="btn-grid-header">Disabled</div>

        <!-- Primary -->
        <div class="btn-grid-label">Primary</div>
        <div><button class="btn btn-primary btn-md" data-media-type="banani-button">Donasi Sekarang</button></div>
        <div><button class="btn btn-primary btn-md hover" data-media-type="banani-button">Donasi Sekarang</button></div>
        <div><button class="btn btn-primary btn-md disabled" data-media-type="banani-button">Donasi Sekarang</button></div>

        <!-- Secondary -->
        <div class="btn-grid-label">Secondary</div>
        <div><button class="btn btn-secondary btn-md" data-media-type="banani-button">Pesan Qurban</button></div>
        <div><button class="btn btn-secondary btn-md hover" data-media-type="banani-button">Pesan Qurban</button></div>
        <div><button class="btn btn-secondary btn-md disabled" data-media-type="banani-button">Pesan Qurban</button></div>

        <!-- Ghost -->
        <div class="btn-grid-label">Ghost</div>
        <div><button class="btn btn-ghost btn-md" data-media-type="banani-button">Batal</button></div>
        <div><button class="btn btn-ghost btn-md hover" data-media-type="banani-button">Batal</button></div>
        <div><button class="btn btn-ghost btn-md disabled" data-media-type="banani-button">Batal</button></div>

        <!-- Danger -->
        <div class="btn-grid-label">Danger</div>
        <div><button class="btn btn-danger btn-md" data-media-type="banani-button">Hapus</button></div>
        <div><button class="btn btn-danger btn-md hover" data-media-type="banani-button">Hapus</button></div>
        <div><button class="btn btn-danger btn-md disabled" data-media-type="banani-button">Hapus</button></div>

        <!-- Success -->
        <div class="btn-grid-label">Success</div>
        <div><button class="btn btn-success btn-md" data-media-type="banani-button">Verifikasi</button></div>
        <div><button class="btn btn-success btn-md hover" data-media-type="banani-button">Verifikasi</button></div>
        <div><button class="btn btn-success btn-md disabled" data-media-type="banani-button">Verifikasi</button></div>
      </div>
    </section>

    <!-- Button Sizes -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Button Sizes</h2>
      </div>
      <div class="btn-sizes-flex">
        <div class="btn-size-item">
          <div class="btn-size-label">Large (48px) - Hero CTA</div>
          <button class="btn btn-primary btn-lg" data-media-type="banani-button">Donasi Sekarang</button>
        </div>
        <div class="btn-size-item">
          <div class="btn-size-label">Medium (40px) - Standard</div>
          <button class="btn btn-primary btn-md" data-media-type="banani-button">Donasi Sekarang</button>
        </div>
        <div class="btn-size-item">
          <div class="btn-size-label">Small (32px) - Inline</div>
          <button class="btn btn-primary btn-sm" data-media-type="banani-button">Donasi</button>
        </div>
      </div>
    </section>

    <!-- Button Features & Shapes -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Layouts &amp; Shapes</h2>
      </div>
      <div class="btn-features-grid">
        <div class="btn-feature-card">
          <div class="btn-feature-label">With Left Icon</div>
          <button class="btn btn-primary btn-md" data-media-type="banani-button">
            <div class="icon-wrap-16"><iconify-icon icon="lucide:download" class="icon-16"></iconify-icon></div>
            Unduh Laporan
          </button>
        </div>
        
        <div class="btn-feature-card">
          <div class="btn-feature-label">With Right Icon</div>
          <button class="btn btn-secondary btn-md" data-media-type="banani-button">
            Lanjut Pembayaran
            <div class="icon-wrap-16"><iconify-icon icon="lucide:arrow-right" class="icon-16"></iconify-icon></div>
          </button>
        </div>

        <div class="btn-feature-card">
          <div class="btn-feature-label">Loading State</div>
          <button class="btn btn-primary btn-md disabled" data-media-type="banani-button">
            <div class="icon-wrap-16"><iconify-icon icon="lucide:loader-2" class="icon-16"></iconify-icon></div>
            Memproses...
          </button>
        </div>

        <div class="btn-feature-card"><div class="btn-feature-label">Icon Only (Square)</div><div class="btn-icon-square-row"><button class="btn btn-secondary btn-icon-square-lg" data-media-type="banani-button"><div class="icon-wrap-16"><iconify-icon icon="lucide:bookmark" class="icon-16"></iconify-icon></div></button><button class="btn btn-primary btn-icon-square-lg" data-media-type="banani-button"><div class="icon-wrap-16"><iconify-icon icon="lucide:plus" class="icon-16"></iconify-icon></div></button></div></div>

        <div class="btn-feature-card">
          <div class="btn-feature-label">Icon Only (Rounded)</div>
          <div style="display: flex; gap: 16px; cursor: default;" class="element-inspector-selected"><button class="btn btn-secondary btn-rounded-full" data-media-type="banani-button" style="width: 40px; height: 40px; aspect-ratio: 1 / 1; padding: 0; border-radius: 9999px; flex-shrink: 0; cursor: default;"><div class="icon-wrap-16"><iconify-icon icon="lucide:arrow-left" class="icon-16"></iconify-icon></div></button><button class="btn btn-danger btn-rounded-full" data-media-type="banani-button" style="width: 40px; height: 40px; aspect-ratio: 1 / 1; padding: 0; border-radius: 9999px; flex-shrink: 0;"><div class="icon-wrap-16"><iconify-icon icon="lucide:trash" class="icon-16"></iconify-icon></div></button></div>
        </div>
      </div>

      <!-- Full Width Example -->
      <div style="max-width: 480px;">
        <div class="btn-feature-label" style="margin-bottom: 16px;">Full Width Button</div>
        <div style="padding: 24px; border: 1px solid var(--border); border-radius: var(--radius-xl); background-color: #FAFAFA;">
          <button class="btn btn-primary btn-md btn-full-width" data-media-type="banani-button">
            Selesaikan Pembayaran
          </button>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'forms'" x-transition>
            <main>
                <!-- Input States Matrix -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Input States</h2>
      </div>
      
      <div class="form-grid-variants">
        <!-- Headers -->
        <div class="grid-col-header">Component</div>
        <div class="grid-col-header">Default</div>
        <div class="grid-col-header">Focus</div>
        <div class="grid-col-header">Filled</div>
        <div class="grid-col-header">Error</div>
        <div class="grid-col-header">Disabled</div>

        <!-- Text Input Row -->
        <div class="grid-row-label">Text Input</div>
        <!-- Default -->
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="mock-input">
            <span class="text-placeholder">Masukkan nama</span>
          </div>
          <div class="form-helper">Sesuai KTP</div>
        </div>
        <!-- Focus -->
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="mock-input is-focus">
            <span class="text-placeholder">Masukkan nama</span>
          </div>
          <div class="form-helper">Sesuai KTP</div>
        </div>
        <!-- Filled -->
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="mock-input">
            <span class="text-value">Abdullah</span>
          </div>
          <div class="form-helper">Sesuai KTP</div>
        </div>
        <!-- Error -->
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="mock-input is-error">
            <span class="text-value">Abdullah</span>
          </div>
          <div class="form-helper error">
            <div class="icon-wrap-16"><iconify-icon icon="lucide:alert-circle" style="color: var(--destructive); font-size: 14px;"></iconify-icon></div>
            Nama wajib diisi
          </div>
        </div>
        <!-- Disabled -->
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="mock-input is-disabled">
            <span class="text-placeholder">Masukkan nama</span>
          </div>
          <div class="form-helper">Sesuai KTP</div>
        </div>

        <!-- Textarea Row -->
        <div class="grid-row-label">Textarea</div>
        <!-- Default -->
        <div class="form-group">
          <label class="form-label">Pesan/Doa</label>
          <div class="mock-textarea">
            <span class="text-placeholder">Tulis pesan atau doa...</span>
          </div>
        </div>
        <!-- Focus -->
        <div class="form-group">
          <label class="form-label">Pesan/Doa</label>
          <div class="mock-textarea is-focus">
            <span class="text-placeholder">Tulis pesan atau doa...</span>
          </div>
        </div>
        <!-- Filled -->
        <div class="form-group">
          <label class="form-label">Pesan/Doa</label>
          <div class="mock-textarea">
            <span class="text-value">Semoga menjadi amal jariyah bagi keluarga. Aamiin.</span>
          </div>
        </div>
        <!-- Error -->
        <div class="form-group">
          <label class="form-label">Pesan/Doa</label>
          <div class="mock-textarea is-error">
            <span class="text-placeholder">Tulis pesan atau doa...</span>
          </div>
          <div class="form-helper error">
            <div class="icon-wrap-16"><iconify-icon icon="lucide:alert-circle" style="color: var(--destructive); font-size: 14px;"></iconify-icon></div>
            Pesan terlalu panjang
          </div>
        </div>
        <!-- Disabled -->
        <div class="form-group">
          <label class="form-label">Pesan/Doa</label>
          <div class="mock-textarea is-disabled">
            <span class="text-placeholder">Tulis pesan atau doa...</span>
          </div>
        </div>

        <!-- Select Row -->
        <div class="grid-row-label">Select</div>
        <!-- Default -->
        <div class="form-group">
          <label class="form-label">Pilih Bank</label>
          <div class="mock-input mock-select">
            <span class="text-placeholder">Pilih bank transfer</span>
            <div class="icon-wrap-16"><iconify-icon icon="lucide:chevron-down" class="icon-16"></iconify-icon></div>
          </div>
        </div>
        <!-- Focus -->
        <div class="form-group">
          <label class="form-label">Pilih Bank</label>
          <div class="mock-input mock-select is-focus">
            <span class="text-placeholder">Pilih bank transfer</span>
            <div class="icon-wrap-16"><iconify-icon icon="lucide:chevron-down" class="icon-16"></iconify-icon></div>
          </div>
        </div>
        <!-- Filled / Open State -->
        <div class="form-group" style="position: relative;">
          <label class="form-label">Pilih Bank</label>
          <div class="mock-input mock-select is-focus">
            <span class="text-value">Bank Syariah Indonesia (BSI)</span>
            <div class="icon-wrap-16"><iconify-icon icon="lucide:chevron-up" class="icon-16" style="color: var(--primary);"></iconify-icon></div>
          </div>
          <!-- Dropdown open simulation -->
          <div class="mock-dropdown-menu">
            <div class="mock-dropdown-item">Bank Muamalat</div>
            <div class="mock-dropdown-item active">Bank Syariah Indonesia (BSI)</div>
            <div class="mock-dropdown-item">Mandiri Syariah</div>
          </div>
        </div>
        <!-- Error -->
        <div class="form-group">
          <label class="form-label">Pilih Bank</label>
          <div class="mock-input mock-select is-error">
            <span class="text-placeholder">Pilih bank transfer</span>
            <div class="icon-wrap-16"><iconify-icon icon="lucide:chevron-down" class="icon-16"></iconify-icon></div>
          </div>
        </div>
        <!-- Disabled -->
        <div class="form-group">
          <label class="form-label">Pilih Bank</label>
          <div class="mock-input mock-select is-disabled">
            <span class="text-placeholder">Pilih bank transfer</span>
            <div class="icon-wrap-16"><iconify-icon icon="lucide:chevron-down" class="icon-16"></iconify-icon></div>
          </div>
        </div>

        <!-- Checkbox Row -->
        <div class="grid-row-label">Checkbox</div>
        <!-- Default -->
        <div class="form-group">
          <div class="mock-checkbox" style="margin-top: 28px;">
            <div class="mock-checkbox-box"></div>
            <span>Hamba Allah</span>
          </div>
        </div>
        <!-- Focus -->
        <div class="form-group">
          <div class="mock-checkbox is-focus" style="margin-top: 28px;">
            <div class="mock-checkbox-box"></div>
            <span>Hamba Allah</span>
          </div>
        </div>
        <!-- Checked -->
        <div class="form-group">
          <div class="mock-checkbox is-checked" style="margin-top: 28px;">
            <div class="mock-checkbox-box">
              <iconify-icon icon="lucide:check" style="font-size: 12px;"></iconify-icon>
            </div>
            <span>Hamba Allah</span>
          </div>
        </div>
        <!-- Error -->
        <div class="form-group">
          <div class="mock-checkbox is-error" style="margin-top: 28px;">
            <div class="mock-checkbox-box"></div>
            <span>Hamba Allah</span>
          </div>
        </div>
        <!-- Disabled -->
        <div class="form-group">
          <div class="mock-checkbox is-disabled" style="margin-top: 28px;">
            <div class="mock-checkbox-box"></div>
            <span>Hamba Allah</span>
          </div>
        </div>

      </div>
    </section>

    <!-- Variations & Special Components -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Variations &amp; Special Components</h2>
      </div>
      
      <div class="variations-grid">
        <!-- Nominal Input with Chips -->
        <div class="variation-card">
          <div class="form-group">
            <label class="form-label">Nominal Donasi</label>
            <div class="mock-input">
              <span class="text-prefix">Rp</span>
              <span class="text-value">500.000</span>
            </div>
            <div class="chip-group">
              <div class="form-chip" data-media-type="banani-button">50rb</div>
              <div class="form-chip" data-media-type="banani-button">100rb</div>
              <div class="form-chip" data-media-type="banani-button">200rb</div>
              <div class="form-chip active" data-media-type="banani-button">500rb</div>
              <div class="form-chip" data-media-type="banani-button">Lainnya</div>
            </div>
          </div>
        </div>

        <!-- Search Input -->
        <div class="variation-card">
          <div class="form-group">
            <label class="form-label">Search Donatur</label>
            <div class="mock-input">
              <div class="icon-wrap-16"><iconify-icon icon="lucide:search" class="icon-16"></iconify-icon></div>
              <span class="text-value">Abdullah</span>
              <div class="icon-wrap-16" style="cursor: pointer;"><iconify-icon icon="lucide:x" class="icon-16"></iconify-icon></div>
            </div>
            <div class="form-helper">Cari berdasarkan nama atau no. referensi</div>
          </div>
        </div>

        <!-- Radio Group -->
        <div class="variation-card">
          <div class="form-group">
            <label class="form-label">Pilih Jenis Qurban</label>
            <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 8px;">
              <div class="mock-radio is-checked">
                <div class="mock-radio-box"><div class="mock-radio-dot"></div></div>
                <span>Kambing Standard (23-25 kg)</span>
              </div>
              <div class="mock-radio">
                <div class="mock-radio-box"><div class="mock-radio-dot"></div></div>
                <span>Kambing Premium (26-28 kg)</span>
              </div>
              <div class="mock-radio">
                <div class="mock-radio-box"><div class="mock-radio-dot"></div></div>
                <span>Sapi Kolektif 1/7</span>
              </div>
            </div>
          </div>
        </div>

        <!-- File Upload -->
        <div class="variation-card">
          <div class="form-group">
            <label class="form-label">Bukti Transfer</label>
            <div class="file-upload-zone" data-media-type="banani-button">
              <div class="icon-wrap-20"><iconify-icon icon="lucide:upload-cloud" class="icon-20"></iconify-icon></div>
              <span class="upload-title">Klik atau drag file bukti transfer</span>
              <span class="upload-subtitle">JPG, PNG, PDF (Maks 2MB)</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Layout Example -->
    <section class="ds-section" style="max-width: 800px;">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Form Layout Example</h2>
      </div>
      
      <div style="border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 32px; background: #FFFFFF;">
        <div class="form-divider" style="margin-top: 0;">
          <span>Informasi Personal</span>
        </div>
        
        <div class="form-row">
          <!-- Name -->
          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <div class="mock-input">
              <span class="text-value">Abdullah</span>
            </div>
          </div>
          
          <!-- Phone (Success State) -->
          <div class="form-group">
            <label class="form-label">No. WhatsApp</label>
            <div class="mock-input" style="border-color: var(--success);">
              <span class="text-prefix">+62</span>
              <span class="text-value">81234567890</span>
              <div class="icon-wrap-16"><iconify-icon icon="lucide:check-circle" style="color: var(--success); font-size: 16px;"></iconify-icon></div>
            </div>
            <div class="form-helper success">
              Nomor terverifikasi
            </div>
          </div>
        </div>

        <div class="form-group" style="margin-top: 24px;">
          <label class="form-label">Email (Opsional)</label>
          <div class="mock-input">
            <span class="text-placeholder">contoh@email.com</span>
          </div>
        </div>

        <div class="form-group" style="margin-top: 16px;">
          <div class="mock-checkbox is-checked">
            <div class="mock-checkbox-box">
              <iconify-icon icon="lucide:check" style="font-size: 12px;"></iconify-icon>
            </div>
            <span>Sembunyikan nama (Hamba Allah)</span>
          </div>
          <div class="form-helper" style="padding-left: 26px;">
            Nama Anda tidak akan ditampilkan di daftar donatur publik.
          </div>
        </div>

      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'cards'" x-transition>
            <main>
                <!-- 1. Artikel Cards -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Artikel Cards</h2>
      </div>
      
      <div class="grid-2-cols">
        <!-- Vertical (Grid View) -->
        <div>
          <h3 style="font-size: 14px; font-weight: 500; margin-bottom: 16px; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em;">Vertical (Grid View)</h3>
          <div class="card" style="max-width: 400px;" data-media-type="banani-button">
             <div class="card-img-wrapper">
                <img data-aspect-ratio="16:9" data-query="Islamic lecture event, congregation, high quality, photography" class="card-img" src="https://storage.googleapis.com/banani-generated-images/generated-images/9d444e9a-9771-4c9f-9457-7d51386da687.jpg">
             </div>
             <div class="card-body">
                <div class="card-badge">Kajian Islam</div>
                <h4 class="card-title line-clamp-2">Memahami Makna Tauhid dalam Kehidupan Sehari-hari</h4>
                <p class="card-excerpt line-clamp-2">Tauhid merupakan landasan utama dalam beragama. Memahami tauhid dengan benar akan membawa keselamatan di dunia dan akhirat.</p>
                <div class="card-meta">
                   <span>12 Rabiul Awal 1445 H</span>
                   <span class="meta-dot"></span>
                   <span>5 min read</span>
                </div>
             </div>
          </div>
        </div>

        <!-- Horizontal (List View) -->
        <div>
          <h3 style="font-size: 14px; font-weight: 500; margin-bottom: 16px; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em;">Horizontal (List View)</h3>
          <div class="card card-horizontal" data-media-type="banani-button">
             <div class="card-img-wrapper" style="width: 240px; flex-shrink: 0;">
                <img data-aspect-ratio="16:9" data-query="Quran reading, peaceful, warm light" class="card-img-horizontal" src="https://storage.googleapis.com/banani-generated-images/generated-images/0f8ec105-7997-4fb5-b6ca-b7469742d6d2.jpg">
             </div>
             <div class="card-body">
                <div class="card-badge">Pendidikan</div>
                <h4 class="card-title line-clamp-2">Program Pembinaan Santri Penghafal Al-Quran Tahap 2</h4>
                <p class="card-excerpt line-clamp-2">Yayasan Mimbar Al-Tauhid kembali membuka program pembinaan untuk mencetak generasi Qurani yang berakhlak mulia.</p>
                <div class="card-meta">
                   <span>10 Rabiul Awal 1445 H</span>
                   <span class="meta-dot"></span>
                   <span>3 min read</span>
                </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 2. Program Donasi & Ebook Cards -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Program Donasi &amp; Ebook Cards</h2>
      </div>
      
      <div class="grid-2-cols">
        <!-- Program Donasi Card -->
        <div>
          <div class="card" style="max-width: 400px;">
             <div class="card-img-wrapper">
                <img data-aspect-ratio="16:9" data-query="Distributing charity food packages, helping hands" class="card-img" src="https://storage.googleapis.com/banani-generated-images/generated-images/8f6fd084-a693-4e5f-a162-a89ea53d7b4f.jpg">
             </div>
             <div class="card-body">
                <h4 class="card-title">Sedekah Pangan untuk Dhuafa</h4>
                <p class="card-excerpt line-clamp-2">Bantu penuhi kebutuhan pangan saudara kita yang membutuhkan di pelosok desa.</p>
                
                <div class="progress-section">
                   <div class="progress-info">
                      <span class="progress-text">Terkumpul <strong>Rp 15.000.000</strong></span>
                      <span class="progress-percent">75%</span>
                   </div>
                   <div class="progress-bar-bg">
                      <div class="progress-bar-fill" style="width: 75%;"></div>
                   </div>
                   <div class="progress-target">Target: Rp 20.000.000</div>
                </div>
                
                <button class="btn-primary full-width" data-media-type="banani-button">Donasi Sekarang</button>
             </div>
          </div>
        </div>

        <!-- Ebook Card -->
        <div>
          <div class="card">
             <div style="padding: 24px; display: flex; gap: 24px; height: 100%;">
                 <img data-aspect-ratio="3:4" data-query="Islamic ebook cover tauhid, clean typography, maroon accent, minimal" class="ebook-cover" src="https://storage.googleapis.com/banani-generated-images/generated-images/1c11458d-10ea-465f-8b50-fa599ce7c842.jpg">
                 <div class="ebook-info">
                    <div class="card-badge">Buku Saku</div>
                    <h4 class="card-title line-clamp-2" style="margin-bottom: 8px; font-size: 20px;">Panduan Praktis Shalat Sesuai Sunnah</h4>
                    <p class="ebook-author">Ustadz Fulan bin Fulan</p>
                    
                    <div style="flex: 1;"></div>
                    
                    <div class="ebook-stats">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                         <iconify-icon icon="lucide:download" style="font-size: 16px; color: #6B7280"></iconify-icon>
                       </div>
                       <span>1.2k Downloads</span>
                    </div>
                    <button class="btn-secondary full-width" data-media-type="banani-button">Unduh Ebook</button>
                 </div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. Laporan & Program/Departemen Cards -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Laporan &amp; Departemen Cards</h2>
      </div>
      
      <div class="grid-2-cols">
        <!-- Laporan Card -->
        <div class="card card-laporan" data-media-type="banani-button">
           <div class="laporan-icon">
              <iconify-icon icon="lucide:file-text" style="font-size: 28px; color: var(--primary);"></iconify-icon>
           </div>
           <div class="laporan-info">
              <div class="laporan-meta">
                 <span class="badge-keuangan">Keuangan</span>
                 <span class="laporan-tahun">2023</span>
              </div>
              <h4 class="card-title" style="margin-bottom: 0;">Laporan Keuangan Tahunan Yayasan</h4>
           </div>
           <div class="laporan-action">
              <span class="link-maroon">Unduh PDF</span>
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:download" style="font-size: 16px; color: var(--primary);"></iconify-icon>
              </div>
           </div>
        </div>

        <!-- Program/Departemen Card -->
        <div class="card card-departemen" data-media-type="banani-button">
           <div class="departemen-header">
              <div class="departemen-icon-wrapper">
                 <iconify-icon icon="lucide:users" style="font-size: 24px; color: var(--primary);"></iconify-icon>
              </div>
              <div>
                 <h4 class="card-title" style="font-size: 20px;">Departemen Sosial &amp; Dakwah</h4>
              </div>
           </div>
           <div class="departemen-info" style="display: flex; flex-direction: column; flex: 1;">
              <p class="card-excerpt line-clamp-2">Mengelola berbagai program sosial kemasyarakatan dan penyebaran dakwah tauhid ke berbagai daerah nusantara.</p>
              <div class="link-maroon-wrap">
                 <span class="link-maroon">Lihat Program</span>
                 <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                   <iconify-icon icon="lucide:arrow-right" style="font-size: 16px; color: var(--primary);"></iconify-icon>
                 </div>
              </div>
           </div>
        </div>
      </div>
    </section>

    <!-- 4. Stat Cards (Admin Dashboard) -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Stat Cards (Admin Dashboard)</h2>
      </div>
      
      <div class="grid-3-cols">
        <!-- Stat Card 1 -->
        <div class="card card-stat">
           <div class="stat-header">
              <div class="stat-icon-wrap">
                 <iconify-icon icon="lucide:wallet" style="font-size: 24px; color: var(--primary);"></iconify-icon>
              </div>
              <span class="stat-label">Total Donasi Bulan Ini</span>
           </div>
           <div class="stat-value">Rp 125.400.000</div>
           <div class="stat-trend trend-up">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:trending-up" style="font-size: 16px; color: var(--success)"></iconify-icon>
              </div>
              <span>+12.5%</span>
              <span class="trend-text">dari bulan lalu</span>
           </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="card card-stat">
           <div class="stat-header">
              <div class="stat-icon-wrap" style="background: var(--info-surface);">
                 <iconify-icon icon="lucide:users" style="font-size: 24px; color: var(--info);"></iconify-icon>
              </div>
              <span class="stat-label">Total Donatur Aktif</span>
           </div>
           <div class="stat-value">1,245</div>
           <div class="stat-trend trend-up">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:trending-up" style="font-size: 16px; color: var(--success)"></iconify-icon>
              </div>
              <span>+5.2%</span>
              <span class="trend-text">dari bulan lalu</span>
           </div>
        </div>
        
        <!-- Stat Card 3 -->
        <div class="card card-stat">
           <div class="stat-header">
              <div class="stat-icon-wrap" style="background: var(--warning-surface);">
                 <iconify-icon icon="lucide:clock" style="font-size: 24px; color: var(--warning);"></iconify-icon>
              </div>
              <span class="stat-label">Donasi Menunggu Verifikasi</span>
           </div>
           <div class="stat-value">24</div>
           <div class="stat-trend trend-down">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:trending-down" style="font-size: 16px; color: var(--destructive)"></iconify-icon>
              </div>
              <span>-2.1%</span>
              <span class="trend-text">dari bulan lalu</span>
           </div>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'navigation'" x-transition>
            <main>
                <!-- Desktop Navbar -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Desktop Navbar</h2>
      </div>
      <div class="comp-container">
        <div class="comp-title">Default State (Transparent / White)</div>
        <div class="desktop-nav default">
          <div class="nav-brand">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-md); color: white;">
              <iconify-icon icon="lucide:book-open" style="font-size: 16px;"></iconify-icon>
            </div>
            Mimbar Al-Tauhid
          </div>
          <div class="nav-links">
            <a href="#" class="nav-link active" data-media-type="banani-button">Beranda</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Program</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Berita</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Donasi</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Ebook</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Laporan</a>
          </div>
          <button class="btn-nav-primary" data-media-type="banani-button">Donasi Sekarang</button>
        </div>
      </div>

      <div class="comp-container">
        <div class="comp-title">Scrolled State (White with Shadow)</div>
        <div class="desktop-nav scrolled">
          <div class="nav-brand">
            <div style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-md); color: white;">
              <iconify-icon icon="lucide:book-open" style="font-size: 16px;"></iconify-icon>
            </div>
            Mimbar Al-Tauhid
          </div>
          <div class="nav-links">
            <a href="#" class="nav-link active" data-media-type="banani-button">Beranda</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Program</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Berita</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Donasi</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Ebook</a>
            <a href="#" class="nav-link" data-media-type="banani-button">Laporan</a>
          </div>
          <button class="btn-nav-primary" data-media-type="banani-button">Donasi Sekarang</button>
        </div>
      </div>
    </section>

    <!-- Mobile Navbar -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Mobile Navbar</h2>
      </div>
      <div class="comp-container" style="display: flex; gap: 48px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 320px;">
          <div class="comp-title">Collapsed State</div>
          <div class="mobile-nav-wrapper">
            <div class="mobile-nav-header">
              <div class="nav-brand" style="font-size: 18px;">
                <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-sm); color: white;">
                  <iconify-icon icon="lucide:book-open" style="font-size: 14px;"></iconify-icon>
                </div>
                Mimbar Al-Tauhid
              </div>
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;" data-media-type="banani-button">
                <iconify-icon icon="lucide:menu" style="font-size: 24px; color: var(--gray-900);"></iconify-icon>
              </div>
            </div>
          </div>
        </div>

        <div style="flex: 1; min-width: 320px;">
          <div class="comp-title">Expanded State</div>
          <div class="mobile-nav-wrapper">
            <div class="mobile-nav-header">
              <div class="nav-brand" style="font-size: 18px;">
                <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-sm); color: white;">
                  <iconify-icon icon="lucide:book-open" style="font-size: 14px;"></iconify-icon>
                </div>
                Mimbar Al-Tauhid
              </div>
              <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;" data-media-type="banani-button">
                <iconify-icon icon="lucide:x" style="font-size: 24px; color: var(--gray-900);"></iconify-icon>
              </div>
            </div>
            <div class="mobile-nav-menu">
              <a href="#" class="mobile-nav-item active" data-media-type="banani-button">Beranda</a>
              <a href="#" class="mobile-nav-item" data-media-type="banani-button">Program</a>
              <a href="#" class="mobile-nav-item" data-media-type="banani-button">Berita</a>
              <a href="#" class="mobile-nav-item" data-media-type="banani-button">Donasi</a>
              <a href="#" class="mobile-nav-item" data-media-type="banani-button">Ebook</a>
              <a href="#" class="mobile-nav-item" data-media-type="banani-button">Laporan</a>
              <button class="btn-nav-primary" style="width: 100%; margin-top: 16px;" data-media-type="banani-button">Donasi Sekarang</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Footer</h2>
      </div>
      <div class="comp-container" style="padding: 0; border: none; background: transparent;">
        <div class="footer-wrapper">
          <div class="footer-grid">
            <div>
              <div class="nav-brand" style="color: #FFFFFF; margin-bottom: 24px;">
                <div style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background-color: #FFFFFF; border-radius: var(--radius-lg); color: #4A0E28;">
                  <iconify-icon icon="lucide:book-open" style="font-size: 20px;"></iconify-icon>
                </div>
                Mimbar Al-Tauhid
              </div>
              <p class="footer-text">Menebar Hidayah, Merajut Ukhuwah. Yayasan pendidikan dan sosial dakwah Islam yang berdedikasi untuk kemaslahatan umat.</p>
              
              <div style="display: flex; gap: 16px; margin-bottom: 16px; color: rgba(255,255,255,0.8); font-size: 14px;">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <iconify-icon icon="lucide:map-pin" style="font-size: 20px;"></iconify-icon>
                </div>
                <span>Jl. Cikiray Rt.04 Rw.04 Desa Sukamanah Kec. Cisaat Kab. Sukabumi Jawa Barat</span>
              </div>
              <div style="display: flex; gap: 16px; margin-bottom: 16px; color: rgba(255,255,255,0.8); font-size: 14px;">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <iconify-icon icon="lucide:phone" style="font-size: 20px;"></iconify-icon>
                </div>
                <span>+62 812-3456-7890</span>
              </div>
              <div style="display: flex; gap: 16px; color: rgba(255,255,255,0.8); font-size: 14px;">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <iconify-icon icon="lucide:mail" style="font-size: 20px;"></iconify-icon>
                </div>
                <span>info@mimbaraltauhid.org</span>
              </div>
            </div>
            
            <div>
              <h3 class="footer-col-title">Quick Links</h3>
              <div class="footer-links">
                <a href="#" class="footer-link" data-media-type="banani-button">Tentang Kami</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Berita &amp; Artikel</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Galeri Kegiatan</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Ebook &amp; Kajian</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Laporan Keuangan</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Hubungi Kami</a>
              </div>
            </div>
            
            <div>
              <h3 class="footer-col-title">Program Yayasan</h3>
              <div class="footer-links">
                <a href="#" class="footer-link" data-media-type="banani-button">Mimbar Pendidikan</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Mimbar Sosial</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Mimbar Dakwah</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Mimbar Ekonomi</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Qurban Peduli</a>
                <a href="#" class="footer-link" data-media-type="banani-button">Zakat &amp; Infaq</a>
              </div>
            </div>
          </div>
          
          <div class="footer-bottom">
            <div>© 2024 Yayasan Mimbar Al-Tauhid. All rights reserved.</div>
            <div style="display: flex; gap: 24px;">
              <a href="#" style="color: rgba(255,255,255,0.6);" data-media-type="banani-button">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                  <iconify-icon icon="lucide:facebook" style="font-size: 20px;"></iconify-icon>
                </div>
              </a>
              <a href="#" style="color: rgba(255,255,255,0.6);" data-media-type="banani-button">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                  <iconify-icon icon="lucide:instagram" style="font-size: 20px;"></iconify-icon>
                </div>
              </a>
              <a href="#" style="color: rgba(255,255,255,0.6);" data-media-type="banani-button">
                <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                  <iconify-icon icon="lucide:youtube" style="font-size: 20px;"></iconify-icon>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Admin Sidebar -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Admin Sidebar</h2>
      </div>
      <div class="comp-container sidebar-container">
        
        <!-- Expanded Sidebar -->
        <div class="sidebar sidebar-expanded">
          <div class="sidebar-header">
            <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-lg); color: white;">
              <iconify-icon icon="lucide:book-open" style="font-size: 18px;"></iconify-icon>
            </div>
            <div style="font-weight: 700; font-size: 16px; color: var(--gray-900);">Mimbar Admin</div>
          </div>
          <div class="sidebar-menu">
            <div class="sidebar-item active" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:layout-dashboard" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Dashboard</span>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:file-text" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Artikel</span>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:heart-handshake" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Donasi</span>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:folder-heart" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Program Donasi</span>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:book" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Ebook</span>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:file-bar-chart-2" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Laporan</span>
            </div>
          </div>
          <div class="sidebar-footer">
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:log-out" style="font-size: 20px;"></iconify-icon>
              </div>
              <span>Keluar</span>
            </div>
          </div>
        </div>

        <!-- Collapsed Sidebar -->
        <div class="sidebar sidebar-collapsed">
          <div class="sidebar-header">
            <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background-color: var(--primary); border-radius: var(--radius-lg); color: white;">
              <iconify-icon icon="lucide:book-open" style="font-size: 18px;"></iconify-icon>
            </div>
          </div>
          <div class="sidebar-menu">
            <div class="sidebar-item active" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:layout-dashboard" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:file-text" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:heart-handshake" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:folder-heart" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:book" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:file-bar-chart-2" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
          </div>
          <div class="sidebar-footer">
            <div class="sidebar-item" data-media-type="banani-button">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:log-out" style="font-size: 20px;"></iconify-icon>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Breadcrumb & Pagination -->
    <section class="ds-section" style="display: flex; gap: 48px; flex-wrap: wrap;">
      <div style="flex: 1; min-width: 300px;">
        <div class="ds-section-header">
          <h2 class="ds-section-title">Breadcrumb</h2>
        </div>
        <div class="comp-container">
          <div class="breadcrumb">
            <span class="breadcrumb-item" data-media-type="banani-button">Home</span>
            <span class="breadcrumb-separator">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon>
              </div>
            </span>
            <span class="breadcrumb-item" data-media-type="banani-button">Program</span>
            <span class="breadcrumb-separator">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon>
              </div>
            </span>
            <span class="breadcrumb-item active" data-media-type="banani-button">Dakwah</span>
          </div>
        </div>
      </div>

      <div style="flex: 1; min-width: 300px;">
        <div class="ds-section-header">
          <h2 class="ds-section-title">Pagination</h2>
        </div>
        <div class="comp-container">
          <div class="pagination">
            <button class="page-btn disabled" data-media-type="banani-button">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-left" style="font-size: 16px;"></iconify-icon>
              </div>
            </button>
            <button class="page-btn active" data-media-type="banani-button">1</button>
            <button class="page-btn" data-media-type="banani-button">2</button>
            <button class="page-btn" data-media-type="banani-button">3</button>
            <div style="padding: 0 4px; color: var(--gray-400);">...</div>
            <button class="page-btn" data-media-type="banani-button">8</button>
            <button class="page-btn" data-media-type="banani-button">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon>
              </div>
            </button>
          </div>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'feedback'" x-transition>
            <main>
                <!-- Badges Section -->
    <section class="ds-section" id="badges-chips-section">
  <div class="ds-section-header">
    <h2 class="ds-section-title">Badges &amp; Chips</h2>
  </div>

  <div class="comp-grid" id="badges-chip-grid">
    <div class="comp-container" id="donation-status-card">
      <div class="comp-title">Status Donasi (Pill)</div>
      <div class="flex-row">
        <div class="badge badge-pill badge-warning">Menunggu Verifikasi</div>
        <div class="badge badge-pill badge-success">Terverifikasi</div>
        <div class="badge badge-pill badge-danger">Ditolak</div>
      </div>
    </div>

    <div class="comp-container" id="qurban-status-card">
      <div class="comp-title">Status Qurban (Rounded)</div>
      <div class="flex-row">
        <div class="badge badge-rounded badge-gray">Menunggu Pembayaran</div>
        <div class="badge badge-rounded badge-info">Dikonfirmasi</div>
        <div class="badge badge-rounded badge-success">Sudah Disembelih</div>
      </div>
    </div>

    <div class="comp-container" id="category-chip-card">
      <div class="comp-title">Category Chips</div>
      <div class="flex-row">
        <div class="chip-outline active" data-media-type="banani-button">Semua</div>
        <div class="chip-outline" data-media-type="banani-button">Akidah</div>
        <div class="chip-outline" data-media-type="banani-button">Fikih</div>
        <div class="chip-outline" data-media-type="banani-button">Sirah</div>
      </div>
    </div>

    <div class="comp-container" id="priority-label-card">
      <div class="comp-title">Priority / Labels</div>
      <div class="flex-row">
        <div class="badge badge-rounded badge-primary">MVP</div>
        <div class="badge badge-rounded badge-gray">Fase 2</div>
        <div class="badge badge-rounded badge-info">Baru</div>
      </div>
    </div>
  </div>
</section>

    <!-- Feedback & Notifications Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Feedback &amp; Notifications</h2>
      </div>
      
      <div class="comp-grid">
        <div class="comp-container">
          <div class="comp-title">Toast Messages</div>
          <div style="display: flex; flex-direction: column; gap: 16px;">
            <!-- Success Toast -->
            <div class="toast toast-success">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: var(--success); flex-shrink: 0;">
                <iconify-icon icon="lucide:check-circle-2" style="font-size: 20px;"></iconify-icon>
              </div>
              <div class="toast-content">
                Donasi berhasil dikonfirmasi!
              </div>
              <div class="toast-close" data-media-type="banani-button">
                <iconify-icon icon="lucide:x" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>
            
            <!-- Error Toast -->
            <div class="toast toast-error">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: var(--destructive); flex-shrink: 0;">
                <iconify-icon icon="lucide:alert-circle" style="font-size: 20px;"></iconify-icon>
              </div>
              <div class="toast-content">
                Upload gagal. Format tidak didukung.
              </div>
              <div class="toast-close" data-media-type="banani-button">
                <iconify-icon icon="lucide:x" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>

            <!-- Info Toast -->
            <div class="toast toast-info">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: var(--info); flex-shrink: 0;">
                <iconify-icon icon="lucide:info" style="font-size: 20px;"></iconify-icon>
              </div>
              <div class="toast-content">
                Email konfirmasi sudah dikirim ke donatur.
              </div>
              <div class="toast-close" data-media-type="banani-button">
                <iconify-icon icon="lucide:x" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>
          </div>
        </div>

        <div class="comp-container">
          <div class="comp-title">Alert Banner</div>
          <div class="alert-banner">
            <div style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <iconify-icon icon="lucide:bell-ring" style="font-size: 24px;"></iconify-icon>
            </div>
            <div class="alert-banner-content">
              Program Qurban 1446H sedang dibuka. Batas pesanan: 30 Mei 2025.
            </div>
            <div class="toast-close" style="color: var(--info); opacity: 0.7;" data-media-type="banani-button">
              <iconify-icon icon="lucide:x" style="font-size: 20px;"></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- States Section -->
    <section class="ds-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Empty &amp; Loading States</h2>
      </div>
      
      <div class="comp-grid">
        <div class="comp-container">
          <div class="comp-title">Empty State</div>
          <div class="empty-state">
            <div class="empty-state-icon">
              <iconify-icon icon="lucide:inbox" style="font-size: 32px;"></iconify-icon>
            </div>
            <h3 class="empty-state-title">Belum ada donasi masuk</h3>
            <p class="empty-state-desc">Data donasi akan muncul di sini setelah ada donatur yang melakukan pembayaran.</p>
            <button class="btn-primary" data-media-type="banani-button">Tambah Donasi Manual</button>
          </div>
        </div>

        <div class="comp-container">
          <div class="comp-title">Loading Skeleton (Static)</div>
          <div class="skeleton-card">
            <div class="skeleton-img">
              <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #D1D5DB;">
                <iconify-icon icon="lucide:image" style="font-size: 48px;"></iconify-icon>
              </div>
            </div>
            <div class="skeleton-body">
              <div class="skeleton-line"></div>
              <div class="skeleton-line short"></div>
              <div class="skeleton-line tiny"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'tables'" x-transition>
            <main>
                <!-- Tables Section -->
    <section class="ds-section" id="data-tables-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Admin Table Pattern</h2>
      </div>

      <div class="comp-container" style="padding: 32px;">
        
        <!-- Admin Page Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
          <div>
            <div style="font-size: 14px; color: var(--gray-600); margin-bottom: 8px;">
              Beranda <span style="margin: 0 4px;">/</span> Donasi <span style="margin: 0 4px;">/</span> <span style="color: var(--gray-900); font-weight: 500;">Daftar Donasi</span>
            </div>
            <h2 style="font-size: 24px; font-weight: 600; color: var(--gray-900); margin: 0;">Daftar Donasi</h2>
          </div>
          <button class="btn-primary" data-media-type="banani-button">
            <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; margin-right: 6px;">
              <iconify-icon icon="lucide:plus" style="font-size: 18px;"></iconify-icon>
            </div>
            Tambah Donasi
          </button>
        </div>

        <!-- Table Toolbar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 16px;">
          <div style="display: flex; gap: 12px; flex: 1; flex-wrap: wrap;">
            <!-- Search Input -->
            <div class="sim-input" style="width: 240px;">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-400);">
                <iconify-icon icon="lucide:search" style="font-size: 16px;"></iconify-icon>
              </div>
              <div style="color: var(--gray-400);">Cari donatur...</div>
            </div>
            <!-- Filter Status -->
            <div class="sim-input" data-media-type="banani-button" style="cursor: pointer;">
              <div style="color: var(--gray-900); font-weight: 500;">Status:</div> <div>Semua</div>
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-600); margin-left: 4px;">
                <iconify-icon icon="lucide:chevron-down" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>
            <!-- Filter Program -->
            <div class="sim-input" data-media-type="banani-button" style="cursor: pointer;">
              <div style="color: var(--gray-900); font-weight: 500;">Program:</div> <div>Semua</div>
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-600); margin-left: 4px;">
                <iconify-icon icon="lucide:chevron-down" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>
            <!-- Date Range -->
            <div class="sim-input" data-media-type="banani-button" style="cursor: pointer;">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-600);">
                <iconify-icon icon="lucide:calendar" style="font-size: 16px;"></iconify-icon>
              </div>
              <div>1 Mei - 30 Mei 2025</div>
            </div>
          </div>
          <div>
            <!-- Export Button -->
            <button class="btn-outline" data-media-type="banani-button" style="height: 38px;">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                <iconify-icon icon="lucide:download" style="font-size: 16px;"></iconify-icon>
              </div>
              Export CSV
            </button>
          </div>
        </div>

        <!-- Bulk Action Bar -->
        <div style="background-color: var(--primary-light); border: 1px solid var(--primary); border-radius: var(--radius-lg); padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <div class="checkbox checked">
              <div style="width: 12px; height: 12px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:minus" style="font-size: 12px;"></iconify-icon>
              </div>
            </div>
            <div style="font-size: 14px; font-weight: 600; color: var(--primary);">1 item dipilih</div>
          </div>
          <div style="display: flex; gap: 8px;">
            <button class="btn-outline-danger" data-media-type="banani-button" style="height: 32px; padding: 0 12px; font-size: 12px;">Tolak Terpilih</button>
            <button class="btn-primary" data-media-type="banani-button" style="height: 32px; padding: 0 12px; font-size: 12px;">Verifikasi Terpilih</button>
          </div>
        </div>

        <!-- Data Table -->
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th style="width: 48px;">
                  <div class="checkbox checked">
                    <div style="width: 12px; height: 12px; display: flex; align-items: center; justify-content: center;">
                      <iconify-icon icon="lucide:minus" style="font-size: 12px;"></iconify-icon>
                    </div>
                  </div>
                </th>
                <th>Nama Donatur</th>
                <th>Program</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- Row 1 -->
              <tr>
                <td><div class="checkbox"></div></td>
                <td class="text-dark">Budi Santoso</td>
                <td>Pembangunan Masjid</td>
                <td class="text-dark">Rp 1.000.000</td>
                <td>12 Mei 2025</td>
                <td><div class="badge badge-pill badge-success">Terverifikasi</div></td>
                <td style="text-align: right;">
                   <div style="display: flex; justify-content: flex-end; gap: 8px;">
                     <button class="action-btn" data-media-type="banani-button" title="Lihat Detail">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:eye" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                   </div>
                </td>
              </tr>
              <!-- Row 2: Simulated Hover -->
              <tr class="row-hover">
                <td><div class="checkbox"></div></td>
                <td class="text-dark">Ahmad Fulan</td>
                <td>Operasional Dakwah</td>
                <td class="text-dark">Rp 500.000</td>
                <td>11 Mei 2025</td>
                <td><div class="badge badge-pill badge-warning">Menunggu Verifikasi</div></td>
                <td style="text-align: right;">
                   <div style="display: flex; justify-content: flex-end; gap: 8px;">
                     <button class="action-btn text-success" data-media-type="banani-button" title="Verifikasi">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                     <button class="action-btn text-danger" data-media-type="banani-button" title="Tolak">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:x-circle" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                     <button class="action-btn" data-media-type="banani-button" title="Lihat Detail">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:eye" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                   </div>
                </td>
              </tr>
              <!-- Row 3: Selected State -->
              <tr class="row-selected">
                <td>
                  <div class="checkbox checked">
                    <div style="width: 12px; height: 12px; display: flex; align-items: center; justify-content: center;">
                      <iconify-icon icon="lucide:check" style="font-size: 12px;"></iconify-icon>
                    </div>
                  </div>
                </td>
                <td class="text-dark">Siti Aminah</td>
                <td>Wakaf Al-Quran</td>
                <td class="text-dark">Rp 250.000</td>
                <td>10 Mei 2025</td>
                <td><div class="badge badge-pill badge-danger">Ditolak</div></td>
                <td style="text-align: right;">
                   <div style="display: flex; justify-content: flex-end; gap: 8px;">
                     <button class="action-btn" data-media-type="banani-button" title="Lihat Detail">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:eye" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                   </div>
                </td>
              </tr>
              <!-- Row 4 -->
              <tr>
                <td><div class="checkbox"></div></td>
                <td class="text-dark">Hamba Allah</td>
                <td>Tebar Buka Puasa</td>
                <td class="text-dark">Rp 1.500.000</td>
                <td>10 Mei 2025</td>
                <td><div class="badge badge-pill badge-success">Terverifikasi</div></td>
                <td style="text-align: right;">
                   <div style="display: flex; justify-content: flex-end; gap: 8px;">
                     <button class="action-btn" data-media-type="banani-button" title="Lihat Detail">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:eye" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                   </div>
                </td>
              </tr>
              <!-- Row 5 -->
              <tr>
                <td><div class="checkbox"></div></td>
                <td class="text-dark">Rizky Aditya</td>
                <td>Sedekah Subuh</td>
                <td class="text-dark">Rp 100.000</td>
                <td>09 Mei 2025</td>
                <td><div class="badge badge-pill badge-warning">Menunggu Verifikasi</div></td>
                <td style="text-align: right;">
                   <div style="display: flex; justify-content: flex-end; gap: 8px;">
                     <button class="action-btn text-success" data-media-type="banani-button" title="Verifikasi">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:check-circle-2" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                     <button class="action-btn text-danger" data-media-type="banani-button" title="Tolak">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:x-circle" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                     <button class="action-btn" data-media-type="banani-button" title="Lihat Detail">
                       <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;"><iconify-icon icon="lucide:eye" style="font-size: 16px;"></iconify-icon></div>
                     </button>
                   </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 8px;">
          <div style="display: flex; align-items: center; gap: 12px; font-size: 14px; color: var(--gray-600);">
            <span>Baris per halaman:</span>
            <div class="sim-input" data-media-type="banani-button" style="padding: 6px 12px; cursor: pointer; height: 32px;">
              10 
              <div style="width: 14px; height: 14px; display: flex; align-items: center; justify-content: center; margin-left: 8px;">
                <iconify-icon icon="lucide:chevron-down" style="font-size: 14px;"></iconify-icon>
              </div>
            </div>
          </div>
          
          <div style="font-size: 14px; color: var(--gray-600);">
            Menampilkan <span style="font-weight: 500; color: var(--gray-900);">1–5</span> dari <span style="font-weight: 500; color: var(--gray-900);">47</span>
          </div>
          
          <div style="display: flex; gap: 8px;">
            <button class="action-btn disabled" data-media-type="banani-button">
              <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-left" style="font-size: 18px;"></iconify-icon>
              </div>
            </button>
            <button class="action-btn" data-media-type="banani-button">
              <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:chevron-right" style="font-size: 18px;"></iconify-icon>
              </div>
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Filter Sidebar Drawer Section -->
    <section class="ds-section" id="drawer-pattern-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">Filter Sidebar / Drawer</h2>
      </div>
      
      <div style="display: flex; gap: 48px; align-items: flex-start;">
        <!-- Drawer Container representation -->
        <div style="width: 360px; background-color: #FFFFFF; border: 1px solid var(--border); border-radius: var(--radius-xl); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; display: flex; flex-direction: column;">
          
          <!-- Drawer Header -->
          <div style="padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 16px; font-weight: 600; color: var(--gray-900); margin: 0;">Filter Data</h3>
            <button class="action-btn" data-media-type="banani-button" style="border: none; width: 28px; height: 28px;">
              <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; color: var(--gray-600);">
                <iconify-icon icon="lucide:x" style="font-size: 18px;"></iconify-icon>
              </div>
            </button>
          </div>
          
          <!-- Drawer Body -->
          <div style="padding: 24px; flex: 1; display: flex; flex-direction: column; gap: 24px; background-color: #FAFAFA;">
            
            <!-- Status Filter -->
            <div>
              <label style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px; display: block;">Status Donasi</label>
              <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;" data-media-type="banani-button">
                  <div class="checkbox checked">
                    <div style="width: 12px; height: 12px; display: flex; align-items: center; justify-content: center;">
                      <iconify-icon icon="lucide:check" style="font-size: 12px;"></iconify-icon>
                    </div>
                  </div>
                  <span style="font-size: 14px; color: var(--gray-900); font-weight: 500;">Semua Status</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;" data-media-type="banani-button">
                  <div class="checkbox"></div>
                  <span style="font-size: 14px; color: var(--gray-600);">Menunggu Verifikasi</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;" data-media-type="banani-button">
                  <div class="checkbox"></div>
                  <span style="font-size: 14px; color: var(--gray-600);">Terverifikasi</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; cursor: pointer;" data-media-type="banani-button">
                  <div class="checkbox"></div>
                  <span style="font-size: 14px; color: var(--gray-600);">Ditolak</span>
                </div>
              </div>
            </div>
            
            <!-- Program Filter -->
            <div>
              <label style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px; display: block;">Program Donasi</label>
              <div class="sim-input" style="justify-content: space-between; cursor: pointer; background: #FFFFFF;" data-media-type="banani-button">
                <span style="color: var(--gray-900);">Semua Program</span>
                <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-600);">
                  <iconify-icon icon="lucide:chevron-down" style="font-size: 16px;"></iconify-icon>
                </div>
              </div>
            </div>
            
            <!-- Date Range Filter -->
            <div>
              <label style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px; display: block;">Rentang Tanggal</label>
              <div class="sim-input" style="justify-content: flex-start; cursor: pointer; background: #FFFFFF; gap: 10px;" data-media-type="banani-button">
                <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--gray-400);">
                  <iconify-icon icon="lucide:calendar" style="font-size: 16px;"></iconify-icon>
                </div>
                <span style="color: var(--gray-400);">Pilih rentang tanggal...</span>
              </div>
            </div>
            
          </div>
          
          <!-- Drawer Footer -->
          <div style="padding: 20px 24px; border-top: 1px solid var(--border); display: flex; gap: 12px; background-color: #FFFFFF;">
            <button class="btn-outline" data-media-type="banani-button" style="flex: 1;">Reset</button>
            <button class="btn-primary" data-media-type="banani-button" style="flex: 1;">Terapkan</button>
          </div>
          
        </div>
        
        <div style="flex: 1; max-width: 480px; padding-top: 24px;">
          <h3 style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px;">Slide-in Panel Pattern</h3>
          <p style="font-size: 14px; color: var(--gray-600); line-height: 1.6; margin-bottom: 16px;">The filter sidebar functions as an overlay drawer that slides in from the right edge of the screen. It is triggered by a "Filter" button in the table toolbar.</p>
          <p style="font-size: 14px; color: var(--gray-600); line-height: 1.6;">Use this pattern when the table requires complex filtering with multiple criteria (like status, program type, and date ranges) that would clutter the main toolbar area.</p>
        </div>
      </div>
    </section>
            </main>
        </div>

        <div x-show="activeTab === 'donasi'" x-transition>
            <main>
                <!-- Step Indicator -->
    <section class="ds-section" id="step-indicator-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">1. Step Indicator</h2>
      </div>
      <div class="comp-container">
        <div class="step-container">
          <div class="step-line-bg"></div>
          <div class="step-line-fill"></div>
          
          <div class="step-item step-completed">
            <div class="step-circle">
              <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:check" style="font-size: 16px;"></iconify-icon>
              </div>
            </div>
            <div class="step-label">Pilih Program</div>
          </div>
          
          <div class="step-item step-active">
            <div class="step-circle">2</div>
            <div class="step-label">Transfer</div>
          </div>
          
          <div class="step-item step-pending">
            <div class="step-circle">3</div>
            <div class="step-label" style="font-weight: 500;">Konfirmasi</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Donation Progress Bar -->
    <section class="ds-section" id="progress-bar-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">2. Donation Progress Bar</h2>
      </div>
      <div class="comp-container">
        
        <div class="progress-wrapper">
          <div class="progress-header">
            <div>
              <div class="progress-label">Terkumpul</div>
              <div class="progress-amount">Rp 150.000.000</div>
            </div>
            <div class="progress-percent">30%</div>
          </div>
          <div class="progress-track">
            <div class="progress-fill" style="width: 30%;"></div>
          </div>
          <div class="progress-target">dari target Rp 500.000.000</div>
        </div>

        <div class="progress-wrapper">
          <div class="progress-header">
            <div>
              <div class="progress-label">Terkumpul</div>
              <div class="progress-amount">Rp 375.000.000</div>
            </div>
            <div class="progress-percent">75%</div>
          </div>
          <div class="progress-track">
            <div class="progress-fill" style="width: 75%;"></div>
          </div>
          <div class="progress-target">dari target Rp 500.000.000</div>
        </div>

        <div class="progress-wrapper">
          <div class="progress-header">
            <div>
              <div class="progress-label">Terkumpul</div>
              <div class="progress-amount">Rp 500.000.000</div>
            </div>
            <div class="progress-percent">100%</div>
          </div>
          <div class="progress-track">
            <div class="progress-fill" style="width: 100%;"></div>
          </div>
          <div class="progress-target">dari target Rp 500.000.000</div>
        </div>

      </div>
    </section>

    <!-- Bank Transfer Instruction Box -->
    <section class="ds-section" id="bank-transfer-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">3. Bank Transfer Instruction Box</h2>
      </div>
      <div class="comp-container">
        
        <div class="bank-card">
          <div class="bank-header">
            <div class="bank-logo-placeholder">BSI</div>
            <div class="bank-name">Bank Syariah Indonesia (BSI)</div>
          </div>
          
          <div class="bank-detail-row">
            <div class="bank-detail-label">Nomor Rekening</div>
            <div class="bank-account-num">
              7123 4567 89
              <button class="action-btn" data-media-type="banani-button" title="Salin Rekening" style="border: none; background: #F3F4F6;">
                <div style="width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                  <iconify-icon icon="lucide:copy" style="font-size: 16px;"></iconify-icon>
                </div>
              </button>
            </div>
          </div>
          
          <div class="bank-detail-row">
            <div class="bank-detail-label">Atas Nama</div>
            <div style="font-size: 16px; font-weight: 500; color: var(--gray-900);">Yayasan Mimbar Al-Tauhid</div>
          </div>

          <div style="height: 1px; background: var(--border); margin: 20px 0;"></div>

          <div class="bank-detail-row" style="margin-bottom: 0;">
            <div class="bank-detail-label">Nominal Transfer</div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
              <div style="font-size: 20px; font-weight: 700; color: var(--primary);">Rp 100.000</div>
              <button class="btn-outline" data-media-type="banani-button" style="height: 32px; font-size: 12px; padding: 0 12px;">
                Salin Nominal
              </button>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- Nominal Quick-pick Chips -->
    <section class="ds-section" id="nominal-chips-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">4. Nominal Quick-pick Chips</h2>
      </div>
      <div class="comp-container">
        <div class="nominal-grid">
          <div class="nominal-chip" data-media-type="banani-button">Rp 25.000</div>
          <div class="nominal-chip" data-media-type="banani-button">Rp 50.000</div>
          <div class="nominal-chip selected" data-media-type="banani-button">Rp 100.000</div>
          <div class="nominal-chip" data-media-type="banani-button">Rp 250.000</div>
          <div class="nominal-chip" data-media-type="banani-button">Rp 500.000</div>
          <div class="nominal-chip" data-media-type="banani-button">Nominal lain</div>
        </div>
      </div>
    </section>

    <!-- Upload Proof Box -->
    <section class="ds-section" id="upload-proof-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">5. Upload Bukti Transfer Box</h2>
      </div>
      <div class="comp-container" style="display: flex; flex-direction: column; gap: 24px;">
        
        <!-- Default State -->
        <div>
          <div style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px;">Default State</div>
          <div class="upload-zone" data-media-type="banani-button">
            <div style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 12px;">
              <iconify-icon icon="lucide:upload-cloud" style="font-size: 32px;"></iconify-icon>
            </div>
            <div style="font-size: 16px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">Klik untuk upload atau drag foto</div>
            <div style="font-size: 14px; color: var(--gray-600);">Maksimal 2MB. Format: JPG, JPEG, PNG.</div>
          </div>
        </div>

        <!-- Filled State -->
        <div>
          <div style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 12px;">Filled State</div>
          <div class="upload-filled">
            <img class="upload-thumb" data-aspect-ratio="1:1" data-query="receipt paper texture" src="https://storage.googleapis.com/banani-generated-images/generated-images/b55a19b3-303f-4cff-b9cf-99e84f875005.jpg" alt="Bukti transfer">
            <div style="flex: 1;">
              <div style="font-size: 14px; font-weight: 600; color: var(--gray-900); margin-bottom: 2px;">bukti-transfer-bsi.jpg</div>
              <div style="font-size: 12px; color: var(--gray-600);">845 KB</div>
            </div>
            <button class="action-btn" data-media-type="banani-button" style="border: none; background: transparent; color: var(--destructive);">
              <div style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:trash-2" style="font-size: 20px;"></iconify-icon>
              </div>
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Donation Success State -->
    <section class="ds-section" id="success-state-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">6. Donation Success State</h2>
      </div>
      <div class="comp-container">
        
        <div class="success-state">
          <div class="success-icon">
            <iconify-icon icon="lucide:check" style="font-size: 32px;"></iconify-icon>
          </div>
          <h3 style="font-size: 28px; font-weight: 700; color: var(--gray-900); margin-bottom: 12px;">Jazakumullahu Khairan!</h3>
          <p style="font-size: 15px; color: var(--gray-600); line-height: 1.6; margin-bottom: 24px;">
            Konfirmasi donasi Anda telah kami terima. Tim kami akan segera melakukan verifikasi maksimal 1x24 jam.
          </p>
          
          <div style="background: #FAFAFA; border: 1px dashed var(--border); border-radius: var(--radius-lg); padding: 16px; margin-bottom: 32px; display: inline-block;">
            <div style="font-size: 12px; color: var(--gray-600); margin-bottom: 4px;">Nomor Referensi</div>
            <div style="font-size: 18px; font-weight: 700; color: var(--primary); letter-spacing: 1px;">DON-1446-XYZ98</div>
          </div>

          <div style="display: flex; gap: 12px; justify-content: center;">
            <button class="btn-outline" data-media-type="banani-button">
              <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                <iconify-icon icon="lucide:link" style="font-size: 18px;"></iconify-icon>
              </div>
              Copy Link
            </button>
            <button class="btn-primary" data-media-type="banani-button" style="background-color: var(--success);">
              <div style="width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                <iconify-icon icon="lucide:message-circle" style="font-size: 18px;"></iconify-icon>
              </div>
              Bagikan via WhatsApp
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Qurban Package Card -->
    <section class="ds-section" id="qurban-card-section">
      <div class="ds-section-header">
        <h2 class="ds-section-title">7. Qurban Package Card</h2>
      </div>
      <div class="comp-container">
        
        <div class="qurban-grid">
          <!-- Default State -->
          <div class="qurban-card">
            <img class="qurban-img" data-aspect-ratio="4:3" data-query="brown goat in field photography" alt="Kambing Qurban" src="https://storage.googleapis.com/banani-generated-images/generated-images/c004e6ee-2f4d-4680-af01-9201c2ee45be.jpg">
            <div class="qurban-body">
              <div class="badge badge-primary" style="margin-bottom: 12px;">Kambing</div>
              <h4 style="font-size: 18px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">Kambing Super</h4>
              <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 12px;">
                Rp 3.500.000
              </div>
              <p style="font-size: 14px; color: var(--gray-600); line-height: 1.5; margin-bottom: 20px;">
                Kambing jantan kualitas super, berat perkiraan 30-35 kg. Cocok untuk qurban keluarga.
              </p>
              <button class="btn-outline btn-full" data-media-type="banani-button">
                Pesan Sekarang
              </button>
            </div>
          </div>

          <!-- Selected/Highlighted State -->
          <div class="qurban-card selected">
            <div style="position: absolute; top: 16px; right: 16px; background: var(--primary); color: white; border-radius: 9999px; padding: 4px 12px; font-size: 12px; font-weight: 600; display: flex; align-items: center; gap: 4px; z-index: 10;">
              <div style="width: 14px; height: 14px; display: flex; align-items: center; justify-content: center;">
                <iconify-icon icon="lucide:check-circle-2" style="font-size: 14px;"></iconify-icon>
              </div>
              Terpilih
            </div>
            <img class="qurban-img" data-aspect-ratio="4:3" data-query="white cow in field photography" alt="Sapi Qurban" src="https://storage.googleapis.com/banani-generated-images/generated-images/1df912a4-eed5-43be-a5c6-beb90c370dcd.jpg">
            <div class="qurban-body">
              <div class="badge badge-primary" style="margin-bottom: 12px;">Sapi 1/7 Saham</div>
              <h4 style="font-size: 18px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">Sapi Patungan</h4>
              <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 12px;">
                Rp 2.800.000
              </div>
              <p style="font-size: 14px; color: var(--gray-600); line-height: 1.5; margin-bottom: 20px;">
                Ikut serta dalam 1/7 saham sapi. Sapi jantan sehat dengan berat perkiraan 300-350 kg.
              </p>
              <button class="btn-primary btn-full" data-media-type="banani-button">
                Pesan Sekarang
              </button>
            </div>
          </div>
        </div>

      </div>
    </section>
            </main>
        </div>

    </div>
</body>
</html>