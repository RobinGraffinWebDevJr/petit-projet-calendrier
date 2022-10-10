<?php
namespace Calendar;

class Month {

    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;



    /**
     * Month constructor
     * @param int $month Le mois compris entre  1 et 12
     * @param int $year L'année
     * @throws \Exception
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Renvoie le 1er jour du mois
     * @return \Datetime
     */
    public function getStartingDay (): \DatetimeInterface {
       return new \DatetimeImmutable("{$this->year}-{$this->month}-01");
    }

    /**
     * Retourne le mois en toute lettre (ex: Mars 2022)
     * @return string
     * @throws \Exception
     */
    public function toString (): string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }


    /**
     * Renvoie le nombre de semaines dans le mois
     * @return int
     */
    public function getWeeks(): int {
        $start = $this->getStartingDay();
        $end =  $start->modify('+1 month -1 day');
        $startWeek = intval($start->format('W'))
        $endWeek = intval($end->format('W'))
        if ($endWeek === 1) {
            $endWeek =  intval($end->modify('-7 days')->format('W')) + 1;
        }
        $weeks = $endWeek - $startWeek + 1;
        if ($weeks < 0) {
            $weeks = intval($end->format('W'));
        }
        return $weeks;
    }


    /**
     * Est-ce que le jour est dans le mois en cours
     * @param \DatetimeInterface $date
     * @return bool
     * @throws \Exception
     */
    public function withinMonth (\DatetimeInterface $date): bool {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Renvoie le mois suivant
     * @return Month
     */
    public function nextMonth (): Month
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**
     * Renvoie le mois précédent
     * @return Month
     */
    public function previousMonth (): Month
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }
}