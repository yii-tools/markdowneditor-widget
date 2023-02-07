<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Dev asset bundle for the MarkDownEditor widget.
 */
final class MarkDownEditorDevAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/simplemde/src';
    public array $css = ['css/simplemde.css'];
    public array $js = ['js/simplemde.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**css/simplemde.css',
                '**js/simplemde.js',
            ),
        ];
    }
}
