<?php $this->layout('layout', ['title' => 'Home']) ?>


<h1>Home page </h1>
<ul>

<?php foreach ($posts as $item): ?>
    <li>
        <?php echo $item['title'] ."<br>" . $item['text'] ?>
    </li>
<?php endforeach; ?>


</ul>

