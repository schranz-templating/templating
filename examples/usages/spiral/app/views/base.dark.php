<extends:layout.base title="[[Welcome To Spiral]]"/>
<use:element path="embed/links" as="homepage:links"/>

<stack:push name="styles">
    <link rel="stylesheet" href="/styles/welcome.css"/>
</stack:push>

<define:body>
    <h1>{{ $title }}</h1>
</define:body>
