<div class="col-sm-8">
    @if (!empty($alphabetise))
        <h6>Starting with:</h6>

        @foreach ($alphabetise as $letter)
            <a href='/users/{{ $letter }}' style="font-size: 28px;"> {{ $letter }} </a>
        @endforeach
    @endif
</div>
