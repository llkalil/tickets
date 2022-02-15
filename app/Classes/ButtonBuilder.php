<?php

namespace App\Classes;

class ButtonBuilder
{
    protected $html = '';

    protected $action = null;

    protected $actionType = '';

    protected $color;

    protected $text;

    protected $classes = 'text-gray-600 hover:text-gray-700 mr-2';

    protected $actionParams;

    public $modalName = false;

    public function __construct($text)
    {
        $this->text = $text;
        $this->color = 'green';
    }

    public static function make($text = null)
    {
        return new static($text);
    }

    public function icon($name)
    {
        $this->text = "<i class='text-xl la $name'></i>";

        return $this;
    }

    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    public function link($href)
    {
        $this->action = $href;
        $this->actionType = 'link';

        return $this;
    }

    public function action($action)
    {
        $this->action = $action;
        $this->actionType = 'function';

        return $this;
    }

    public function openModal($component_name, ...$params)
    {
        $this->modalName = $component_name;
        $this->emit('openModal', $params);

        return $this;
    }

    public function emit($event, ...$params)
    {
        $this->action = $event;
        $this->actionType = 'event';
        $this->actionParams = func_get_arg(1);

        return $this;
    }

    public function create()
    {
        if ($this->actionType == null) {
            $this->html = $this->text;
        } elseif ($this->actionType == 'link') {
            $this->html = "<a class='{$this->getClass()}' href='{$this->action}'>{$this->text}</a>";
        } elseif ($this->actionType == 'action') {
            $this->html = "<button class='{$this->getClass()}' @click='{$this->action}'>{$this->text}</button>";
        } elseif ($this->actionType == 'event') {
            //dd($this->actionParams);
            $event_params = ! empty($this->actionParams) ? ','.json_encode($this->actionParams) : '';
            if ($this->modalName) {
                $this->html = "<button class='{$this->getClass()}' @click='window.Livewire.emit(\"{$this->action}\",\"{$this->modalName}\"{$event_params})'>{$this->text}</button>";
            } else {
                $this->html = "<button class='{$this->getClass()}' @click='window.Livewire.emit(\"{$this->action}\"{$event_params})'>{$this->text}</button>";
            }
        }

        return $this->html;
    }

    protected function getClass()
    {
        return str_replace(':color', $this->color, $this->classes);
    }

    public function color(string $string)
    {
        $this->color = $string;

        return $this;
    }
}
