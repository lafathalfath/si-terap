@extends('layouts.admin_layout')
@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 5px 10px;
    }
    .number {
        width: 20px;
        text-align: center;
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

<h1>Manage IP2SIP</h1>
<div>
    <form action="{{ route('manage.ip2sip.view') }}">
        <input type="search" name="search" placeholder="Search here" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>
</div>
<div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
    <button onclick="toggleCreate()">+ Create</button>
    <form action="{{ route('manage.ip2sip.store') }}" method="POST" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Type here" required>
        <label for="bsip">BSIP</label>
        <select name="bsip_id" id="bsip" required>
            <option value="" selected disabled>-- Select One --</option>
            @foreach ($bsip as $bs)
                <option value="{{ $bs->id }}">{{ $bs->name }}</option>
            @endforeach
        </select>
        <div style="display: flex;align-items:center;justify-content:flex-end;gap:5px;">
            <button type="submit">Submit</button>
            <button type="button" onclick="toggleCreate()">Cancel</button>
        </div>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th class="number">#</th>
            <th>Name</th>
            <th>BSIP</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ip2sip as $key=>$dt)
            <tr>
                <td class="number">{{ $loop->iteration + ( $ip2sip->currentPage() - 1 ) * $ip2sip->perPage() }}</td>
                <form action="{{ route('manage.ip2sip.update', Crypt::encryptString($dt->id)) }}" method="POST" class="edit">
                    @csrf
                    @method('PUT')
                    <td>
                        <div class="name-data" style="display: block;">
                            {{ $dt->name }}
                        </div>
                        <input type="text" name="name" class="name-input" style="display: none" placeholder="Type here" value="{{ $dt->name }}" required>
                    </td>
                    <td>
                        <div class="bsip-data" style="display: block;">
                            {{ $dt->bsip->name }}
                        </div>
                        <select name="bsip_id" class="bsip-input" style="display: none" required>
                            <option value="" disabled>-- Select One --</option>
                            @foreach ($bsip as $bs)
                                <option value="{{ $bs->id }}" {{ $bs->id == $dt->bsip->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </form>
                <td>
                    <div class="actions" style="display: block;">
                        <button onclick="toggleEdit({{ $key }})">Edit</button>
                        <button onclick="toggleDelete({{ $key }})">Delete</button>
                    </div>
                    <div class="edit-action" style="display: none;">
                        <button onclick="update({{ $key }})">Submit</button>
                        <button onclick="toggleEdit({{ $key }})">Cancel</button>
                    </div>
                    <form action="{{ route('manage.ip2sip.destroy', Crypt::encryptString($dt->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
                        @csrf
                        @method('DELETE')
                        <div>Are you sure <span style="color: red;">delete</span> this entry?</div>
                        <div style="display: flex;align-items:center;justify-content:flex-end;gap:5px;">
                            <button type="submit">Yes</button>
                            <button type="button" onclick="toggleDelete({{ $key }})">Cancel</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{ dd(request()->table) }} --}}
{{-- pagination --}}
<div style="margin: 10px;display:flex;align-items:center;justify-content:center;gap: 5px;">
    <a href="{{ route('manage.ip2sip.view', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $ip2sip->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
    <a href="{{ route('manage.ip2sip.view', [...request()->all(), 'page' => $ip2sip->currentPage() - 1]) }}" class="paginate-button {{ $ip2sip->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
    @for ($i = 1; $i <= $ip2sip->lastPage(); $i++)
        @if ($i > $ip2sip->currentPage() - 5 && $i < $ip2sip->currentPage() + 5)
            <a href="{{ route('manage.ip2sip.view', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $ip2sip->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endif
    @endfor
    <a href="{{ route('manage.ip2sip.view', [...request()->all(), 'page' => $ip2sip->currentPage() + 1]) }}" class="paginate-button {{ $ip2sip->currentPage() == $ip2sip->lastPage() ? 'disabled-paginate' : '' }}">>></a>
    <a href="{{ route('manage.ip2sip.view', [...request()->all(), 'page' => $ip2sip->lastPage()]) }}" class="paginate-button {{ $ip2sip->currentPage() == $ip2sip->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
</div>
{{--  end pagination --}}

<script>
    const toggleCreate = () => {
        const form = document.getElementById('create')
        if (form.style.display == 'flex') form.style.display = 'none'
        else if (form.style.display == 'none') form.style.display = 'flex'
    }

    const toggleDelete = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const form = document.getElementsByClassName('delete')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (form.style.display == 'block') form.style.display = 'none'
        else if (form.style.display == 'none') form.style.display = 'block'
    }
    
    const toggleEdit = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const editAction = document.getElementsByClassName('edit-action')[index]
        const nameData = document.getElementsByClassName('name-data')[index]
        const bsipData = document.getElementsByClassName('bsip-data')[index]
        const nameInput = document.getElementsByClassName('name-input')[index]
        const bsipInput = document.getElementsByClassName('bsip-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (nameData.style.display == 'block') nameData.style.display = 'none'
        else if (nameData.style.display == 'none') nameData.style.display = 'block'
        if (bsipData.style.display == 'block') bsipData.style.display = 'none'
        else if (bsipData.style.display == 'none') bsipData.style.display = 'block'
        if (nameInput.style.display == 'block') nameInput.style.display = 'none'
        else if (nameInput.style.display == 'none') nameInput.style.display = 'block'
        if (bsipInput.style.display == 'block') bsipInput.style.display = 'none'
        else if (bsipInput.style.display == 'none') bsipInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection