@php
  $products = products_history();
@endphp
<div class="p_browse_history_wrapper">
  <h3 class="section_label">閲覧履歴</h3>
  <ul class="p_history_index_list">
    @foreach($products as $product)
    <li>
      <a href="{{ URL::to('/products/' . $product->id) }}" class="p_history_index">
        <figure class="history_thumb">
          <img src="{{ asset($product->get_photos()[0]->path) }}" alt="{{$product->name}}">
        </figure>
        <h4 class="history_title">{{$product->name}}</h4>
      </a>
    </li>
    @endforeach
  </ul>
</div>