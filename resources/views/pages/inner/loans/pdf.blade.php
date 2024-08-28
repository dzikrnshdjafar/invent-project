<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Peminjaman</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>User</th>
                <th>Loan Date</th>
                <th>Return Date</th>
                <th>Duration (days)</th>
                <th>Quantities</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->item->name }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->created_at }}</td>
                    <td>{{ $loan->return_date ?? 'Not returned yet' }}</td>
                    <td>{{ $loan->loan_duration }}</td>
                    <td>{{ $loan->quantity }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
