@if($page->canvas_mode === 'full_page')
  @extends('layouts.app')
@else
  @extends('layouts.canvas')
@endif

@section('content')
  <div class="lp-canvas w-full overflow-hidden">
    @foreach($page->blocks as $block)
      @if(view()->exists('lp.blocks.' . $block->type))
        @include('lp.blocks.' . $block->type, ['block' => $block])
      @endif
    @endforeach
  </div>
@endsection
