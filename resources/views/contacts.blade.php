@extends('layout/app')

@section('title')
    Контакты
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
        <h2 class="title mt-5" style="color: black;">Контакты </h2>
        <div class="d-flex gap-5 my-5">
            <div class="col-5 p-5 shadow d-flex flex-column justify-content-center">
                <p style="font-weight: 600;">Если возникли вопросы, напишите или позвоните нам!</p>
                <p><i class="bi bi-envelope"></i> <span>Email: </span>offical_airlines@gmail.com</p>
                <p><i class="bi bi-telephone"></i> <span>Телефон: </span>+7950245024</p>
            </div>
            <div class="col-6">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad2680e57c888ad5ccd97e30d742fea3705c934761d34d3debf1d7400fbd308e2&amp;width=600&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </div>
@endsection