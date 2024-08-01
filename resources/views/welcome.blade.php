@extends('layout/app')

@section('content')
<style>
    label {
        color: white;
    }
    input[type="text"], input[type="date"] {
        background-color: #ffffff73;
        padding: 10px;
        border-radius: 5px;
    }
    .button {
            /* transition: background-color 0.2s; */
            margin-top: 10px;
            background-color: #5B4A66; 
        }
    .button:hover {
            background-color: #755787;
            color: white;
        }

</style>
<div class=""  id="mainPage">
    <div class="">
        <img src="{{ asset('public\img\main_plane.jpg') }}" alt="" style="position: absolute; top:0; z-index: -2; width: 100%; max-height:100%;">
    </div>

    <div class="container">
        <div class="search_block" style="position: absolute; top: 50vh; z-index: 1000;">
            <h1>Поиск авиабилетов</h1>
            <div class="form my-3">
                <form id="search_form" class="col-12 d-flex gap-3 align-items-center" action="{{ route('show_flights_search') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="col-4">
                        <div class="mb-3">
                          <label for="from_city" class="form-label">откуда</label>
                          <input type="text" class="form-control" id="from_city" name="from_city">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                          <label for="to_city" class="form-label">куда</label>
                          <input type="text" class="form-control" id="to_city" name="to_city">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="date_flight" class="form-label">когда</label>
                            <input type="date" class="form-control" id="date_flight" name="date_flight">
                          </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" style="color: white; font-weight: 500; font-size: 20px; padding: 10px 50px; border: none;" class="btn btn-light button">найти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top: 95vh; position: relative;">
        <h3 style="font-weight: 300; text-align: center;" class="my-3">Популярные направления</h3>
        <div class="d-flex col-12 gap-4 justify-content-center mb-5">
            <div v-for="pop in popular">
                <div class="img" style="width: 306px; height: 345px; border-radius: 10px; position: relative;">
                <img :src="'/public/'+(pop['city'])[0].img" alt="" style="width: 100%;
                height: 100%; object-fit: cover;border-radius: 10px;">
                <p style="position:absolute; bottom: 40px; left: 25px; color: white; font-size: 28px; font-weight:700;">@{{ ((pop['city'])[0]).name }}</p></div>
            </div>
        </div>

        <h3 style="font-weight: 300; text-align: center;" class="my-5">Все рейсы</h3>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Название</th>
                <th scope="col">Откуда</th>
                <th scope="col">Куда</th>
                <th scope="col">Самолет</th>
                <th scope="col">Цена</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="flight in flights">
                <th scope="row">@{{ flight.number }}</th>
                <td>@{{ ((cities.filter((el)=>el.id == flight.city_from_id))[0]).name }}</td>
                <td>@{{ ((cities.filter((el)=>el.id == flight.city_to_id))[0]).name }}</td>
                <td>@{{ flight.airplane.number }}</td>
                <td>@{{ flight.price + (flight.price * flight.procent/100) }} P</td>
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
                    flights: [],
                    popular: [],
                    cities: [],
                    flights: [],
                }
            },
            methods: {
                async getData() {
                    const responsePopularCity = await fetch('{{ route('getPopular') }}');
                    this.popular = await responsePopularCity.json();

                    const response = await fetch('{{ route('getCities') }}');
                    this.cities = await response.json();

                    this.popular.forEach(popular => {
                        city = this.cities.filter((el)=>el.id == popular.city_to_id);
                        popular['city'] = city;
                    });

                    const responseFights = await fetch('{{ route('getFlightforMain') }}');
                    this.flights = await responseFights.json();

                }
            },
            mounted() {
                this.getData();
            }
        }
        Vue.createApp(app).mount('#mainPage');
    </script>
@endsection