# What is LangBranch
It's a simple plugin enable you to use a shortcode like below to display correspond language version of content based on `get_locale()`.
```php
［langbranch aio en_US="English version" en_GB="en_US" zh_TW="中文版本" ja_JP="日本語バージョン"］

［langbranch en_US］
Content here will only be displayed if get_locale() returns "en_US".
［/langbranch］
［langbranch en_US zh_TW］
Content here will only be displayed if get_locale() returns "en_US" or "zh_TW".
［/langbranch］
```

# Motivation
I've been using TranslatePress to provide multi locale experience for visiters.
However, I had been suffering from losting translated content once I update original language's content, until I decided to create a simple shortcode to solve this problem.

# Usages
## AIO (1-liner) Mode
```php
［langbranch aio en_US="English version" en_GB="en_US" zh_TW="中文版本" ja_JP="日本語バージョン"］
```
By appending `aio` after langbranch main tag, you can setup one specific paragraph in several languages, and if you decide that some locale user to share the same language, you can just type the locale code you want to refer to directly in content. For example, you can make UK version the same as US version.

However, if LangBranch go too deep (chain over 5 stacks) it will fail.
Don't do this:
`--1---||---2---||---3---||---4---||---5---||---6---> Oh no!`
`en_US -> en_GB -> en_AU -> en_HK -> zh_TW -> ja_JP`

## Seperate Mode
```php
［langbranch en_US］
Content here will only be displayed if get_locale() returns "en_US".
［/langbranch］［langbranch en_US zh_TW］
Content here will only be displayed if get_locale() returns "en_US" or "zh_TW".
這裡的內容，只有當 get_locale() 回傳 "en_US" 或 "zh_TW" 才會顯示。
［/langbranch］
```
Very straight forward, isn't?
But when using several shortcodes, I would suggest you don't put a linebreak between `［/langbranch］` and `［langbranch］`, in order to prevent unwanted linebreak `<br>` being rendered.

# Optional step
All contents enclosed by `［langbranch］` will be rendered enclosed by `<div class="langbranch"></div>`
So if you are using auto machine translating like TranslatePress offers, you may want to exclude all selector `.langbranch`.

# Recaps
What this "plugin" do is very simple, and you may encounter some issues while using it.
For the worst case, it breaks your site up.
If that happen, fear not, just go to your `wp-content/plugins` directory and delete `langbranch` and you shall be fine.