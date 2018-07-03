<div class="ui error message">
    <i class="close icon"></i>
    <ul class="list">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>