# Commit Convention Guide

This project follows [Conventional Commits](https://www.conventionalcommits.org/) for all git commits. This ensures clear, semantic commit messages that are easy to parse and understand.

## Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

## Type

Must be one of the following:

- **feat**: A new feature
- **fix**: A bug fix
- **docs**: Documentation only changes
- **style**: Changes that don't affect code meaning (formatting, missing semicolons, etc.)
- **refactor**: A code change that neither fixes a bug nor adds a feature
- **perf**: A code change that improves performance
- **test**: Adding or updating tests
- **chore**: Changes to build process, dependencies, or tooling
- **ci**: Changes to CI configuration files
- **revert**: Reverts a previous commit

## Scope (Optional)

The scope specifies what part of the codebase is affected. Examples:
- `api`: Changes to REST API
- `dashboard`: Dashboard UI changes
- `optimizer`: Image optimization engine
- `settings`: Settings page
- `core`: Core plugin functionality

## Subject

- Use imperative mood ("add" not "added" or "adds")
- Don't capitalize first letter
- No period (.) at the end
- Limit to 50 characters
- Be specific and descriptive

## Body (Optional)

- Explain **what** and **why**, not how
- Wrap at 72 characters
- Separate from subject with a blank line
- Use bullet points for multiple changes

## Footer (Optional)

- Reference issues: `Fixes #123`, `Closes #456`
- Breaking changes: `BREAKING CHANGE: description`

## Examples

### Good Commits

```
feat(api): add REST endpoint for image statistics

- Implements GET /wp-json/image-optimizer/v1/stats
- Returns total images, optimization status, and savings
- Includes proper permission checks

Fixes #15
```

```
fix(dashboard): correct image URL generation for WebP files

The dashboard was displaying broken image links for WebP
optimized images due to missing URL transformation.

Closes #23
```

```
docs: update README with installation instructions
```

```
perf(optimizer): reduce memory usage in batch operations
```

### Bad Commits

```
fix bugs  # No type, vague
```

```
FEAT(API): Add new feature  # Wrong case, capitalized
```

```
fix: updated the thing  # Wrong tense
```

## Setup Commit Linting

To enable automatic commit message validation:

```bash
npm install
npm run setup-hooks
```

This will:
1. Install commitlint and husky
2. Set up git hooks to validate commit messages before they're accepted

## Validate Manually

To check if a commit message is valid:

```bash
npx commitlint --edit <commit-message-file>
```

## Benefits

- 📖 Clear, readable commit history
- 🔍 Easy to search for specific changes
- 🤖 Enables automated changelog generation
- 📊 Better for understanding project evolution
- 🔗 Integrates well with CI/CD pipelines
