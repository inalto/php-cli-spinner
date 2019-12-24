<?php

/*
 * This file is part of the Spinner package.
 *
 * (c) Alexey Popov <alexey.popov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spinner;

class Spinner
{
    /**
     * @var array
     */
    private $frames = [];

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $current;

    /**
     * @var int
     * terminal width
     */
    private $width;

    /**
     * @var boolean
     */

    /**
     * Spinner constructor.
     *
     * @param array $frames
     */
    public function __construct(array $frames,$pad = true)
    {
        $this->frames  = $frames;
        $this->length  = count($this->frames);
        $this->current = 0;
        $this->pad = $pad;
        $this->width = exec('tput cols');
    }

    /**
     * @param string $message
     */
    public function tick(string $message)
    {
        $next = $this->next();
        if ($this->pad) {
            $message=str_pad($message,$this->width - strlen($this->frames[0]));
        }

        echo chr(27).'[0G';
        echo sprintf('%s %s', $this->frames[$next], $message);
    }

    /**
     * @return int
     */
    private function next(): int
    {
        $prev          = $this->current;
        $this->current = $prev + 1;

        if ($this->current >= $this->length - 1) {
            $this->current = 0;
        }

        return $prev;
    }
}
