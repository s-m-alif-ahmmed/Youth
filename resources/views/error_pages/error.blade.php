<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Youth | 404 Error</title>

    {{--Favicon--}}
    @foreach($logo_addresses as $logo)
        <link rel="icon" type="image/x-icon" href="{{asset($logo->favicon)}}">
    @endforeach

</head>
<body>

<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <div class="content-box-404">
                        <p class="text-404">404</p>
                        <p class="text-p">
                            Look like you're lost
                        </p>

                        <p class="text-p-two">the page you are looking for not avaible!</p>

                        <a href="{{ route('home') }}" class="link_404">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /*======================
404 page
=======================*/


    .page_404{
        padding: 10% 0;
        background:#fff;
        font-family: 'Arvo', serif;
        text-align: center;
    }
    .text-404{
        font-size:80px;
    }

    .text-p{
        font-size:70px;
    }

    .text-p-two{
        font-size: 30px;
    }

    .link_404{
        color: #fff!important;
        padding: 10px 20px;
        background: #e10000;
        margin: 20px 0;
        display: inline-block;
        text-decoration: none;
        border-radius: 10px;
    }

    .content-box-404{
        margin-top:-50px;
    }
</style>

</body>
</html>





