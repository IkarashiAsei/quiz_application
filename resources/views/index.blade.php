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
    <div class="container">
      <div class="bg"></div>
      <div class="bg bg2"></div>
      <div class="bg bg3"></div>
      
   
  </body>
</html> -->

@extends('base')
@section('content')
<div class="content">
        <!-- アンサーがセットされているか。（問題を回答した時） -->
        @if(isset($answer))
        <!-- <input type="hidden" id="problem_id" name="id" value="{{ $problem->id }}"> -->
        <input type="hidden" id="answer" name="answer" value="{{ $answer }}">
        <input type="hidden" id="route" name="route" value="{{ route('problem.index', ['id' => $next_id]) }}">
        @endif
        <div class="jumbotron mt-5">
          <div class="d-flex justify-content-center">
            <div id="js-question" class="alert alert-primary" role="alert">
              {{ $problem->name  }}
            </div>
          </div>
        </div>
        <div id="js-items" class="d-flex justify-content-center">
          <div class="m-2">
            <a href="{{ url('/problem/answer', ['id' => $problem->id, 'number' => 1]  ) }}" id="js-btn-1" class="btn btn-primary">{{ $choice->choice_1 }}</a>
          </div>
          <div class="m-2">
            <a href="{{ url('/problem/answer', ['id' => $problem->id, 'number' => 2]  ) }}" id="js-btn-2" class="btn btn-primary">{{ $choice->choice_2 }}</a>
          </div>
          <div class="m-2">
            <a href="{{ url('/problem/answer', ['id' => $problem->id, 'number' => 3]  ) }}" id="js-btn-3" class="btn btn-primary">{{ $choice->choice_3  }}</a>
          </div>
          <div class="m-2">
            <a href="{{ url('/problem/answer', ['id' => $problem->id, 'number' => 4]  ) }}" id="js-btn-4" class="btn btn-primary">{{ $choice->choice_4  }}</a>
          </div>
        </div>
      </div>
   </div>
   <script src="{{ asset('js/problem.js') }}"></script>
@endsection          