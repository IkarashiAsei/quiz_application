<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>クイズアプリ</title>
  </head>
  <body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    
  </body>
</html> -->

@extends('base')
@section('content')
<div class="content">
      <h1> あなたの正解数は {{ $count  }} です。</h1>
      <a href="{{ url('/') }}"> 
         <p>ホーム画面に戻る</p>
      </a>
    </div>
@endsection          