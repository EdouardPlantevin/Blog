<?php

namespace App\Core;

class Form 
{

    private $formCode = '';

    public function create()
    {
        return $this->formCode;
    }

    public static function validate(array $form, array $fields): bool
    {
        foreach($fields as $field)
        {
            if(!isset($form[$field]) || empty($form[$field]))
            {
                return false;
            }
        }
        return true;
    }

    private function addAttributes(array $attributes): string
    {
        $attrs = '';

        $shortAttrs = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        foreach($attributes as $attribute => $value)
        {
            if(in_array($attribute, $shortAttrs) && $value == true)
            {
                $attrs .= " $attribute";
            }
            else
            {
                $attrs .= " $attribute=\"$value\"";
            }
        }
        return $attrs;
    }

    public function startForm(string $method = 'post', string $action = '#', array $attributes = []):self
    {

        $this->formCode .= "<form action='$action' method='$method'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    public function endForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    public function addLabel(string $for, string $text, array $attributes = []): self
    {

        $this->formCode .= "<label for='$for'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        $this->formCode .= ">$text</label>";

        return $this;
    }

    public function addInput(string $type, string $name, array $attributes = []): self
    {
        $this->formCode .= "<input type='$type' name='$name'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes). '>' : '>';

        return $this;
    }

    public function addTextarea(string $name, string $value = '', array $attributes = []): self
    {
        $this->formCode .= "<textarea name='$name'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '>';

        $this->formCode .= ">$value</textarea>";

        return $this;
    }

    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        $this->formCode .= "<select name='$name'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        foreach($options as $value => $text)
        {
            $this->formCode .= "<option value=\"$value\">$text</option>";
        }

        $this->formCode .= "</select>";

        return $this;
    }

    public function addBtn(string $type, string $text, array $attributes = []): self
    {
        $this->formCode .= "<button type='$type'";

        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        $this->formCode .= ">$text</button>";

        return $this;
    }

}