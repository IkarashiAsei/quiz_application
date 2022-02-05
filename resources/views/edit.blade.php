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
        @if(isset($problem->name))
        <form method="post" action="{{ route('problem.update') }}">
          @method('PUT')
          <input type="hidden" name="problem_id" value="{{ $problem->id }}" />
          <input type="hidden" name="choice_id" value="{{ $problem->choice_id }}" />
        @else
        <form method="post" action="{{ route('problem.register') }}">
          @endif
            @csrf
            <dl>
              <dt>問題</dt>
              <dd>
                <input type="text" name="name"
                  @if(isset($problem->name))
                  value="{{ $problem->name }}"
                  @else
                  value=""
                  @endif />
              </dd>
              <dt>選択肢1</dt>
              <dd>
                <input type="text" name="choice_1"
                @if(isset($problem->choice_1))
                  value="{{ $problem->choice_1 }}"
                @else
                  value=""
                @endif />
              </dd>
              <dt>選択肢2</dt>
              <dd>
                <input type="text" name="choice_2"
                @if(isset($problem->choice_2))
                  value="{{ $problem->choice_2 }}"
                @else
                  value=""
                @endif />
              </dd>
              <dt>選択肢3</dt>
              <dd>
                <input type="text" name="choice_3"
                @if(isset($problem->choice_3))
                  value="{{ $problem->choice_3 }}"
                @else
                  value=""
                @endif />
              </dd>
              <dt>選択肢4</dt>
              <dd>
                <input type="text" name="choice_4"
                @if(isset($problem->choice_4))
                  value="{{ $problem->choice_4 }}"
                @else
                  value=""
                @endif />
              </dd>
              <dt>答え</dt>
              <dd>
                <input type="number" name="answer"
                @if(isset($problem->answer))
                  value="{{ $problem->answer }}"
                @else
                  value=""
                @endif />
              </dd>
            </dl>
            <button class="btn btn-primary" type="submit">登録</button>
      </form>
    </div>     
@endsection          