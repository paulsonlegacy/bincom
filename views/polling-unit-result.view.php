<h2>Polling Unit Result Viewer</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
    
    <label>Select Polling Unit:</label>
    <select class="form-select mb-3" name="pu" required>
        <?php foreach($context['polling_units'] as $pu): ?>
        <option value=<?=$pu["uniqueid"]; ?>><?=$pu["polling_unit_name"]; ?></option>
        <?php endforeach ?>
    </select>
    <button class="btn btn-primary" type="submit">Show PU Result</button>
</form>

<hr class="my-4">


<?php
    if ($context['search']) {
        $searched_polling_unit = fetch_pu($context['pu_id']);
    }
?>

<?php if ($context['search'] && !empty($context['pu_results'])): ?>
<h4>Results for Polling Unit: <?=$searched_polling_unit['polling_unit_name']. " (". $searched_polling_unit['polling_unit_number']. ") " ?></h4>
<ul class="list-group">
    <?php foreach($context['pu_results'] as $pu): ?>
    <li class="list-group-item"><?=$pu['party_abbreviation']; ?>: <?=$pu['party_score']; ?></li>
    <?php endforeach ?>
</ul>
<?php elseif ($context['search'] && empty($context['pu_results'])): ?>
<h4 class="text-danger">No Results for LGA: <?=$searched_polling_unit['polling_unit_name']; ?></h4>
<?php endif ?>