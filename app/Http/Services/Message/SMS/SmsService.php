<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Services\Message\Interfaces\MessageInterface;

class SmsService implements MessageInterface
{

    private string $from;
    private string $text;
    private array $values;
    private string $patternCode;
    private string $to;
    private bool $is_pattern = false;

    public function fire()
    {
        $farazSms = new FarazSmsService();

        if($this->is_pattern){
            $result = $farazSms->sendPatternSmsWithApiKey($this->to, $this->values, $this->from, $this->patternCode);
        }else{
            $result = $farazSms->sendTextSmsWithApiKey($this->to, $this->text, $this->from);
        }

        return $result->getBody()->getContents();
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setValues($values)
    {
        $this->values = $values;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getPatternCode()
    {
        return $this->patternCode;
    }

    public function setPatternCode($patternCode)
    {
        $this->patternCode = $patternCode;
    }

    public function isPattern($isPattern = false){
        $this->is_pattern = $isPattern;
    }
}
