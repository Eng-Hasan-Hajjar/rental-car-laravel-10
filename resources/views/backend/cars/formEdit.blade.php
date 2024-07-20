

<div class="container">
    <h1>التعديل</h1>
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.cars.partials.form')
        <button type="submit" class="btn btn-primary">تحديث </button>
        <a href="{{ url('/adminpanel/car') }}" class="btn btn-secondary" >  السيارات  </a>

    </form>
</div>
