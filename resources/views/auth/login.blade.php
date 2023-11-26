<x-app-layout title="Авторизация">
    @section('content')
        <section class="py-5">
            <div class="container-xxl d-flex align-items-center justify-content-center">
                <form action="{{ route('auntificate') }}" method="post" style="max-width: 350px">
                    @csrf
                    <h2 class="mb-3">Авторизация</h2>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                        <label for="password">Password</label>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-blue">Войти</button>
                </form>
            </div>
        </section>
    @endsection
</x-app-layout>
