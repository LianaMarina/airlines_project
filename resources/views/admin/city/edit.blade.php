@extends('layout/app')

@section('title')
    Редактирование города
@endsection

@section('content')
    <div class="container" id="editCity">
        <div :class="message ? 'alert alert-success':''">
            @{{ message }}
        </div>
        <div class="row">
            <div class="row justify-content-center" style="margin-top: 100px;">
                    <div class="col-6 p-5 shadow">
                        <h2 class="pb-3">Изменение города</h2>
    
                        <form id="form_edit_city" @submit.prevent="editCity({{ $city->id }})" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Название города</label>
                                <input type="text" class="form-control" id="name" name="name" :class="errors.name ? 'is-invalid':''" value="{{ $city->name }}">
                                <div class="invalid-feedback" v-for="error in errors.name">
                                    @{{ error }}
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="img" class="form-label">Фото города</label>
                                <input type="file" class="form-control" id="img" name="img" :class="errors.img ? 'is-invalid':''">
                                <div class="invalid-feedback" v-for="error in errors.img">
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
                async editCity(id) {
                    let form = document.getElementById('form_edit_city');
                    let form_data = new FormData(form);
                    form_data.append('id', id);
                    const response = await fetch('{{ route('editCity') }}', {
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
        Vue.createApp(app).mount('#editCity');
    </script>
@endsection