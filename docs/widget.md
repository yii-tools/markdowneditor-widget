# Markdown editor widget

The markdown editor widget is a wrapper for the [SimpleMDE](https://simplemde.com/) editor, the assets are registered in the view automatically when the widget is used, and the editor is rendered. You must set the `assetManager` component `Yiisoft\Assets\AssetManager::class` and the `view` component `Yiisoft\View\WebView::class`.

## Example of usage simple in the view

```php
<?php

declare(strict_types=1);

use Yii\MarkDownEditor\MarkDownEditor;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \Yiisoft\View\WebView $this
 */
?>

<?= MarkDownEditor::widget([$form, 'message'])
    ->assetManager($assetManager)
    ->autoFocusEditor()
    ->autoSave(2000)
    ->webView($webView)
    ->initialValue('Write your message here...')
?>
```

## Example of usage with Field::class in the view

```php
<?php

declare(strict_types=1);

use Yii\Forms\Component\Field;
use Yii\MarkDownEditor\MarkDownEditor;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \Yiisoft\View\WebView $this
 */
?>

<?= Field::widget([MarkDownEditor::widget([$form, 'message'])])
    ->assetManager($assetManager)
    ->containerClass('mt-3')
    ->webView($webView)
    ->notLabel()
?>
```

It is suggested to use [cebe/markdown](https://github.com/cebe/markdown), which is a fast and easy to use markdown parser for PHP.

## Example of usage in the controller

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactForm;
use cebe\markdown\GithubMarkdown;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Method;

final class ContactAction
{
    public function run(
        GithubMarkdown $parser,
        ServerRequestInterface $serverRequest,
        ViewRenderer $viewRenderer
    ): ResponseInterface {
        /** @psalm-var array<string, mixed> */
        $body = $serverRequest->getParsedBody();
        $method = $serverRequest->getMethod();

        $contactForm =  new ContactForm();

        if ($method === Method::POST && $contactForm->load($body)) {
            $message = '';

            if ($contactForm->getMessage() !== '') {
                $message = $parser->parse($contactForm->getMessage());
            }
 
    	    // your code here ...
        }

        // your code here ...
    }
}
```

## Methods of the widget

All methods are available on the widget instance.

Method                | Parameter        | Description                                                                                                           | Default
----------------------|------------------|-----------------------------------------------------------------------------------------------------------------------|---------
`assetManager()`      | `AssetManager`   | Returns a new instance specifying the asset manager.                                                                  | `null`
`autoFocusEditor()`   | `bool`           | Returns a new instance specifying autofocuses the editor.                                                             | `false`
`autoSave()`          | `int`            | Returns a new instance specifying autosaves the editor.                                                               | `1000`
`cols()`              | `int`            | Returns a new instance specifying maximum number of characters per line of text for the UA to show.                   | `20`
`environmentAsset()`  | `string`         | Returns a new instance specifying the environment asset. Values allowed: `Cdn`, `Dev` and `Prod`.                     | `Prod`
`forceSync()`         | `bool`           | Returns a new instance specifying force text changes made in SimpleMDE to be immediately stored in original textarea. | `false`
`hideIcons()`         | `array`          | Returns a new instance specifying an array of icon names to hide. Can be used to hide specific icons shown by default without completely customizing the toolbar. | `[]`
`indentWithTabs()`    | `bool`           | Returns a new instance specifying indent using spaces instead of tabs.                                                | `true`
`initialValue()`      | `mixed`          | Returns a new instance specifying the initial value of the editor.                                                    | `''`
`lineWrapping()`      | `bool`           | Returns a new instance specifying disable line wrapping.                                                              | `false`
`option()`            | `(string,mixed)` | Returns a new instance specifying the options for the editor.                                                         | `[]`
`placeholder()`       | `string`         | Returns a new instance specifying the placeholder text to display when the editor is empty.                           | `''`	
`promptURLs()`        | `bool`           | Returns a new instance that specifies whether a JS alert window requests the image URL or link.                       | `false`
`rows()`              | `int`            | Returns a new instance specifying the number of lines of text for the UA to show.                                     | `1`
`showIcons()`         | `array`          | Returns a new instance specifying the icons to show in the toolbar.                                                   | `[]`
`spellChecker()`      | `bool`           | Returns a new instance specifying whether spell checking is enabled.                                                  | `false`
`styleSelectedText()` | `bool`           | Returns a new instance specifying whether to style the selected text.                                                 | `false`
`tabSize()`           | `int`            | Returns a new instance specifying the tab size.                                                                       | `2`
`toolbar()`           | `array`          | Returns a new instance specifying the toolbar configuration.                                                          | `See below`
`toolbarTips()`       | `bool`           | Returns a new instance specifying whether to show tooltips for toolbar buttons.                                       | `false`
`webView()`           | `WebView`        | Returns a new instance specifying the web view.                                                                       | `null`
`wrap()`              | `string`         | Returns a new instance specifying instructs the UA to add no line breaks to the submitted value of the textarea.      | `'hard'`

#### Default toolbar

```php
[
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
```
