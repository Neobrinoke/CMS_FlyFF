<div class="ui error message">
    <i class="close icon"></i>
    <ul class="list">
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>