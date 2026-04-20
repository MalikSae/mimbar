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

  $classes = "$display $m_pad $d_pad w-full";
@endphp

<div class="{{ $classes }}">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col {{ $desktop['text_align'] == 'left' ? 'md:items-start' : ($desktop['text_align'] == 'right' ? 'md:items-end' : 'md:items-center') }} {{ $mobile['text_align'] == 'left' ? 'items-start' : ($mobile['text_align'] == 'right' ? 'items-end' : 'items-center') }}">
    <img src="{{ $c['image_url'] ?? '' }}" alt="{{ $c['alt'] ?? '' }}" class="max-w-full h-auto rounded-xl shadow-sm">
    @if(!empty($c['caption']))
      <p class="mt-3 text-sm text-gray-500 italic text-center max-w-2xl">{{ $c['caption'] }}</p>
    @endif
  </div>
</div>
