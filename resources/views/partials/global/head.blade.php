<head>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<title>Heleum</title>

	<link rel="apple-touch-icon" sizes="57x57" href="/css/images/favicon/apple-touch-icon-57x57.png" />

	<link rel="apple-touch-icon" sizes="114x114" href="/css/images/favicon/apple-touch-icon-114x114.png" />

	<link rel="apple-touch-icon" sizes="72x72" href="/css/images/favicon/apple-touch-icon-72x72.png" />

	<link rel="apple-touch-icon" sizes="144x144" href="/css/images/favicon/apple-touch-icon-144x144.png" />

	<link rel="apple-touch-icon" sizes="60x60" href="/css/images/favicon/apple-touch-icon-60x60.png" />

	<link rel="apple-touch-icon" sizes="120x120" href="/css/images/favicon/apple-touch-icon-120x120.png" />

	<link rel="apple-touch-icon" sizes="76x76" href="/css/images/favicon/apple-touch-icon-76x76.png" />

	<link rel="apple-touch-icon" sizes="152x152" href="/css/images/favicon/apple-touch-icon-152x152.png" />

	<link rel="icon" type="image/png" href="/css/images/favicon/favicon-196x196.png" sizes="196x196" />

	<link rel="icon" type="image/png" href="/css/images/favicon/favicon-96x96.png" sizes="96x96" />

	<link rel="icon" type="image/png" href="/css/images/favicon/favicon-32x32.png" sizes="32x32" />

	<link rel="icon" type="image/png" href="/css/images/favicon/favicon-16x16.png" sizes="16x16" />

	<link rel="icon" type="image/png" href="/css/images/favicon/favicon-128.png" sizes="128x128" />

	<meta name="application-name" content="Heleum"/>

	<meta name="msapplication-TileColor" content="#405E82" />

	<meta name="msapplication-TileImage" content="/css/images/favicon/mstile-144x144.png" />

	<meta name="msapplication-square70x70logo" content="/css/images/favicon/mstile-70x70.png" />

	<meta name="msapplication-square150x150logo" content="/css/images/favicon/mstile-150x150.png" />

	<meta name="msapplication-wide310x150logo" content="/css/images/favicon/mstile-310x150.png" />

	<meta name="msapplication-square310x310logo" content="/css/images/favicon/mstile-310x310.png" />

	<meta name="theme-color" content="#405E82" />

	@include('partials.global.opengraph')

	<link rel="shortcut icon" type="image/x-icon" href="/css/images/favicon/favicon.ico" />

	<!-- Vendor Styles -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" />

	<link rel="stylesheet" href="/vendor/skeleton/css/skeleton.css" />

	<!-- App Styles -->
	<link rel="stylesheet" href="/css/style.css?v={{ filemtime(public_path('/css/style.css')) }}" />

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> --}}

	<style type="text/css">

        .large-top-spacing {
            margin-top: 8rem;
        }
        .alert {
            background-color: #f0987b;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
        }
        .underline {
            text-decoration: underline;
        }
	</style>



    <style type="text/css">
        {{-- Colors from [Uphold](https://uphold.com/en/transparency) --}}
        .card-usd { background-color: rgb(90, 159, 79) !important; }
        .card-eur { background-color: rgb(85, 123, 200) !important; }
        .card-gbp { background-color: rgb(159, 110, 204) !important; }
        .card-chf { background-color: rgb(213, 43, 30) !important; }
        .card-cad { background-color: rgb(237, 41, 57) !important; }
        .card-mxn { background-color: rgb(0, 93, 64) !important; }
        .card-jpy { background-color: rgb(204, 204, 204) !important; }
        .card-aud { background-color: rgb(254, 189, 35) !important; }
        .card-nzd { background-color: rgb(33, 33, 33) !important; }
        .card-chy { background-color: rgb(235, 66, 66) !important; }
        .card-ars { background-color: rgb(117, 170, 219) !important; }
        .card-brl { background-color: rgb(45, 100, 71) !important; }
        .card-dkk { background-color: rgb(204, 0, 1) !important; }
        .card-xau { background-color: rgb(238, 208, 111) !important; }
        .card-hkd { background-color: rgb(200, 16, 46) !important; }
        .card-inr { background-color: rgb(244, 117, 0) !important; }
        .card-ils { background-color: rgb(102, 153, 255) !important; }
        .card-kes { background-color: rgb(161, 37, 15) !important; }
        .card-nok { background-color: rgb(239, 43, 45) !important; }
        .card-xpd { background-color: rgb(172, 180, 183) !important; }
        .card-php { background-color: rgb(65, 105, 225) !important; }
        .card-xpt { background-color: rgb(201, 188, 181) !important; }
        .card-pln { background-color: rgb(220, 20, 60) !important; }
        .card-xag { background-color: rgb(178, 178, 178) !important; }
        .card-sgd { background-color: rgb(244, 42, 65) !important; }
        .card-sek { background-color: rgb(0, 113, 184) !important; }
        .card-chf { background-color: rgb(213, 43, 30) !important; }
        .card-aed { background-color: rgb(36, 141, 72) !important; }
        .card-btn { background-color: rgb(255, 178, 81) !important; }
        .card-ltc { background-color: rgb(102, 102, 102) !important; }
        .card-eth { background-color: rgb(68, 67, 65) !important; }
        .card-bch { background-color: rgb(247, 147, 26) !important; }
        .card-bat { background-color: rgb(128, 134, 150) !important; }
        .card-dash { background-color: rgb(27, 119, 184) !important; }
        .card-btg { background-color: rgb(235, 168, 8) !important; }
        .card-vox { background-color: rgb(102, 102, 102) !important; }
    </style>
</head>
