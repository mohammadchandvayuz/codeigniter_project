<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?= $project['id']; ?></td>
            <td><?= $project['name']; ?></td>
            <td><?= $project['description']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
