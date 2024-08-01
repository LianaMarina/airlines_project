@extends('layout/app')

@section('title')
    Мои билеты
@endsection

@section('content')
    <style>
        p {
            color: white;
        }

        .flight-number {
            font-weight: 500;
            font-size: 18px;
        }

        .city_to_from span {
            font-weight: 500;
            font-size: 14px;
            color: white;
        }

        .city_to_from p {
            font-weight: 700;
            font-size: 24px;
            max-width: 120px;
            line-height: 30px;
        }

        .first_part_flight::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            display: inline-block;
            height: 100%;
            width: 2px;
            background-color: #2825d484;
        }
    </style>
    <div class="container" id="allTickets">
        <h2 class="title mt-5" style="color: black;">Все билеты </h2>

        <div class="my-5 col-6">
            <h5>Фильтрация</h5>
            <form id="filter_tiket" class="d-flex gap-2 align-items-end" @submit.prevent="filterStatusTicket">
                <div>
                    <label for="filter" class="my-2">Фильтровать по статусу:</label>
                    <select name="filter" id="filter" class="form-control">
                        <option value="active">Активные</option>
                        <option value="notActive">Использованные</option>
                        <option value="canceled">Отмененные</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="background-color: #2825d484; color:white;">Применить</button>
            </form>
        </div>

        <div>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ФИО заказчика</th>
                    <th scope="col">Статус рейса</th>
                    <th scope="col">Статус билета</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="ticket in tickets">
                    <td>@{{ ticket.user.fio }}</td>
                    <td>@{{ ticket.flight.status }}</td>
                    <td>@{{ ticket.status }}</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    tickets: [],
                    flights: [],
                    cities: [],
                }
            },
            methods: {
                async getData() {
                    const responseTickets = await fetch('{{ route('getAllTickets') }}');
                    this.tickets = await responseTickets.json();

                    const responseFlights = await fetch('{{ route('getFlights') }}');
                    this.flights = await responseFlights.json();
                    this.flights.forEach(flight => {
                        let date1 = new Date(flight.arrival_time);
                        let date2 = new Date(flight.departure_time);
                        let hours = Math.floor((Math.abs(date2 - date1))/(1000*60*60));
                        let minutes = Math.floor((Math.abs(date2 - date1))%(1000 * 60 * 60)/(1000 * 60));
                        flight['time'] = hours + 'ч ' + minutes + 'мин';
                        console.log(flight);
                    });

                    const responseCities = await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();
                },
                async filterStatusTicket() {
                    let form = document.getElementById('filter_tiket');
                    let form_data = new FormData(form);
                    const responseFilter = await fetch('{{ route('admin_filter_tickets') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        body: form_data,
                    });
                    if (responseFilter.status == 200) {
                        this.tickets = await responseFilter.json();
                    }
                }
            },
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#allTickets');
    </script>
@endsection
