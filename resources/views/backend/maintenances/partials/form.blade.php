<!-- resources/views/maintenances/partials/form.blade.php -->
<div class="form-group">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $maintenance->date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control" id="details" name="details" required>{{ old('details', $maintenance->details ?? '') }}</textarea>
</div>
