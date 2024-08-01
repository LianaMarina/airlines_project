@extends('layout/app')

@section('title')
    Выбор места на рейс
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

        .purple_box {
            background-color: #8675FF;
        }

        .white_box {
            background-color: white;
        }

        .white_box p {
            color: black;
        }

        .pink_box {
            background-color: #EDB6E1;
        }
    </style>
    <div class="container" id="seatTicket">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <h2 class="title mt-5" style="color: black;">Выбор места </h2>
        <div class="row my-5">
            <div class="col-5">
                <div class="p-4 simple-linear first_part_flight shadow" style="position: relative;">
                    <div
                        style="background-color: #2825d484; position: absolute; width: 100%; top: 0; left:0; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 20px 30px 0px 30px;">
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
                        <div style="position: absolute; top: 30%; left: 30px;">
                            <img src="{{ asset('public\img\flight_img.png') }}" alt="img-flight-card" style="width: 100%;">
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
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <p style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;">
                                @{{ (flight.departure_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                            <p style="font-weight: 500; font-size: 14px; color: #816EF8;">@{{ (flight.departure_time.split(' ')[1]) }}</p>
                        </div>
                        <div class="">
                            <p style="margin-bottom: 0;">время полёта</p>
                            <p style="font-weight: 700; font-size: 24px; text-align: center;">@{{ flight.time }}</p>
                        </div>
                        <div class="">
                            <p style="font-weight: 500; font-size: 16px; color: #816EF8; margin-bottom: 0;">
                                @{{ (flight.arrival_time.split(' ')[0]).split('-').reverse().join('.') }}</p>
                            <p style="font-weight: 500; font-size: 14px; color: #816EF8;">@{{ (flight.arrival_time.split(' ')[1]) }}</p>
                        </div>
                    </div>
                    <p style="font-size: 25px; line-height: 25px; font-weight: 700; color: #998EE7; text-align: right;"
                        class="px-5">@{{ flight.price }} Р</p>
                </div>
            </div>
            <div class="col-6">
                <p style="color: black; font-weight: 500;">Выберите одно из предлагаемых мест.</p>
                <p style="color: black;">Выход из самолёта находится в левой части расположения мест:</p>
                <div class="d-flex gap-2 p-3 flex-wrap" style="background-color: #8575ff6a; border-radius: 50px;">
                    <div v-for="seat in seats" id="choose_seat">
                        <div @click="choose" class="purple_box d-flex gap-2"  
                            style="width: 45px; height: 45px; border-radius: 5px; display:flex; justify-content:center; padding-top: 10px;"
                            v-if="flight.airplane_id === seat.airplane_id && seat.status == 'свободно'" id="free">
                            <p  :data-value="seat.id">@{{ seat.number }}</p>
                        </div>
                        <div @click="choose" class="white_box d-flex gap-2" 
                            style="width: 45px; height: 45px; border-radius: 5px; display:flex; justify-content:center; padding-top: 10px;"
                            v-if="flight.airplane_id === seat.airplane_id && seat.status == 'занято'" id="notFree">
                            <p :data-value="seat.id">@{{ seat.number }}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-5 justify-content-center mt-3">
                    <div class="d-flex gap-1">
                        <div style="width: 20px; height:20px; background-color: #9370DA;"></div>
                        <p style="color: black;">свободно</p>
                    </div>
                    <div class="d-flex gap-1">
                        <div
                            style="width: 20px; height:20px; background-color: white; border: 1px solid black; border-radius: 5px;">
                        </div>
                        <p style="color: black;">занято</p>
                    </div>
                    <div class="d-flex gap-1">
                        <div style="width: 20px; height:20px; background-color: #EDB6E1;"></div>
                        <p style="color: black;">выбрано вами</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="show_reg_flight">
            <div class="row">
                <h2 class="title mt-5" style="color: black;">Регистрация на рейс </h2>
                <p style="color: black;"class="my-3">Заполните личные данные для покупки и оформления билета<br>
                    <span style="font-weight: 500">ВНИМАНИЕ!</span> Если вы покупаете билет не для себя, введите данные
                    человека, на которого оформляете билет
                </p>
            </div>
            <div class="row my-3">
                <form id="form_reg_ticket" @submit.prevent="regTicket">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="fio" class="form-label">ФИО</label>
                            <input type="text" class="form-control" id="fio" name="fio"
                                :class="errors.fio ? 'is-invalid' : ''">
                            <div class="invalid-feedback" v-for="error in errors.fio">
                                @{{ error }}
                            </div>
                        </div>
                    <div class="mb-3 col-6">
                        <label for="birthday" class="form-label">Дата рождения</label>
                        <input type="date" class="form-control" id="birthday" name="birthday"
                            :class="errors.birthday ? 'is-invalid' : ''">
                        <div class="invalid-feedback" v-for="error in errors.birthday">
                            @{{ error }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="birth_certificate_num" class="form-label">Свидетельство о рождении</label>
                        <input type="text" class="form-control" id="birth_certificate_num" name="birth_certificate_num"
                            :class="errors.birth_certificate_num ? 'is-invalid' : ''" aria-describedby="birth_certificate_num_help">
                            <div id="birth_certificate_num_help" class="form-text" style="color: rgba(0, 0, 0, 0.29);">*eсли билет оформляется для ребёнка</div>
                        <div class="invalid-feedback" v-for="error in errors.birth_certificate_num">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="passport_seria_number" class="form-label">Серия и номер паспорта</label>
                        <input type="text" class="form-control" id="passport_seria_number"
                            name="passport_seria_number"  :class="errors.passport_seria_number ? 'is-invalid' : ''">
                        <div class="invalid-feedback" v-for="error in errors.passport_seria_number">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="password" class="form-label">Введите пароль</label>
                        <input type="text" class="form-control" id="password"
                            name="password" :class="errors.password ? 'is-invalid' : ''">
                        <div class="invalid-feedback" v-for="error in errors.password">
                            @{{ error }}
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="mb-3">
                            <input type="checkbox"  class="form-check-input mx-3" id="rule" name="rule"
                            :class="errors.rule ? 'is-invalid' : ''">
                        <label for="rule" class="form-label">Я знаком с политикой конфиденциальности и даю свое согласие
                            на обработку персональных данных.</label>
                        <div class="invalid-feedback" v-for="error in errors.rule">
                            @{{ error }}
                        </div>
                    </div>
                    </div>
                    <button style="background-color: #5B4A66; padding: 10px 20px; border-radius: 5px; color:white;" type="submit" class="btn">ОФОРМИТЬ</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                    seats: [],
                    cities: [],
                    // id: '',
                    show_reg_flight: false,
                    seat_id: '',
                    flight: {
                        id: '',
                        city_from_id: '',
                        city_to_id: '',
                        airport_from_id: '',
                        airport_to_id: '',
                        number: '',
                        price: '',
                        status: '',
                        airplane_id: '',
                        departure_time: '',
                        arrival_time: '',
                        time: '',
                    },
                }
            },
            methods: {
                async getData() {
                    const responseSeats = await fetch('{{ route('getSeats') }}');
                    this.seats = await responseSeats.json();
                    this.flight.id = {{ $flight->id }};
                    this.flight.city_from_id = {{ $flight->city_from_id }};
                    this.flight.city_to_id = {{ $flight->city_to_id }};
                    this.flight.airport_from_id = {{ $flight->airport_from_id }};
                    this.flight.airport_to_id = {{ $flight->airport_to_id }};
                    this.flight.number = '{{ $flight->number }}';
                    this.flight.price = {{ ($flight->price * $flight->procent) / 100 + $flight->price }};
                    this.flight.airplane_id = {{ $flight->airplane_id }};
                    this.flight.departure_time = '{{ $flight->departure_time }}';
                    this.flight.arrival_time = '{{ $flight->arrival_time }}';

                    let date2 = new Date(this.flight.departure_time);
                    let date1 = new Date(this.flight.arrival_time);
                    let minutes = Math.floor((Math.abs(date2 - date1)) % (1000 * 60 * 60) / (1000 * 60));
                    let hours = Math.floor((Math.abs(date2 - date1)) / (1000 * 60 * 60));
                    this.flight['time'] = hours + 'ч ' + minutes + 'мин';
                    console.log(this.flight);


                    const responseCities = await fetch('{{ route('getCities') }}');
                    this.cities = await responseCities.json();
                },
                async regTicket() {
                    let form = document.getElementById('form_reg_ticket');
                    let form_data = new FormData(form);
                    console.log(this.seat_id);
                    form_data.append('seat', this.seat_id);
                    form_data.append('flight', this.flight.id);
                    form_data.append('price', this.flight.price);
                    const response = await fetch('{{ route('regTicket') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                        window.location = '{{ route('show_my_tickets') }}';
                    }
                },
                choose(el) {
                    console.log(el.target.dataset.value);
                let freeSeats = document.querySelectorAll('.pink_box');
                let parent = el.target.parentElement;
                    console.log(parent.id);
            if (parent.id == 'free') {
                parent.classList.remove('purple_box');
                parent.classList.add('pink_box');
                this.seat_id = el.target.dataset.value;
                this.show_reg_flight = true;
                freeSeats.forEach(seats => {
                    seats.classList.remove('pink_box');
                    seats.classList.add('purple_box');
                });
            }
            let notFreeSeat = document.querySelector('.pink_box');
            if (notFreeSeat) {
                this.seat_id = el.target.dataset.value;
        } else {
            this.show_reg_flight = false;
        }
    }
            },
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#seatTicket');

    </script>
@endsection
