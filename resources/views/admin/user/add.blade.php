@extends('layout/app')

@section('title')
    Добавление пользователя
@endsection

@section('content')
    <div class="container" id="addUser">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Добавление пользователя</h2>
    
                        <form id="form_add_user" @submit.prevent="addUser">
                            <div class="mb-3">
                                <label for="fio" class="form-label">ФИО</label>
                                <input type="text" class="form-control" id="fio" name="fio" :class="errors.fio ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.fio">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="d-flex col-12 justify-content-between">
                                <div class="mb-3 col-5">
                                    <label for="birthday_date" class="form-label">День рождения</label>
                                    <input type="date" class="form-control" id="birthday_date" name="birthday_date" :class="errors.birthday_date ? 'is-invalid':''">
                                    <div class="invalid-feedback" v-for="error in errors.birthday_date">
                                        @{{error}}
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="phone" class="form-label">Телефон</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" :class="errors.phone ? 'is-invalid':''">
                                    <div class="invalid-feedback" v-for="error in errors.phone">
                                        @{{ error }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Почта</label>
                                <input type="email" class="form-control" id="email" name="email" :class="errors.email ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.email">
                                    @{{error}}
                                </div>
                            </div>
                            <div class="d-flex col-12 justify-content-between">
                                <div class="mb-3 col-5">
                                    <label for="password" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password" :class="errors.password ? 'is-invalid':''">
                                    <div class="invalid-feedback" v-for="error in errors.password">
                                        @{{ error }}
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="password_confirmation" class="form-label">Повторить пароль еще раз</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" :class="errors.password ? 'is-invalid':''">
                                    <div class="invalid-feedback" v-for="error in errors.password">
                                        @{{ error }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rule" name="rule" :class="errors.rule ? 'is-invalid':''">
                                <label class="form-check-label" for="rule">Согласие с правилами регистрации пользователя</label>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn big-button">ОТПРАВИТЬ</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    message: '',
                    errors: [],
                }
            },
            methods: {
                async addUser() {
                    let form = document.getElementById('form_add_user');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('registration') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if (response.status == 200) {
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        form.reset();
                    }
                }
            }
        }
        Vue.createApp(app).mount('#addUser');
    </script>
@endsection