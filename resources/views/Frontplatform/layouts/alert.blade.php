@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success div-content">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fas fa-check"></i>  {{ \Illuminate\Support\Facades\Session::get('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger div-content">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
