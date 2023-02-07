<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\MarkDownEditor\Tests\Support\TestForm;
use Yii\MarkDownEditor\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TextArea widget must be a string or null value.');

        MarkDownEditor::widget([new TestForm(), 'string'])->attributes(['value' => 1])->render();
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testEnvironmentAsset(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid environment asset: test');

        MarkDownEditor::widget([new TestForm(), 'string'])->environmentAsset('test');
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHiddenIcons(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test');

        MarkDownEditor::widget([new TestForm(), 'string'])->hiddenIcons(['test']);
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testShowIcons(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test');

        MarkDownEditor::widget([new TestForm(), 'string'])->showIcons(['test']);
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testToolbar(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test1');

        MarkDownEditor::widget([new TestForm(), 'string'])->toolbar(['test1']);
    }
}
