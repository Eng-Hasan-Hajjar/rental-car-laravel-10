


<div class="container">
   
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" style="margin: 10px">
        @csrf
        @include('backend.cars.partials.form')
        <button type="submit" class="btn btn-primary">حفظ</button>

        <a href="{{ url('/adminpanel/car') }}" class="btn btn-secondary" >  السيارات  </a>
    </form>
</div>








