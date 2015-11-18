1. Remove AppBundle

2. Add new Bundle

3. NAMESPACES:
Route class namespace for using annotation routing. @Route("/controller/action")
Response class namepspace for responses.
NOTE: Autocomplete add namespaces instead of me. \m/
      Shortcut: alt + enter, for importing namespace.

4.Debug: app_dev.php/route/to/action vs /route/to/action

What's the app_dev.php in the URL?
         Great question! By including app_dev.php in the URL, you're executing Symfony through a
         file - web/app_dev.php - that boots it in the dev environment. This enables great debugging
         tools and rebuilds cached files automatically. For production, you'll use clean URLs - like
         http://localhost:8000/lucky/number - that execute a different file - app.php - that's optimized
         for speed. To learn more about this and environments, see Environments.

5. TWIG: The easiest way to use Twig - or many other tools in Symfony - is to extend Symfony's base Controller class:

-------------------------------------------------------------------------------------
Read/practice about:
1. namespaces
2. json encode/decode
3. Implode() http://www.w3schools.com/php/showphp.asp?filename=demo_func_string_implode