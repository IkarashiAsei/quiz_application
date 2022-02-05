@extends('base')
@section('content')
<div class="content">
            <a href="{{ route('problem.index', ['id' => $min_id]) }}">
            <h1>クイズスタート</h1>
            </a>
            <a href="{{ route('problem.list') }}"> 
            <p>一覧画面</p>
            </a>
            <a href="{{ route('problem.create') }}"> 
            <p>登録画面</p>
            </a> 
          </div>
@endsection          