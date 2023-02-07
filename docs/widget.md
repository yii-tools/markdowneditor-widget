## Usage widget

The widget is a wrapper for the [SimpleMDE](https://simplemde.com/) editor. The assets are registered in the view automatically when the widget is used.

### Example of usage simple

```php
<?php

declare(strict_types=1);

use Yii\MarkDownEditor\MarkDownEditor;
?>

<?= MarkDownEditor::widget([$form, 'message'])
    ->autoFocusEditor()
    ->autoSave(2000)
    ->initialValue('Write your message here...')
?>
```

### Example of usage with Field::class

```php
<?php

declare(strict_types=1);

use Yii\MarkDownEditor\MarkDownEditor;
?>

<?= Field::widget([MarkDownEditor::widget([$form, 'message'])])
    ->containerClass('mt-3')
    ->notLabel()
?>
```

### Methods

All methods are available on the widget instance.

Method               | Description                                              | Default
---------------------|----------------------------------------------------------|---------
`autoFocusEditor()`  | Returns a new instance specifying autofocuses the editor.| `false`
`autoSave()`         | Returns a new instance specifying autosaves the editor.  | 1000
`cols()`             | Returns a new instance specifying maximum number of characters per line of text for the UA to show. | `20`
`environmentAsset()` | Returns a new instance specifying the environment asset. Values allowed: `Cdn`, `Dev` and `Prod`. | `Prod`
`forceSync()`        | Returns a new instance specifying force text changes made in SimpleMDE to be immediately stored in original textarea. | `false`
`hideIcons()`        | Returns a new instance specifying an array of icon names to hide. Can be used to hide specific icons shown by default without completely customizing the toolbar. | `[]`
`indentWithTabs()`   | Returns a new instance specifying indent using spaces instead of tabs. | `true`
`initialValue()`     | Returns a new instance specifying the initial value of the editor. | `''`
`lineWrapping()`     | Returns a new instance specifying disable line wrapping. | `false`
`options`            | Returns a new instance specifying the options for the editor. | `[]`
`placeholder()`      | Returns a new instance specifying the placeholder text to display when the editor is empty. | `''`	
`promptURLs()`       | Returns a new instance that specifies whether a JS alert window requests the image URL or link. | `false`
`rows()`             | Returns a new instance specifying the number of lines of text for the UA to show. | `1`
`showIcons()`        | Returns a new instance specifying the icons to show in the toolbar. | `[]`
`spellChecker()`     | Returns a new instance specifying whether spell checking is enabled. | `false`
`styleSelectedText`  | Returns a new instance specifying whether to style the selected text. | `false`
`tabSize()`          | Returns a new instance specifying the tab size. | `2`
`toolbar()`          | Returns a new instance specifying the toolbar configuration. | `See below`
`toolbarTips()`      | Returns a new instance specifying whether to show tooltips for toolbar buttons. | `false`
`wrap()`             | Returns a new instance specifying instructs the UA to add no line breaks to the submitted value of the textarea. | `''`


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
