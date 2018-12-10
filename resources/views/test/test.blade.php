<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="{{ mix('/css/app.css') }}">
</head>
<body>
<div id="app">
    @{{ message }}
    <example-component>

    </example-component>

</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>