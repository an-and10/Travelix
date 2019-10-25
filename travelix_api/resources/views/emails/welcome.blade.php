<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$data['name']}}</h2>
<br/>
Your registered email-id is {{$data['email']}}

<h3> Your link to fill the form is <a href="localhost:8000/api/contact/send_mail/1">Click the Link to grap your seats</a>
</body>

</html>