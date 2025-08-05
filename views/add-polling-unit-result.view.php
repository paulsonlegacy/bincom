<h2>Add New Polling Unit Result</h2>

<?php if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?= $_SESSION['message_tag']; ?> my-2"><?= $_SESSION['message']; ?></div>
<?php endif ?>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
    <div class="mb-3">
        <label for="pu_id" class="form-label">Polling Unit</label>
        <select class="form-select mb-3" name="polling_unit" required>
            <?php foreach($context['polling_units'] as $pu): ?>
            <option value=<?=$pu["uniqueid"]; ?>><?=$pu["polling_unit_name"]; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="party" class="form-label">Party Abbreviation</label>
        <input type="text" class="form-control" id="party" name="party_abbreviation" maxlength="7" required>
    </div>
    <div class="mb-3">
        <label for="score" class="form-label">Score</label>
        <input type="number" class="form-control" id="score" name="party_score" maxlength="12" required>
    </div>
    <div class="mb-3">
        <label for="user" class="form-label">Entered By</label>
        <input type="text" class="form-control" id="user" name="user" maxlength="60" required>
    </div>
    <button type="submit" class="btn btn-warning">Submit</button>
</form>