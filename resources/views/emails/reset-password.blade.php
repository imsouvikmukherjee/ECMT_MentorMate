<!doctype html>
<html lang="en">
    <head>
        <title>Password Reset</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.3.2 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .email-container {
                width: 80%;
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .logo {
                display: block;
                margin: 0 auto 20px;
                max-width: 100px;
                border-radius: 50%;
            }
            .btn {
                padding: 12px 20px;
                background-color: #008cff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                text-align: center;
                display: inline-block;
            }
            .btn-container {
                margin: 20px 0;
                text-align: center;
            }
            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                margin-top: 20px;
            }
            @media (max-width: 576px) {
                .email-container {
                    padding: 15px;
                    width: 80%;
                }
                .btn {
                    width: 100%;
                    box-sizing: border-box;
                }
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <img src="{{url('https://images.shiksha.com/mediadata/images/1668580355php58bPcn.jpeg')}}" alt="Logo" class="logo">
            <h2 class="text-center">Password Reset Request</h2>
            <p>Hello, {{$name}}</p>
            <p>We have received a request to reset your password. If this was you, please click the button below to reset your password:</p>

            <!-- Reset Button -->
            <div class="btn-container">
                <a href="{{ $resetLink }}" class="btn">Reset Password</a>
            </div>

            <p>If you did not request a password reset, please ignore this email. Your password will not be changed.</p>

            <p class="footer">If you have any questions, feel free to contact us at Eminent College of Management and Technology.</p>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
