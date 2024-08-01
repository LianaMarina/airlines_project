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
    <div class="container" id="myTickets">
        <h2 class="title mt-5" style="color: black;">Мои билеты </h2>
        <div class="d-flex justify-content-between col-12">
             <div class="my-5 col-6">
            <h5>Фильтрация</h5>
            <form id="filter_tiket" class="d-flex gap-2 align-items-end" @submit.prevent="filterStatusTicket">
                <div>
                    <label for="filter" class="my-2">Фильтровать по статусу:</label>
                    <select name="filter" id="filter" class="form-control">
                        <option value="active">Активные</option>
                        <option value="notActive">Использованные</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="background-color: #2825d484; color:white;">Применить</button>
            </form>
        </div>

        <div class="my-5 col-6">
            <h5>Сортировка</h5>
            <form id="sort_ticket" class="d-flex gap-2 align-items-end" @submit.prevent="SortTickets">
                <div>
                    <label for="sort" class="my-2">Фильтровать по времени прилета/отлета:</label>
                    <select name="sort" id="sort" class="form-control">
                        <option value="departure_time">По времени прилёта</option>
                        <option value="arrival_time">По времени отлета</option>
                    </select>
                </div>
                <button type="submit" class="btn" style="background-color: #2825d484; color:white;">Применить</button>
            </form>
        </div>
        </div>
        <div class="flight mb-4 simple-linear col-12 d-flex gap-5 shadow" v-for="ticket in tickets">
            <div class="col-6 p-4 first_part_flight" style="position: relative;">
                <div v-for="flight in flights">
                    <p style="background-color: #2825d484; position: absolute; width: 100%; top: 0; left:0; border-top-left-radius: 10px; padding: 20px 30px 0px 30px;" class="flight-number" v-if="flight.id == ticket.flight_id">@{{ flight.number }}</p>
                    <p style="position: absolute; top: 0; right:0; padding: 20px 30px 0px 30px;" class="flight-number" v-if="flight.id == ticket.flight_id">Место: @{{ (flight.airplane.seats.filter((seat)=>seat.id == ticket.seat_id))[0].number}}</p>
                    
                </div>
                <div class="d-flex justify-content-between py-5">
                    <div class="city_to_from">
                        <span>из</span>
                        <div v-for="flight in flights">
                            <div v-for="city in cities" v-if="flight.id == ticket.flight_id">
                                <div v-if="city.id == flight.city_from_id">
                                    <p>@{{ city.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-11"style="position: absolute; top: 30%; left: 10px;">
                        <img src="{{ asset('public\img\flight_img.png') }}" alt="img-flight-card" style="width: 100%;">
                    </div>
                    <div class="city_to_from">
                        <span>до</span>
                        <div v-for="flight in flights">
                            <div v-for="city in cities" v-if="flight.id == ticket.flight_id">
                                <div v-if="city.id == flight.city_to_id">
                                    <p>@{{ city.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between col-12">
                    <div class="" v-for="flight in flights">
                        <p style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;"
                            v-if="flight.id == ticket.flight_id">
                            @{{ (flight.departure_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                        <p style="font-weight: 500; font-size: 14px; color: #816EF8;" v-if="flight.id == ticket.flight_id">
                            @{{ (flight.departure_time.split(' ')[1]).split(':', 2).join(':') }}</p>
                    </div>
                    <div class="" v-for="flight in flights">
                        <p style="margin-bottom: 0;" v-if="flight.id == ticket.flight_id">время полёта</p>
                        <p style="font-weight: 700; font-size: 24px; text-align: center;"
                            v-if="flight.id == ticket.flight_id">@{{ flight.time }}</p>
                    </div>
                    <div class="" v-for="flight in flights">
                        <p v-if="flight.id == ticket.flight_id"
                            style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;">
                            @{{ (flight.arrival_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                        <p v-if="flight.id == ticket.flight_id" style="font-weight: 500; font-size: 14px; color: #816EF8;">
                            @{{ (flight.arrival_time.split(' ')[1]).split(':', 2).join(':') }}</p>
                    </div>
                </div>

            </div>
            <div class="col-5 pt-5">
                <div class="d-flex justify-content-between">
                    <p style="font-size: 18px">ФИО: </p>
                    <p style="font-size: 18px" class="px-5">@{{ ticket.fio }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p style="font-size: 18px; line-height: 25px;">Дата рождения </p>
                    <p style="font-size: 18px; line-height: 25px;" class="px-5">@{{ ticket.birthday }}</p>
                </div>
                <div class="d-flex justify-content-between" v-if="ticket.passport_seria_number">
                    <p style="font-size: 18px; line-height: 25px;">Серия и номер паспорта: </p>
                    <p style="font-size: 18px; line-height: 25px;" class="px-5">@{{ ticket.passport_seria_number }}</p>
                </div>
                <div class="d-flex justify-content-between" v-if="ticket.birth_certificate_num">
                    <p style="font-size: 18px; line-height: 25px;">Свидетельство о рождении: </p>
                    <p style="font-size: 18px; line-height: 25px;" class="px-5">@{{ ticket.birth_certificate_num }}</p>
                </div>
                <div class="d-flex justify-content-between" v-if="ticket.birth_certificate_num">
                    <p style="font-size: 18px; line-height: 25px;">Ваше место: </p>
                </div>

                <div class="d-flex justify-content-between">
                    <p style="font-size: 20px; line-height: 25px; font-weight: 700; color: #998EE7">Стоимость </p>
                    <p style="font-size: 25px; line-height: 25px; font-weight: 700; color: #998EE7;" class="px-5">
                        @{{ ticket.price }} Р</p>
                </div>
                    <a :href="`{{ route('cancelTicket') }}/${ticket.id}`" v-if="ticket.status == 'бронь'" class="btn my-3"
                    style="background-color: #816EF8">Отказаться <i class="bi bi-x-square"></i></a>
            </div>
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
                    cities_from: [],
                    cities_to: [],
                    cities: [],
                }
            },
            methods: {
                async getData() {
                    const responseTickets = await fetch('{{ route('getTickets') }}');
                    this.tickets = await responseTickets.json();

                    const responseFlights = await fetch('{{ route('getFlights') }}');
                    this.flights = await responseFlights.json();
                    this.flights.forEach(flight => {
                        let date1 = new Date(flight.arrival_time);
                        let date2 = new Date(flight.departure_time);
                        let hours = Math.floor((Math.abs(date2 - date1)) / (1000 * 60 * 60));
                        let minutes = Math.floor((Math.abs(date2 - date1)) % (1000 * 60 * 60) / (1000 *
                            60));
                        flight['time'] = hours + 'ч ' + minutes + 'мин';
                        console.log(flight);
                    });

                    const responseCities = await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();
                },
                async filterStatusTicket() {
                    let form = document.getElementById('filter_tiket');
                    let form_data = new FormData(form);
                    const responseFilter = await fetch('{{ route('filter_status_tickets') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (responseFilter.status == 200) {
                        this.tickets = await responseFilter.json();
                    }
                },
                async SortTickets() {
                    let form = document.getElementById('sort_ticket');
                    let form_data = new FormData(form);
                    const responseSort = await fetch('{{ route('sort_my_tickets') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}',
                        },
                        body: form_data,
                    });
                    if (responseSort.status == 200) {
                        this.tickets = await responseSort.json();
                    }
                }
            },
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#myTickets');
    </script>
@endsection
