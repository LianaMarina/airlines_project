@extends('layout/app')

@section('title')
    Добавление рейса
@endsection

@section('content')
    <div class="container" id="addFlight">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div :class="kind_error ? 'alert alert-danger':''">
                @{{ kind_error }}
            </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Добавление рейса</h2>
    
                        <form id="form_add_flight" @submit.prevent="addFlight">
                            <div class="mb-3">
                                <label for="number" class="form-label">Номер рейса</label>
                                <input type="text" class="form-control" id="number" name="number" :class="errors.number ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.number">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="city_from_id" class="form-label">Город вылета</label>
                                <select name="city_from_id" id="city_from_id" class="form-control" >
                                    <option class="form-control" :value="city.id" v-for="city in cities" :class="errors.city_from_id ? 'is-invalid':''">@{{ city.name }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.city_from_id">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="city_to_id" class="form-label">Город прилета</label>
                                <select name="city_to_id" id="city_to_id" :class="errors.city_to_id ? 'is-invalid':''" class="form-control">
                                    <option class="form-control" v-for="city in cities" :value="city.id">@{{ city.name }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.city_to_id">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="airport_from_id" class="form-label">Аэропорт вылета</label>
                                <select name="airport_from_id" id="airport_from_id" :class="errors.airport_from_id ? 'is-invalid':''" class="form-control">
                                    <option v-for="airport in airports" class="form-control" :value="airport.id">@{{ airport.title }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.airport_from_id">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="airport_to_id" class="form-label">Аэропорт прилёта</label>
                                <select name="airport_to_id" id="airport_to_id" :class="errors.airport_to_id ? 'is-invalid':''" class="form-control">
                                    <option v-for="airport in airports" class="form-control" :value="airport.id">@{{ airport.title }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.airport_to_id">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Цена (за одно место)</label>
                                <input type="text" class="form-control" id="price" name="price" :class="errors.price ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.price">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="procent" class="form-label">Наценка рейса (%)</label>
                                <input type="text" class="form-control" id="procent" name="procent" :class="errors.procent ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.procent">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="airplane" class="form-label">Самолёт</label>
                                <select name="airplane" id="airplane" :class="errors.airplane ? 'is-invalid':''" class="form-control">
                                    <option v-for="airplane in airplanes" class="form-control" :value="airplane.id">@{{ airplane.number }}</option>
                                </select>
                                <div class="invalid-feedback" v-for="error in errors.airplane">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="departure_time" class="form-label">Время отправления</label>
                                <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" :class="errors.departure_time ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.departure_time">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="arrival_time" class="form-label">Время прилёта</label>
                                <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" :class="errors.arrival_time ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.arrival_time">
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
                    kind_error: '',
                    cities: [],
                    airports: [],
                    airplanes: [],
                    city_from_id: '',
                    city_to_id: '',
                }
            },
            methods: {
                async getData() {
                    const responseCities = await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();

                    const responseAirports = await fetch('{{ route('getAirports') }}');
                    this.airports = await responseAirports.json();

                    const responseAirplanes = await fetch('{{ route('getAirplanes') }}');
                    this.airplanes = await responseAirplanes.json();
                },
                async addFlight() {
                    let form = document.getElementById('form_add_flight');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('addFlight') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        this.kind_error = await response.json();
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
                // console.log(1);
            }
        }
        Vue.createApp(app).mount('#addFlight');
    </script>
@endsection