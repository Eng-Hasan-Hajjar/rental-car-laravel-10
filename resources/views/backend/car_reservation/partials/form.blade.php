
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif





<!-- resources/views/reservations/partials/form.blade.php -->
<div class="form-group">
    <label for="start_date"> تاريخ البداية </label>
    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $reservation->start_date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="end_date"> تاريخ النهاية </label>
    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $reservation->end_date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status"> الحالة </label>
    <select class="form-control" id="status" name="status" required>
        <option value="pending" {{ (old('status', $reservation->status ?? '') == 'pending') ? 'selected' : '' }}> معلق </option>
        <option value="confirmed" {{ (old('status', $reservation->status ?? '') == 'confirmed') ? 'selected' : '' }}>  مثبت </option>
        <option value="cancelled" {{ (old('status', $reservation->status ?? '') == 'cancelled') ? 'selected' : '' }}> إلغاء </option>
    </select>
</div>



   <div class="form-group">
        <label for="pickup_garage_id">كراج الاستلام</label>
        <select name="pickup_garage_id" id="pickup_garage_id" class="form-control">
            @foreach($garages as $garage)
                <option value="{{ $garage->id }}">{{ $garage->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="dropoff_garage_id">كراج التسليم</label>
        <select name="dropoff_garage_id" id="dropoff_garage_id" class="form-control">
            @foreach($garages as $garage)
                <option value="{{ $garage->id }}">{{ $garage->name }}</option>
            @endforeach
        </select>
    </div>
