<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UEC ThangLong University | Thang Long University</title>
    <link href="{{asset('assets/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/common.css")}}" rel="stylesheet" type="text/css">
</head>

<body class="login-container">
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="http://thanglong.edu.vn"><img src="{{asset("assets/images/logo.png")}}" alt=""></a>
        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#">
                    <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
                </a>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog3"></i>
                    <span class="visible-xs-inline-block position-right"> Options</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="page-container">

    <div class="page-content" id="login">

        <div class="content-wrapper">

            @if($errors->any())
                <h6 class="text-danger text-center" id="text-error">{{$errors->first()}}</h6>
            @endif
            <div class="content" >


                <form-login v-if="login == true" @forget_password="forget_password" @set_reg="set_reg"></form-login>
                <form-forgot-password v-if="forgetPassword == true"></form-forgot-password>
                <form-reg @set_login="set_login" v-if="reg == true"></form-reg>

                <div class="footer text-muted">
                    &copy; 2018. <a href="{{route('web.home')}}">UEC TLU</a> by <a href="http://thanglong.edu.vn" target="_blank">ThangLong University</a>
                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript" src="{{asset("assets/js/build/pages/auth/login.js")}}"></script>
<script>
    setTimeout(function(){
        let textError = document.getElementById('text-error');
        if(textError != null)
        {
            textError.remove()
        }
    },5000)
</script>
</body>
</html>
