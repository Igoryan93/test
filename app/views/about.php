<?php $this->layout('layout', ['title' => 'about']) ?>

<h1>About user </h1>
<p>Hello, <?=$this->e($id['username'])?></p>
<p>Email, <?=$this->e($id['email'])?></p>
<p>Text, <?=$this->e($id['text'])?></p>
<p>Data, <?=$this->e($id['date'])?></p>
