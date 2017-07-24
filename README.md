### For Everyone

This is a set of answers to a tech test originally posed at https://github.com/netsells/RomanNumerals-API

This is not suitable for any kind of use, I do not suggest cloning or otherwise using this repository. By line count 95.16% of this is `not my own code` but rather comes from upstream.

### For NetSells

I have removed Artisan to prevent a `did not read` infosec fail.

I have added the SQL file _database/roman.sql_ rather than creating a database migration. Bridging the gap between DevOps and Dev is sometimes difficult to justify, but this is a very useful approach to database methodology when building stateless microservices at scale.

The three endpoint URLs are:
```
/convert/{id}/roman
/top/10
/last/10
```

### Security considerations

It should be pointed out that if you are using the wrong version of `PHP < 5.6.0` then there is one major XSS injection site, and an interesting one in two of the three routes:
```
\x27\x10\x27 ** 9800 + \x00 + Meterpreter code (PHP)
```
If you are using `PHP < 5.1.5` then more or less everything is an XSS, SQLI, ReDoS and even LFI goldmine.

If you are using `PHP > 7.0.0` it is reasonably well secured by the regex in the routes.
