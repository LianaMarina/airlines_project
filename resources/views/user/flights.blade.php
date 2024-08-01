@extends('layout/app')

@section('title')
    Рейсы
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
    <div class="container" id="allFlights">
        <div class="row my-5">
            <div class="d-flex justify-content-between">
                <div class="col-3">
                    <h4 style="font-weight: 400;">Фильтры</h4>
                    <form @submit.prevent="filterFlights" id="form_filter_flights">
                        <div class="mb-3">
                            <label for="select_city_form">Откуда</label>
                            <select name="city_from_id" id="select_city_form" class="form-control" v-model="select_city_form">
                                <option v-for="city in cities" :value="city.id">@{{ city.name }}</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="select_city_to">Куда</label>
                            <select name="city_to_id" id="select_city_to" class="form-control" v-model="select_city_to">
                                <option v-for="city in cities" :value="city.id">@{{ city.name }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <p style="color: black;">Цена</p>
                            <div class="d-flex gap-2">
                                <div class="">
                                    <label for="price_from">От</label>
                                    <input type="text" id="price_from" name="price_from" v-model="price_from">
                                </div>
                                <div class="">
                                    <label for="price_to">До</label>
                                    <input type="text" id="price_to" name="price_to" v-model="price_to">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-outline-dark">Применить</button>
                    </form>
                </div>
                <div class="col-8">
                    <h2 class="title" style="color: black;">Рейсы</h2>
                    <p class="my-3">По вашему запросу найдены следующие рейсы: </p>
                    <div class="flights my-3 col-12">
                        <div class="flight mb-4 simple-linear col-12 d-flex gap-5 shadow" v-for="flight in flights">
                            <div class="col-6 p-4 first_part_flight" style="position: relative;">
                                <div
                                    style="background-color: #2825d484; position: absolute; width: 100%; top: 0; left:0; border-top-left-radius: 10px; padding: 20px 30px 0px 30px;">
                                    <p class="flight-number">@{{ flight.number }}</p>
                                </div>
                                <div class="d-flex justify-content-between py-5">
                                    <div class="city_to_from">
                                        <span>из</span>
                                        <div v-for="city in cities">
                                            <div v-if="city.id == flight.city_from_id">
                                                <p>@{{ city.name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=""style="position: absolute; top: 40%; left: 20px;">
                                        <img src="{{ asset('public\img\flight_img.png') }}" alt="img-flight-card"
                                            style="width: 90%;">
                                    </div>
                                    <div class="city_to_from">
                                        <span>до</span>
                                        <div v-for="city in cities">
                                            <div v-if="city.id == flight.city_to_id">
                                                <p>@{{ city.name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-5">
                                    <div class="">
                                        <p style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;">
                                            @{{ (flight.departure_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                                        <p style="font-weight: 500; font-size: 14px; color: #816EF8;">@{{ (flight.departure_time.split(' ')[1]).split(':', 2).join(':') }}
                                        </p>
                                    </div>
                                    <div class="">
                                        <p style="margin-bottom: 0;">время полёта</p>
                                        <p style="font-weight: 700; font-size: 24px; text-align: center;">
                                            @{{ flight.time }}</p>
                                    </div>
                                    <div class="">
                                        <p style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;">
                                            @{{ (flight.arrival_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                                        <p style="font-weight: 500; font-size: 14px; color: #816EF8;">@{{ (flight.arrival_time.split(' ')[1]).split(':', 2).join(':') }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-5 pt-5">
                                <div class="d-flex justify-content-between">
                                    <p style="font-size: 18px">Цена места: </p>
                                    <p style="font-size: 18px" class="px-5">@{{ flight.price }} руб</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p style="font-size: 18px; line-height: 25px;">Количество свободных: </p>
                                    <p style="font-size: 18px; line-height: 25px;" class="px-5">@{{ flight.seats }}
                                        мест</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p style="font-size: 18px; line-height: 25px;">Взимаемый процент: </p>
                                    <p style="font-size: 18px; line-height: 25px;" class="px-5">@{{ flight.procent }} %
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p style="font-size: 20px; line-height: 25px; font-weight: 700; color: #998EE7">
                                        Стоимость </p>
                                    <p style="font-size: 25px; line-height: 25px; font-weight: 700; color: #998EE7;"
                                        class="px-5">@{{ flight.price + (flight.price * (flight.procent / 100)) }} Р</p>
                                </div>
                                @auth
                                    <a :href="`{{ route('show_flight_seats_buy_ticket') }}/${flight.id}`" class="btn mt-4 px-4"
                                        style="background-color: #998EE7;">Выбрать место <i class="bi bi-arrow-right"></i></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    flights: [],
                    cities: [],
                    seats: [],
                    cities: [],
                    select_city_form: '',
                    select_city_to: '',
                    price_from: 0,
                    price_to: 0,
                    flights_copy: [],
                }
            },
            methods: {
                async getFlights() {

                    // console.log(this.flights.length);
                    this.flights.forEach(flight => {
                        let date1 = new Date(flight.arrival_time);
                        let date2 = new Date(flight.departure_time);
                        let hours = Math.floor((Math.abs(date2 - date1)) / (1000 * 60 * 60));
                        let minutes = Math.floor((Math.abs(date2 - date1)) % (1000 * 60 * 60) / (1000 *
                            60));
                        flight['time'] = hours + 'ч ' + minutes + 'мин';
                        // console.log(flight);
                    });

                    const responseCities = await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();
                },
                filterFlights() {
                    this.flights = [...this.flights_copy];
                    if(this.select_city_form) {
                        this.flights = this.flights.filter((flight)=>flight.city_from_id == this.select_city_form);
                    }
                    if(this.select_city_to) {
                        this.flights = this.flights.filter((flight)=>flight.city_to_id == this.select_city_to);
                    }
                    if(this.price_from !== 0 && this.price_to !== 0) {
                        this.flights = this.flights.filter((flight)=>(flight.price + (flight.price * flight.procent/100)) >= this.price_from);
                        this.flights = this.flights.filter((flight)=>(flight.price + (flight.price * flight.procent/100)) <= this.price_to);
                    } else {
                        if(this.price_from !== 0) {
                            this.flights = this.flights.filter((flight)=>(flight.price + (flight.price * flight.procent/100)) >= this.price_from);
                        }
                        if(this.price_to !== 0) {
                            this.flights = this.flights.filter((flight)=>(flight.price + (flight.price * flight.procent/100)) <= this.price_to);
                        }
                    }
                    
                   return this.flights;
                },
            },
            mounted() {
                this.flights = <?php echo json_encode($flights); ?>;
                this.flights_copy = <?php echo json_encode($flights); ?>;
                this.getFlights();
            }
        }
        Vue.createApp(app).mount('#allFlights');
    </script>
@endsection
