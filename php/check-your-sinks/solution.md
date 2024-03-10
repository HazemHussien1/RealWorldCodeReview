# Solution

The vulnerability is a PHP Filter Injection vulnerability.

The vulnrability lies in the code that takes in user input from the header `Content-Dir` and uses it as the base for the directory to include the file `bypasser.php` from.
```
    define('BMI_ROOT_DIR', $fields['content-dir']);
    define('BMI_INCLUDES', BMI_ROOT_DIR . 'includes');
    ...

    require_once BMI_INCLUDES . '/bypasser.php';
```

The Wordpress plugin Backup Migration was vulnerable to this exact vulnerability a few months ago, here's a blog post (that i wrote) analyzing the vulnerability and the fix for it: 
https://hazemhussien99.wordpress.com/2023/12/17/analysis-poc-for-cve-2023-6553/

Here's the original Wordfence report https://www.wordfence.com/blog/2023/12/critical-unauthenticated-remote-code-execution-found-in-backup-migration-plugin/
