<?php namespace Larangu\DirectiveNg;

use Larangu\DirectiveNg\Contracts\DirectiveGenerator;

class Generator implements DirectiveGenerator
{
    public function ngAttr($key, $expression)
    {
        return "[{$key}]=\"{$expression}\"";
    }

    public function event($event, $expression)
    {
        return "({$event})=\"{$expression}\"";
    }

    public function template($template, $expression = null)
    {
        if (is_null($expression)) {
            return "*{$template}";
        }

        return "*{$template}=\"{$expression}\"";
    }

    public function ngIf($condition)
    {
        return $this->template('ngIf', $condition);
    }

    public function ngFor($expression, $singel = null, $index = null, $trackBy = null)
    {
        if (!is_null($singel)) {
            $expression = "let {$singel} of {$expression}";
        }

        if (!is_null($index)) {
            $expression .= "; {$index}=index";
        }

        if (!is_null($trackBy)) {
            $expression .= "; trackBy:{$trackBy}";
        }

        return $this->template('ngFor', $expression);
    }

    public function ngClass($expression)
    {
        if (is_array($expression)) {
            $expression = str_replace("\"", '', json_encode($expression));
        }

        return $this->ngAttr('ngClass', $expression);
    }

    public function ngStyle($expression)
    {
        if (is_array($expression)) {
            $expression = str_replace("\"", '', json_encode($expression));
        }

        return $this->ngAttr('ngStyle', $expression);
    }

    public function ngRouterLink($expression)
    {
        return "[routerLink]=\"$expression\"";
    }

    public function ngLink($link)
    {
        return "[routerLink]=\"['{$link}']\"";
    }

    public function ngSwitch($expression)
    {
        return $this->ngAttr('ngSwitch', $expression);
    }

    public function ngSwitchCase($value)
    {
        return $this->template('ngSwitchCase', "'{$value}'");
    }

    public function ngSwitchDefault()
    {
        return $this->template('ngSwitchDefault');
    }

    public function click($expression)
    {
        return $this->event('click', $expression);
    }

    public function ngSubmit($expression)
    {
        return $this->event('ngSubmit', $expression);
    }

    public function model($key)
    {
        return "[(ngModel)]=\"{$key}\"";
    }
}
