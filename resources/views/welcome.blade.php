<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Large files uploader</title>
    </head>
    <body>
    <div class="wrapper">
        <div id="upload-status">
            Please select a file you want to upload:
        </div>
        <input type="file" id="fileInput" />
        <button onclick="uploadFile()">Upload</button>
    </div>
    </body>

    <script type="module" src="app.js"></script>
</html>
