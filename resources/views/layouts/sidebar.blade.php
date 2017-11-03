<div class="col-sm-3 offset-sm-1 blog-sidebar">
    @if (Auth::check())
    <div class="sidebar-module sidebar-module-inset">

        <h4>Your Subscriptions</h4>
        {{-- link to subscribed --}}
        <ol class="list-unstyled">
            @if (!empty($subscribed))
                @foreach ($subscribed as $subscription)
                    <li>
                        <a href='/profiles/{{ $subscription->username }}'>
                            {{ $subscription->username }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ol>
    </div>
    @endif
    <div class="sidebar-module">
        <h4>Recent Archives</h4>
        <ol class="list-unstyled">
            @if (!empty($archives))
            @foreach ($archives as $stats)
            <li>
                <a href='/?month={{ $stats['month'] }}&year={{ $stats['year'] }}'>{{ $stats['month'] . ' ' . $stats['year'] }}</a>
            </li>
            @endforeach
            @endif
        </ol>
    </div>

    <div class="sidebar-module">
        <h4>Popular Tags</h4>
        <ol class="list-unstyled">
            @if (!empty($tags))
            @foreach ($tags as $tag)
            <li>

                <a href='/posts/tags/{{ $tag->name }}'>
                    {{ $tag->name }} ({{ $tag->posts_count }})
                </a>
            </li>
            @endforeach
            @endif
        </ol>
    </div>

  {{-- <div class="sidebar-module">
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="#">GitHub</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
    </ol>
</div> --}}
</div><!-- /.blog-sidebar -->
