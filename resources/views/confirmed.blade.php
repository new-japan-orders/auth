@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ご本人確認完了</div>
                <div class="card-body">
                    <p>ご登録いただいたメールアドレス<span>{{$user->email}}</span>のご本人確認ができました。</p>
                    <p>ログインしてから{{env('APP_NAME')}}をご利用ください。</p>
                    <p><a href="/login">ログイン画面へ</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection