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
 * Chain of the responsibility.
 */
final class Chain implements Handler
{
    /**
     * @var Sequence
     */
    private $iterator;

    /**
     * @var Stage
     */
    private $stage;

    /**
     * @var Handler[]
     */
    private $handlers;

    /**
     * @var int
     */
    private $count;

    /**
     * Init chain.
     */
    public function __construct()
    {
        $this->handlers = [new NoopHandler()];
        $this->count = 0;
        $this->iterator = new Sequence($this);
        $this->stage = new Stage($this->iterator);
    }

    /**
     * @param Handler $handler
     *
     * @return Chain
     */
    public function push(Handler $handler): self
    {
        $this->handlers[] = $handler;
        ++$this->count;

        return $this;
    }

    /**
     * Picks handler by index.
     *
     * @param int $index
     *
     * @return Handler
     */
    public function pick(int $index): Handler
    {
        return $this->handlers[($index + 1) * ($index < $this->count)];
    }

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    public function process($payload)
    {
        $handler = $this->iterator->pickFirst();
        $payload = $handler->handle($payload, $this->stage);

        return $payload;
    }

    /**
     * Allows reuse the chain as handler of the another.
     *
     * {@inheritdoc}
     */
    public function handle($payload, Stage $next)
    {
        return $next->process($this->process($payload));
    }
}
