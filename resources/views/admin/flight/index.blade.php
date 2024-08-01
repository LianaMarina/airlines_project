@extends('layout/app')

@section('title')
        Все рейсы
@endsection

@section('content')

    <div class="container" id="allFlights">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Рейсы</h2>
            <a href="{{ route('show_add_flight_page') }}" class="btn button" style="background-color: #5B4A66;">Добавить рейс <i class="bi bi-list-columns-reverse"></i></a>
    </div>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Номер рейса</th>
                <th scope="col">Город отлёта</th>
                <th scope="col">Город прилёта</th>
                <th scope="col">Аэропорт отлёта</th>
                <th scope="col">Аэропорт прилёта</th>
                <th scope="col">Самолёт</th>
                <th scope="col">Цена (место + наценка)</th>
                <th scope="col">Дата отлёта</th>
                <th scope="col">Дата прилёта</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="flight in flights">
                <th scope="row">@{{ flight.id }}</th>
                <td>@{{ flight.number }}</td>
                <td>
                    <div v-for="city in cities">
                        <div v-if="city.id == flight.city_from_id">@{{ city.name }}</div>
                    </div>
                </td>
                <td>
                    <div v-for="city in cities">
                        <div v-if="city.id == flight.city_to_id">@{{ city.name }}</div>
                    </div>
                </td>
                <td>
                    <div v-for="airport in airports" >
                        <div v-if="airport.id == flight.airport_from_id">
                             @{{ airport.title }}
                        </div>
                    </div>
                </td>
                <td>
                    <div v-for="airport in airports" >
                        <div v-if="airport.id == flight.airport_to_id">
                             @{{ airport.title }}
                        </div>
                    </div>
                </td>
                <td>
                    <div v-for="airplane in airplanes">
                        <div v-if="airplane.id == flight.airplane_id">
                            @{{ airplane.number }}
                        </div>
                    </div>
                </td>
                <td>
                    @{{ flight.price }}
                </td>
                <td>
                    @{{ flight.departure_time }}
                </td>
                <td>
                    @{{ flight.arrival_time }}
                </td>
                <td>
                    <div class="d-flex flex-column gap-3">
                        @{{ flight.status }}
                        <button type="button" class="btn btn-edit mx-2" data-bs-toggle="modal" :data-bs-target="'#Modal_'+flight.id">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                    <div class="modal fade" :id="'Modal_'+flight.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Изменение статуса рейса</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="editStatusFlight(flight.id)" :id="'editStatusFlight'+flight.id">
                                    <select name="status" id="status" class="form-control">
                                        <option value="готов">готов</option>
                                        <option value="в полёте">в полёте</option>
                                        <option value="прибыл">прибыл</option>
                                        <option value="отменен">отменен</option>
                                        <option value="ТО">тех.обслуживание</option>
                                    </select>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-dark">Сохранить изменения</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td>
                    <div class="d-flex flex-column gap-3">
                        <a :href="`{{ route('show_edit_flight_page') }}/${flight.id}`" class="btn btn-edit mx-2"><i class="bi bi-pencil-square"></i></a>
                        <a :href="`{{ route('delete_flight') }}/${flight.id}`" class="btn btn-delete"><i class="bi bi-trash"></i></a>
                    </div>
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
                    flights: [],
                    cities: [],
                    airplanes: [],
                }
            },
            methods: {
                async getData() {
                    const responseAirports = await fetch('{{ route('getAirports') }}');
                    this.airports = await responseAirports.json();

                    const responseFligths =await fetch('{{ route('getFlights') }}');
                    this.flights = await responseFligths.json();

                    const responseCities =await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();

                    const responseAirplanes =await fetch('{{ route('getAirplanes') }}');
                    this.airplanes = await responseAirplanes.json();

                
                    this.flights.forEach(flight => {
                        flight.price = (flight.price*(flight.procent/100))+flight.price;
                    });
                },
                async editStatusFlight(id) {
                    let form = document.getElementById('editStatusFlight'+id);
                    // let id = (form.querySelector('select')).id;
                    let form_data = new FormData(form);
                    form_data.append('id', id);
                    const response = await fetch('{{ route('edit_status_flight') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        body: form_data,
                    });
                    if(response.status==400) {
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
                        this.getData();
                    }
                }
            },
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#allFlights');
    </script>
@endsection