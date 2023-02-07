<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Cdn asset bundle for the MarkDownEditor widget.
 */
final class MarkDownEditorCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $css = ['https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css'];
    public array $js = ['https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js'];
}
