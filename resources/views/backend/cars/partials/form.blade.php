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
    <label for="daily_rate">الأجرة اليومية</label>
    <input type="text" class="form-control" id="daily_rate" name="daily_rate" value="{{ old('daily_rate', $car->daily_rate ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">الحالة  </label>
    <select class="form-control" id="status" name="status" required>
        <option value="متوفرة" {{ old('status', $car->status ?? '') == 'متوفرة' ? 'selected' : '' }}>متوفر</option>
        <option value="غير متوفرة" {{ old('status', $car->status ?? '') == 'غير متوفرة' ? 'selected' : '' }}>غير متوفر</option>
        <option value="في الصيانة" {{ old('status', $car->status ?? '') == 'في الصيانة' ? 'selected' : '' }}>في الصيانة </option>
    </select>
</div>
<div class="form-group">
    <label for="description">الوصف </label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $car->description ?? '') }}</textarea>
</div>


