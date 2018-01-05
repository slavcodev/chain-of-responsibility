<?php
/**
 * This file is part of Zee Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/zee/
 */

namespace Zee\Chains;

/**
 * Chain handler.
 */
interface Handler
{
    /**
     * @param mixed $payload
     * @param Stage $next
     *
     * @return mixed
     */
    public function handle($payload, Stage $next);
}
