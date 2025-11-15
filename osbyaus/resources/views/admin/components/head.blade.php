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
            height: 80px !important;
        }
        .wg-table.table-product-list .wg-product .title .body-text {
            font-size: 14px !important;
        }
        /* Input focus custom border color */
/* Form control focus — only border color, transparent background */
/* Admin panel input focus — only border color, transparent background */
.admin-form .form-control:focus,
.form-control:focus {
    border: 0.5px solid #94010E !important; /* thin dark red border */
    background-color: transparent !important;
    box-shadow: 0 0 0 1px rgba(148, 1, 14, 0.6) !important; /* darker red shadow */
    outline: none !important;
}
   .admin-table {
            width: 100%;
            font-size: 16px; /* increase font size */
            border: none;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            border: none; /* remove borders */
            text-align: left;
        }

        .admin-table thead {
            font-size: 18px; /* slightly larger header font */
        }
        
        .block-stock {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 14px;
        }
        
        .admin-table {
            width: 100%;
            font-size: 16px;
            border: none;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            border: none;
            text-align: left;
        }

        .admin-table thead {
            font-size: 18px;
        }
        
        .block-stock {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 14px;
        }
        
        /* Additional styles for responsiveness */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .admin-table {
            min-width: 800px;
        }
        
        /* Mobile-specific adjustments */
        @media (max-width: 768px) {
            .admin-table th,
            .admin-table td {
                padding: 10px 8px;
                font-size: 14px;
            }
            
            .admin-table thead {
                font-size: 16px;
            }
            
            .block-stock {
                font-size: 12px;
                padding: 4px 8px;
            }
        }
        
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 20px 0;
        }
        
        /* Utility classes */
        .flex {
            display: flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .flex-wrap {
            flex-wrap: wrap;
        }
        
        .gap10 {
            gap: 10px;
        }
        
        .gap20 {
            gap: 20px;
        }
        
        .mb-30 {
            margin-bottom: 30px;
        }
        
        .mt-5 {
            margin-top: 5px;
        }
        
        .text-tiny {
            font-size: 14px;
            color: #666;
        }
        
        .bg-1 {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        
        .fw-7 {
            font-weight: 700;
        }
        
        .wg-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        h3 {
            margin: 0;
            font-size: 24px;
        }


        .category-table {
            width: 100%;
            font-size: 16px;
            border: none;
        }

        .category-table th,
        .category-table td {
            padding: 9px 12px;
            border: none;
            text-align: left;
        }

        .category-table thead {
            font-size: 18px;
        }
        
        .block-stock {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 14px;
        }
        
        /* Additional styles for responsiveness */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .category-table {
            min-width: 800px;
        }
        
        /* Mobile-specific adjustments */
        @media (max-width: 768px) {
            .category-table th,
            .category-table td {
                padding: 10px 8px;
                font-size: 14px;
            }
            
            .category-table thead {
                font-size: 16px;
            }
            
            .block-stock {
                font-size: 12px;
                padding: 4px 8px;
            }
        }
        
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 20px 0;
        }
        
        /* Utility classes */
        .flex {
            display: flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .flex-wrap {
            flex-wrap: wrap;
        }
        
        .gap10 {
            gap: 10px;
        }
        
        .gap20 {
            gap: 20px;
        }
        
        .mb-30 {
            margin-bottom: 30px;
        }
        
        .mt-5 {
            margin-top: 5px;
        }
        
        .text-tiny {
            font-size: 14px;
            color: #666;
        }
        
        .bg-1 {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        
        .bg-2 {
            background-color: #ffebee;
            color: #c62828;
        }
        
        .fw-7 {
            font-weight: 700;
        }
        
        .wg-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        h3 {
            margin: 0;
            font-size: 24px;
        }
        
        /* Category specific styles */
        .category-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }
        
        .category-info {
            display: flex;
            align-items: center;
        }
        
        .category-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .category-description {
            color: #666;
            font-size: 14px;
        }
        
        .item-actions {
            display: flex;
            gap: 10px;
        }
        
        .item-actions a {
            color: #666;
            text-decoration: none;
            border-radius: 4px;
            transition: color 0.3s;
        }
        
        .item-actions a:hover {
            color: #007bff;
            background-color: #f8f9fa;
        }
        
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .text-center {
            text-align: center;
        }
        
        .py-5 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        
        .text-muted {
            color: #6c757d;
        }
        
        .body-text {
            font-size: 14px;
            line-height: 1.5;
        }
        
        .fw-bold {
            font-weight: bold;
        }
        
        .mb-14 {
            margin-bottom: 14px;
        }
        
        .mb-0 {
            margin-bottom: 0;
        }
        
        .mt-1 {
            margin-top: 0.25rem;
        }
        
        .text-main-dark {
            color: #333;
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
