<?php

declare(strict_types=1);


$model = new \Simulator\Model\FixedModelXml();

$serializer = new \Simulator\Serializer\TextModelSerializer();
$serializer->serialize($model);