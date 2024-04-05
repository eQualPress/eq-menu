# eQual - Menu

Contributors: (this should be a list of wordpress.org userid's)

Tags: comments, spam

Requires at least: 4.5

Tested up to: 6.5

Requires PHP: 7.3

Stable tag: 0.1.0

License: GPLv2 or later

License URI: https://www.gnu.org/licenses/gpl-2.0.html

A plugin that adds a menu to the admin bar.

## Description

This plugin adds a menu to the admin bar.
Menus refers to eQual entities that are used.

### Features

- Add a menu to the admin bar

### Usage

call the function `eq_add_menu` in your theme or plugin to add a menu to the admin bar.

```php
eq_add_menu(
    array | string  $menu_id,
    string          $page_title,
    string          $menu_title,
    string          $capability,
    string          $icon_url = ''
);
```

## Installation

1. Upload `eq-menu.zip` to the `/wp-content/plugins/` directory or by WordPress plugin manager
2. Activate the plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

## Screenshots

![](C:\wamp64\www\equal\public\wp-content\plugins\eq-menu\doc\images\poster.png)

## Changelog

= 1.0 =

- A change since the previous version.
- Another change.

= 0.5 =

- List versions from most recent at top to oldest at bottom.

## Upgrade Notice

## Arbitrary section

