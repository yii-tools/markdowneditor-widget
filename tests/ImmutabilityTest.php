<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests;

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
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testImmutability(): void
    {
        $markDownEditor = MarkDownEditor::widget([new TestForm(), 'string']);

        $this->assertNotSame($markDownEditor, $markDownEditor->autoFocusEditor(true));
        $this->assertNotSame($markDownEditor, $markDownEditor->autoSave(1000));
        $this->assertNotSame($markDownEditor, $markDownEditor->environmentAsset('Prod'));
        $this->assertNotSame($markDownEditor, $markDownEditor->forceSync(true));
        $this->assertNotSame($markDownEditor, $markDownEditor->hiddenIcons(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->indentWithTabs(true));
        $this->assertNotSame($markDownEditor, $markDownEditor->initialValue('initial value'));
        $this->assertNotSame($markDownEditor, $markDownEditor->lineWrapping(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->option('autofocus', true));
        $this->assertNotSame($markDownEditor, $markDownEditor->placeholder('placeholder'));
        $this->assertNotSame($markDownEditor, $markDownEditor->promptURLs(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->showIcons(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->spellChecker(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->styleSelectedText(false));
        $this->assertNotSame($markDownEditor, $markDownEditor->tabSize(4));
        $this->assertNotSame($markDownEditor, $markDownEditor->toolbar(['heading-1', 'heading-2', 'heading-3']));
        $this->assertNotSame($markDownEditor, $markDownEditor->toolbarTips(false));
    }
}
