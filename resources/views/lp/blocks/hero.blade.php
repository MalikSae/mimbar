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

  $d_align = 'md:text-' . ($desktop['text_align'] ?? 'left');
  $m_align = 'text-' . ($mobile['text_align'] ?? 'left');

  $d_font_map = ['small' => 'md:text-sm', 'base' => 'md:text-base', 'large' => 'md:text-lg', 'xl' => 'md:text-xl'];
  $m_font_map = ['small' => 'text-sm', 'base' => 'text-base', 'large' => 'text-lg', 'xl' => 'text-xl'];
  $d_font = $d_font_map[$desktop['font_size'] ?? 'base'] ?? 'md:text-base';
  $m_font = $m_font_map[$mobile['font_size'] ?? 'base'] ?? 'text-base';

  $classes = "$display $m_pad $d_pad $m_align $d_align $m_font $d_font relative w-full";
@endphp

<section class="{{ $classes }}">
  @if(!empty($c['image_url']))
    <div class="absolute inset-0 z-0">
      <img src="{{ $c['image_url'] }}" alt="Hero Background" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-black/50"></div> <!-- Overlay -->
    </div>
  @endif

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
    @if(!empty($c['heading']))
      <h1 class="font-bold font-heading tracking-tight text-4xl sm:text-5xl md:text-6xl mb-4" style="{{ !empty($c['image_url']) ? 'color: #ffffff;' : '' }}">
        {{ $c['heading'] }}
      </h1>
    @endif

    @if(!empty($c['subheading']))
      <p class="mt-4 max-w-3xl mx-auto text-xl mb-8 {{ !empty($c['image_url']) ? 'text-gray-100' : 'text-gray-600' }}">
        {{ $c['subheading'] }}
      </p>
    @endif

    @if(!empty($c['button_label']) && !empty($c['button_url']))
      <div class="mt-8 flex justify-center md:justify-start {{ $desktop['text_align'] == 'center' ? 'md:justify-center' : ($desktop['text_align'] == 'right' ? 'md:justify-end' : '') }}">
        <a href="{{ $c['button_url'] }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-primary hover:bg-primary-dark transition-colors shadow">
          {{ $c['button_label'] }}
        </a>
      </div>
    @endif
  </div>
</section>
