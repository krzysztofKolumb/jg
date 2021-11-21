<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jan Gietka Photos | @yield('title')</title>
    <style>
        @font-face {
            font-family: "Oswald";
            src: url("/font/oswald-medium-webfont.woff2") format("woff2"), url("/font/oswald-medium-webfont.woff") format("woff"), url("/font/oswald-medium-webfont.ttf") format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: "Oswald";
            src: url("/font/oswald-regular-webfont.woff2") format("woff2"), url("/font/oswald-regular-webfont.woff") format("woff"), url("/font/oswald-regular-webfont.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Roboto Condensed";
            src: url("/font/robotocondensed-regular-webfont.woff2") format("woff2"), url("/font/robotocondensed-regular-webfont.woff") format("woff"), url("/font/robotocondensed-regular-webfont.ttf") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        a,body,div,footer,h1,h2,h3,h4,h5,h6,header,html,
        p {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        a {
            text-decoration: none;
        }

        body {
            height: 100%;
            margin: 0;
            font-size: 16px;
            font-family: "Roboto Condensed", sans-serif;
            font-weight: 400;
            color: #5c5c5c;
            background-color: #eee;
            line-height: 1;
        }

        html {
            height: 100%;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        main h3,
        main p {
            font-size: 25px;
        }

        main p {
            padding: 0 10px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        h1 {
            margin: 0 0 18px 0;
            font-family: Oswald, sans-serif;
            font-size: 3.625em;
            font-weight: 500;
            letter-spacing: 0.1em;
            color: #9d8662;
            text-transform: uppercase;
        }

        h1+p {
            margin-left: 10px;
            padding-bottom: 50px;
            font-family: Oswald, sans-serif;
            font-size: 2.0625em;
            font-weight: 400;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
        }

        .page-header {
            position: absolute;
            width: 100%;
            top: 0;
            z-index: 8;
            padding: 15px 0 20px 0;
            background-color: #fff;
            opacity: 1;
        }

        .page-header .container {
            width: 96%;
            overflow: hidden;
        }

        .logo {
            display: block;
            width: 290px;
            margin-left: 10px;
            padding: 0;
            overflow: hidden;
        }

        .logo h1 {
            display: block;
            width: auto;
            margin-bottom: 5px;
            padding-top: 5px;
            font-size: 2.3125em;
            color: #9d8662;
            letter-spacing: normal;
            opacity: 1;
        }

        .logo p {
            width: auto;
            margin: 0 0 0 5px;
            padding-bottom: 0;
            font-size: 1.125em;
            color: #9d8662;
            letter-spacing: 0.3em;
            opacity: 1;
        }

        footer {
            position: relative;
            width: 100%;
            bottom: 0;
            left: 0;
            z-index: 1;
            padding: 10px 0;
            background-color: rgba(255, 255, 255, 0.6);
        }

        footer .wrapper {
            width: 98%;
            margin: 0 auto;
            text-align: center;
        }

        footer a,
        footer p {
            margin-bottom: 4px;
            font-size: 1.1em;
            color: #9d8662;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-align: center;
            opacity: 1;
        }

        footer .by {
            margin-bottom: 0;
            font-weight: 400;
            font-size: 0.8em;
            letter-spacing: normal;
        }

        footer .by a {
            font-size: 1em;
            letter-spacing: normal;
        }


        @media screen and (min-width: 480px) {
            .page-header {
                padding: 20px 0;
            }

            .page-header .container {
                width: 90%;
            }

            .logo {
                margin: 0 auto;
                text-align: center;
            }

        }

        @media screen and (min-width: 1600px) {
            h1 {
                font-size: 3.8125em;
            }

            h1+p {
                font-size: 2.1875em;
            }

            .logo h1 {
                font-size: 2.5625em;
            }

            .logo p {
                font-size: 1.25em;
            }
        }
    </style>

</head>

<body>

    <header class="page-header">
        <div class="container">
            <a class="logo" href="{{ route('home') }}">
                <h1>Jan Gietka</h1>
                <p>Photography</p>
            </a>
        </div>
    </header>
    <main>
        <h3>
            @yield('code')
        </h3>
        <p> | </p>
        <h3>
            @yield('message')
        </h3>
    </main>
</body>

</html>