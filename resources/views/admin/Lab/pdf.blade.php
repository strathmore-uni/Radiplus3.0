<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab Test Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .centered-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .centered-table th,
        .centered-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .centered-table th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            margin-top: 30px;
        }

        .radiology-image {
            margin-top: 20px;
            text-align: center;
        }

        .radiology-image img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h1>Lab Test Details</h1>

<table class="centered-table">
    <tr>
        <th>Name</th>
        <td>{{$data->name}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{$data->email}}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{$data->phone}}</td>
    </tr>
    <tr>
        <th>Test Name</th>
        <td>{{$data->test_name}}</td>
    </tr>
    <tr>
        <th>Test Price</th>
        <td>{{$data->price}}</td>
    </tr>
    <tr>
        <th>Payment Status</th>
        <td>{{$data->payment_status}}</td>
    </tr>
    <tr>
        <th>Radiology Image</th>
        <td class="radiology-image">
            @if($data->radiology_image)
                <img src="{{ asset('storage/'.$data->radiology_image) }}" alt="Radiology Image">
            @else
                <p>No Image</p>
            @endif
        </td>
    </tr>
</table>

<footer>Prepared by Radiplus</footer>

</body>
</html>

