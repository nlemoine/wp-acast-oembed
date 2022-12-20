<?php

/**
 * Plugin Name:       Acast oEmbed provider
 * Plugin URI:        https://github.com/nlemoine/wp-acast-oembed
 * Description:       Add Acast oEmbed provider
 * Version:           0.1.0
 * Requires at least: 5.5
 * Requires PHP:      7.4
 * Author:            Nicolas Lemoine
 * Author URI:        https://github.com/nlemoine
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-acast-oembed
 * Domain Path:       /languages
 */

namespace n5s\AcastOembed;

const ACAST_PROVIDER_URL = 'https://embed.acast.com/$1';

\wp_oembed_add_provider('#https?://(.+\.)?acast\.com/.*#i', namespace\ACAST_PROVIDER_URL, true);

/**
 * Get versioned asset name
 *
 * @param string $asset
 * @return string|null
 */
function get_asset(string $asset): ?string
{
    $plugin_path = \untrailingslashit(\plugin_dir_path(__FILE__));
    $manifest_path = $plugin_path . '/assets/dist/manifest.json';
    if (\is_file($manifest_path) && \is_readable($manifest_path)) {
        $manifest = \json_decode(\file_get_contents($manifest_path), true);
        return $manifest[$asset] ?? null;
    }
    return null;
}

/**
 * Get asset url
 *
 * @param string $asset
 * @return string|null
 */
function get_asset_url(string $asset): ?string
{
    $plugin_url = \untrailingslashit(\plugin_dir_url(__FILE__));
    $asset_versioned = get_asset($asset);
    return $asset_versioned ? \sprintf('%s/assets/dist/%s', $plugin_url, $asset_versioned) : null;
}

/**
 * Get asset path
 *
 * @param string $asset
 * @return string
 */
function get_asset_path(string $asset): ?string
{
    $plugin_path = \untrailingslashit(\plugin_dir_path(__FILE__));
    $asset_versioned = get_asset($asset);
    return $asset_versioned ? \sprintf('%s/assets/dist/%s', $plugin_path, $asset_versioned) : null;
}

/**
 * Add acast embed variation
 *
 * @return void
 */
function add_acast_embed_variation(): void
{
    $asset_path = get_asset_path('acast.php');
    $asset_url = get_asset_url('acast.js');
    if (!$asset_path || !$asset_url) {
        return;
    }

    if (!\is_file($asset_path)) {
        return;
    }

    $asset_args = require $asset_path;

    \wp_enqueue_script(
        'acast-embed-variation',
        $asset_url,
        $asset_args['dependencies'] ?? [],
        null
    );
}
\add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\\add_acast_embed_variation');
