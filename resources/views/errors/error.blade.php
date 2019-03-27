@if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        @foreach($errors->all() as $error)
            <p><span class="glyphicon glyphicon-exclamation-sign"></span> {{ $error }}</p>
        @endforeach
    </div>
@endif