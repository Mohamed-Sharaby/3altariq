
@if($image)
    <a data-fancybox="gallery" href="{{$image}}">
        <img src="{{$image}}" width="70" height="70"
             class="img-thumbnail" alt="provider_img">
    </a>
@else {{__('No Image')}} @endif
