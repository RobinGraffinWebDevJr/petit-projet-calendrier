<?php
namespace Calendar;

class EventValidator {

    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data) {
        $this->validate('name', 'minLength', 3);
    }
    
}