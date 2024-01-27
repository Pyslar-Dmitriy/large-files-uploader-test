<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Large files uploader</title>

        @vite('resources/scss/app.scss')
    </head>
    <body>
    <div class="wrapper">
        <div id="upload-status">
            Please select a file you want to upload:
        </div>
        <input type="file" id="file-input" />
        <span id="file-name"></span>
        <button onclick="uploadFile()">Upload</button>
    </div>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
    <script>
        const resumable = new Resumable({
            target: '/upload',
            uploadMethod: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        })

        resumable.assignBrowse(document.getElementById('file-input'));

        resumable.on('fileAdded', function(file, event){
            document.getElementById('file-name').innerText = file.fileName
        })

        resumable.on('fileSuccess', function(file, message){
            document.getElementById('file-name').innerText = `${file.fileName} is successfully uploaded!`
        })

        resumable.on('fileError', function(file, message){
            document.getElementById('file-name').innerText = 'Something went wrong. Try again.'
        })

        function uploadFile() {
            resumable.upload()
        }
    </script>

</html>
