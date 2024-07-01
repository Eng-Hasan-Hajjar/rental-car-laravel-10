<!-- resources/views/garages/partials/form.blade.php -->
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $garage->name ?? '') }}" required>
</div>
<div class="form-group">
    <label for="location">Location</label>
    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $garage->location ?? '') }}" required>
</div>
<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $garage->phone_number ?? '') }}" required>
</div>
<div class="form-group">
    <label for="working_hours">Working Hours</label>
    <input type="text" class="form-control" id="working_hours" name="working_hours" value="{{ old('working_hours', $garage->working_hours ?? '') }}" required>
</div>
