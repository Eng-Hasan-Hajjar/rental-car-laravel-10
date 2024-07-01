


<div class="container">
    <h1>Add New Car</h1>
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('cars.partials.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>












<!-- Submit Button -->
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! Form::submit('حفظ', ['class' => 'btn btn-primary  pull-right']) !!}
        <a href="{{ url('/adminpanel/car') }}" class="btn btn-secondary" >  أماكن التخييم  </a>
    </div>
</div>


