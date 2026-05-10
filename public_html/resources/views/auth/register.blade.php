<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-200/50">
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-800 mb-2">
                        Hospital dos Óculos
                    </h1>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">
                        Criar conta
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nome</label>
                        <input
                            id="name"
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 text-base"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input
                            id="email"
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 text-base"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Senha</label>
                        <input
                            id="password"
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 text-base"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Confirmar senha</label>
                        <input
                            id="password_confirmation"
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 text-base"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Registrar
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Já tem conta?
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500">Entrar</a>
                </p>
            </div>

            <p class="mt-6 text-center text-xs sm:text-sm text-slate-500">
                © {{ date('Y') }} Hospital dos Óculos. Todos os direitos reservados.
            </p>
        </div>
    </div>
</x-guest-layout>
