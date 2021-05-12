<?php

abstract class Node
{
    /**
     * The line number in the source file that defines this node
     */
    public int $line;

    /**
     * The lines of text from source file that defines this node
     */
    public array $lines;

    public function __construct(int $line, array $lines)
    {
        $this->line = $line;
        $this->lines = $lines;
    }

    public function echo(): void
    {
        echo implode("\n", $this->lines) . "\n";
    }

    abstract public function equals(Node $other): bool;

    public function canMerge(Node $other): bool
    {
        if ($this->equals($other)) {
            return true;
        }

        return false;
    }

    abstract public function mergeWith(Node $other): ?Node;
}

class EmptyLine extends Node
{
    public function equals(Node $other): bool
    {
        return $other instanceof EmptyLine;
    }

    public function mergeWith(Node $other): ?self
    {
        return $other instanceof EmptyLine ? new EmptyLine(0, ['']) : null;
    }
}

class Section extends Node
{
    public Header $header;
    /**
     * @var Node[]
     */
    public array $content;

    public function __construct(int $line, array $lines, Header $header, array $content)
    {
        parent::__construct($line, $lines);

        $this->header = $header;
        $this->content = $content;
    }

    public function equals(Node $other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        if (!$this->header->equals($other->header)) {
            return false;
        }

        $tHead = 0;
        $oHead = 0;

        while ($tHead < count($this->content) && $oHead < count($other->content)) {
            if ($this->content[$tHead] instanceof EmptyLine) {
                ++$tHead;

                continue;
            }
            if ($other->content[$oHead] instanceof EmptyLine) {
                ++$oHead;

                continue;
            }

            if (!$this->content[$tHead]->equals($other->content[$oHead])) {
                return false;
            }

            ++$tHead;
            ++$oHead;
        }

        return true;
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

    public function equals(Node $other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        return $this->level === $other->level && $this->content === $other->content;
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

    public function equals(Node $other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        return $this->content === $other->content;
    }
}


class ListItem extends Node
{
    public ListItemHeader $header;
    /**
     * @var string[]
     */
    public array $content;

    public function __construct(int $line, array $lines, ListItemHeader $header, array $content)
    {
        parent::__construct($line, $lines);

        $this->header = $header;
        $this->content = $content;
    }

    public function equals(Node $other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        if (!$this->header->equals($other->header)) {
            return false;
        }


        if (count($this->content) !== count($other->content)) {
            return false;
        }

        for ($i = 0; $i < count($this->content); $i++) {
            if ($this->content[$i] !== $other->content[$i]) {
                return false;
            }
        }

        return true;
    }
}

class ItemList extends Node
{
    /**
     * @var ListItem[]
     */
    public array $items;

    public function __construct(int $line, array $lines, array $items)
    {
        parent::__construct($line, $lines);

        $this->items = $items;
    }

    public function equals(Node $other): bool
    {
        if (!($other instanceof self)) {
            return false;
        }

        if (count($this->items) !== count($other->items)) {
            return false;
        }

        for ($i = 0; $i < count($this->items); $i++) {
            if (!$this->items[$i]->equals($other->items[$i])) {
                return false;
            }
        }

        return true;
    }
}
