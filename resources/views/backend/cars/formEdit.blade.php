

<div class="container">
    <h1>Edit Car</h1>
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('cars.partials.form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
