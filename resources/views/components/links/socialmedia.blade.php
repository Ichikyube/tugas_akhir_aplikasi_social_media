<div>
    @if (isset($socialNetworking))
                <section class="col-md-4 col-md-offset-4 marginTop">
                    <article>
                        <figure>
                            <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" alt="">
                        </figure>
                    </article>
                    <article>
                        <ul>
                            @foreach ($socialNetworking as $social)

                        @if ($social->name_provider === "facebook")
                            <li><i class="fa fa-facebook">{{ $social->name_provider }}</i></li>
                        @else
                            <li><i class="fa fa-twitter">{{ $social->name_provider }}</i></li>
                        @endif

                        @endforeach
                        </ul>
                    </article>
                </section>

                @else
                    no social
                @endif
    @endif
</div>
