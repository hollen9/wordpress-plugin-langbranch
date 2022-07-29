=== Plugin Name ===
Requires PHP: 7.4
Tested up to: 6.0.1
Stable tag: 1.0.1
Tags: shortcode,language,translate,locale,translatepress,translation
Donate link: https://buymeacoffee.com/hollen9
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

It's a simple plugin enable you to use a shortcode like below to display correspond language version of content based on get_locale().
== Description ==

# What is LangBranch
It's a simple plugin enable you to use a shortcode like below to display correspond language version of content based on `get_locale()`.
```php
[langbranch aio en_US="English version" en_GB="en_US" zh_TW="中文版本" ja_JP="日本語バージョン"]

[langbranch en_US]
Content here will only be displayed if get_locale() returns "en_US".
[/langbranch]
[langbranch en_US zh_TW]
Content here will only be displayed if get_locale() returns "en_US" or "zh_TW".
[/langbranch]
```

# Motivation
I've been using TranslatePress to provide multi locale experience for visiters.
However, I had been suffering from losting translated content once I update original language's content, until I decided to create a simple shortcode to solve this problem.

# Usages
## AIO (1-liner) Mode
```php
[langbranch aio en_US="English version" en_GB="en_US" zh_TW="中文版本" ja_JP="日本語バージョン"]
```
By appending `aio` after langbranch main tag, you can setup one specific paragraph in several languages, and if you decide that some locale user to share the same language, you can just type the locale code you want to refer to directly in content. For example, you can make UK version the same as US version.

However, if LangBranch go too deep (chain over 5 stacks) it will fail.
Don't do this:
`--1---||---2---||---3---||---4---||---5---||---6---> Oh no!`
`en_US -> en_GB -> en_AU -> en_HK -> zh_TW -> ja_JP`

## Seperate Mode
```php
[langbranch en_US]
Content here will only be displayed if get_locale() returns "en_US".
[/langbranch][langbranch en_US zh_TW]
Content here will only be displayed if get_locale() returns "en_US" or "zh_TW".
這裡的內容，只有當 get_locale() 回傳 "en_US" 或 "zh_TW" 才會顯示。
[/langbranch]
```
Very straight forward, isn't?
But when using several shortcodes, I would suggest you don't put a linebreak between `[/langbranch]` and `[langbranch]`, in order to prevent unwanted linebreak `<br>` being rendered.

# Optional step
All contents enclosed by `[langbranch]` will be rendered enclosed by `<div class="langbranch"></div>`
So if you are using auto machine translating like TranslatePress offers, you may want to exclude all selector `.langbranch`.

# Recaps
What this "plugin" do is very simple, it doesn't has access to either filesystem or database.

However, you still have chance to encounter some issues while using it.
For the worst case, it breaks your site up if script produce error.
If that happen, do not be panic!
Just go to your `wp-content/plugins` directory and delete `langbranch` and you shall be fine.

# Links

[Visit Github repo](https://github.com/hollen9/wordpress-plugin-langbranch) for issues tracking and reporting.
[Visit hollen9.com](https://hollen9.com/plugin-langbranch-shortcode/) for latest updates and thoughts.
[Buy me a coffee](https://buymeacoffee.com/hollen9) for supporting my works. 

== Changelog ==

= 1.01 =
* Check array's key before accessing it in order to avoid PHP notice message.

= 1.0 =
* Init push