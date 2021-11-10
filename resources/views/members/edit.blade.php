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
        <form method='post' action=" {{ route('members.update', $user) }}">
            <input type='hidden' name="_method" value='PATCH'>
            @csrf
            <div class='mb-3'>
                <div class='row mb-2'>
                    <div class='col-6'>
                        <label for='name' class='form-label'>Nome</label>
                        <input type='text' class='form-control' name='name' id='name' required value="{{$user->name}}">
                    </div>
                    <div class='col-6'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='email' class='form-control' name='email' id='email' required value="{{$user->email}}">
                    </div>
                </div>
            </div>
            <div class='mb-3'>
                <div class='row mb-2'>
                    <div class='col-6'>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='password_type' id='random_password' value='1'>
                            <label class='form-check-label' for='rando_password'>Gerar Senha Aelatória</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='password_type' id='defined_password' value='2' checked='checked'>
                            <label class='form-check-label' for='rando_password'>Manter Senha Atual</label>
                        </div>
                    </div>
                </div>
            </div>
            <a class='btn btn-danger' href='{{$previous}}'>Cancelar</a>
            <input type='submit' class='btn btn-success' value='Atualizar Usuário'>
        </form>
    </div>
@endsection