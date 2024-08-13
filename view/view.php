<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam-2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="post" action="/text">
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="text" rows="5" required></textarea>

        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    <?php
    $task = new \App\Task();
    $tasks = $task->getAllTasks(); ?>

    <ul class="list-group">
        <?php foreach ($tasks as $task) : ?>
            <li class="list-group-item"><?php echo $task['text']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>