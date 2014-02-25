ShowPosts
=========

A simple Wordpress function with short-code that grabs certain categories of posts for display on pages, posts, or templates. Feel free to edit, modify, submit changes, etc.

Instructions
============

Take the contents of the show-posts.php file and place inside of the functions.php of your WordPress theme. Remember to remove the <?php ?> tags around the script! (It depends on where you place it)


Have fun!
---------



To-do:

- Adding a better documentation
- Fix date and post date (does there need to be two?!)
- Ability to add category ID's instead of *only* names
- Allow for the construction of more pylons

Updates:
--------

- Added a *filtermode* which prints the category slugs as classes in the div conatining the post. This [allows for filtering via jQuery](http://stackoverflow.com/a/16149592)
