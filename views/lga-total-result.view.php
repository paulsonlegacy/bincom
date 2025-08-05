<h2>Summed Results by LGA</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
    <label>Select Local Government Area:</label>
    <select class="form-select mb-3" name="lga">
        <?php foreach($context['lgas'] as $lga): ?>
        <option value=<?=$lga["uniqueid"]; ?>><?=$lga["lga_name"]; ?></option>
        <?php endforeach ?>
    </select>
    <button class="btn btn-success" type="submit">Show LGA Result</button>
</form>

<hr class="my-4">

<?php if ($context['search'] && !empty($context['party_results'])): ?>
<h4>Summed Results for LGA: <?=fetch_lga($context['lga_id'])['lga_name']; ?></h4>
<ul class="list-group">
    <?php foreach($context['party_results'] as $party): ?>
    <li class="list-group-item"><?=$party['party_abbreviation']; ?>: <?=$party['total_score']; ?></li>
    <?php endforeach ?>
</ul>
<?php elseif ($context['search'] && empty($context['party_results'])): ?>
<h4 class="text-danger">No Results for LGA: <?=fetch_lga($context['lga_id'])['lga_name']; ?></h4>
<?php endif ?>