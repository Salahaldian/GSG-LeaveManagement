<!DOCTYPE html>
<html>
<head>
    <title>Leave Request Form</title>
</head>
<body>
<h1>Leave Request Form</h1>

<form action="{{ route('employee.store') }}" method="post">
    @csrf
    <label for="reason">Reason:</label><br>
    <textarea id="reason" name="reason" rows="4" cols="50"></textarea><br><br>
    <button type="submit">Send the Request</button>
</form>
</body>
</html>
