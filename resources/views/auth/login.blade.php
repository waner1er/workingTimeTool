<x-layouts.no-layout>
    <div class="box-container">
        <div class="login">
            <h1>Login</h1>
            <form method="POST" action="{{ route('login.submit') }}" class="login__form">
                @csrf
                <div class="login__form__input">
                    <label for="email">E-mail:</label>
                    <input id="email" type="text" name="email" value="{{ old('email') }}" autofocus>
                </div>
                <div class="login__form__input">
                    <label for="password">Mot de passe:</label>
                    <input id="password" type="password" name="password">
                </div>

                <div class="login__form__submit">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
            @if($errors->has('email') || $errors->has('password'))
                <div class="form-error">
                    <strong>Une erreur s'est produite lors de la connexion. Veuillez vérifier vos identifiants.</strong>
                </div>
            @endif
        </div>
    </div>
</x-layouts.no-layout>
