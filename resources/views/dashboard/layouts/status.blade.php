@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable  show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p class="m-0" style="color: #0b0b0b;">{{ session()->get('success') }}</p>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissable  show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p class="m-0">{{ session()->get('error') }}</p>

    </div>
@endif

@if(session()->has('info'))
    <div class="alert alert-info alert-dismissable  show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p class="m-0">{{ session()->get('info') }}</p>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger alert-dismissable  show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif





