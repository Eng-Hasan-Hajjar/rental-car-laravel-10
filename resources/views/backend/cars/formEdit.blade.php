

<div class="container">
    <h1>التعديل</h1>
    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
            <label for="image" class="col-md-4 col-form-label text-md-right"> الصورة </label>
            <div class="col-md-6">
                <div style="">
                    @if (isset($car))
                        @if ($car->image != '')
                            <img src="{{ Request::root() . '/images/' . $car->image }}"
                                />
                            <br>
                        @endif
                    @endif
                    {!! Form::file('image',null, ['class' => 'form-control', 'style' => '']) !!}

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">تحديث </button>
        <a href="{{ url('/adminpanel/car') }}" class="btn btn-secondary" >  السيارات  </a>

    </form>
</div>
