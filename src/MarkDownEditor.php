<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor;

use InvalidArgumentException;
use JsonException;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\Exception\InvalidConfigException;
use Yiisoft\Strings\Inflector;
use Yiisoft\View\WebView;

use function array_key_exists;
use function in_array;
use function is_string;
use function json_encode;

final class MarkDownEditor extends AbstractInputWidget
{
    use Attribute\HasCols;
    use Attribute\HasRows;
    use Attribute\HasWrap;

    private AssetManager|null $assetManager = null;
    /** @psalm-var array<string, mixed> $editorOptions */
    private array $editorOptions = [];
    private string $environmentAsset = 'Prod';
    private array $toolbar = [
        'bold',
        'italic',
        'strikethrough',
        'heading',
        'heading-smaller',
        'heading-bigger',
        'heading-1',
        'heading-2',
        'heading-3',
        'code',
        'quote',
        'unordered-list',
        'ordered-list',
        'link',
        'image',
        'table',
        'horizontal-rule',
        'preview',
        'side-by-side',
        'fullscreen',
        'guide',
    ];
    private WebView|null $webView = null;

    /**
     * Returns a new instance with the specified asset manager instance.
     *
     * @param AssetManager $assetManager The asset manager instance.
     */
    public function assetManager(AssetManager $assetManager): self
    {
        $new = clone $this;
        $new->assetManager = $assetManager;

        return $new;
    }

