@extends('layout/app')

@section('title')
        Места в самолёте
@endsection

@section('content')
    <div class="container" id="allSeats">
      <div :class="message ? 'alert alert-success':''">
        @{{ message }}
    </div>
        <div class="d-flex justify-content-between align-items-center">
             <h2 style="color: black;" class="my-5">Места в самолёте {{ $airplane->number }}</h2>
            <a href="{{ route('show_add_seat_page', ['id'=>$airplane->id]) }}" class="btn button" style="background-color: #5B4A66;">Добавить места <i class="bi bi-plus-circle"></i></a>
        </div>
       
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Номер</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="seat in seats">
                <th  v-if="seat.airplane_id === id" scope="row">@{{ seat.id }}</th>
                <td v-if="seat.airplane_id === id" >
                    @{{ seat.number }}
                </td>
                <td v-if="seat.airplane_id === id" >@{{ seat.status }}</td>
                <td v-if="seat.airplane_id === id" >
                    <button type="button" class="btn btn-edit mx-2" data-bs-toggle="modal" :data-bs-target="'#Modal_'+seat.id">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <div class="modal fade" :id="'Modal_'+seat.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Изменение статуса рейса</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form @submit.prevent="editSeat(seat.id, id)" :id="'editSeat'+seat.id">
                                <div class="mb-3">
                                  <label for="number" class="form-label">Номер места</label>
                                  <input type="text" class="form-control" id="number" name="number" :value="seat.number" :class="errors.number ? 'is-invalid':''">
                                  <div class="invalid-feedback" v-for="error in errors.number">
                                      @{{ error }}
                                  </div>
                              </div>
                              <div class="mb-3">
                                <label for="status" class="form-label">Статус места</label>
                                <select name="status" id="status" class="form-control">
                                <option value="свободно">свободно</option>
                                <option value="занято">занято</option>
                            </select>
                              </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-dark">Сохранить изменения</button>
                                  </div>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <a :href="`{{ route('delete_seat') }}/${seat.id}`" class="btn btn-delete">Удалить</a> --}}
                    <a :href="`{{ route('delete_seat') }}/${seat.id}`" class="btn btn-delete">Удалить</a>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    message: '',
                    seats: [],
                    id: '',
                    errors: [],
                }
            },
            methods: {
                async getSeats() {
                    const response = await fetch('{{ route('getSeats') }}');
                    this.seats = await response.json();
                    this.id = {{ $airplane->id }};
                },
                async editSeat(seatId, id) {
                  let form = document.getElementById('editSeat'+seatId);
                  let form_data = new FormData(form);
                  form_data.append('id', id);
                  form_data.append('seatId', seatId);
                  const responseEdit = await fetch('{{ route('editSeat') }}', {
                    method: 'POST',
                    headers: {
                      'X-CSRF-TOKEN':'{{ csrf_token() }}',
                    },
                    body: form_data,
                  });
                  if (responseEdit.status == 400) {
                    this.errors = await responseEdit.json();
                    setTimeout(() => {
                      this.errors = [];
                    }, 10000);
                  }
                  if (responseEdit.status == 200) {
                    this.message = await responseEdit.json();
                    setTimeout(() => {
                      this.message = '';
                    }, 10000);
                    this.getSeats();
                  }
                }
            },
            mounted() {
                this.getSeats();
            }
        }
        Vue.createApp(app).mount('#allSeats');
    </script>
@endsection