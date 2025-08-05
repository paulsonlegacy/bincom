<h2>Add New Polling Unit Result</h2>
<form>
    <div class="mb-3">
        <label for="pu_id" class="form-label">Polling Unit ID</label>
        <input type="text" class="form-control" id="pu_id" name="pu_id" required>
    </div>
    <div class="mb-3">
        <label for="party" class="form-label">Party Abbreviation</label>
        <input type="text" class="form-control" id="party" name="party" required>
    </div>
    <div class="mb-3">
        <label for="score" class="form-label">Score</label>
        <input type="number" class="form-control" id="score" name="score" required>
    </div>
    <div class="mb-3">
        <label for="user" class="form-label">Entered By</label>
        <input type="text" class="form-control" id="user" name="user" required>
    </div>
    <button type="submit" class="btn btn-warning">Submit</button>
</form>

<hr class="my-4">
<!-- Insert success or error message dynamically -->
<div class="alert alert-success d-none">Result added successfully!</div>