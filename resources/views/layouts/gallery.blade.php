<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ $metatitle }}
        {{ $metadesc }}
        <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">                   
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5"> 
        <style>
            @font-face{font-family:Oswald;src:url(/font/oswald-medium-webfont.woff2) format("woff2"),url(/font/oswald-medium-webfont.woff) format("woff"),url(/font/oswald-medium-webfont.ttf) format("truetype");font-weight:500;font-style:normal}@font-face{font-family:Oswald;src:url(/font/oswald-regular-webfont.woff2) format("woff2"),url(/font/oswald-regular-webfont.woff) format("woff"),url(/font/oswald-regular-webfont.ttf) format("truetype");font-weight:400;font-style:normal}@font-face{font-family:"Roboto Condensed";src:url(/font/robotocondensed-regular-webfont.woff2) format("woff2"),url(/font/robotocondensed-regular-webfont.woff) format("woff"),url(/font/robotocondensed-regular-webfont.ttf) format("truetype");font-weight:400;font-style:normal}a,body,div,footer,h1,h2,h3,h4,h5,h6,header,html,i,img,li,nav,p,section,span,strong,ul{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}html{overflow:auto}body{margin:0;font-size:16px;font-family:"Roboto Condensed",sans-serif;font-weight:400;color:#5c5c5c;background-color:#fff;line-height:1}a{text-decoration:none}footer,header,main,section{display:block}ul li{list-style:none}button{background-color:transparent;border:0}.wrapper{width:80%;margin:0 auto}.container{width:90%;margin:0 auto}h1{margin:0 0 18px 0;font-family:Oswald,sans-serif;font-size:3.625em;font-weight:500;letter-spacing:.1em;color:#9d8662;text-transform:uppercase}h1+p{margin-left:10px;padding-bottom:50px;font-family:Oswald,sans-serif;font-size:2.0625em;font-weight:400;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.8)}h2{text-transform:uppercase;color:#9d8662;letter-spacing:.2em;font-size:1.125em;text-align:center;padding:0}h2 span{opacity:0}h2 .space{height:2px}.page-header{position:absolute;width:100%;top:0;z-index:8;padding:15px 0 20px 0;background-color:#fff}.page-header .container{width:96%;overflow:hidden}.logo{display:block;width:290px;margin-left:10px;padding:0;overflow:hidden}.logo h1{display:block;width:auto;margin-bottom:5px;padding-top:5px;font-size:2.3125em;color:#9d8662;letter-spacing:normal;opacity:0}.logo p{width:auto;margin:0 0 0 5px;padding-bottom:0;font-size:1.125em;color:#9d8662;letter-spacing:.3em;opacity:0}.page-nav{position:fixed;width:250px;height:100vh;top:0;right:-250px;z-index:2;display:flex;flex-direction:column;justify-content:center;background:#1a1a1a;text-align:center;transition:right .7s ease .2s}.menu-list ul{padding:20px 0}.menu-list ul li{margin-bottom:30px}.menu-list ul li a{font-family:Oswald,sans-serif;color:#9d8662;text-transform:uppercase;font-size:1.1875em;letter-spacing:.2em}.menu-list ul li a:hover{color:#b09e82}.menu-list ul li:last-child{margin-bottom:0}.menu-button{position:fixed;z-index:9999999;top:15px;right:10px;width:50px;height:50px;cursor:pointer;margin-left:10px;opacity:0}.menu-button span,.menu-button span:after,.menu-button span:before{content:"";display:block;height:3px;width:100%;background:#b09e82;position:relative;transition:all .2s ease-in-out}.menu-button span:before{top:13px}.menu-button span:after{top:-15px}.menu-button:selection{background:0 0}.menu-button:-moz-selection{background:0 0}.menu-button.is-open span{background:0 0}.menu-button.is-open span:after,.menu-button.is-open span:before{top:0;transform-origin:center;transform:rotate(45deg);background:#9d8662}.menu-button.is-open span:before{transform:rotate(-45deg)}.menu-button.is-open span:after{top:-2px}.menu-button:hover span:before{top:17px}.menu-button:hover span:after{top:-19px}.menu-button.is-open:hover span:after,.menu-button.is-open:hover span:before{top:0;background:#b09e82}.menu-button.is-open:hover span:after{top:-2px}.page-nav.on-click{right:0}footer{position:relative;width:100%;bottom:0;left:0;z-index:1;padding:10px 0;background-color:rgba(255,255,255,.6)}footer .wrapper{width:98%;margin:0 auto;text-align:center}footer a,footer p{margin-bottom:4px;font-size:1.1em;color:#9d8662;text-transform:uppercase;letter-spacing:.1em;text-align:center;opacity:0}footer .by{margin-bottom:0;font-weight:400;font-size:.8em;letter-spacing:normal}footer .by a{font-size:1em;letter-spacing:normal}.title-container{margin-top:110px;margin-bottom:15px}.img-container{width:100%;min-height:90vh;padding:10px 0;background:#eee;border-top:1px solid #dbdbdb}.no-js .grid,.no-js .grid a,.no-js .logo h1,.no-js .logo p,.no-js .menu-button,.no-js footer a,.no-js footer p,.no-js h2 span{opacity:1}.hidden{display:none!important;visibility:hidden}.visuallyhidden{border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.visuallyhidden.focusable:active,.visuallyhidden.focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.invisible{visibility:hidden}.clearfix:after,.clearfix:before{content:" ";display:table}.clearfix:after{clear:both}.img-container{display:block;min-height:100%;position:relative;background:#eee}.grid{max-width:98%;margin:0 1% 20px 1%;padding:0;display:flex;flex-wrap:wrap;justify-content:space-around;list-style:none;opacity:0}.grid a{width:48%;margin:1%;padding:0;cursor:pointer;overflow:hidden;opacity:0}.grid a.open{position:fixed;z-index:999}.grid a:hover img{transform:scale3d(1.05,1.05,1)}.grid a:hover div{opacity:1}.grid img{display:block;width:100%;padding:0;margin:0;transform:scale3d(1,1,1);-webkit-backface-visibility:hidden;backface-visibility:hidden;transition:opacity .6s,transform .6s,filter .6s;transition:opacity .6s,transform .6s,filter .6s}.grid div{position:absolute;width:100%;height:100%;top:0;left:0;display:flex;flex-direction:column;justify-content:center;color:rgba(255,255,255,.8);text-transform:uppercase;text-align:center;-webkit-backface-visibility:hidden;backface-visibility:hidden;line-height:1.5;transition:opacity .9s;font-weight:400;background:rgba(0,0,0,.3);opacity:0}.grid div h3{font-family:"Roboto Condensed",sans-serif;font-weight:400;font-size:1em;padding:10px}.grid div p{display:none}.vanish{display:none}.grid a.shown,.no-cssanimations .grid a,.no-js .grid a{opacity:1}.grid.effect-2 a.animate{transform:translateY(200px);-webkit-animation:moveUp .9s ease forwards;animation:moveUp .9s ease forwards}@-webkit-keyframes moveUp{100%{-webkit-transform:translateY(0);opacity:1}}@keyframes moveUp{100%{transform:translateY(0);opacity:1}}@-webkit-keyframes grow{100%{transform:scale(1);opacity:1}}@keyframes grow{100%{transform:scale(1);opacity:1}}.lds-spinner{display:none}@media screen and (min-width:480px){h2{position:relative;margin:120px auto 20px auto}h2 span{width:30px;display:block;margin-bottom:15px;padding-left:5px;text-align:center}.page-header{padding:20px 0}.page-header .container{width:90%}.logo{margin:0 auto;text-align:center}.menu-button{width:55px;height:55px;top:20px;right:5%}.title-container{position:fixed;width:1px;height:100vh;margin:0;top:0;left:4%;z-index:1;display:flex;flex-direction:column;align-items:center;background-color:transparent}.grid{width:88%;margin:105px 5% 30px 7%}}@media screen and (min-width:800px){.grid a{width:32.33%;margin:.5%}}@media screen and (min-width:1190px){.menu-button{right:5%}.title-container{left:7%}.grid{max-width:80%;margin:105px auto 30px auto}.grid a{width:32.7%;margin:3px}}@media screen and (min-width:1300px){.grid{width:80%;max-width:1380px}.grid a{width:24.4%}}@media screen and (min-width:1600px){h1{font-size:3.8125em}h1+p{font-size:2.1875em}h2{margin-top:135px;font-size:1.25em}.menu-button{top:25px}.menu-list ul li a{font-size:1.3125em}.logo h1{font-size:2.5625em}.logo p{font-size:1.25em}.grid{margin-top:120px}}@media screen and (min-width:1730px){.menu-button{right:6%}.title-container{left:8%}}@media screen and (min-width:1900px){.menu-button{right:8%}.title-container{left:10%}}
        </style>
    </head>

    <body>
        <x-header></x-header>
        <div class="title-container">
           <div class="title">
               <h2>{{ $title }}</h2>
           </div>
        </div>   
        <section class="img-container">

        {{ $slot }}

        </section>
        <x-footer></x-footer>
        <link rel="stylesheet" href="{{ asset('css/gallery-slider.min.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
        <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
		<script src="{{ asset('js/classie.min.js')}}"></script>
		<script src="{{ asset('js/AnimOnScroll.min.js')}}"></script>
        <script src="{{ asset('js/main.min.js')}}"></script>       
        <script src="{{ asset('js/photoslider.min.js')}}"></script>
        <script src="{{ asset('js/photoslider-ui-default.min.js')}}"></script>
        <script src="{{ asset('js/slider.min.js')}}"></script>

        <script>

            jQuery(function($){ 

                var ENDPOINT = "{{ url('/') }}";
                var album = "{{ $album }}";
                var page = 1;
                var totalPages = parseInt($('#grid').attr('data-total-pages'));
                let $grid = $('.grid').masonry({
                    itemSelector: 'a',
                    horizontalOrder: false,
                    visibleStyle: { transform: 'translateY(0)', opacity: 1 },
                    hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
                });
                let loading = false;

                new AnimOnScroll( document.getElementById( 'grid' ), {
                        minDuration : 0.4,
                        maxDuration : 0.7,
                        viewportFactor : 0.2
                    } );

                function infinteLoadMore(page) {
                    $.ajax({
                        url: ENDPOINT + "/" + album + "?page=" + page,
                        datatype: "json",
                        type: "get",

                        beforeSend: function () {
                            $('.lds-spinner').addClass('show');
                        }
                    }).done(function (response) {

                        if (response.length == 0) {
                            $('.auto-load').html("We don't have more data to display :(");
                            return;
                        }
                        let $photos = $(response.html);
                        let $grid = $('.grid').masonry({
                                itemSelector: 'a',
                                horizontalOrder: false,
                                visibleStyle: { transform: 'translateY(0)', opacity: 1 },
                                hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
                            });

                        $photos.imagesLoaded( function() {
                            
                            $grid.append( $photos ).masonry( 'appended', $photos ).masonry('layout');

                            new AnimOnScroll( document.getElementById( 'grid' ), {
                                minDuration : 0.4,
                                maxDuration : 0.7,
                                viewportFactor : 0.2
                            } );

                            $('.lds-spinner').removeClass('show');

                            if(page < totalPages){
                                $('#button').show();
                            }else{
                                $('.lds-spinner').removeClass('show');
                                $('#end').show();
                            }

                            loading = false;

                        })

                    }).fail(function (jqXHR, ajaxOptions, thrownError) {
                            console.log('Server error occured');
                    });

                }

                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() + 200 >= $(document).height()) {
                        if(loading == false){
                            page++;
                            if( page <= totalPages ){
                                loading = true;
                                infinteLoadMore(page);
                            }
                        }
                    }
                });

            });    

        </script>

    </body>
</html>
