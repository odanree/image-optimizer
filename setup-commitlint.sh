#!/bin/bash
# Install commitlint and husky for commit message linting
# Run this once to set up git hooks

# Install dependencies
npm install --save-dev @commitlint/config-conventional @commitlint/cli husky

# Initialize husky
npx husky install

# Add commit-msg hook
npx husky add .husky/commit-msg 'npx --no -- commitlint --edit "$1"'

echo "✅ Commit linting set up successfully!"
echo "Conventional commits are now enforced on all commits."
