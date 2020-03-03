@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@elseif(session()->has('alert'))
    <div class="alert alert-danger">
        {{ session()->get('alert') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif
@if($errors)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endforeach
@endif