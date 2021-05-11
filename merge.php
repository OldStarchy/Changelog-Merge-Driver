<?php

require 'types.php';

class ChangelogReader
{
    private $content;
    private $lines;
    private $head;

    public function __construct(string $file)
    {
        $this->content = file_get_contents($file);
        $this->lines = explode("\n", $this->content);
        $this->head = 0;
    }

    public function readSection()
    {
        $mark = $this->mark();
        $header = $this->readHeader();

        if ($header === null) {
            return;
        }

        $content = [];
        while (!$this->eof() && !$this->peek($this->readHeader())) {
            $content[] = $this->readEmpty() ?? $this->readList() ?? $this->readLine();
        }

        return new Section(
            $mark,
            $this->lines($mark),
            $header,
            $content,
        );
    }

    public function readList()
    {
        $mark = $this->mark();

        $item = $this->readListItem();

        if ($item === null) {
            $this->reset($mark);

            return;
        }

        $items = [$item];
        while (!$this->eof() && ($item = $this->readListItem()) !== null) {
            $items[] = $item;
        }

        return new ItemList(
            $this->$mark,
            $this->lines($mark),
            $items,
        );
    }

    public function readListItem()
    {
        $mark = $this->mark();

        $header = $this->readListItemHeader();

        if ($header === null) {
            $this->reset($mark);

            return;
        }

        $content = [];
        while (!$this->eof() &&
            (
                $this->peek($this->readEmpty()) ??
                $this->peek($this->readListItemHeader())
            ) !== null
        ) {
            $content[] = $this->readLine();
        }

        return new ListItem(
            $mark,
            $this->lines($mark),
            $header,
            $content,
        );
    }

    public function peek(?Node $part)
    {
        if ($part !== null) {
            $this->reset($part->line);
        }

        return $part;
    }

    public function readListItemHeader()
    {
        $mark = $this->mark();

        $line = $this->readLine();

        if (preg_match('/^(-|\*)( {:3}|\t)(.*)$/', $line, $matches)) {
            return new ListItemHeader(
                $mark,
                $this->lines($mark),
                $matches[4],
            );
        }

        $this->reset($mark);
    }

    public function readEmpty()
    {
        $mark = $this->mark();
        $line = $this->readLine();
        if ($line === '') {
            return new EmptyLine($mark, $this->lines($mark));
        }

        $this->reset($mark);
    }

    public function lines(int $mark)
    {
        return array_slice($this->lines, $mark, $this->head - $mark);
    }

    public function mark(): int
    {
        return $this->head;
    }

    public function reset(int $mark)
    {
        $this->head = $mark;
    }

    public function readLine()
    {
        return $this->lines[$this->head++];
    }

    public function eof()
    {
        return $this->head >= count($this->lines);
    }

    public function readHeader()
    {
        $mark = $this->mark();

        $line = $this->readLine();

        if (preg_match('/^(#+)\s*(.*)$/', $line, $matches)) {
            return new Header(
                $mark,
                $this->lines($mark),
                strlen($matches[1]),
                $matches[2],
            );
        }
        $this->reset($mark);
    }
}

class Writer
{
    public $buffer = [];

    public function conflict(array $ours, array $theirs)
    {
        //TODO: refspec "<<<<<<< HEAD:file.txt"
        $lines[] = '<<<<<<<';

        $this->lines($ours);

        $lines[] = '=======';

        $this->lines($theirs);

        $lines[] = '>>>>>>>';
    }

    public function lines(array $lines)
    {
        foreach ($lines as $line) {
            $this->buffer[] = $line;
        }
    }
}

function compareSemver($a, $b)
{
    $ap = explode('.', $a);
    $bp = explode('.', $b);

    for ($i = 2; $i >= 0; $i--) {
        if ($ap[$i] > $bp[$i]) {
            return 1;
        }
        if ($ap[$i] < $bp[$i]) {
            return -1;
        }
    }

    return 0;
}

function compareListItem(ListItem $a, ListItem $b)
{
    // punctuation at the top (eg. "[")
    // Care about numbers eg. 20 > 12 > 2 > 1
}

function mergeItemList(ItemList $a, ItemList $b)
{
    // Sort each list
    // merge lists removing duplicates

    //TODO: do the above psudo code not this temp hack
    return new ItemList(
        0,
        array_merge($a->lines, $b->lines),
        array_merge($a->items, $b->items),
    );
}

$oursFile = 'test/ours.md';
$theirsFile = 'test/theirs.md';

$ours = new ChangelogReader($oursFile);
$theirs = new ChangelogReader($theirsFile);

$output = new Writer();

while (!$ours->eof() && !$theirs->eof()) {
    $oursMark = $ours->mark();
    $theirsMark = $theirs->mark();

    $oursPart = $ours->readSection();
    $theirsPart = $theirs->readSection();

    $oursHeader = $oursPart->header;
    $theirsHeader = $theirsPart->header;

    if ($oursHeader->level === 1 && $theirsHeader->level === 1) {
        if ($oursHeader->content !== $theirsHeader->content) {
            $output->conflict($oursPart->lines, $theirsPart->lines);
        } else {
            $output->lines($theirsPart->lines);
        }

        continue;
    }

    if ($oursHeader->level === 1) {
        $output->lines($oursPart->lines);
        $theirs->reset($theirsMark);

        continue;
    }
    if ($oursHeader->level === 1) {
        $output->lines($theirsPart->lines);
        $ours->reset($oursMark);

        continue;
    }


    if ($oursHeader->level === 2 && $theirsHeader->level === 2) {
        $oursName = strtolower($oursHeader->content);
        $theirsName = strtolower($theirsHeader->content);

        $oursNew = in_array($oursName, ['patch', 'minor', 'major']);
        $theirsNew = in_array($theirsName, ['patch', 'minor', 'major']);

        if ($oursNew && $theirsNew) {
            $significance =
                ($oursName === 'major' || $thiersName === 'major') ? 'Major' :
                (($oursName === 'minor' || $thiersName === 'minor') ? 'Minor' :
                'Patch');

            $output->lines(["## ${significance}"]);

            //todo merge changelog notes
            $output->lines($oursPart->content);
            $output->lines($theirsPart->content);

            continue;
        }

        if ($oursNew) {
            $output->lines($oursPart->lines);
            $theirs->reset($theirsMark);

            continue;
        }
        if ($theirsNew) {
            $output->lines($theirsPart->lines);
            $ours->reset($oursMark);

            continue;
        }

        $diff = compareSemver($oursHeader->content, $theirsHeader->content);
        if ($diff > 0) {
            $output->lines($oursPart->lines);
            $theirs->reset($theirsMark);

            continue;
        }
        if ($diff < 0) {
            $output->lines($theirsPart->lines);
            $ours->reset($oursMark);

            continue;
        }

        //TODO: proper merge
        $output->lines($oursPart->lines);
    }
}


echo implode("\n", $output->buffer);
