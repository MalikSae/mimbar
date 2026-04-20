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

  $classes = "$display $m_pad $d_pad w-full";
@endphp

<div class="{{ $classes }}">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    @php
        $current = (float)($c['current_amount'] ?? 0);
        $target = (float)($c['target_amount'] ?? 0);
        $percentage = $target > 0 ? min(100, round(($current / $target) * 100)) : 0;
    @endphp
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @if(!empty($c['label']))
          <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">{{ $c['label'] }}</h3>
        @endif
        
        <div class="flex flex-col sm:flex-row justify-between items-baseline mb-2 space-y-2 sm:space-y-0">
          <div class="text-2xl font-bold font-heading text-primary">
            Rp {{ number_format($current, 0, ',', '.') }}
          </div>
          <div class="text-sm text-gray-500">
            dari target <span class="font-medium text-gray-900">Rp {{ number_format($target, 0, ',', '.') }}</span>
          </div>
        </div>
        
        <div class="relative w-full bg-gray-200 rounded-full h-3 mb-2 flex items-center">
            <div class="bg-primary h-3 rounded-full transition-all duration-1000 ease-out relative" style="width: {{ $percentage }}%">
               <!-- Decorative shine -->
               <div class="absolute inset-0 bg-white/20 rounded-full"></div>
            </div>
        </div>
        
        <div class="text-right text-xs font-bold text-primary">
          {{ $percentage }}% Tercapai
        </div>
    </div>
  </div>
</div>
