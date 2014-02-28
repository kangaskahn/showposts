ShortPosts
=========

A simple Wordpress function with short-code that grabs certain categories of posts for display on pages, posts, or templates. Feel free to edit, modify, submit changes, etc.

Shortcode allowing the display of posts in a certain category. An easy way of interacting with WP_Query for non-developers.

Example:

```
[showposts count="2" category="news"]
```

Refer to the [WordPress Codex page on WP_Query](http://codex.wordpress.org/Class_Reference/WP_Query).

#### Options:

`category`
: the name/slug of the category you wish to display.
:Now allows for category slug name or category IDs separated by commas with no spaces. `category="1,2,3"` or `category="news,events,stats"`
: Default is none.

`count`
: the amount of posts you wish to display.
: Default is `-1`, for unlimited posts.

`excerpt`
: Set to false to hide the excerpt.
: Default is true.

`orderby`
: Order posts by one of the [WP_Query `orderby` params](http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters).
: Default is 'date'.

`order`
: Ascending ('ASC') or descending ('DESC').
: Default is 'DESC'.

`postdate`
: Set to false to hide the date.
: Default is true.

`showcategories`
: Set to true to display the categories at the bottom of the post, with links.
: Example: "News, Events, Products"

`titleonly`
: Set to true to only show the title
: Default is false.

###Have fun!
----

####To-do:

- Ability to add category ID's instead of *only* names
- Allow for the construction of more pylons


####Updates:

- Upgraded this help doc (with *much* help from [montchr](https://github.com/montchr))
- Added new parameters: 
    - `showcategories` : true/false
        - Displays the current categories the post is in.
        - Default is false.
    - Changed the listmode `shortcode` to `titleonly`.
        - If `titleonly` is set to true, it will only display the title, **still as divs though**!
        - Default is false.
- Changed the name to ShortPosts
- Made the code cleaner (with more help from [montchr](https://github.com/montchr))
- **Now Depricated** :: Added a `filtermode` which prints the category slugs as classes in the div conatining the post. This [allows for filtering via jQuery](http://stackoverflow.com/a/16149592)


####Done:

- Adding a better documentation
- Fix date and post date (does there need to be two?!)

