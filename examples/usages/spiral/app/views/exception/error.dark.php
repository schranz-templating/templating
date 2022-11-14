<extends:layout.base title="[[Something went wrong]]"/>
<use:element path="embed/links" as="homepage:links"/>

<stack:push name="styles">
    <link rel="stylesheet" href="/styles/welcome.css"/>
</stack:push>

<define:body>
    <div>
        <div class="placeholder" style="margin: 0 auto; width: fit-content; margin-bottom: 20px;">
            <img src="/images/logo.svg" alt="Framework Logotype" width="200px"/>
            <h2>[[Something went wrong]]. [[Error code]]: {{ $code }}</h2>

            <homepage:links git="https://github.com/spiral/app" style="font-weight: bold;"/>

            <div style="font-size: 12px; margin-top: 10px;">
                [[This view file is located in]] <b>app/views/exception/error.dark.php</b>.
            </div>
        </div>

        @if ($exception && env('DEBUG') === true)
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @while($exception)
                    <section style="box-sizing: content-box; max-width: 100%; overflow: auto; background: #efefef; padding: 5px 20px;">
                        <h3>{{ $exception->getMessage() }}</h3>
                        <pre>{{ $exception->getTraceAsString() }}</pre>
                    </section>

                    @php $exception = $exception->getPrevious(); @endphp
                @endwhile
            </div>
        @endif
    </div>
</define:body>
