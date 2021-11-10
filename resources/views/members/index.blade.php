@extends('layouts.app')

@section('content')
    <div class='container'>
        @if ($message != '')
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <div class='row mb-2 justify-content-end'>
            <div class='col-2'>
                <a href="{{ route('members.create') }}" class='btn btn-success'>
                    <i class='bi bi-plus'></i> Novo Usuário
                </a>
            </div>
        </div>
        <div class='row mb-2'>
            <div class='col'>
                <table class='table table-stripped table-hover'>
                    <thead class='thead-light'>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Nome</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Status</th>
                            <th scope='col'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userList as $user)
                            <tr>
                                <th scope='row'>{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td><h5>{!! $user->status !!}</h5></td>
                                <td class='row'>
                                    <a href="{{ route('members.edit',$user) }}" class='btn btn-sm bg-warning text-dark'>
                                        <i class='bi bi-pencil'></i>
                                    </a>
                                    <form action="{{ route('members.destroy',$user) }}" method='POST'>
                                        <input type='hidden' name="_method" value='DELETE'>
                                        @csrf
                                        <button class='btn btn-sm bg-danger text-light'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection