<!DOCTYPE html> {{-- 11.21 --}}
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
        <body>
            <div class="container bg-light text-center py-4">
                <h1>Welcome to Insta App!</h1>
                <p>Connecting you to the world of photos and stories.</p>
            </div>
            <div class="container bg-white text-center py-4">
                <div class="container">
                    <img src="https://t.ly/Hs9TH" alt="Insta App Image" class="img-fluid" style="object-fit: cover; width: 100%; height:200px">
                </div>
                <div class="py-4">
                    <p class="mb-0">Hello <span class="fw-bold">{{$name}}</span>!</p>
                    <p class="mb-0">Thank you for joining Insta App.</p>
                    <p>To start sharing your moments, please access the app <a href="{{ $app_url }}" class="btn btn-success btn-sm">here</a> .</p>
                    <p>Happy exploring!</p>
                </div>
            </div>
            <div class="container bg-dark text-white text-center py-3">
                <p class="m-0">You received this email as a new user of Insta App.</p>
            </div>
        </body>
 </html>
 {{-- $name and $app_url are coming from the $details. It was defined in the create() of RegisterController --}}