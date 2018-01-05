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

use Zee\Chains\Chain;

/**
 * Class ChainTest.
 */
final class ChainTest extends TestCase
{
    /**
     * @test
     */
    public function useChain()
    {
        $chain = (new Chain())
            ->push(new MultiplierHandlerStub())
            ->push(new MultiplierHandlerStub())
        ;

        self::assertSame(2 * 2 * 4, $chain->process(2));
    }

    /**
     * @test
     */
    public function reuseChain()
    {
        $chain = (new Chain())
            ->push(new MultiplierHandlerStub())
            ->push(new MultiplierHandlerStub())
        ;

        $chain = (new Chain())
            ->push(new MultiplierHandlerStub())
            ->push($chain)
            ->push(new MultiplierHandlerStub())
        ;

        self::assertSame(2 * 2 * 4 * 16 * 256, $chain->process(2));
    }
}