    /**
     * Returns a new instance specifying autofocuses the editor.
     *
     * @param bool $value Whether to autofocus the editor. Defaults to `false`.
     */
    public function autoFocusEditor(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['autofocus'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying saves the text that's being written and will load it back in the future.
     * It will forget the text when the form it's contained in is submitted.
     *
     * @param int $delay The delay in milliseconds between each save. Defaults to `1000`.
     */
    public function autoSave(int $delay): self
    {
        $new = clone $this;
        $new->editorOptions['autosave'] = [
            'delay' => $delay,
            'enabled' => true,
            'uniqueId' => $this->getId(),
        ];

        return $new;
    }

    /**
     * Returns a new instance with the specified environment of asset.
     *
     * @param string $value The environment of assets. Acceptable values are `dev`, `prod` and `cdn`. Defaults to
     * 'prod'.
     *
     * @throws InvalidArgumentException If the environment asset is invalid.
     */
    public function environmentAsset(string $value): self
    {
        if (!in_array($value, ['Cdn', 'Dev', 'Prod'], true)) {
            throw new InvalidArgumentException('Invalid environment asset: ' . $value . '.');
        }

        $new = clone $this;
        $new->environmentAsset = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying force text changes made in SimpleMDE to be immediately stored in original
     * textarea.
     *
     * @param bool $value Whether to force text changes made in SimpleMDE to be immediately stored in original textarea.
     * Defaults to `false`.
     */
    public function forceSync(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['forceSync'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying an array of icon names to hide. Can be used to hide specific icons shown by
     * default without completely customizing the toolbar.
     *
     * @param array $icons The icon names to hide. Defaults to `[]`.
     */
    public function hiddenIcons(array $icons): self
    {
        $this->validateIconsToolbar($icons);

        $new = clone $this;
        $new->editorOptions['hideIcons'] = $icons;

        return $new;
    }

    /**
     * Returns a new instance specifying indent using spaces instead of tabs.
     *
     * @param bool $value Whether to indent using spaces instead of tabs. Defaults to `true`.
     */
    public function indentWithTabs(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['indentWithTabs'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the initial value of the editor.
     *
     * @param mixed $value The initial value of the editor. Defaults to `''`.
     */
    public function initialValue(mixed $value): self
    {
        $new = clone $this;
        $new->editorOptions['initialValue'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying disable line wrapping.
     *
     * @param bool $value Whether to disable line wrapping. Defaults to `false`.
     */
    public function lineWrapping(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['lineWrapping'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the options for the editor.
     *
     * @param string $attribute The name of the option.
     * @param mixed $value The value of the option.
     */
    public function option(string $attribute, mixed $value): self
    {
        $new = clone $this;
        $new->editorOptions[$attribute] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the placeholder text to display when the editor is empty.
     *
     * @param string $value The placeholder text to display when the editor is empty. Defaults to `''`.
     */
    public function placeholder(string $value): self
    {
        $new = clone $this;
        $new->editorOptions['placeholder'] = $value;

        return $new;
    }

    /**
     * Returns a new instance that specifies whether a JS alert window requests the image URL or link. Defaults to
     * `false`.
     */
    public function promptURLs(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['promptURLs'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the icons to show in the toolbar.
     *
     * @param array $icons The icon names to show. Defaults to `[]`.
     */
    public function showIcons(array $icons): self
    {
        $this->validateIconsToolbar($icons);

        $new = clone $this;
        $new->editorOptions['showIcons'] = $icons;

        return $new;
    }

    /**
     * Returns a new instance specifying whether spell checking is enabled.
     *
     * @param bool $value Whether spell checking is enabled. Defaults to `false`.
     */
    public function spellChecker(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['spellChecker'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying whether to style the selected text.
     *
     * @param bool $value Whether to style the selected text. Defaults to `false`.
     */
    public function styleSelectedText(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['styleSelectedText'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the tab size.
     *
     * @param int $value The tab size. Defaults to `2`.
     */
    public function tabSize(int $value): self
    {
        $new = clone $this;
        $new->editorOptions['tabSize'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the toolbar configuration.
     *
     * @param array $toolbar The toolbar configuration. Defaults to `[]`.
     */
    public function toolbar(array $toolbar): self
    {
        $this->validateIconsToolbar($toolbar);

        $new = clone $this;
        $new->editorOptions['toolbar'] = $toolbar;

        return $new;
    }

    /**
     * Returns a new instance specifying whether to show tooltips for toolbar buttons.
     *
     * @param bool $value Whether to show tooltips for toolbar buttons. Defaults to `false`.
     */
    public function toolbarTips(bool $value): self
    {
        $new = clone $this;
        $new->editorOptions['toolbarTips'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the webview instance.
     *
     * @param webView $value The webview instance.
     */
    public function webView(webView $value): self
    {
        $new = clone $this;
        $new->webView = $value;

        return $new;
    }

    /**
     * @throws InvalidArgumentException If the `assetManager` or `webView` properties are not set.
     * @throws InvalidConfigException If an error occurs during register asset.
     * @throws JsonException If an error occurs during encoding.
     */
    protected function beforeRun(): bool
    {
        if ($this->assetManager === null) {
            throw new InvalidArgumentException('The `assetManager()` property must be set.');
        }

        if ($this->webView === null) {
            throw new InvalidArgumentException('The `webView()` property must be set.');
        }

        $this->assetManager->register('Yii\MarkDownEditor\Asset\MarkDownEditor' . $this->environmentAsset . 'Asset');
        $this->webView->registerJs($this->getScript());

        return parent::beforeRun();
    }

    protected function run(): string
    {
        return $this->renderTextArea();
    }

    /**
     * @throws JsonException If an error occurs during encoding.
     */
    private function getScript(): string
    {
        $config = '';
        $editorOptions = $this->editorOptions;
        $editorOptions['element'] = 'element: document.getElementById("' . $this->getId() . '"), ';

        if (!isset($editorOptions['toolbar'])) {
            $editorOptions['toolbar'] = $this->toolbar;
        }

        $varName = (new Inflector())->toPascalCase($this->getId());

        /** @psalm-var mixed $value */
        foreach ($editorOptions as $attribute => $value) {
            $config .= match ($attribute) {
                'element' => (string) $value,
                default => $attribute . ': ' . json_encode($value, JSON_THROW_ON_ERROR),
            };
        }

        return "var $varName = new SimpleMDE({ $config });";
    }

    /**
     * @throws InvalidArgumentException If the `value` parameter is not a string or null.
     */
    private function renderTextArea(): string
    {
        $attributes = $this->attributes;

        $content = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue(),
        };

        unset($attributes['value']);

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/syntax.html#contents
         */
        if (!is_string($content) && null !== $content) {
            throw new InvalidArgumentException('TextArea widget must be a string or null value.');
        }

        $attributes['id'] = $this->getId();

        return $this->renderInput('textarea', (string) $content, null, $attributes);
    }

    /**
     * @throws InvalidArgumentException If the `icons` parameter contains invalid toolbar items.
     */
    private function validateIconsToolbar(array $icons): void
    {
        /** @psalm-var string[] $icons */
        foreach ($icons as $icon) {
            if (!in_array($icon, $this->toolbar, true)) {
                throw new InvalidArgumentException('Invalid toolbar item: ' . $icon);
            }
        }
    }
}
