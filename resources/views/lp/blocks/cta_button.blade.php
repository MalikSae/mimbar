@php
  $c = $block->content ?? [];
  $desktop = $block->desktop_settings ?? [];
  $mobile  = $block->mobile_settings  ?? [];

  $d_visible = $desktop['visible'] ?? true;
  $m_visible = $mobile['visible'] ?? true;
  
  if (!$d_visible && !$m_visible) { $display = 'hidden'; }
  else if ($d_visible && !$m_visible) { $display = 'hidden md:block'; }
  else if (!$d_visible && $m_visible) { $display = 'block md:hidden'; }
  else { $display = 'block'; }

  $d_pad_map = ['none' => 'md:py-0', 'small' => 'md:py-6', 'medium' => 'md:py-12', 'large' => 'md:py-20'];
  $m_pad_map = ['none' => 'py-0', 'small' => 'py-6', 'medium' => 'py-12', 'large' => 'py-20'];
  $d_pad = $d_pad_map[$desktop['padding'] ?? 'medium'] ?? 'md:py-12';
  $m_pad = $m_pad_map[$mobile['padding'] ?? 'medium'] ?? 'py-12';

  $d_align = 'md:text-' . ($desktop['text_align'] ?? 'center');
  $m_align = 'text-' . ($mobile['text_align'] ?? 'center');

  $classes = "$display $m_pad $d_pad w-full $m_align $d_align";

  $style = $c['style'] ?? 'primary';
  if ($style === 'secondary') {
      // Assuming secondary is around orange or alternate color
      $btnClass = "bg-orange-500 hover:bg-orange-600 text-white border-transparent";
  } elseif ($style === 'outline') {
      $btnClass = "bg-transparent text-primary hover:text-primary-dark border-primary hover:bg-primary-surface";
  } else {
      $btnClass = "bg-primary hover:bg-primary-dark text-white border-transparent";
  }
@endphp

<div class="{{ $classes }}">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ $c['url'] ?? '#' }}" class="inline-flex items-center justify-center px-8 py-3 border text-base font-bold rounded-full transition-colors shadow-sm {{ $btnClass }}">
      {{ $c['label'] ?? 'Klik di Sini' }}
    </a>
  </div>
</div>
