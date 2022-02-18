@php

$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
$tags_ru = App\Models\Product::groupBy('product_tags_ru')->select('product_tags_ru')->get();

@endphp




<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if(session()->get('language') == 'eng')
            @foreach($tags_en as $tag)
            <a class="item" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_en) }}">{{ $tag->product_tags_en }}</a>
            @endforeach
            @else

            @foreach($tags_ru as $tag)
            <a class="item" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_ru) }}">{{ $tag->product_tags_ru }}</a>
            @endforeach

            @endif
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>