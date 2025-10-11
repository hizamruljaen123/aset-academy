<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Text Helper Functions
 * Provides utility functions for text processing and HTML handling
 */

/**
 * Decode HTML entities and return clean HTML
 * This function properly decodes HTML entities including double-encoded ones
 *
 * @param string $text The text to decode
 * @param bool $allow_html Whether to allow HTML tags or strip them
 * @return string The decoded text
 */
function decode_html_entities($text, $allow_html = true)
{
    if (empty($text)) {
        return '';
    }

    // First decode HTML entities
    $decoded = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // If the result still contains encoded entities, decode again
    if (strpos($decoded, '&') !== false && strpos($decoded, ';') !== false) {
        $decoded = html_entity_decode($decoded, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    // If HTML is not allowed, strip tags
    if (!$allow_html) {
        $decoded = strip_tags($decoded);
    }

    return $decoded;
}

/**
 * Safely render HTML content with proper decoding
 * This function handles double-encoded HTML entities and renders clean HTML
 *
 * @param string $content The HTML content to render
 * @param array $options Options for rendering (strip_tags, max_length, etc.)
 * @return string The rendered HTML content
 */
function render_html_content($content, $options = [])
{
    $defaults = [
        'strip_tags' => false,
        'max_length' => null,
        'add_ellipsis' => true
    ];

    $options = array_merge($defaults, $options);

    // Decode HTML entities
    $decoded = decode_html_entities($content, !$options['strip_tags']);

    // Apply length limit if specified
    if ($options['max_length'] && mb_strlen($decoded) > $options['max_length']) {
        $decoded = mb_substr($decoded, 0, $options['max_length']);
        if ($options['add_ellipsis']) {
            $decoded .= '...';
        }
    }

    return $decoded;
}

/**
 * Create a safe HTML excerpt from content
 * Useful for meta descriptions or preview text
 *
 * @param string $content The full content
 * @param int $max_length Maximum length of excerpt
 * @return string The excerpt with HTML stripped
 */
function create_html_excerpt($content, $max_length = 150)
{
    // First decode HTML entities
    $decoded = decode_html_entities($content, false);

    // Create excerpt
    if (mb_strlen($decoded) > $max_length) {
        $excerpt = mb_substr($decoded, 0, $max_length);
        $excerpt .= '...';
    } else {
        $excerpt = $decoded;
    }

    return $excerpt;
}

/**
 * Check if text contains HTML tags
 *
 * @param string $text The text to check
 * @return bool True if contains HTML tags
 */
function contains_html($text)
{
    return $text !== strip_tags($text);
}

/**
 * Convert special characters to HTML entities (opposite of decode_html_entities)
 *
 * @param string $text The text to encode
 * @return string The encoded text
 */
function encode_html_entities($text)
{
    return htmlentities($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
