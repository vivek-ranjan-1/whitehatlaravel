<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Banner Email' }}</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center;">

    <!-- Add the banner image -->
    <div>
        <img src="{{ $bannerImageUrl }}" alt="Banner" style="width: 100%; max-width: 600px;max-height:400px">
		{{ $message }}
    </div>

    <!-- Optional: A call to action or footer -->
    <div style="margin-top: 20px;">
        <a href="{{ url('/') }}" style="font-size: 16px; color: #3490dc; text-decoration: none;">Visit Our Website</a>
    </div>

</body>
</html>
