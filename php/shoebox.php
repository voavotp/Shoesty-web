<!-- code for each shoe to be displayed in a box -->
<div class="shoebox">
    <img src="<?= $shoe['Image'] ?>" alt="<?= $shoe['Model'] ?>" class="shoebox-image">
    <h2><?=($shoe['Model']) ?></h2>
    <p><strong><?= ($shoe['Name']) ?></strong></p>
    <p><strong>Brand:</strong> <?= ($shoe['Brand']) ?></p>
    <p><strong>Price:</strong> $<?= number_format($shoe['Price'], 2) ?></p>
    <p><strong>Contact:</strong> <a href="mailto:<?= ($shoe['Email']) ?>"><?=($shoe['Email']) ?></a></p>
</div>

