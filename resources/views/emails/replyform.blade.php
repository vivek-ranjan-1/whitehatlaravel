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
		
		.sentMail{
			color:#FFB6C1
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
                @if(@$mailData['reciever'] === 'admin')
                <p>
                <h3>Hello <span class="name">{{$mailData['name']}}</span></h3>
                Thank you for reaching out to us. Your enquiry has been successfully submitted, and we appreciate your interest in our company. Our team is dedicated to providing exceptional customer service and will get back to you as soon as possible.
            </p>
            <p>
                Best regards,
                <br>
                White Hat Realty
            </p>
            @else
            <p>
			{!!$mailData['message']!!}
            </p>
            
            @endif
        </div>

    </div>
</body>

</html>