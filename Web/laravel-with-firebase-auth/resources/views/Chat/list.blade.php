<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h1>Users List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>UID</th>
                <th>Email</th>
                <th>Display Name</th>
                <th>Phone Number</th>
                <th>Photo URL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['uid'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['display_name'] }}</td>
                    <td>{{ $user['phone_number'] }}</td>
                    <td><img src="{{ $user['photo_url'] }}" alt="Profile Photo" width="50"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
