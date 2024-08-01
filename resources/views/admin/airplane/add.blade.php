@extends('layout/app')

@section('title')
    Создание самолёта
@endsection

@section('content')
    <div class="container" id="addAirplane">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Создание самолета</h2>
    
                        <form id="form_add_airplane" @submit.prevent="addAirplane">
                            <div class="mb-3">
                                <label for="number" class="form-label">Название самолета</label>
                                <input type="text" class="form-control" id="number" name="number" :class="errors.number ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.number">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto mt-5">
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
                }
            },
            methods: {
                async addAirplane() {
                    let form = document.getElementById('form_add_airplane');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('addAirplane') }}', {
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
            }
        }
        Vue.createApp(app).mount('#addAirplane');
    </script>
@endsection