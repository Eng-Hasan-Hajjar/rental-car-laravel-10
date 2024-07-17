<div class="form-group">
    <label for="brand">العلامة التجارية</label>
    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand ?? '') }}" required>
</div>
<div class="form-group">
    <label for="model">الموديل</label>
    <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model ?? '') }}" required>
</div>
<div class="form-group">
    <label for="year">العام</label>
    <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $car->year ?? '') }}" required>
</div>
<div class="form-group">
    <label for="color">اللون</label>
    <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $car->color ?? '') }}" required>
</div>
<div class="form-group">
    <label for="seats">عدد المقاعد </label>
    <input type="number" class="form-control" id="seats" name="seats" value="{{ old('seats', $car->seats ?? '') }}" required>
</div>
<div class="form-group">
    <label for="daily_rate">تقييم يومي</label>
    <input type="text" class="form-control" id="daily_rate" name="daily_rate" value="{{ old('daily_rate', $car->daily_rate ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">الحالة  </label>
    <select class="form-control" id="status" name="status" required>
        <option value="available" {{ old('status', $car->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ old('status', $car->status ?? '') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
        <option value="in_maintenance" {{ old('status', $car->status ?? '') == 'in_maintenance' ? 'selected' : '' }}>In Maintenance</option>
    </select>
</div>
<div class="form-group">
    <label for="description">الوصف </label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $car->description ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="image">الصورة </label>
    <input type="file" class="form-control" id="image" name="image">
</div>
