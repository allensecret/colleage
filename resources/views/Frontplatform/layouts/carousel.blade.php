<div class="row">
    <div class="col-12 mb-4" style="background-color: rgb(246, 244, 239);padding-left: 0;padding-right: 0">
        <div id="demo" class="carousel slide " data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                @foreach($index_img as $list)
                    <li data-target="#demo" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? "active":"" }}"></li>
                @endforeach
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                @foreach($index_img as $img)
                    <div class="carousel-item {{ $loop->index == 0 ? "active":""}}">
                        <img src="/storage/index_img/{{ $img->img }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
