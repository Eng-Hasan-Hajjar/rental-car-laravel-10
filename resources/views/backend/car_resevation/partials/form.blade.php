<!-- resources/views/reservations/partials/form.blade.php -->
<div class="form-group">
    <label for="start_date">Start Date</label>
    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $reservation->start_date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="end_date">End Date</label>
    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $reservation->end_date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="pending" {{ (old('status', $reservation->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
        <option value="confirmed" {{ (old('status', $reservation->status ?? '') == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
        <option value="cancelled" {{ (old('status', $reservation->status ?? '') == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>
