@extends('layout/app')

@section('title')
        Все самолеты
@endsection

@section('content')
    <div class="container" id="allAirplanes">
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Самолёты</h2>
            <a href="{{ route('show_add_airplane_page') }}" class="btn button" style="background-color: #5B4A66;">Добавить самолет <i class="bi bi-airplane"></i></a>
        </div>
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="airplane in airplanes">
                <th scope="row">@{{ airplane.id }}</th>
                <td>@{{ airplane.number }}</td>
                <td>
                    <a :href="`{{ route('show_edit_airplane_page') }}/${airplane.id}`" class="btn btn-edit mx-2">Редактировать</a>
                    <a :href="`{{ route('delete_airlane') }}/${airplane.id}`" class="btn btn-delete mx-2">Удалить</a>
                    <a :href="`{{ route('show_all_airplane_seats') }}/${airplane.id}`" class="btn" style="background-color: #BC93AB">Места <i class="bi bi-arrow-right"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    airplanes: [],
                    message: '',
                    errors: [],
                }
            },
            methods: {
                async getAirplanes() {
                    const response = await fetch('{{ route('getAirplanes') }}');
                    this.airplanes = await response.json();
                }
            },
            mounted() {
                this.getAirplanes();
            }
        }
        Vue.createApp(app).mount('#allAirplanes');
    </script>
@endsection