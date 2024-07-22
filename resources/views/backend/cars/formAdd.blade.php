


<div class="container">

    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" style="margin: 10px">
        @csrf
        @include('backend.cars.partials.form')
        <div class="form-group">
            <label for="garage_id">اختر الكراج</label>
            <select class="form-control" id="garage_id" name="garage_id">
                @foreach($garages as $garage)
                    <option value="{{ $garage->id }}">{{ $garage->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">الصورة </label>
            <input type="file" class="form-control" id="image" name="image">
        </div>


        <button type="submit" class="btn btn-primary">حفظ</button>

        <a href="{{ url('/adminpanel/car') }}" class="btn btn-secondary" >  السيارات  </a>
    </form>
</div>








