<?php
        require '../srzc/bootstrap.php';
        $pdo = get_pdo();
        $events = new Calendar\Events($pdo);
        $start = new DateTimeImmutable('first day of january')
        $end = $start->modify(DateTimeImmutable('last day of December'))->modify('+ 1 day');
        $events = $events->getEventsBetween($start, $end);
        ?>

        id,nom,start,end
        <?php foreach($events as $event): ?>
        <?php $event->getId(); ?>;"<?= addlashes($event->getName()) ?>";"<?= $event->getStart->format('Y-m-d'); ?>";"
        $event->id; ?>;"<?= addlashes($event->name) ?>";"<?= $event->getEnd->format('Y-m-d'); ?>
        <?php endforeach; ?>