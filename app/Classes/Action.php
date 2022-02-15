<?php


namespace App\Classes;


use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Action extends Column
{
    public bool $asDropdown = false;
    protected $buttons = [];
    protected $button = '';

    public function __construct(string $text = null, string $column = null)
    {
        $column = null;
        parent::__construct($text, $column);
    }

    public function asDropdown()
    {
        $this->asDropdown = true;
        return $this;
    }

    public function formatted($row, $column = null): HtmlString
    {
        if ($column instanceof self) {
            $columnName = $column->column();
        } elseif (is_string($column)) {
            $columnName = $column;
        } else {
            $columnName = $this->column();
        }

        $value = data_get($row, $columnName);

        if (!$this->asDropdown && count($this->buttons) >= 1 ) {

            collect($this->buttons)->each(function ($button) use ($column, $row, $value) {
                $this->button .= call_user_func($button, $value, $column, $row);
            });


            $this->asHtml = true;

            $result = new HtmlString($this->button);
            $this->button = '';
            return $result;
        }else{
            return $this->buildDropdown($row, $column, $value);
        }

    }

    /**
     * @param null $callback
     * @return $this
     */
    public function addButton($callback = null): Action
    {
        $this->buttons[] = $callback;

        return $this;
    }

    private function buildDropdown($row, ?string $column, $value)
    {
        $buttons = collect($this->buttons)->map(function ($button) use ($column, $row, $value) {
            return call_user_func($button, $value, $column, $row);
        });

        return new HtmlString(view('components.table-dropdown.base',compact('buttons'))->render());
    }
}