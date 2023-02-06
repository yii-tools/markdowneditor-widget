<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Asset\Npm;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Asset bundle for the MarkDownEditor widget.
 */
final class MarkDownEditorMinAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/simplemde';
    public array $css = ['dist/simplemde.min.css'];
    public array $js = ['dist/simplemde.min.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**dist/simplemde.min.css',
                '**dist/simplemde.min.js',
            ),
        ];
    }
}
