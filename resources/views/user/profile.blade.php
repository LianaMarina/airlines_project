@extends('layout/app')

@section('title')
    Профиль
@endsection

@section('content')
<style>
    span {
        font-weight: 700;
        font-size: 18px;
        color: #8675FF;
    }
    p {
        font-size: 18px;
    }
</style>
    <div class="container">
        <h2 style="color: black;" class="my-5">Мой профиль</h2>
        <div class="shadow p-5">
            <div class="d-flex gap-3 align-items-center">
                <div class="col-5">
                    <img src="{{ asset('public\img\user_photo.png') }}" alt="" width="250px;">
                </div>
                <div class="col-6">
                    <p><span>ФИО: </span>{{ $user->fio }}</p>
                    <p><span>Дата рождения: </span>{{ $user->birthday_date }}</p>
                    <p><span>Почта: </span>{{ $user->email }}</p>
                    <p><span>Телефон: </span>{{ $user->phone }}</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('show_edit_user_profile')}}" class="btn" style="background-color: #4b3658;">Редактировать данные</a>
                        <a href="{{ route('delete_user_me', ['id'=>$user->id]) }}" class="btn btn-delete">Удалить профиль</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
