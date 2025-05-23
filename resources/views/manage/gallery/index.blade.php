@extends('layouts.admin_layout')
@section('content')

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 7px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #00452C;
        color: white;
    }
    
    .number {
        width: 20px;
        text-align: center;
    }
    
    .paginate-item {
        border: 1px solid gray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }

    .paginate-item:hover {
        border: 1px solid gray;
        background-color: lightgray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }
    
    .paginate-button {
        /* border: 1px solid black; */
        background-color: #3d943d;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }

    .paginate-button:hover {
        /* border: 1px solid black; */
        background-color: #51ac51;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }
    
    .disabled-paginate {
        pointer-events: none;
        background-color: #cacaca;
        color: white;
        border: none;
    }
    
    .active-paginate {
        pointer-events: none;
        background-color: #00452C;
        color: white;
        border: none;
    }

    .submit {
        background-color: #00452C;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
    }

    .submit:hover {
        background-color: #005737;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
    }
    
    .update {
        background-color: rgb(255, 191, 0);
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }

    .update:hover {
        background-color: rgb(255, 206, 57);
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }
    
    .delete {
        background-color: rgb(166, 0, 0);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }

    .delete:hover {
        background-color: rgb(186, 0, 0);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }
</style>

<div>
    
    <h1>Manage Gallery</h1>

    <div>
        <form action="{{ route('manage.gallery.index') }}">
            <input type="search" name="search" style="height: 40px; width: 250px; border-radius:5px; border: solid 1px; border-color: gray" placeholder="Search here" value="{{ request()->search }}">
            <button class="submit" type="submit">Search</button>
        </form>
    </div>

    <div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
        <button class="submit" onclick="toggleCreate()">+ Create</button>
        <form action="{{ route('manage.gallery.store', request()->table) }}" method="POST" enctype="multipart/form-data" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
            @csrf
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Type here" required>
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Type here" required cols="30" rows="10"></textarea>
            <label for="image">Image</label>
            <input type="file" accept=".png,.jpg,.jpeg" name="image" id="image" required>
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
                <th>BSIP</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gallery as $key=>$gal)
                <tr>
                    <td class="number">{{ $loop->iteration + ( $gallery->currentPage() - 1 ) * $gallery->perPage() }}</td>
                    <form action="{{ route('manage.gallery.update', Crypt::encryptString($gal->id)) }}" method="POST" enctype="multipart/form-data" class="edit">
                        @csrf
                        @method('PUT')
                        <td>
                            <div class="title-data" style="display: block;">
                                {{ $gal->title }}
                            </div>
                            <input type="text" name="title" value="{{ $gal->title }}" class="title-input" placeholder="Type here" required style="display: none">
                        </td>
                        <td>
                            <div class="description-data" style="display: block;">
                                {{ $gal->description }}
                            </div>
                            <textarea name="description" id="" cols="30" rows="10" class="description-input" style="display: none" required>{{ $gal->description }}</textarea>
                        </td>
                        <td>
                            <div class="image-data" style="display: block;">
                                <a href="{{ $gal->image_url }}" target="_blank">Look Image >></a>
                            </div>
                            <input type="file" name="image" accept=".jpg,.jpeg,.png" class="image-input" style="display: none">
                        </td>
                    </form>
                    <td>
                        <div class="actions" style="display: block;">
                            <button class="update" onclick="toggleEdit({{ $key }})">Edit</button>
                            <button class="delete" onclick="toggleDelete({{ $key }})">Delete</button>
                        </div>
                        <div class="edit-action" style="display: none;">
                            <button class="update" onclick="update({{ $key }})">Submit</button>
                            <button class="delete" onclick="toggleEdit({{ $key }})">Cancel</button>
                        </div>
                        <form action="{{ route('manage.gallery.destroy', Crypt::encryptString($gal->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
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

    <div style="margin: 10px;display:flex;align-items:center;justify-content:center;gap: 5px;">
        <a href="{{ route('manage.gallery.index', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $gallery->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
        <a href="{{ route('manage.gallery.index', [...request()->all(), 'page' => $gallery->currentPage() - 1]) }}" class="paginate-button {{ $gallery->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
        @for ($i = 1; $i <= $gallery->lastPage(); $i++)
            <a href="{{ route('manage.gallery.index', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $gallery->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endfor
        <a href="{{ route('manage.gallery.index', [...request()->all(), 'page' => $gallery->currentPage() + 1]) }}" class="paginate-button {{ $gallery->currentPage() == $gallery->lastPage() ? 'disabled-paginate' : '' }}">>></a>
        <a href="{{ route('manage.gallery.index', [...request()->all(), 'page' => $gallery->lastPage()]) }}" class="paginate-button {{ $gallery->currentPage() == $gallery->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
    </div>

</div>

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
        const titleData = document.getElementsByClassName('title-data')[index]
        const titleInput = document.getElementsByClassName('title-input')[index]
        const descriptionData = document.getElementsByClassName('description-data')[index]
        const descriptionInput = document.getElementsByClassName('description-input')[index]
        const imageData = document.getElementsByClassName('image-data')[index]
        const imageInput = document.getElementsByClassName('image-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (titleData.style.display == 'block') titleData.style.display = 'none'
        else if (titleData.style.display == 'none') titleData.style.display = 'block'
        if (titleInput.style.display == 'block') titleInput.style.display = 'none'
        else if (titleInput.style.display == 'none') titleInput.style.display = 'block'
        if (descriptionData.style.display == 'block') descriptionData.style.display = 'none'
        else if (descriptionData.style.display == 'none') descriptionData.style.display = 'block'
        if (descriptionInput.style.display == 'block') descriptionInput.style.display = 'none'
        else if (descriptionInput.style.display == 'none') descriptionInput.style.display = 'block'
        if (imageData.style.display == 'block') imageData.style.display = 'none'
        else if (imageData.style.display == 'none') imageData.style.display = 'block'
        if (imageInput.style.display == 'block') imageInput.style.display = 'none'
        else if (imageInput.style.display == 'none') imageInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>

@endsection