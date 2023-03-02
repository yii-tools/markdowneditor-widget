<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests;

use PHPUnit\Framework\TestCase;
use Yii\MarkDownEditor\Asset;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\MarkDownEditor\Tests\Support\TestForm;
use Yii\MarkDownEditor\Tests\Support\TestTrait;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    public function testAutoFocusEditor(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->autoFocusEditor(false)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('autofocus: false', $this->getScript());
    }

    public function testAutoSave(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->autoSave(500)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString(
            'autosave: {"delay":500,"enabled":true,"uniqueId":"testform-string"}',
            $this->getScript(),
        );
    }

    public function testEnvironmentAssetWithCdn(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->environmentAsset('Cdn')
            ->webView($this->webView)
            ->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\MarkDownEditorCdnAsset::class));
    }

    public function testEnvironmentAssetWithDev(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->environmentAsset('Dev')
            ->webView($this->webView)
            ->render();

        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\MarkDownEditorDevAsset::class));
    }

    public function testForceSync(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->forceSync(false)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('forceSync: false', $this->getScript());
    }

    public function testGetElementId(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('element: document.getElementById("testform-string")', $this->getScript());
    }

    public function testHiddenIcons(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->hiddenIcons(['heading-1', 'heading-2', 'heading-3'])
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('hideIcons: ["heading-1","heading-2","heading-3"', $this->getScript());
    }

    public function testIndentWithTabs(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->indentWithTabs(false)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('indentWithTabs: false', $this->getScript());
    }

    public function testInitialValue(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->initialValue('Hello World')
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('initialValue: "Hello World"', $this->getScript());
    }

    public function testLineWrapping(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->lineWrapping(true)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('lineWrapping: true', $this->getScript());
    }

    public function testOption(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->option('placeholder', 'Hello World')
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('placeholder: "Hello World"', $this->getScript());
    }

    public function testPromptURLs(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->promptURLs(true)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('promptURLs: true', $this->getScript());
    }

    public function testPlaceholder(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->placeholder('Hello World')
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('placeholder: "Hello World"', $this->getScript());
    }

    public function testRender(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]"></textarea>
            HTML,
            MarkDownEditor::widget([new TestForm(), 'string'])
                ->assetManager($this->assetManager)
                ->webView($this->webView)
                ->render(),
        );
        $this->assertTrue($this->assetManager->isRegisteredBundle(Asset\MarkDownEditorProdAsset::class));
    }

    public function testShowIcons(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->showIcons(['heading-1', 'heading-2', 'heading-3'])
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('showIcons: ["heading-1","heading-2","heading-3"]', $this->getScript());
    }

    public function testSpellChecker(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->spellChecker(true)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('spellChecker: true', $this->getScript());
    }

    public function testStyleSelectedText(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->styleSelectedText(true)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('styleSelectedText: true', $this->getScript());
    }

    public function testTabSize(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->tabSize(2)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('tabSize: 2', $this->getScript());
    }

    public function testToolbar(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->toolbar(['bold', 'italic'])
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('toolbar: ["bold","italic"]', $this->getScript());
    }

    public function testToolbarTips(): void
    {
        MarkDownEditor::widget([new TestForm(), 'string'])
            ->assetManager($this->assetManager)
            ->toolbarTips(true)
            ->webView($this->webView)
            ->render();

        $this->assertStringContainsString('toolbarTips: true', $this->getScript());
    }

    private function getScript(): string
    {
        $script = '';

        /**
         * @psalm-var string[][] $getAllJs
         * @psalm-suppress MixedMethodCall
         */
        $getAllJs = Assert::inaccessibleProperty($this->webView, 'state')->getJS();

        foreach ($getAllJs as $js) {
            foreach ($js as $value) {
                $script = $value;
            }
        }

        return $script;
    }
}
