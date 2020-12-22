<?php $this->layout('layout', ['title' => 'about']) ?>

<h1>Home page</h1>
<ul>
<?php foreach ($posts as $item): ?>
    <li>
        <?php echo $item['username'] ?>
        <?php echo $item['email'] ?>
        <?php echo $item['txt'] ?>
        <?php echo $item['date'] ?>
    </li>
<?php endforeach; ?>
</ul>