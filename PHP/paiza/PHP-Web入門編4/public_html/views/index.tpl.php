<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Player List</h1>
    	<p><?= $message ?></p>

        <?php foreach ($players as $player) { ?>
            <p>
                <?= $player->id ?>,
                <?= $player->name ?>,
                <?= $player->level ?>,
                <?= $player->job->job_name ?>,
                <a href='show_player.php?id=<?= $player->id ?>'>表示</a>
            </p>
        <?php } ?>

        <h2>Job List</h2>

        <?php foreach ($jobs as $job) { ?>
            <p>
    			<?= $job->id ?>,
    			<?= $job->job_name ?>,
    			<?= $job->vitality ?>,
                <?= $job->strength ?>,
                <a href='show_job.php?id=<?= $job->id ?>'>表示</a>
    		</p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
