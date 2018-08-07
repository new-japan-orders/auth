@extends('app_front.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレス確認完了</div>
                <div class="card-body">
                    <p>メールアドレス<span>{{$user->email}}</span>の確認が完了しました。</p>
                    <p><a href='/'>トップへ戻る</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection