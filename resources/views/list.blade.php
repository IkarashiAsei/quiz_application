<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/overview.css') }}">
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
      @if (isset($message))
          <p class="message">{{ $message }}<p>
        @endif
        <ul>
          @foreach($problems as $problem)
            <li>
              <a href="{{ route('problem.edit', ['id' => $problem->id]) }}">
                {{ $problem->name }}
              </a>
              <form method="post" action="{{ route('problem.destory', ['id' => $problem->id]) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary" type="submit">削除する</button>
              </form>
            </li>
          @endforeach
        </ul>
    </div>
@endsection          