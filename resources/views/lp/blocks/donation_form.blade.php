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
  <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
      <div class="p-6 sm:p-8">
        @if(!empty($c['campaign_title']))
          <h2 class="text-2xl font-bold font-heading text-gray-900 mb-6 text-center">{{ $c['campaign_title'] }}</h2>
        @endif

        @if(!empty($c['show_progress']) && !empty($c['target_amount']))
          @php
              // Placeholder for current donation amount (always 0 as per prompt)
              $current = 0;
              $target = (float)$c['target_amount'];
              $percentage = $target > 0 ? min(100, round(($current / $target) * 100)) : 0;
          @endphp
          <div class="mb-8">
            <div class="flex justify-between text-sm font-medium text-gray-700 mb-2">
              <span>Terkumpul: Rp 0</span>
              <span>Target: Rp {{ number_format($target, 0, ',', '.') }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-primary h-2.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
            </div>
          </div>
        @endif

        <form action="{{ route('programs.index') }}" method="GET" class="space-y-5">
           <!-- Note: Arahkan ke program.index atau route donasi yang sudah ada -->
          <div>
            <label for="amount_{{ $block->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nominal Donasi</label>
            <div class="relative rounded-md shadow-sm">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="text-gray-500 sm:text-sm">Rp</span>
              </div>
              <input type="number" name="amount" id="amount_{{ $block->id }}" required class="block w-full rounded-lg border-gray-300 pl-10 focus:border-primary focus:ring-primary sm:text-sm" placeholder="100000">
            </div>
          </div>

          <div>
             <label for="name_{{ $block->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
             <input type="text" name="name" id="name_{{ $block->id }}" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary sm:text-sm" placeholder="Hamba Allah">
          </div>

          <div>
             <label for="phone_{{ $block->id }}" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
             <input type="text" name="phone" id="phone_{{ $block->id }}" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary sm:text-sm" placeholder="08123456789">
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
              Donasi Sekarang
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
