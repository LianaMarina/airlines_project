@extends('layout/app')

@section('title')
        Все города
@endsection

@section('content')
    <div class="container" id="allCities">
        @if (session()->has('success_add_city'))
            <div class="alert alert-success">
                @{{ session('success_add_city') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Города</h2>
            <a href="{{ route('show_add_city_page') }}" class="btn button" style="background-color: #5B4A66;">Добавить город <i class="bi bi-building"></i></a>
        </div>
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Фото</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="city in cities">
                <th scope="row">@{{ city.id }}</th>
                <td>
                    <img :src="'/public'+city.img" alt="" style="width: 250px;">
                </td>
                <td>@{{ city.name }}</td>
                <td>
                    <a :href="`{{ route('show_edit_city_page') }}/${city.id}`" class="btn btn-edit mx-2">Редактировать</a>
                    <a :href="`{{ route('delete_city') }}/${city.id}`" class="btn btn-delete">Удалить</a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    cities: [],
                    message: '',
                    errors: [],
                }
            },
            methods: {
                async getCities() {
                    const response = await fetch('{{ route('getCities') }}');
                    this.cities = await response.json();
                }
            },
            mounted() {
                this.getCities();
                console.log(this.cities);
            }
        }
        Vue.createApp(app).mount('#allCities');
    </script>
@endsection