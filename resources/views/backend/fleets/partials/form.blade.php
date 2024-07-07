<!-- resources/views/fleets/partials/form.blade.php -->
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $fleet->name ?? '') }}" required>
</div>
<div class="form-group">
    <label for="location">Location</label>
    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $fleet->location ?? '') }}" required>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $fleet->description ?? '') }}</textarea>
</div>
