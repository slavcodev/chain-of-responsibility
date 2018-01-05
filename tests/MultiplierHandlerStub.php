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

namespace Zee\Chains\Tests;

use Zee\Chains\Handler;
use Zee\Chains\Stage;

/**
 * Class MultiplierHandlerStub.
 */
final class MultiplierHandlerStub implements Handler
{
    /**
     * {@inheritdoc}
     */
    public function handle($payload, Stage $next)
    {
        return $next->process($payload * $payload);
    }
}
