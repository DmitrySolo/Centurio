<?php

class CycleManager
{
    /// SUBCYCLE
    private $itemsPerSubCycle = 100;
    private $timeoutPerSucycle = 10;



    /**
     * @return int
     */
    public function getItemsPerSubCycle(): int
    {
        return $this->itemsPerSubCycle;
    }

    /**
     * @param int $itemsPerSubCycle
     */
    public function setItemsPerSubCycle(int $itemsPerSubCycle)
    {
        $this->itemsPerSubCycle = $itemsPerSubCycle;
    }


    public function runNextSubCycle($DB)
    {
        $maxCycle = (($DB->query("SELECT MAX(cycle_id) AS max_cycle FROM sku;", PDO::FETCH_ASSOC)->fetchAll()[0]['max_cycle']));
        $minCycle = (($DB->query("SELECT MIN(cycle_id) AS min_cycle FROM sku;", PDO::FETCH_ASSOC)->fetchAll()[0]['min_cycle']));

        echo $minCycle,$maxCycle;
        if ($maxCycle == $minCycle) {
            if ($DB->query("SELECT date_time_end FROM cycles WHERE  cycle = $maxCycle AND date_time_end IS NOT NULL;", PDO::FETCH_ASSOC)->fetchAll()) {
                echo 'Start new';
            } else {
                echo "stopThis";
            };
            //ECHO END OF CYCLE AND SET ENDING TIME if no if yes start new here // ПРОВЕРЯЕМ НА ДАТУ ЗАКРЫТИя ЕСЛИ НЕТ СТАВИМ И ЗАКРЫВАЕМ ПРОЦЕСС  ЕСЛИ ЕСТЬ - НАЧИНАЕМ НОВЫЙ
        } else {
            echo "Its looks like the cycle doesnt finished its task";
//           $this->itemsPerSubCycle;
//
//
//           ($DB->query("SELECT MAX(cycle_id) AS max_cycle FROM sku;", PDO::FETCH_ASSOC)->fetchAll()[0]['max_cycle']);

        }
    }
///CYCLE
    public function run($DB){
        $this->runNextSubCycle($DB);
    }
    public function stop($DB){

    }
    public function getPercentOfCycleProgress()
    {
    }
    //RESULT
    public function getCycleResult($DB, $cycle = 'last')
    {
    }

}