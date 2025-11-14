<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Osbyaus</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/admin-ecomus/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/admin-ecomus/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/admin-ecomus/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/admin-ecomus/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/admin-ecomus/css/styles.css') }}">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        textarea.form-control {
            height: 60px !important;
        }
    </style>

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('admin/admin-ecomus/icon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-sweetalert.css') }}">
    <link href="{{ asset('css/form-errors.css') }}" rel="stylesheet">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('admin/admin-ecomus/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admin/admin-ecomus/images/favicon.png') }}">
</head>
