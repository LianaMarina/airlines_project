@extends('layout/app')

@section('title')
    Редактирование самолёта
@endsection

@section('content')
    <div class="container" id="editAirplane">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Изменение самолёта</h2>
    
                        <form id="form_edit_airplane" @submit.prevent="editAirplane({{ $airplane->id }})">
                            <div class="mb-3">
                                <label for="number" class="form-label">Название самолёта</label>
                                <input type="text" class="form-control" id="number" name="number" :class="errors.number ? 'is-invalid':''" value="{{ $airplane->number }}">
                                <div class="invalid-feedback" v-for="error in errors.number">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn big-button">СОХРАНИТЬ</button>
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
                async editAirplane(id) {
                    let form = document.getElementById('form_edit_airplane');
                    let form_data = new FormData(form);
                    form_data.append('id', id);
                    const response = await fetch('{{ route('editAirplane') }}', {
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
                    }
                }
            }, 
        }
        Vue.createApp(app).mount('#editAirplane');
    </script>
@endsection