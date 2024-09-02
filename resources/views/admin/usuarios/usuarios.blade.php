@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")


<div id="alert-wrapper">
    @if($errors->any())
        <div class="alert error">
            @foreach ($errors->all() as $error) 
                <p class="error-message">{{ $error }}</p>
            @endforeach

            @if(isset($contentError))
                <p class="error-message">{{ $contentError }}</p>
            @endif
        </div>
    @endif

    @if (session('message'))
        <div class="alert succes">{{ session('message') }}</div>
    @endif
</div>



<div>
    {{ paginateUsuarios() }}
</div>

@endsection
