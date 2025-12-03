This folder holds site-wide CSS files for the CCE website.

Cache-busting
--
During active development we append a simple version token to CSS links in `header.php`, for example `?v=20250925.2`.
When updating CSS files, bump this token so browsers fetch the latest assets. In CI you may prefer a hash of the file contents.

Intentional `!important` uses
--
There are a few intentional `!important` declarations in the codebase:

- The `.sr-only` accessibility helper (in `global.css`) uses `!important` on multiple properties to guarantee elements are visually hidden while remaining available to screen readers. This is a standard and intentional pattern.
- There is one comment in `index.css` noting an intentional use of `!important` to override legacy component-level color rules inside cards. If you want to remove that `!important`, refactor the legacy rules' specificity instead.

If you prefer zero `!important` in the repo, I can audit and refactor these cases, but the accessibility helper should remain functionally equivalent after a careful refactor.
