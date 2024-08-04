<!-- resources/views/maintenances/partials/form.blade.php -->

<div class="form-group  ">
    <label for="car_id"> السيارة </label>
    <select name="car_id" id="car_id" class="form-control">
        @foreach($cars as $car)
          <option value="{{ $car->id }}">{{ $car->brand }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="date"> تاريخ انتهاء الصيانة المتوقع :</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $maintenance->date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="details"> التفاصيل </label>
    <textarea class="form-control" id="details" name="details" required>{{ old('details', $maintenance->details ?? '') }}</textarea>
</div>
