<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            margin: 0px;
            font-family:  'Calibri';
        }

        body{
            width: 21.59cm;
            height: 27.94cm;
        }

        header{
            width: 100%;
            height: 128px;
            background-color: rgb(39 39 42);
            display: flex;
            justify-content: center;
            position: relative;
        }

        header>img{
            position: absolute;
            width: 120px;
            height: 120px;
            left: 1rem/* 16px */;
            top: 4px/* 16px */;
        }

        header>h1{
            position: absolute;
            text-align: center;
            font-size: 0.875rem/* 14px */;
            color: rgb(228 228 231);
            right: 1rem/* 16px */;
            top: 1rem/* 16px */;
            width: 10rem/* 160px */;
        }

        .header{
            margin: .80cm;
            width: 20cm;
            text-align: center;
            font-size: 3.75rem/* 60px */;
            line-height: 1;
            color: rgb(24 24 27);
            font-family: 'Arial';
            text-transform: capitalize;
        }

        p{
            margin: .80cm;
            width: 20cm;
            text-align: left;
            color: rgb(39 39 42);
            border: 2px rgb(39,39,42);
            border-radius: 0.25rem/* 4px */;
            word-break: break-all;
        }

        footer{
            position: absolute;
            width: 100%;
            height: 6rem/* 96px */;
            bottom: 0px;
            background-color: rgb(39 39 42);
        }

        footer>h1{
            text-align: center;
            color: rgb(228 228 231);
            padding: 2.25rem/* 36px */;
            font-size: 16px/* 60px */;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <header>     
        <img src="img/logo-0.svg">
        <h1>Pdf generado solo para pruebas</h1>
    </header>
    <h1 class="header">{{$title}}</h1>
    <p>{{$p}}</p>
    <footer>
        <h1>© Empresa de Transporte Artemisa todos los derechos reservados</h1>
    </footer>
</body>
</html>