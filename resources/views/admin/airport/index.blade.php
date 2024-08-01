@extends('layout/app')

@section('title')
        Все аэропорты
@endsection

@section('content')
    <div class="container" id="allAirports">
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Аэропорты</h2>
            <a href="{{ route('show_add_airport_page') }}" class="btn button" style="background-color: #5B4A66;">Добавить аэропорт <i class="bi bi-airplane"></i></a>
        </div>
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Город</th>
                <th scope="col">Адрес</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="airport in airports">
                <th scope="row">@{{ airport.id }}</th>
                <td>@{{ airport.title }}</td>
                <td>@{{ airport.city.name }}</td>
                <td>@{{ airport.address }}</td>
                <td>
                    <a :href="`{{ route('show_edit_airport_page') }}/${airport.id}`" class="btn btn-edit mx-2">Редактировать</a>
                    <a :href="`{{ route('delete_airport') }}/${airport.id}`" class="btn btn-delete">Удалить</a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    airports: [],
                    message: '',
                    errors: [],
                }
            },
            methods: {
                async getAirports() {
                    const response = await fetch('{{ route('getAirports') }}');
                    this.airports = await response.json();
                }
            },
            mounted() {
                this.getAirports();
            }
        }
        Vue.createApp(app).mount('#allAirports');
    </script>
@endsection