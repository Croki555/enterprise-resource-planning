<x-app-layout title="Регистрация">
    @section('content')
        <section class="py-5">
            <div class="container-xxl d-flex align-items-center justify-content-center">
                <form action="{{ route('register.store') }}" method="post" style="max-width: 350px">
                    @csrf
                    <h2 class="mb-3">Регистрация</h2>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Имя пользователя" value="{{ old('name') }}">
                        <label for="name">Имя пользователя</label>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Адрес электронной почты</label>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Пароль">
                        <label for="password">Пароль</label>
                        <a href="#" class="password-control"></a>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароля">
                        <label for="password_confirmation">Подтверждение пароля</label>
                    </div>
                    <button type="submit" class="btn-blue">Зарегистрироваться</button>
                </form>
                <script type="module">
                    $('body').on('click', '.password-control', function(){
                        if ($('#password').attr('type') == 'password'){
                            $(this).addClass('view');
                            $('#password').attr('type', 'text');
                        } else {
                            $(this).removeClass('view');
                            $('#password').attr('type', 'password');
                        }
                        return false;
                    });
                </script>
            </div>
        </section>
    @endsection
</x-app-layout>
