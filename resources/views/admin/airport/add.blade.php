@extends('layout/app')

@section('title')
    Добавление аэропорта
@endsection

@section('content')
    <div class="container" id="addAirport">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Добавление аэропорта</h2>
    
                        <form id="form_add_airport" @submit.prevent="addAirport">
                            <div class="mb-3">
                                <label for="title" class="form-label">Название аэропорта</label>
                                <input type="text" class="form-control" id="title" name="title" :class="errors.title ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.title">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Город</label>
                                <select name="city" id="city" :class="errors.city ? 'is-invalid':''" class="form-control">
                                    <option class="form-control" :value="city.id" v-for="city in cities">@{{ city.name }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.city">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Адрес</label>
                                <input type="text" class="form-control" id="address" name="address" :class="errors.address ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.address">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn big-button">ДОБАВИТЬ</button>
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
                    cities: [],
                }
            },
            methods: {
                async getData() {
                    const response = await fetch('{{ route('getCities') }}');
                    this.cities = await response.json();
                },
                async addAirport() {
                    let form = document.getElementById('form_add_airport');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('addAirport') }}', {
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
            }, 
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#addAirport');
    </script>
@endsection