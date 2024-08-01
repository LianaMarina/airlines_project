@extends('layout/app')

@section('title')
    Добавление мест
@endsection

@section('content')
    <div class="container" id="addSeats">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Добавление мест</h2>
                        <form id="form_add_seats" @submit.prevent="addSeats({{ $airplane->id }})">
                            <div class="mb-3">
                                <label for="number" class="form-label">Номер места</label>
                                <input type="text" class="form-control" id="number" name="numbers[]" v-for="number in numbers" :class="errors.number ? 'is-invalid':''">
                                <button type="button" class="btn form-button btn-outline-secondary mx-2 my-1" @click="add_number_input"><i class="bi bi-plus"></i></button>
                                <div class="invalid-feedback" v-for="error in errors.number">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn big-button">СОЗДАТЬ</button>
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
                    numbers: [],
                }
            },
            methods: {
                add_number_input() {
                    this.numbers.push('');
                },
                async addSeats(id) {
                    let form = document.getElementById('form_add_seats');
                    let form_data = new FormData(form);
                    form_data.append('id', id)
                    const response = await fetch('{{ route('addSeats') }}',
                        {method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: form_data});
                    if(response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if(response.status == 200) {
                        this.message = await response.json();
                        setTimeout(() => {
                            this.message = '';
                        }, 10000);
                        this.numbers = [];
                    }
                }
            }
        }
        Vue.createApp(app).mount('#addSeats');
    </script>
@endsection