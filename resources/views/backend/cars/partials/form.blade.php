<div class="form-group">
    <label for="brand">Brand</label>
    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand ?? '') }}" required>
</div>
<div class="form-group">
    <label for="model">Model</label>
    <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model ?? '') }}" required>
</div>
<div class="form-group">
    <label for="year">Year</label>
    <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $car->year ?? '') }}" required>
</div>
<div class="form-group">
    <label for="color">Color</label>
    <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $car->color ?? '') }}" required>
</div>
<div class="form-group">
    <label for="seats">Seats</label>
    <input type="number" class="form-control" id="seats" name="seats" value="{{ old('seats', $car->seats ?? '') }}" required>
</div>
<div class="form-group">
    <label for="daily_rate">Daily Rate</label>
    <input type="text" class="form-control" id="daily_rate" name="daily_rate" value="{{ old('daily_rate', $car->daily_rate ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="available" {{ old('status', $car->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ old('status', $car->status ?? '') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
        <option value="in_maintenance" {{ old('status', $car->status ?? '') == 'in_maintenance' ? 'selected' : '' }}>In Maintenance</option>
    </select>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $car->description ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image">
</div>
