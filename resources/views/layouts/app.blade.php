<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ $title }}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="{{ asset('/css/admin.css') }}" media="all" rel="stylesheet" type="text/css" />
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
  
        <x-jet-banner />
        @livewire('navigation-menu')

        <!-- Page Heading -->
        <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main class="container my-5">
            {{ $slot }}
        </main>

        <div id="alert" class="alert btn-warning alert-dismissible fade" role="alert">
                Zaktualizowano profil!
        </div>

        <div id="save-loader-container">
            <div id="save-loader">
                <div>
                    <div class="lds-spinner">
                        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    </div>
                    <p>Zapisywanie zdjęcia</p>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')

        <!-- Bootstrap 4 -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/l5827vw7aogh95lwv1hv7zqkh893yghbzw0578fqqlziuicp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://cdn.tiny.cloud/1/l5827vw7aogh95lwv1hv7zqkh893yghbzw0578fqqlziuicp/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <script>

            window.addEventListener('open-modal', event => {
                var modalId = event.detail.message;
                var modalTitle = event.detail.title;
                $("#" + modalId).modal('show');
                $("#modal-title").text(modalTitle);
            })

            window.addEventListener('close-modal', event => {
                $('.modal').modal('hide');
                $('#alert').text(event.detail.message);
                $('#alert').addClass('show');
                    setTimeout(function(){
                        $('#alert').removeClass('show');
                }, 3500);
            })

            window.addEventListener('show-loader', event => {
                $('#save-loader-container').show();
                Livewire.emit('save');
            })

            window.addEventListener('hide-loader', event => {
                $('#save-loader-container').hide();
                $('.modal').modal('hide');
                $('#alert').text(event.detail.message);
                $('#alert').addClass('show');
                    setTimeout(function(){
                        $('#alert').removeClass('show');
                }, 3500);
            })


            $(document).on("change", "#file", function(e) {
                $('#updated-img').hide();
                var width, height;
                var _URL = window.URL || window.webkitURL;
                var file = e.target.files[0];
                var name = file.name;
                var timestamp = file.lastModified;
                var image = new Image();
                image.src = _URL.createObjectURL(file);
                image.onload = function () {
                    width = image.width;
                    height = image.height;
                    Livewire.emit('change', timestamp, width, height);
                }
            });

            $('#photo').change(function(e) {
                var file = e.target.files[0];
                var name = file.name;
                var timestamp = file.lastModified;
            });

            $('#about-content-modal').on('show.bs.modal', function(event){
                tinymce.init({
                    language: 'pl',
                    selector:'#textarea-editor',
                    height: '400px',
                    menubar: false,
                    plugins: 'autolink link lists paste',
                    toolbar: ' undo redo | h2 h3 h4 h5 h6 | bold ',
                    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                    paste_as_text: true,
                    contextmenu: false,
                });
            })

            $('#editor-form').on('submit', function(event){
                var content = tinyMCE.activeEditor.getContent();
                $(this).find('textarea').val(content);
                Livewire.emit('updateContent', content);
                event.preventDefault();
            })

            // var time = 2000;
            // $("#upload").on('click', function(){
            //     $($('#gallery-old a').get().reverse()).each(function(){
            //         var href = $(this).attr('href');
            //         var ds = $(this).attr('data-size');
            //         var dm = $(this).attr('data-med');
            //         var dms = $(this).attr('data-med-size');
            //         var thumb = $(this).find('img').attr('src');
            //         var title = $(this).find('h3').text();
            //         var desc = $(this).find('p').text();
            //         Livewire.emit('upload', href,ds,dm,dms,thumb,title,desc);
            //     })
            // })

        </script>
    </body>
</html>
