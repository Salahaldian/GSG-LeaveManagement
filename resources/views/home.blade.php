<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
@extends('layouts.app') <!-- Extending the main layout template -->

@section('content')
    <h1>Welcome to the Application</h1>

    <form action="{{ route('employee.create') }}" method="post">
        @csrf
        <button type="submit">Send the Request</button>
    </form>

    <a href="">
        <button>Show All Requests</button>
    </a>
@endsection
</body>
</html>
