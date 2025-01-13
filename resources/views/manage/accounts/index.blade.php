@extends('layouts.admin_layout')
@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #000;
        padding: 5px 10px;
    }
    .badge {
        padding: 5px 10px;
        border-radius: 5px;
        background-color: green;
        color: #fff;
        width: fit-content;
        font-size: 12px;
    }
    .access-container {
        display: flex;
        gap: 5px;
    }
    .edit-access {
        background-color: #ffae00;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
    }
    .btn-submit {
        background-color: green;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        color: #fff;
    }
    .btn-primary {
        background-color: #0062ff;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        color: #fff;
    }
    .btn-secondary {
        background-color: #cbcbcb;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        color: #000;
    }
    .paginate-item {
        border: 1px solid black;
        padding: 0 5px;
        text-decoration: none;
    }
    .paginate-button {
        /* border: 1px solid black; */
        background-color: #3d943d;
        color: white;
        padding: 0 5px;
        text-decoration: none;
    }
    .disabled-paginate {
        pointer-events: none;
        background-color: #cacaca;
        color: white;
        border: none;
    }
    .active-paginate {
        pointer-events: none;
        background-color: green;
        color: white;
        border: none;
    }
</style>
<div>
    <h2>Accounts</h2>
    <form action="" style="display: flex; justify-content: flex-end; gap: 5px;">
        <input type="search" name="search">
        <button type="submit" class="btn-submit">search</button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Service Access</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <div class="access-container">
                            @foreach ($user->service as $service)
                                <div class="badge">{{ $service->name }}</div>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <button class="edit-access" onclick="showAccessForm({{ $loop->iteration }})">Edit Access</button>
                            <form action="{{ route($user->role_id != 1 ? 'manage.accounts.set_as_admin' : 'manage.accounts.remove_admin', Crypt::encryptString($user->id)) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="{{ $user->role_id != 1 ? 'btn-primary' : 'btn-secondary' }}">{{ $user->role_id != 1 ? 'Make as Admin' : 'Make as User' }}</button>
                            </form>
                        </div>
                        <div id="access-form-{{ $loop->iteration }}" style="display: none">
                            <br>
                            <form action="{{ route('manage.accounts.service_access_update', Crypt::encryptString($user->id)) }}" method="POST" style="border: 1px solid black; padding: 5px 10px;">
                                @csrf
                                @method('PUT')
                                @foreach ($services as $service)
                                    @php
                                        $check = false;
                                        foreach ($user->service as $item) {
                                            if ($item->name == $service->name) $check = true;
                                        }
                                    @endphp
                                    <label for="service{{ $loop->iteration }}">
                                        <input type="checkbox" name="service[]" value="{{ $service->id }}" id="service{{ $loop->iteration }}" {{ $check ? 'checked' : '' }}>
                                        {{ $service->name }}
                                    </label><br>
                                @endforeach
                                <br>
                                <div style="display: flex;justify-content: flex-end;">
                                    <button type="submit" class="btn-submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- pagination --}}
    <div style="margin: 10px;display:flex;align-items:center;justify-content:center;gap: 5px;">
        <a href="{{ route('manage.accounts.view', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $users->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
        <a href="{{ route('manage.accounts.view', [...request()->all(), 'page' => $users->currentPage() - 1]) }}" class="paginate-button {{ $users->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
        @for ($i = 1; $i <= $users->lastPage(); $i++)
            <a href="{{ route('manage.accounts.view', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $users->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endfor
        <a href="{{ route('manage.accounts.view', [...request()->all(), 'page' => $users->currentPage() + 1]) }}" class="paginate-button {{ $users->currentPage() == $users->lastPage() ? 'disabled-paginate' : '' }}">>></a>
        <a href="{{ route('manage.accounts.view', [...request()->all(), 'page' => $users->lastPage()]) }}" class="paginate-button {{ $users->currentPage() == $users->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
    </div>
    {{--  end pagination --}}
</div>

<script>
    const showAccessForm = (iteration) => {
        const form = document.getElementById(`access-form-${iteration}`).style
        if (form.display == 'none') form.display = 'block'
        else if (form.display == 'block') form.display = 'none'
    }
</script>
@endsection