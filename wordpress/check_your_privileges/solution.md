The snippet of code is taken from the Social Warfare plugin, and it's vulnerable to unauthenticated RCE.

To quote Wordfence's blog post (which you can check here: https://www.wordfence.com/blog/2019/03/recent-social-warfare-vulnerability-allowed-remote-code-execution/) on the vulnerability:
The intent of this code was to parse a remote text document into a `key->value` array of options for the plugin to use. However, instead of using a typical data storage format like a serialized string or (preferably) JSON, the plugin generated options as an actual block of PHP code, which is crunched by eval() into an array.

```
$options = file_get_contents($_GET['swp_url'] . '?swp_debug=get_user_options');
...
try {
    $fetched_options = eval( $array );
}
```

When a malicious injection matches the format used by the plugin normally, as in the attack campaigns running currently, an XSS payload can be injected into one or more of those settings. However, the contents of `<pre>` tags in the remote file are arbitrarily passed to `eval()`, meaning the code within is executed directly as PHP.

A basic example of a remote payload demonstrating PHP execution.
`<pre>phpinfo();</pre>`

A note on using `is_admin()` (taken from https://developer.wordpress.org/reference/functions/is_admin/):
Does not check if the user is an administrator; use current_user_can() for checking roles and capabilities.
