<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests\Provider;

use Yii\MarkDownEditor\Asset\MarkDownEditorCdnAsset;

final class CdnAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public static function assetBundles(): array
    {
        return [
            [
                'Css',
                MarkDownEditorCdnAsset::class,
            ],
            [
                'Js',
                MarkDownEditorCdnAsset::class,
            ],
        ];
    }
}
