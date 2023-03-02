<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\MarkDownEditor\Tests\Support\TestForm;
use Yii\MarkDownEditor\Tests\Support\TestTrait;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    use TestTrait;

    public function testAssetManager(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The `assetManager()` property must be set.');

        MarkDownEditor::widget([new TestForm(), 'string'])
            ->attributes(['value' => 1])
            ->webView($this->webView)
            ->render();
    }

    public function testContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TextArea widget must be a string or null value.');

        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->attributes(['value' => 1])
            ->webView($this->webView)
            ->render();
    }

    public function testEnvironmentAsset(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid environment asset: test.');

        MarkDownEditor::widget([new TestForm(), 'string'])->environmentAsset('test');
    }

    public function testHiddenIcons(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test');

        MarkDownEditor::widget([new TestForm(), 'string'])->hiddenIcons(['test']);
    }

    public function testShowIcons(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test');

        MarkDownEditor::widget([new TestForm(), 'string'])->showIcons(['test']);
    }

    public function testToolbar(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid toolbar item: test1');

        MarkDownEditor::widget([new TestForm(), 'string'])->toolbar(['test1']);
    }

    public function testWebView(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The `webView()` property must be set.');

        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->attributes(['value' => 1])
            ->render();
    }
}
