@extends('layouts.app')

@section('content')
    <div class='container'>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method='post' action=" {{ route('members.store') }}">
            @csrf
            <div class='mb-3'>
                <div class='row mb-2'>
                    <div class='col-6'>
                        <label for='name' class='form-label'>Nome</label>
                        <input type='text' class='form-control' name='name' id='name' required>
                    </div>
                    <div class='col-6'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='email' class='form-control' name='email' id='email' required>
                    </div>
                </div>
            </div>
            <div class='mb-3'>
                <div class='row mb-2'>
                    <div class='col-6'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='password_type' id='random_password' value='1' checked='checked' onchange="aleatorio();">
                            <label class='form-check-label' for='rando_password'>Gerar Senha Aelatória</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='password_type' id='defined_password' value='2' onchange="definir();">
                            <label class='form-check-label' for='rando_password'>Digitar uma Senha</label>
                        </div>
                    </div>
                    <div class='col-6 d-none password_field'>
                        <label for='password' class='form-label'>Senha</label>
                        <input type='password' class='form-control' name='password' id='password'>
                    </div>
                </div>
            </div>
            <a class='btn btn-danger' href='{{$previous}}'>Cancelar</a>
            <input type='submit' class='btn btn-success' value='Criar Usuário'>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/members.js') }}" defer></script>
@endsection