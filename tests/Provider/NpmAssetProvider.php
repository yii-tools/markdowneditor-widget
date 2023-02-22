<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests\Provider;

use Yii\MarkDownEditor\Asset;

final class NpmAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public static function assetBundles(): array
    {
        return [
            [
                'Css',
                Asset\MarkDownEditorDevAsset::class,
            ],
            [
                'Js',
                Asset\MarkDownEditorDevAsset::class,
            ],
            [
                'Css',
                Asset\MarkDownEditorProdAsset::class,
            ],
            [
                'Js',
                Asset\MarkDownEditorProdAsset::class,
            ],
        ];
    }
}
