<html>
<head>
    <style>
        a{
          color: #1EAEDB;  
        }
        .token{
            background-color: #1b6d85;
            color: #e6ffff;
            padding: 15px 15px !important;
            text-align: center;
        }
        .signature{
            font-size: small;
        }
    </style>
</head>
<body style="background: rgba(112,215,239,0.14); color: #04062f; text-align: center">
<p>{{(__('registration.mailtitle'))}}</p>
<p>{{(__('registration.mailaccountinformation'))}}</p>
<p class="token">{{(__('account.mail'))." : ".$email."     ".(__('account.password'))." : ".$password}}</p>
<p>{{(__('registration.mailcontent'))}}</p>
<br>
<p class="signature">{{(__('registration.mailsignature'))}}</p>
</body>
</html>