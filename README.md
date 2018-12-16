Weldyn2 Extensions
==================

This is a collection of custom [phpBB][1] extensions used on the official
[Battle for Wesnoth forums][2]. These extensions are designed to work with
phpBB 3.2.0 and later phpBB 3.2.x versions.

[1]: <https://www.phpbb.com/>
[2]: <https://forums.wesnoth.org/>

Some functionality is still hardcoded in the form of direct modifications to
the phpBB codebase until upstream adds the required functionality for porting
them to the extensions framework. These modifications can be found as part of
the commit history of the [Weldyn2][3] repository.

[3]: <https://github.com/shikadiqueen/weldyn2>

**NOTE:** These extensions have not been submitted to the phpBB extensions
database for review, and they are provided here for reference purposes only
without any form of warranty or technical support. We cannot guarantee that they
will not break your forum board or that they do not unintentionally introduce
new security vulnerabilities. **USE AT YOUR OWN RISK.**


List of extensions by directory
-------------------------------

 * `privatemessageip/` (Private Message Sender IP):
   Adds an IP field to the profile display on UCP private message views
   including the author's IP, to make this information readily available to
   moderators and administrators without having to report the PM first.
 * `profilewesnothd/` (Wesnoth MP Profile Info):
   Enables the last MP server join time to be displayed for each account where
   available and allowed by the account settings/the current viewing user's
   permissions.
 * `profileregistrationip/` (Profile Registration IP):
   Enables administrators with the Can Manage Users permission to see the IP
   address a user registered with on their profile page.
 * `registrationage/` (Registration Age):
   Very crude extension that adds age restriction language to the registration
   terms page.
 * `registrationchallenge/` (Registration Challenge):
   Adds an extra confirmation field to the user registration page requiring
   them to type three characters from their username and email address. This is
   meant as a very lazy additional anti-spambot measure.
 * `ruleslink/` (Rules Link):
   Adds a link to the forum board's rules (Posting Guidelines) to the navbar,
   allowing the topic id to be set in the ACP.
 * `signaturelinecap/` (Signature Line Cap):
   Implements a line count limit for user signatures.
 * `wesmere/` (Wesmere Site Integration):
   Adds the [Wesmere][5] site navigation bar at the top of the forums,
   replacing the built-in search box provided by prosilver-compatible styles.

[4]: https://www.phpbb.com/customise/db/extension/ban_hammer_2/
[5]: https://github.com/wesnoth/wesmere/
