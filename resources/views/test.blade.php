@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach


        </ul>
    </div>

@endif

<form id="test" method="POST">
    @csrf
    <label for="nombre">Campo 1</label>
    <input type="text" name="nombre" id="nombre">

    <button type="submit" name="save_data" class="btn btn-primary">Save changes</button>
</form>


@endsection






