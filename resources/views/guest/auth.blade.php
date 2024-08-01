@extends('layout/app')

<style>
    .auth_airplane {
        position: absolute;
        left: -100px;
        top: 25px;
    }
</style>

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="container my-5" id="auth">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-12 d-flex shadow p-0" style="position: relative;">
                <div class="col-6">
                    <img src="{{ asset('public\img\auth_airplane.png') }}" alt="" style="height: 100%;" class="auth_airplane">
                </div>
                <div class="col-6 p-5">
                    <h2 class="pb-3">Вход</h2>

                    <form id="form_auth" @submit.prevent="Auth">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="phone" class="form-control" id="phone" name="phone" :class="errors.phone ? 'is-invalid':''">
                            <div class="invalid-feedback" v-for="error in errors.phone">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" :class="errors.password ? 'is-invalid':''">
                            <div class="invalid-feedback" v-for="error in errors.password">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button type="submit" class="btn big-button">ВХОД</button>
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
                async Auth() {
                    let form = document.getElementById('form_auth');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('auth') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if(response.status == 400) {
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
                        window.location = '{{ route('show_user_profile') }}';
                    }
                }
            },
            mounted() {
                console.log(1);
            }
        }

        Vue.createApp(app).mount("#auth");
    </script>
@endsection
