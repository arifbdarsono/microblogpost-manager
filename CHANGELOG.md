# Changelog

All notable changes to this project will be documented in this file.  
This project adheres to [Semantic Versioning 2.0.0](https://semver.org/).

## [0.1.0] – 2025-05-24
### Added
- Initial release of the “Microblogpost Manager” project.
- Basic folder structure: `src/`, `includes/`, `templates/`, `data/`.
- `Post` and `Blog` classes for managing blog posts (add, edit, delete).
- Add/Edit Post form and post listing on index page.
- Input sanitization and output escaping to prevent XSS.
- CSRF protection using token validation.
- JSON file-based storage (`data/posts.json`).
- Modular layout with template files (`form.php`, `post_list.php`).
- Basic styling and structure compatible with PHP 7.0+.
