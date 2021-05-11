<?php

class Node
{
    public int $line;
    public array $lines;

    public function __construct(int $line, array $lines)
    {
        $this->line = $line;
        $this->lines = $lines;
    }

    public function echo()
    {
        echo implode("\n", $this->lines) . "\n";
    }
}

class EmptyLine extends Node
{
}

class Section extends Node
{
    public Header $header;
    public array $content;

    public function __construct(int $line, array $lines, Header $header, array $content)
    {
        parent::__construct($line, $lines);

        $this->header = $header;
        $this->content = $content;
    }
}

class Header extends Node
{
    public int $level;
    public string $content;

    public function __construct(int $line, array $lines, int $level, string $content)
    {
        parent::__construct($line, $lines);

        $this->level = $level;
        $this->content = $content;
    }
}

class ListItemHeader extends Node
{
    public string $content;

    public function __construct(int $line, array $lines, string $content)
    {
        parent::__construct($line, $lines);

        $this->content = $content;
    }
}


class ListItem extends Node
{
    public ListItemHeader $header;
    public array $content;

    public function __construct(int $line, array $lines, ListItemHeader $header, array $content)
    {
        parent::__construct($line, $lines);

        $this->header = $header;
        $this->content = $content;
    }
}

class ItemList extends Node
{
    public array $items;

    public function __construct(int $line, array $lines, array $items)
    {
        parent::__construct($line, $lines);

        $this->items = $items;
    }
}
