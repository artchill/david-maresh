# davidmareshbook.com

Author website for **Dr. Robert David Maresh** and his memoir *Sins of the Father: How I Overcame the Effects of Incest—More or Less*. Designed and developed for Olympus Story House.

## Pages
`index.html` (Home) · `author.html` · `book.html` · `reviews.html` · `contact.html` · `404.html`
Clean URLs (no `.html`) and HTTPS/non-www redirects are handled by `.htaccess`.

## Contact form
`contact.html` posts to `contact-send.php`, which emails **davidmaresh@msn.com** and **paul.finch@olympusstoryhouse.com** (edit the `$recipients` list at the top of the file). It includes a honeypot field and a per-IP throttle.

## Deploy (GitHub Actions to SiteGround FTP)
Pushing to `main` runs `.github/workflows/deploy.yml`. Repo secrets required:
`FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`, `FTP_DIR`.
`FTP_DIR` is the target folder as seen by the FTP account, e.g. `/davidmareshbook.com/public_html/` (or `./` if the FTP account is already limited to public_html).

## Styling
`assets/css/style.css` is built from `src/input.css` + `tailwind.config.js` and is committed, so no build runs on deploy. To rebuild after changing classes: `npm install` then `npm run build:css`.

## Content notes
Crisis-line numbers (988, RAINN) appear in the content note, contact page and footer. Confirm with the author and publisher.
