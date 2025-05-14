<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Chameleon</title>
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-assets/datatables/dataTables.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/datatables/responsive.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/output.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .nav-item.active a {
            background-color: #8833FF;
            /* light gray, for example */
            color: #fff;
            /* or any color for active text/icon */
        }

        .holiday {
            /* background-color: #f87171; */
            /* color: white; */
            font-weight: bold;
            border-radius: 0.5rem;
            color: #f87171;
        }
    </style>
</head>
