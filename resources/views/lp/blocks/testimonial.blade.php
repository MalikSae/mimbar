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

  $classes = "$display $m_pad $d_pad w-full";
@endphp

<div class="{{ $classes }}">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <figure class="bg-gray-50 border-l-4 border-primary rounded-r-xl p-6 sm:p-8 relative">
        <iconify-icon icon="lucide:quote" class="absolute top-4 right-6 text-5xl text-gray-200/50 -rotate-6"></iconify-icon>
        
        <blockquote class="{{ $m_align }} {{ $d_align }} relative z-10">
            <p class="text-lg sm:text-xl font-medium text-gray-800 leading-relaxed italic mb-6">
                "{{ $c['quote'] ?? '' }}"
            </p>
        </blockquote>
        
        <figcaption class="flex items-center {{ $desktop['text_align'] == 'center' ? 'md:justify-center' : ($desktop['text_align'] == 'right' ? 'md:justify-end' : 'md:justify-start') }} {{ $mobile['text_align'] == 'center' ? 'justify-center' : ($mobile['text_align'] == 'right' ? 'justify-end' : 'justify-start') }} relative z-10">
            @if(!empty($c['author']))
                <div class="text-base font-bold text-gray-900">
                    &mdash; {{ $c['author'] }}
                    @if(!empty($c['location']))
                        <span class="text-sm text-gray-500 font-normal ml-1 border-l mx-2 border-gray-300 pl-2">{{ $c['location'] }}</span>
                    @endif
                </div>
            @endif
        </figcaption>
    </figure>
  </div>
</div>
