@extends('admin.tema')

@section('css')
@endsection

@section('master')

<div class="container">
    <h1>Kullanıcıları Yönet</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Kullanıcı Adı</th>
                <th>Mevcut Rol</th>
                <th>Rol Atama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles->pluck('name')->first() ?? 'Rol Yok' }}</td>
                    <td>
                        <form action="{{ route('users.assignRole', $user) }}" method="POST">
                            @csrf
                            <select name="role_id" class="form-control">
                                <option value="">Rol Seç</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Rol Atama</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>














@endsection


@section('js')

@endsection