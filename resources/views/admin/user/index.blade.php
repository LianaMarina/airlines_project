@extends('layout/app')

@section('title')
        Все пользователи
@endsection

@section('content')
    <div class="container" id="allUsers">
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Пользователи</h2>
            <a href="{{ route('show_add_user_page') }}" class="btn button" style="background-color: #5B4A66;">Добавить пользователя <i class="bi bi-person-add"></i></a>
        </div>
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ФИО</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Почта</th>
                <th scope="col">Телефон</th>
                <th scope="col">Роль</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users">
                <th scope="row">@{{ user.id }}</th>
                <td>
                    @{{ user.fio }}
                </td>
                <td>@{{ user.birthday_date }}</td>
                <td>@{{ user.email }}</td>
                <td>@{{ user.phone }}</td>
                <td>@{{ user.role }}</td>
                <td>
                    <a :href="`{{ route('show_edit_user_page') }}/${user.id}`" class="btn btn-edit mx-2">Редактировать</a>
                    <a :href="`{{ route('delete_user') }}/${user.id}`" class="btn btn-delete">Удалить</a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    users: [],
                    message: '',
                    errors: [],
                }
            },
            methods: {
                async getUsers() {
                    const response = await fetch('{{ route('getUsers') }}');
                    this.users = await response.json();
                }
            },
            mounted() {
                this.getUsers();
            }
        }
        Vue.createApp(app).mount('#allUsers');
    </script>
@endsection