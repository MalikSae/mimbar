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

  $classes = "$display $m_pad $d_pad $m_align $d_align $m_font $d_font w-full text-gray-800";
@endphp

<div class="{{ $classes }}">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg prose-primary max-w-none">
    {!! $c['body'] ?? '' !!}
  </div>
</div>
