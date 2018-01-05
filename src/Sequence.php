<?php
/**
 * This file is part of Zee Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/zee/
 */

declare(strict_types=1);

namespace Zee\Chains;

/**
 * Chain iterable sequence.
 */
final class Sequence
{
    /**
     * @var int
     */
    private $pointer = 0;

    /**
     * @var Chain
     */
    private $chain;

    /**
     * @param Chain $chain
     */
    public function __construct(Chain $chain)
    {
        $this->chain = $chain;
    }

    /**
     * Changes pointer to next stage.
     *
     * @return Handler
     */
    public function pickNext(): Handler
    {
        ++$this->pointer;
        $handler = $this->chain->pick($this->pointer);

        return $handler;
    }

    /**
     * Rewinds sequence and returns first handler.
     *
     * @return Handler
     */
    public function pickFirst(): Handler
    {
        $this->pointer = 0;
        $handler = $this->chain->pick($this->pointer);

        return $handler;
    }
}
