<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php $this->start('welcome') ?>
            Welcome!
        <?php $this->stop() ?>
        <?=$this->section('welcome')?>
    </title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
</head>
<body>
    <?php $this->start('body') ?>
        <h1><?=$this->e($title)?></h1>
    <?php $this->stop() ?>
    <?=$this->section('body')?>
</body>
</html>
