<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {

            margin: 10% 0 !important;
            padding: 0 !important;
            background: #f3f3f3;
            width: 100%;
        }

        .card-body {
            width: 80%;
            margin: auto;
            padding: 5%;
            background-color: #fff;
            box-shadow: 2px 2px 2px #e3e3e3;
        }

        .name{
            color:#1e5577;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <img src="{{url('/assets/images/email.jpg')}}" alt=""
                width="100%" height="150px" srcset="">
                @if(@$mailData['reciever'] !== 'admin')
                <p>
                <h3>Hello <span class="name">{{$mailData['name']}}</span></h3>
                Thank you for reaching out to us. Your inquiry has been successfully submitted, and we appreciate your
                interest in our company. Our team is dedicated to providing exceptional customer
                service and will get back to you as soon as possible.
            </p>
            <p>
                Best regards,
                <br>
                White Hat Realty
            </p>
            @else
            <p>
            <h3>Hello Admin</h3>
                There is a query from {{$mailData['name']}} -<br>
                
                From - {{$mailData['email']}} / {{$mailData['mobile']}}<br>
                Message- {{@$mailData['message']}}
            </p>
            <p>
                Best regards,
                <br>
                White Hat Realty
            </p>
            @endif
        </div>

    </div>
</body>

</html>