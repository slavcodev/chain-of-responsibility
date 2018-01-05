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
 * Chain stage.
 */
final class Stage
{
    /**
     * @var Sequence
     */
    private $iterator;

    /**
     * @param Sequence $iterator
     */
    public function __construct(Sequence $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * {@inheritdoc}
     */
    public function process($payload)
    {
        $handler = $this->iterator->pickNext();
        $payload = $handler->handle($payload, $this);

        return $payload;
    }
}
