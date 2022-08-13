<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/calendar.css">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-primary mb-3">
            <a href="/index.php" class="navbar-brand">Mon calendrier</a>
        </nav>

    <?php 
    require './src/Date/Month.php';
        $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null); 
        $start = $month->getStartingDay()->modify('last monday');
    ?>
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
   <h1><?= $month->toString(); ?></h1>
   <div>
    <a href="/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
    <a href="/index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
   </div>
    </div>

    <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
    <?php for ($i = 0; $i < $month->getWeeks(); $i++): ?>
        <tr>
            <?php 
            foreach($month->days as $k => $day): 
               $date = (clone $start)->modify("+" . ($k + $i * 7) . " days")
                ?>
            <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
               <?php if ($i === 0): ?>
                <div class="calendar__weekday"><?= $day; ?></div>
                <?php endif; ?>
               <div class="calendar__day"><?= $date->format('d'); ?></div>
            </td>
            <?php endforeach; ?>
        </tr>
    <?php endfor; ?>
    </table>
    </body>
</html>